<?php

declare(strict_types=1);

namespace App\Services\task;

use App\Models\Task;
use App\Repositories\TaskRepository;


class ShowTaskService
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function execute(int $id): Task
    {
        return $this->taskRepository->getById($id);

    }

}