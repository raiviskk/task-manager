# Task Manager

Task Manager is a simple web application for managing tasks. It allows users to view, create, and delete tasks.

## Table of Contents

It requires PHP 7.4 and MySQL 8.0 or higher.

- [Installation](#installation)
- [Usage](#usage)
- [Features](#features)


## Installation

1. Clone the repository:

   git clone https://github.com/raiviskk/task-manager.git

2. Install dependencies:

   composer install

3. Set up your environment variables:

   Create a .env file based on .env.example and fill in the required configuration.

4. Initialize the database:

   mysqladmin create task_manager

   ./vendor/bin/doctrine-migrations migrate
   

## Usage

Run the built-in PHP server:

1. php -S localhost:8000 -t public

2. Visit http://localhost:8000 in your web browser.

## Features

1. View a list of tasks
2. Create a new task
3. View details of a specific task
4. Delete a task

![Screenshot](https://github.com/raiviskk/task-manager/blob/main/demo/Screenshot%201.png)
![Screenshot](https://github.com/raiviskk/task-manager/blob/main/demo/Screenshot%202.png)
![Screenshot](https://github.com/raiviskk/task-manager/blob/main/demo/Screenshot%203.png)
  
   
   

