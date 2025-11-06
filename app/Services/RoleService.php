<?php

namespace App\Services;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class RoleService extends BaseService
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        parent::__construct($roleRepository);
    }

    public function getOrCreateByName(string $name)
    {
        return $this->roleRepository->firstOrCreateByName($name);
    } 

    public function validateRoleIds(array $roleIds)
    {
        $roles = $this->roleRepository->findWhereIn($roleIds);
        return $roles->pluck('id')->toArray();
    }
}