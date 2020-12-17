<?php

namespace app\controllers;

use app\models\todo\Todo;
use core\Request;

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

    public function create()
    {
        return view('create');
    }

    public function returnTodos(): array
    {
        return $this->todo->listTodos();
    }

    public function storage()
    {
        if (is_int($this->todo->saveTodo())) {
            $todos = $this->returnTodos();

            return view('index', ['flash' => 'New todo created!', 'todos' => $todos]);
        }

        $todos = $this->returnTodos();

        return view('index', ['flash' => 'Todo not created!', 'todos' => $todos]);
    }

    public function delete()
    {
        $todoId = intval(Request::extractFromPost('todo-id'));
        $this->todo->deleteTodo($todoId);

        $todos = $this->todo->listTodos();

        return view('index', ['flash' => 'Todo deleted!', 'todos' => $todos]);
    }

    public function edit($params)
    {
        $todo = $this->todo->getTodo($params['todo-id']);

        return view('edit', $todo);
    }

    public function update()
    {
        $todoId = Request::extractFromPost('todo-id');

        $this->todo->update($todoId);
        $todos = $this->todo->listTodos();

        return view('index', ['flash' => 'Todo updated!', 'todos' => $todos]);
    }

    public function statusChange()
    {
        $todoId = Request::extractFromPost('todo-id-completed');
        $this->todo->statusChange($todoId);

        $todos = $this->todo->listTodos();

        return view('index', ['flash' => 'Todo updated!', 'todos' => $todos]);
    }
}
