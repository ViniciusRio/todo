<?php
function dieAndDump($value) {
    echo "<pre>";
            die(var_dump($value));
    echo "</pre>";

}

function change_key($array,$old_key,$new_key) {

    if(!array_key_exists($old_key,$array)) {
        return $array;
    }

    $keys = array_keys($array);
    $keys[array_search($old_key, $keys)] = $new_key;

    return array_combine($keys, $array);
}

error_reporting();
ini_set('display_errors',1);

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
                $tasksUpdate = change_key($tasksJsonArray, $title, $todoTitle);

                file_put_contents($fileName, json_encode($tasksUpdate, JSON_PRETTY_PRINT));

              }
            
         }


        header('Location: index.php');


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

        header('Location: index.php');

    }