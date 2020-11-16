<?php

namespace app\controllers;

use core\Application;
use app\models\todo\Todo;

class TodoController
{
    private Todo $todo;

    public function __construct()
    {
        $this->todo = new Todo();
    }

    public function index()
    {
        $todos = $this->todo->listTodos();

        return view('index', compact('todos', $todos));

    }
}