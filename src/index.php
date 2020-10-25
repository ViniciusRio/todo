<?php
    $taskFile = file_get_contents('todo-list.json');
    $tasksJson = json_decode($taskFile, true);
    $taskId = intval($_GET['todo-id-edit']);

    $taskTitle = '';
    $taskCurrent = '';

    if ($taskId) {
        foreach ($tasksJson as $key => $value) {
            if ($value['id'] === $taskId) {
                $taskTitle = $key;
                $taskCurrent = $value;
            }
        }

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
    <form action="storage.php" method="post">
        <fieldset>
            <label for="todo-title">Title</label>
            <input type="text" name="todo-title" id="todo-title" value="<?= $taskTitle ?>"/>

            <label for="todo-completed">Completed?</label>
                <input type="checkbox" name="todo-completed" id="todo-completed" <?= $taskCurrent['completed'] ? 'checked' : '' ?>> 
            <button type="submit"><?=$taskTitle ? 'Update' : 'Save'?></button>
        </fieldset>
        <?php if ($taskCurrent['id']): ?>
            <input type="hidden" name="todo-id" value="<?=$taskCurrent['id']?>">
        <?php endif; ?>
    </form>

    <?php foreach ($tasksJson as $todoTitle => $todo) : ?>
        <dl>
        <form action="delete.php" method="post">
            <input type="hidden" name="todo-id" value=<?=$todo['id']?>/>
            <button type="submit">delete</button>
        </form>
        <!-- <form action="" method="get"> -->
            <!-- <input type="hidden" name="todo-id-edit"/> -->
            <a style="text-decoration:none;" href="?todo-id-edit=<?= $todo['id'] ?>"><?= $todoTitle ?></a>

        <!-- </form> -->
        <form action="change-status.php" method="post">
            <input type="hidden" name="todo-id-completed" value=<?=$todo['id']?>/>
            <input type="checkbox" name="todo-check" <?= $todo[completed] ? 'checked' : '' ?> />
        </form>
        </dl>
    <?php endforeach; ?>
    <script>
    const titleTodo = document.querySelectorAll('dt');
    titleTodo.forEach(title => {
        title.onclick = function() {
            this.parentNode.submit();
        };
    });
    const checkbox = document.querySelectorAll('input[type=checkbox][name=todo-check]');
    checkbox.forEach(ch => {
        ch.onclick = function() {
            this.parentNode.submit();
        };
    });
    </script>
</body>
</html>