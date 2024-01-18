<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Collections\TaskCollections;
use App\Models\Task;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class MySQLTaskRepository implements TaskRepository
{


    private Connection $database;

    public function __construct()
    {

        $connectionParams = [
            'dbname' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
            'host' => $_ENV['DB_HOST'],
            'driver' => $_ENV['DB_DRIVER'],
        ];
        $this->database = DriverManager::getConnection($connectionParams);
    }

    public function getById(int $id): ?Task
    {
        $data = $this->database->createQueryBuilder()
            ->select('*')
            ->from('tasks')
            ->where('id = :id')
            ->setParameter('id', $id)
            ->fetchAssociative();

        if (empty($data)) {
            return null;
        }

        return $this->buildModel($data);

    }

    private function buildModel(array $data): Task
    {
        return new Task(
            $data['task_name'],
            $data['task_description'],
            $data['created_at'],
            $data['id'],
        );
    }

    public function getAll(): TaskCollections
    {
        $tasks = $this->database->createQueryBuilder()
            ->select('*')
            ->from('tasks')
            ->fetchAllAssociative();

        $taskCollection = new TaskCollections();
        foreach ($tasks as $data) {
            $taskCollection->add(
                $this->buildModel($data)
            );
        }
        return $taskCollection;

    }

    public function save(Task $task): void
    {

        $builder = $this->database->createQueryBuilder();

        $builder->insert('tasks')
            ->insert('tasks')
            ->values([
                    'task_name' => ':name',
                    'task_description' => ':description',
                    'created_at' => ':created_at'
                ]
            )->setParameters([
                'name' => $task->getName(),
                'description' => $task->getDescription(),
                'created_at' => $task->getCreatedAt()
            ])->executeQuery();
    }

    public function delete(Task $task): void
    {
        $this->database->createQueryBuilder()
            ->delete('tasks')
            ->where('id = :id')
            ->setParameter('id', $task->getId())
            ->executeQuery();
    }
}