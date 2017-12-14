<?php

include_once('templates/common/header.php');
include_once('database/list.php');
include_once('database/project.php');
include_once('utils/utils_lists.php');

if(!logged())
    redirect('index.php');

$username = $_SESSION['username'];

$foundlist = null;
$userOwnLists = getUserLists($username);

foreach($userOwnLists as $list) {

    if($list['id'] == $_GET['list_id']){
        $foundlist = $list;
        break;
    }

}

if($foundlist == null)
    redirect('lists.php');

$listtasks = getTasksOfTDList($foundlist['id']);
$project = getProject($foundlist['projectID']);

if(isset($_SESSION['updateListMessage']))
    $message = $_SESSION['updateListMessage'];

?>

<script src="scripts/todo_list.js" defer></script>
<section class="main_area" id = "edit_list">

    <h1> Edit TODO List (Project: <?=$project['projTitle']?>) </h1>

    <p class="messages"> 
            <?php 
                if(isset($message))
                    echo $message;
                $_SESSION['updateListMessage'] = '';
            ?>
    </p>
    
    <form id="edit_list_form" action="action_update_list.php" method="post">

        <input type="text" name="id" id="id" value="<?=$list['id']?>">
        <input type="text" name="projectdeadline" value="<?=$project['projDateDue']?>">

        <label for="title">Title </label>  
        <input type="text" name="title" id="title" value=<?='"'.$list['tdlTitle'].'"'?>/>

        <label for="datedue">Deadline </label>  
        <input id="datedue "type="date" name="deadline" value="<?=date('Y-m-d',$foundlist['tdlDateDue']);?>" max="<?=date('Y-m-d',$project['projDateDue']);?>">

        <label for="description"> Description </label>
        <textarea name="description" id="description"><?=$list['tdlDescription']?></textarea>

        <input type = "submit" value="Save">

    </form>

    <h2> Tasks List </h2>

    <table id="tasks_list">

        <tr>
            <th>Task</th>
            <th>Description</th>
            <th>%</th>
            <th>Deadline</th>
            <th>Responsable</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>

        <?php foreach($listtasks as $task) { ?>

            <tr>

                <td id="task_id" class ="hidden"><?=$task['id']?></td>
                <td><?=$task['taskTitle']?></td>
                <td><?=$task['taskDescription']?></td>
                <td><?=$task['percentageCompleted']?> % </td>
                <td><?=date('d/m/Y',$task['taskDateDue'])?></td>
                <td id="taskdeadline"><?=$task['taskDateDue']?></td>
                <td><?=$task['fullName']?></td>
                <td><img src="<?=getUserImagePathTN($task['userResponsable'])?>"</td>
                <td><a href="edit_task.php?task_id=<?=$task['id']?>"><img src="images/edit.svg"></a></td>
                <td><a href="" id="delete_task_button"><img src="images/delete.svg"></a></td>

            </tr>

        <?php } ?>

        <tr id="add_new_task">

            <td id="td_task_title"><input type="text" name="task_title" placeholder="New Task Title"></td>
            <td id="td_task_desc"><textarea name="task_desc" placeholder="New Task Description"></textarea></td>
            <td id="range"><input id="compl" type="range" min="0" max="100" step="5" name="task_completition" value="0"><label for="compl">0</label>%</td>
            <td id="td_task_dead_line"><input id="task_deadline" type="date" name="task_deadline" value="<?=date('Y-m-d',$foundlist['tdlDateDue']);?>" max="<?=date('Y-m-d',$foundlist['tdlDateDue']);?>"></td>
            <td id="td_responsible"><input type="text" list="collaborators" name="task_responsable" placeholder="Responsable">
                <datalist id="collaborators">
                </datalist>
            </td>
            <td></td>
            <td id="td_add"><input type="button" value="Add"></td>

        </tr>

    </table>


</section>


<?php include('templates/common/footer.php'); ?>