<?php

namespace App\Repositories;

abstract class BaseRepository
{
    protected $query;

    public abstract function getByID($id);
    public abstract function filter($conditions);
    public abstract function create($data);
    public abstract function update($data);
}