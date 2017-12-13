<?php

include('templates/common/header.php');
include_once('database/task.php');
include_once('database/list.php');

if(!logged())
    redirect('index.php');

$task_id = $_GET['task_id'];
$task = getTaskFromId($task_id);
$responsibleUser = getUser($task['userResponsable']);
$list = getListFromId($task['todoListID']);

?>

<script src="scripts/edit_task.js" defer></script>
<section class="main_area" id = "edit_task">

    <h1> Edit Task - <?=$task['taskTitle'] ?></h1>
    <form id="edit_task" action="action_update_task.php" method="post">

        <label for="title">Title</label>
        <input id= "title" name = "title" type="text" value="<?=$task['taskTitle']?>">

        <label for="description">Description</label>
        <textarea id="description" name="description"> <?=$task['taskDescription']?></textarea>

        <label for="deadline">Deadline</label>
        <input id= "deadline" name = "deadline" type="date" value=<?=date('Y-m-d',$task['taskDateDue'])?> max="<?=date('Y-m-d',$list['tdlDateDue']);?>">

        <label for="responsible">Responsible</label>
        <td id="responsible"><input type="text" list="collaborators" name="responsible" placeholder="Responsable" value="<?=$responsibleUser['fullName']?>" >
                <datalist id="collaborators">
                </datalist>
        </td>

        <input type="number" id="list_deadline_secs" value="<?=$list['tdlDateDue']?>" class="hidden">
        <input type="number" name="list_id" id="list_id" value="<?=$list['id']?>" class="hidden">
        <input type="number" name="task_id" id="task_id" value="<?=$task['id']?>" class="hidden">
        <input type="text" name="username_responsible" value="<?=$responsibleUser['username']?>" class="hidden">

        <input type="submit" value="Save">

        
    </form>


</section>


<?php include('templates/common/footer.php');?>