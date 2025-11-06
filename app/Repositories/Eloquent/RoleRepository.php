<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function firstOrCreateByName(string $name)
    {
        return $this->model->firstOrCreate(['name' => $name]);
    }

    public function findWhereIn(array $ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }
}