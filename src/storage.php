<?php
function change_key($array, $oldKey, $newKey)
{
    if (!array_key_exists($oldKey, $array)) {
        return $array;
    }

    $keys = array_keys($array);
    $keys[array_search($oldKey, $keys)] = $newKey;

    return array_combine($keys, $array);
}

    $todoTitle = $_POST['todo-title'] ?? '';
    $todoTitle = trim($todoTitle);
    $todoIdUpdate = intval($_POST['todo-id']);
    $fileName = __DIR__ . '/' . 'todo-list.json';
    $isCompleted = $_POST['todo-completed'] ? true : false;

    if ($todoIdUpdate) {
        $tasksFile = file_get_contents($fileName);
        $tasksJsonArray = json_decode($tasksFile, true);

        foreach ($tasksJsonArray as $title => $value) {
            if ($value['id'] === $todoIdUpdate) {
                $tasksJsonArray[$title]['completed'] = $_POST['todo-completed'] ? true : false;
                $tasksUpdate = change_key($tasksJsonArray, $title, $todoTitle);

                file_put_contents($fileName, json_encode($tasksUpdate, JSON_PRETTY_PRINT));
            }
        }

        header('Location: index.view.php');

        return;
    }

    if ($todoTitle) {
        if (file_exists($fileName)) {
            $json = file_get_contents($fileName);
            $jsonArray = json_decode($json, true);
        } else {
            $jsonArray = [];
        }

        $taskSizePlus = count($jsonArray) + 1;

        $jsonArray[$todoTitle] = ['id' => $taskSizePlus, 'completed' => $isCompleted];
        file_put_contents($fileName, json_encode($jsonArray, JSON_PRETTY_PRINT));

        header('Location: index.view.php');
    }
