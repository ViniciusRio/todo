<?php require DIR_BASE_NAME . '/app/views/partials/head.php'; ?>
    <form action="storage" method="POST">
        <label for="todo-title">Title</label>
        <input type="text" name="todo-title">

        <label for="todo-completed">Completed?</label>
        <input type="checkbox" name="todo-completed">

        <button type="submit">Save</button>
    </form>
<?php require DIR_BASE_NAME . '/app/views/partials/footer.php'; ?>

