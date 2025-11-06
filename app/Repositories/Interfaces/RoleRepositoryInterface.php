<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface extends BaseRepositoryInterface
{
    public function firstOrCreateByName(string $name);
    public function findWhereIn(array $ids);
}
