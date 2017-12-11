<?php

include('templates/common/header.php');
include_once('database/task.php');

if(!logged())
    redirect('index.php');

$task_id = $_GET['task_id'];
$task = getTaskFromId($task_id);

?>


<section class="main_area" id = "edit_task">

    <h1> Edit Task - <?=$task['taskTitle'] ?></h1>
    <form id="edit_task" action="" method="post">

        <label for="title">Title</label>
        <input id= "title" name = "title" type="text" value=<?=$task['taskTitle']?>>

        <label for="description">
        <textarea id="description" name="description"> <?=$task['taskDescription']?></textarea>


    </form>


</section>


<?php include('templates/common/footer.php');?>