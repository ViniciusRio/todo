<?php

namespace app\models\todo;

class Todo
{
    public function listTodos(): array
    {

        $todoFile = file_get_contents(  DIR_BASE_NAME . '/' . 'todo-list.json');

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

}