
<?php
use Doctrine\DBAL\DriverManager;

return DriverManager::getConnection([
    'dbname' => 'task_manager',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
]);