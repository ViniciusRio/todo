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
        if (is_bool($todos)) {
            return view('index', ['todos' => 'Is not possibly open file']);
        }

        return view('index', compact('todos', $todos));
    }

    public function create()
    {
        return view('create');
    }

    public function returnTodos()
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
        $todos = '';

        if (is_int($this->todo->deleteTodo($todoId))) {
            $todos = $this->returnTodos();

            return view('index', ['flash' => 'Todo deleted!', 'todos' => $todos]);
        }

        $todos = $this->returnTodos();

        return view('index', ['flash' => "{$todos}", 'todos' => $todos]);
    }

    public function edit($params)
    {
        $todo = $this->todo->getTodo($params['todo-id']);
        if (is_bool($todo)) {
            $todos = $this->returnTodos();
            return view('index', ['flash' => 'Todo not found!', 'todos' => $todos]);
        }

        return view('edit', $todo);
    }

    public function update()
    {
        $todoId = Request::extractFromPost('todo-id');
        $todos = '';

        if (is_bool($this->todo->update($todoId))) {
            $todos = $this->returnTodos();

            return view('index', ['flash' => 'Todo failed!', 'todos' => $todos]);
        }

        $todos = $this->returnTodos();

        return view('index', ['flash' => 'Todo updated!', 'todos' => $todos]);
    }

    public function statusChange()
    {
        $todoId = Request::extractFromPost('todo-id-completed');
        $todos = '';
        $status = $this->todo->statusChange($todoId);

        if (is_bool($status)) {
            $todos = $this->returnTodos();

            return view('index', ['flash' => 'Status not update!', 'todos' => $todos]);
        }

        if (is_string($status)) {
            $todos = $this->returnTodos();

            return view('index', ['flash' => $status, 'todos' => $todos]);
        }

        $todos = $this->returnTodos();

        return view('index', ['flash' => 'Todo updated!', 'todos' => $todos]);
    }
}
