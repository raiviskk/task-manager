<?php

declare(strict_types=1);

namespace App\Services\task;


use App\Repositories\TaskRepository;

class DeleteTaskService
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }


    public function execute(int $id): void
    {
        $task = $this->taskRepository->getById($id);
        if ($task === null) {
            return;
        }
        $this->taskRepository->delete($task);
    }

}