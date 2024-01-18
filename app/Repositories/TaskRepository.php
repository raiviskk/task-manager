<?php

namespace App\Repositories;

use App\Collections\TaskCollections;
use App\Models\Task;

interface TaskRepository
{
    public function getById(int $id): ?Task;

    public function getAll(): TaskCollections;

    public function save(Task $task): void;

    public function delete(Task $task): void;
}
