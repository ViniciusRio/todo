<?php

    $todoTitle = $_POST['todo-title'] ?? '';
    $todoTitle = trim($todoTitle);

    if ($todoTitle) {
        $fileName = __DIR__ . '/' . 'todo-list.json';
        $isCompleted = $_POST['todo-completed'] ? true : false;

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