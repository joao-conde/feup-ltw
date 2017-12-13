<html>
<header>
    <title>This is title</title>
</header>
<body>
    <?php
        include_once('../database/task.php');

        $tasksOrdered = getUserTasksOrderedBy('fump', 'taskTitle');

        print_r($tasksOrdered);
    ?>
</body>
</html>

