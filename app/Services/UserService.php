<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

/**  
 * @property UserRepositoryInterface $repository
 */
class UserService extends BaseService
{
    public function __construct(UserRepositoryInterface $repository)
    {
        parent::__construct($repository);
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

    public function create(array $data){
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user = $this->repository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'] ?? null,
        ]);

        if (!empty($data['roles'])) {
            $user->roles()->sync($data['roles']);
        } else {
            $viewer = Role::firstOrCreate(['name' => 'viewer']);
            $user->roles()->syncWithoutDetaching([$viewer->id]);
        }

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

        $user = $this->repository->update($user, array_filter([
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'password' => $data['password'] ?? null,
        ]));

        if (array_key_exists('roles', $data)) {
            $roles = is_array($data['roles']) ? $data['roles'] : [];
            $user->roles()->sync($roles);
        }

        return $user;
    }
}