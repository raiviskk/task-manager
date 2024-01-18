<?php

declare(strict_types=1);

namespace App\Services\task;

use App\Collections\TaskCollections;
use App\Repositories\TaskRepository;


class IndexTaskService
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }


    public function execute(): TaskCollections
    {
        return $this->taskRepository->getAll();
    }

}