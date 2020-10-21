<?php
    // error_reporting();
    // ini_set('display_errors',1);

    $todoTitle = $_POST['todo-title'] ?? '';
    $todoTitle = trim($todoTitle);

    if ($todoTitle) {
        $fileName = __DIR__ . '/' . 'todo-list.json';

        if (file_exists($fileName)) {
            $json = file_get_contents($fileName);
            $jsonArray = json_decode($json, true);
        } else {
            $jsonArray = [];
        }

        $jsonArray[$todoTitle] = ['completed' => $_POST['todo-completed'] ? true : false];
        file_put_contents($fileName, json_encode($jsonArray, JSON_PRETTY_PRINT));

    }

        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo</title>
</head>
<body>
    <form action="" method="post">
        <fieldset>
            <label for="todo-title">Title</label>
            <input type="text" name="todo-title" id="todo-title">

            <!-- <label for="todo-description">Description</label>
            <input type="text" name="todo-description" id="todo-description"> -->

            <label for="todo-completed">Completed?</label>
                <input type="checkbox" name="todo-completed" id="todo-completed"> 

            <button type="submit">Save</button>
        </fieldset>
    </form>
</body>
</html>