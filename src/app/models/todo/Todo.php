<?php

namespace app\models\todo;

use core\Request;

class Todo
{
    private string $todoListFile = DIR_BASE_NAME . '/' . 'todo-list.json';

    public function listTodos(): array
    {
        $todoFile = file_get_contents($this->todoListFile);

        return json_decode($todoFile, true);

        // $todoId = intval($_GET['todo-id-edit']);
        // $taskTitle = '';
        // $taskCurrent = '';
//    if ($taskId) {
//        foreach ($tasksJson as $key => $value) {
//            if ($value['id'] === $taskId) {
//                $taskTitle = $key;
//                $taskCurrent = $value;
//            }
//        }
//
//    }
    }

    public function saveTodo()
    {
        $todoTitle = Request::extractFromPost('todo-title') ?? '';
        $isCompleted = Request::extractFromPost('todo-completed') ? true : false;

        $todoTitle = trim($todoTitle);

        if (file_exists($this->todoListFile)) {
            $json = file_get_contents($this->todoListFile);
            $jsonArray = json_decode($json, true);
        } else {
            $jsonArray = [];
        }

        $taskSizePlus = count($jsonArray) + 1;

        $jsonArray[$todoTitle] = ['id' => $taskSizePlus, 'completed' => $isCompleted];

        file_put_contents($this->todoListFile, json_encode($jsonArray, JSON_PRETTY_PRINT));
    }

    public function deleteTodo($todoId)
    {
        $todoFile = file_get_contents($this->todoListFile);
        $todoAssoc = json_decode($todoFile, true);

        foreach ($todoAssoc as $key => $value) {
            if ($value['id'] === $todoId) {
                unset($todoAssoc[$key]);
            }
        }

        file_put_contents($this->todoListFile, json_encode($todoAssoc, JSON_PRETTY_PRINT));
    }

    public function getTodo($todoId): ?array
    {
        $todoContent = file_get_contents($this->todoListFile);
        $todoDecode = json_decode($todoContent, true);

        foreach ($todoDecode as $title => $value) {
            if ($value['id'] === intval($todoId)) {
                $todo = [
                    'id' => $value['id'],
                    'title' => $title,
                    'completed' => $value['completed']
                ];

                return $todo;
            }
        }

        return null;
    }

    public function update($todoId)
    {
        $todoContent = file_get_contents($this->todoListFile);
        $todoDecode = json_decode($todoContent, true);

        foreach ($todoDecode as $title => $value) {
            if ($value['id'] === intval($todoId)) {
                $todoCompleted = Request::extractFromPost('todo-completed');
                $todoTitle = Request::extractFromPost('todo-title');

                $todoDecode[$title]['completed'] = $todoCompleted ? true : false;
                $tasksUpdate = $this->change_key($todoDecode, $title, $todoTitle);

                file_put_contents($this->todoListFile, json_encode($tasksUpdate, JSON_PRETTY_PRINT));
            }
        }
    }

    public function change_key($array, $oldKey, $newKey)
    {
        if (!array_key_exists($oldKey, $array)) {
            return $array;
        }

        $keys = array_keys($array);
        $keys[array_search($oldKey, $keys)] = $newKey;

        return array_combine($keys, $array);
    }
}
