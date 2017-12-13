<?php 

include_once('templates/common/header.php'); 
include_once('database/task.php');
include_once('utils/utils_general.php');

if(!logged())
    redirect('index.php');

$username = $_SESSION['username'];
$userTasks = getUserTasks($username);

?>

<script src="scripts/task.js" defer></script>
<section class="main_area" id="tasks">

<table id='my_tasks'>
    <tr>
        <th id='taskTitle'>Name</th>
        <th id='taskDescription'>Description</th>
        <th id='taskDateDue'>Deadline</th>
        <th id='percentageCompleted'> % <input id="show_completed", type="checkbox" checked></th>
        <th id='todoListID'>TODO List</th>
        <th></th>
    </tr>
    
    <?php foreach($userTasks as $task) { ?>

        <tr <?php /* if($task['percentageCompleted'] == 100) echo 'class="task_completed"' */?>>

            <td><?=$task['taskTitle'];?></td>
            <td><?=$task['taskDescription'];?></td>
            <td><?=date('d/m/Y',$task['taskDateDue']);?></td>
            <td class="range"><input id='<?= $task['id'];?>' type="range" min="0" max="100" step="5" name="task_completition" value="<?php echo $task['percentageCompleted'];?>"><label for="compl"><?php echo $task['percentageCompleted'];?></label>%</td>
            <td><a href="#"><?=$task['tdlTitle'];?></a></td>
            <td><div id="task_semaphore"></div></td>

        </tr>

    <?php } ?>

</table>



</section>

<?php include_once('templates/common/footer.php'); ?>