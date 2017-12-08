<?php 

include_once('templates/common/header.php');
include_once('database/list.php');
include_once('database/project.php');
include_once('utils/utils_lists.php');
include_once('utils/utils_general.php');

if(!logged())
    redirect('index.php');

    $userWorkingLists = getUserListIsWorking($_SESSION['username']);

    $foundlist = null;

    foreach($userWorkingLists as $list) {
        if($list['id'] == $_GET['list_id']){
            $foundlist = $list;
            break;
        }
    }

    if($foundlist == null) 
        redirect('lists.php');


    $listtasks = getTasksOfTDList($foundlist['id']);
    $project = getProject($foundlist['projectID']);
    
?>

<section class=main_area id="view_todo_list">

    <h1><span id="list_title">TODO List: </span><?=$foundlist['tdlTitle']?></h1>

    <h2><span id="list_title">Project: </span><?=$project['projTitle']?></h2>

    <p id="list_desc"><span id="label">What to Do:</span><?=$foundlist['tdlDescription']?></p>

    <table>

        <tr>
            <th>Task</th>
            <th>Completition</th>
            <th>Deadline</th>
            <th>Responsable</th>
            <th></th>
        </tr>

        <?php foreach($listtasks as $task) { ?>

            <tr>

                <td><?=$task['taskTitle']?></td>
                <td><?=$task['percentageCompleted']?> % </td>
                <td><?=$task['taskDateDue']?></td>
                <td><?=$task['fullName']?></td>
                <td><img src="<?=getUserImagePathTN($task['userResponsable'])?>"</td>

            </tr>

        <?php } ?>

    </table>

</section>


<?php include_once('templates/common/footer.php'); ?>


