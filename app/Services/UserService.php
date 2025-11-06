<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

/**  
 * @property UserRepositoryInterface $repository
 * @property RoleService $roleService
 */
class UserService extends BaseService
{
    protected $roleService;
    public function __construct(UserRepositoryInterface $repository, RoleService $roleService)
    {
        parent::__construct($repository);
        $this->roleService = $roleService;
    }

    public function getUserByEmail(string $email)
    {
        return $this->repository->findByEmail($email);
    }

    public function getByIdWithRoles($id)
    {
        $user = $this->getById($id);
        $user->load('roles');
        return $user;
    }

    public function create(array $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user = $this->repository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'] ?? null,
        ]);

        $this->syncUserRoles($user, $data['roles'] ?? []);

        return $user;
    }

    public function update($id, array $data)
    {
        $user = $this->repository->find($id);

        if (!$user) {
            return null;
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user = $this->repository->update($id, array_filter([
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'password' => $data['password'] ?? null,
        ]));

        if (array_key_exists('roles', $data)) {
            $this->syncUserRoles($user, $data['roles'] ?? []);
        }

        return $user;
    }

    protected function syncUserRoles($user, array $roleIds)
    {
        if (empty($roleIds)) {
            $defaultRole = $this->roleService->getOrCreateByName('viewer');
            $user->roles()->syncWithoutDetaching([$defaultRole->id]);
        } else {
            $validRoleIds = $this->roleService->validateRoleIds($roleIds);
            $user->roles()->sync($validRoleIds);
        }
    }
}
