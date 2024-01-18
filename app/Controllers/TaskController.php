<?php

declare(strict_types=1);

namespace App\Controllers;


use App\RedirectResponse;
use App\Response;
use App\Services\task\DeleteTaskService;
use App\Services\task\IndexTaskService;
use App\Services\task\ShowTaskService;
use App\Services\task\StoreTaskService;
use App\ViewResponse;

class TaskController
{
    private IndexTaskService $indexTaskService;
    private StoreTaskService $storeTaskService;
    private ShowTaskService $showTaskService;
    private DeleteTaskService $deleteTaskService;

    public function __construct(
        IndexTaskService  $indexTaskService,
        StoreTaskService  $storeTaskService,
        ShowTaskService   $showTaskService,
        DeleteTaskService $deleteTaskService
    )
    {
        $this->indexTaskService = $indexTaskService;
        $this->storeTaskService = $storeTaskService;
        $this->showTaskService = $showTaskService;
        $this->deleteTaskService = $deleteTaskService;
    }

    public function index(): Response
    {

        $taskCollection = $this->indexTaskService->execute();
        return new ViewResponse('tasks/index', ['tasks' => $taskCollection]);
    }


    public function show(int $id): Response
    {

        $task = $this->showTaskService->execute($id);

        return new ViewResponse('tasks/show', ['task' => $task]);
    }

    public function create(): Response
    {
        return new ViewResponse('tasks/create');
    }

    public function store(): Response
    {
        $errors = $this->storeTaskService->execute($_POST['name'], $_POST['description']);

        if (!empty($errors)) {
            return new ViewResponse('tasks/create', ['errors' => $errors]);
        }

        return new RedirectResponse('/');
    }

    public function delete(int $id): RedirectResponse
    {

        $this->deleteTaskService->execute($id);

        return new RedirectResponse('/');
    }
}
