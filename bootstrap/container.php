<?php


use App\Repositories\TaskRepository;
use App\Repositories\MySQLTaskRepository;

use function DI\create;

// DI container configuration
return [
    TaskRepository::class => create(MySQLTaskRepository::class),
];
