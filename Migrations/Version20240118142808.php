<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240118142808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create tasks table';
    }

    public function up(Schema $schema): void
    {
        $tasksTable = $schema->createTable('tasks');
        $tasksTable->addColumn('id', 'integer', ['autoincrement' => true]);
        $tasksTable->addColumn('task_name', 'string', ['length' => 255]);
        $tasksTable->addColumn('task_description', 'text');
        $tasksTable->addColumn('created_at', 'datetime');
        $tasksTable->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('tasks');
    }
}
