
<?php require DIR_BASE_NAME . '/app/views/partials/head.php'; ?>

<a href="create">Create new todo</a>
<?php if (isset($flash)): ?>
    <p><?=$flash;?></p>
<?php endif; ?>

<?php foreach ($todos as $todoTitle => $todo) : ?>
    <dl>
        <form action="delete" method="POST">
            <input type="hidden" name="todo-id" value=<?=$todo['id']; ?> />
            <button type="submit">delete</button>
        </form>

        <form action="edit" method="GET">
            <input type="hidden" name="todo-id" value=<?=$todo['id']; ?> />
            <button type="submit"><?= $todoTitle ?></button>
        </form>

        <form action="status/change" method="post">
            <input type="hidden" name="todo-id-completed" value=<?=$todo['id']?>>
            <input type="checkbox" name="todo-check" <?= $todo['completed'] ? 'checked' : '' ?> />
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

<?php require DIR_BASE_NAME . '/app/views/partials/footer.php'; ?>

