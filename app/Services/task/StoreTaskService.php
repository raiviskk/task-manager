<?php

declare(strict_types=1);

namespace App\Services\task;


use App\Models\Task;
use App\Repositories\TaskRepository;
use Exception;


class StoreTaskService
{
    private TaskRepository $taskRepository;
    private array $errors = [];

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(string $name, string $description): array
    {

        if (empty($name) || empty($description)) {
            $this->errors[] = 'Name and description are required.';
        }

        if (strlen($name) > 255) {
            $this->errors[] = 'Name must not exceed 255 characters.';
        }

        if (strlen($description) < 10) {
            $this->errors[] = 'Description must be at least 10 characters long.';
        }

        if (!empty($this->errors)) {
            return $this->errors;
        }

        $task = new Task($name, $description);

        try {
            $this->taskRepository->save($task);
        } catch (Exception) {
            $this->errors[] = 'Failed to save the task. Please try again.';

        }

        return [];
    }
}