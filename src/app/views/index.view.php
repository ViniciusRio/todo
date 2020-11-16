
<?php require(DIR_BASE_NAME . '/app/views/partials/head.php'); ?>

<?php foreach ($todos as $todoTitle => $todo) : ?>
    <dl>
        <form action="../delete.php" method="post">
            <input type="hidden" name="todo-id" value=<?=$todo['id']?>/>
            <button type="submit">delete</button>
        </form>
        <!-- <form action="" method="get"> -->
        <!-- <input type="hidden" name="todo-id-edit"/> -->
        <a style="text-decoration:none;" href="?todo-id-edit=<?= $todo['id'] ?>"><?= $todoTitle ?></a>

        <!-- </form> -->
        <form action="../change-status.php" method="post">
            <input type="hidden" name="todo-id-completed" value=<?=$todo['id']?>/>
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

<?php require(DIR_BASE_NAME . '/app/views/partials/footer.php'); ?>

