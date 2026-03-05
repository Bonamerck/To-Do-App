# PHP To-Do App

Simple project management and task tracking application built with **PHP and MySQLi**.

## Features

- User registration and login
- Create projects
- Add tasks to projects
- Toggle task completion
- Delete tasks
- Delete projects (cascade deletes tasks)
- Secure queries using prepared statements

## Requirements

- PHP 8+
- MySQL
- Apache (XAMPP, MAMP, or Laragon)

## Setup Instructions

1. Clone the repository

git clone https://github.com/yourusername/todo-app.git


2. Move the project into your web server folder

Example (XAMPP):

htdocs/todo-app


3. Create database

Open **phpMyAdmin** and import:

database/todo_app.sql


4. Start Apache and MySQL

5. Open in browser

http://localhost/todo-app/register.php

## Demo Workflow

1. Register a user
2. Login
3. Create a project
4. Add tasks
5. Toggle task completion
6. Delete tasks/projects
