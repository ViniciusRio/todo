<?php

namespace app\models\todo;

use core\Request;
use Throwable;

class Todo
{
    private string $todoListFile = DIR_BASE_NAME . '/' . 'todo-list.json';

    public function listTodos()
    {
        try {
            $todoFileContent = file_get_contents($this->todoListFile);

            if (is_string($todoFileContent) || is_array($todoFileContent)) {
                return json_decode($todoFileContent, true);
            }
            return false;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function saveTodo()
    {
        try {
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

            return file_put_contents($this->todoListFile, json_encode($jsonArray, JSON_PRETTY_PRINT));
        } catch (Throwable $th) {
            return $th->getMessage();
        }
    }

    public function deleteTodo($todoId)
    {
        try {
            $todoFileContent = file_get_contents($this->todoListFile);
            $todoDecode = json_decode($todoFileContent, true);

            foreach ($todoDecode as $title => $value) {
                if ($value['id'] === $todoId) {
                    unset($todoDecode[$title]);
                }
            }

            return file_put_contents($this->todoListFile, json_encode($todoDecode, JSON_PRETTY_PRINT));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function getTodo($todoId)
    {
        try {
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

            return false;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update($todoId)
    {
        try {
            $todoContent = file_get_contents($this->todoListFile);
            $todoDecode = json_decode($todoContent, true);

            foreach ($todoDecode as $oldTitle => $value) {
                if ($value['id'] === intval($todoId)) {
                    $todoCompleted = Request::extractFromPost('todo-completed');
                    $newTitle = Request::extractFromPost('todo-title');

                    $todoDecode[$oldTitle]['completed'] = $todoCompleted ? true : false;
                    $todoUpdated = $this->change_key($todoDecode, $oldTitle, $newTitle);

                    return file_put_contents($this->todoListFile, json_encode($todoUpdated, JSON_PRETTY_PRINT));
                }
            }
            return false;
        } catch (\Throwable $th) {
            return $th->getMessage();
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

    public function statusChange($todoId)
    {
        try {
            $todoContent = file_get_contents($this->todoListFile);
            $todoDecode = json_decode($todoContent, true);

            foreach ($todoDecode as $key => $value) {
                if ($value['id'] === intval($todoId)) {
                    $todoDecode[$key]['completed'] = !$todoDecode[$key]['completed'];

                    return file_put_contents($this->todoListFile, json_encode($todoDecode, JSON_PRETTY_PRINT));
                }
            }

            return false;
        } catch (Throwable $th) {
            return $th->getMessage();
        }
    }
}
