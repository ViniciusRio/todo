<?php require DIR_BASE_NAME . '/app/views/partials/head.php'; ?>
    <form action="update" method="POST">
        <label for="todo-title">Title</label>
        <input type="text" name="todo-title" value="<?=$title?>"/>

        <label for="todo-completed">Completed?</label>
        <input type="checkbox" name="todo-completed" <?=$completed ? 'checked' : ''?> />

        <button type="submit">Update</button>
    </form>
<?php require DIR_BASE_NAME . '/app/views/partials/footer.php'; ?>

