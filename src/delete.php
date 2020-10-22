<?php

$todoId = intval($_POST['todo-id']);
$todoFile = file_get_contents('todo-list.json');
$todoAssoc = json_decode($todoFile, true);

foreach ($todoAssoc as $key => $value) {
    
    if ($value['id'] === $todoId) {
        unset($todoAssoc[$key]);
    }
}

file_put_contents('todo-list.json', json_encode($todoAssoc, JSON_PRETTY_PRINT));

header('Location: index.php');
