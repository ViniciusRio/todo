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
            <input type="text" name="todo-title" id="todo-title">

            <!-- <label for="todo-description">Description</label>
            <input type="text" name="todo-description" id="todo-description"> -->

            <label for="todo-completed">Completed?</label>
                <input type="checkbox" name="todo-completed" id="todo-completed"> 

            <button type="submit">Save</button>
        </fieldset>
    </form>

    <?php foreach ($jsonArray as $todoTitle => $todo) : ?>
        <dl>
        <form action="delete.php" method="post">
            <input type="hidden" name="todo-id" value=<?=$todo['id']?>/>
            <dt><?= $todoTitle ?><button type="submit">delete</button></dt>
        </form>
        <form action="change-status.php" method="post">
            <input type="hidden" name="todo-id-completed" value=<?=$todo['id']?>/>
            <input type="checkbox" name="todo-check" <?= $todo[completed] ? 'checked' : '' ?> />
        </form>
        </dl>
    <?php endforeach; ?>
    <script>
    const checkbox = document.querySelectorAll('input[type=checkbox][name=todo-check]');
    checkbox.forEach(ch => {
        ch.onclick = function() {
            this.parentNode.submit();
        };
    });
    </script>
</body>
</html>