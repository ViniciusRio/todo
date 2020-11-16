<form action="../storage.php" method="post">
    <fieldset>
        <label for="todo-title">Title</label>
        <input type="text" name="todo-title" id="todo-title" value=""/>

        <label for="todo-completed">Completed?</label>
        <input type="checkbox" name="todo-completed" id="todo-completed" />
        <button type="submit"></button>
    </fieldset>
    <?php // if ($taskCurrent['id']): ?>
    <!--        <input type="hidden" name="todo-id" value="--><?//=$taskCurrent['id']?><!--">-->
    <?php // endif; ?>
</form>