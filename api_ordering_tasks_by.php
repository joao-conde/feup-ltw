<?php

    include('database/task.php');
    session_start();

    $order_by = $_POST['order_by'];

    $tasksOrdered = getUserTasksOrderedBy($_SESSION['username'], $order_by);
    
    echo json_encode($tasksOrdered);

?>