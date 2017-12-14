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
        <th><div class='div_order_by' id='taskTitle'>Name<img src="images/down-arrow.png" alt="Down arrow"></div></th>
        <th class='mobileHidden'><div class='div_order_by' id='taskDescription'>Description<img src="images/down-arrow.png" alt="Down arrow"></div></th>
        <th><div class='div_order_by' id='taskDateDue'>Deadline<img src="images/down-arrow.png" alt="Down arrow"></div></th>
        <th><div class='div_order_by' id='percentageCompleted'> % <img src="images/down-arrow.png" alt="Down arrow"></div><input id="show_completed", type="checkbox" checked><label for='show_completed'>Hide completed tasks.</label></th>
        <th class='mobileHidden'><div class='div_order_by' id='todoListID'>TODO List<img src="images/down-arrow.png" alt="Down arrow"></div></th>
        <th id="semaphore"></th>
    </tr>
    
    <?php foreach($userTasks as $task) { ?>

        <tr <?php ?>>

            <td><?=$task['taskTitle'];?></td>
            <td class="mobileHidden"><?=$task['taskDescription'];?></td>
            <td><?=date('d/m/Y',$task['taskDateDue']);?></td>
            <td class="range"><input id='<?= $task['id'];?>' type="range" min="0" max="100" step="5" name="task_completition" value="<?php echo $task['percentageCompleted'];?>"><label for="compl"><?php echo $task['percentageCompleted'];?></label>%</td>
            <td class="mobileHidden"><a href="#"><?=$task['tdlTitle'];?></a></td>
            <td id="semaphore"><div id="task_semaphore"></div></td>

        </tr>

    <?php } ?>

</table>



</section>

<?php include_once('templates/common/footer.php'); ?>