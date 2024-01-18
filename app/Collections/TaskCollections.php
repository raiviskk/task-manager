<?php

declare(strict_types=1);

namespace App\Collections;

use App\Models\Task;

class TaskCollections
{
    private array $tasks = [];

    public function __construct(array $tasks = [])
    {
        foreach ($tasks as $task) {
            if (!$task instanceof Task) {
                continue;
            }
            $this->add($task);
        }

    }

    public function add(Task $task): void
    {
        $this->tasks[] = $task;
    }

    public function getAll(): array
    {
        return $this->tasks;
    }
}