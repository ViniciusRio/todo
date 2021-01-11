
<?php require DIR_BASE_NAME . '/app/views/partials/head.php'; ?>
<div class="content">
    <a id="btn-new-todo" href="create">
        New <i class="fa fa-plus" aria-hidden="true"></i> 
    </a> 
    <?php if (isset($flash)): ?>
        <p><?=$flash;?></p>
    <?php endif; ?>

    <?php if (is_array($todos) && !empty($todos)): ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th class="th-icon"></th>
                    <th class="th-icon"></th>


                </tr>
            </thead>
            <tbody>

                <?php foreach ($todos as $todoTitle => $todo) : ?>
                    <tr>
                        <td class="td-click-edit"><?=$todo['id']; ?></td>
                        <td class="td-click-edit"><?=$todoTitle; ?></td>
                        <td>
                            <form action="delete" method="POST">
                                <input type="hidden" name="todo-id" value=<?=$todo['id']; ?> />
                                <button class="btn-danger" type="submit">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="edit" method="get">
                                <input type="hidden" name="todo-id" value=<?=$todo['id']; ?> />
                                <button class="btn-edit" type="submit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
        
                <!-- <dl>
                    <form action="delete" method="POST">
                        <input type="hidden" name="todo-id" value=<?=$todo['id']; ?> />
                        <button type="submit">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>
        
                    <form action="edit" method="GET">
                        <input type="hidden" name="todo-id" value=<?=$todo['id']; ?> />
                        <button type="submit"><?= $todoTitle ?></button>
                    </form>
        
                    <form action="status/change" method="post">
                        <input type="hidden" name="todo-id-completed" value=<?=$todo['id']?>>
                        <input type="checkbox" name="todo-check" <?= $todo['completed'] ? 'checked' : '' ?> />
                    </form>
                </dl> -->
                <?php endforeach; ?>
            </tbody>
    </table>

    <?php elseif (empty($todos)): ?>
        <p>File empty</p>

    <?php else:?>
        <p><?=$todos;?></p>
    <?php endif; ?>
</div>

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

