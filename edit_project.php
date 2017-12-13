<?php

include_once('templates/common/header.php');
include_once('database/list.php');
include_once('database/project.php');
include_once('utils/utils_projects.php');

if(!logged())
    redirect('index.php');

$username = $_SESSION['username'];

$foundproj = null;
$userOwnProjects = getUserProjects($username);

foreach($userOwnProjects as $proj) {

    if($proj['id'] == $_GET['project_id']){
        $foundproj = $proj;
        break;
    }

}

if($foundproj == null)
    redirect('projects.php');

$todoListsOfProject = getTDListsOfProject($foundproj['id']);
// $project = getProject($foundlist['projectID']);

if(isset($_SESSION['updateProjectMessage']))
    $message = $_SESSION['updateProjectMessage'];

?>

<script src="scripts/project.js" defer></script>
<section class="main_area" id = "edit_project">

    <h1> Edit Project <?=$foundproj['projTitle']?> </h1>

    <p class="messages"> 
            <?php 
                if(isset($message))
                    echo $message;
                $_SESSION['updateProjectMessage'] = '';
            ?>
    </p>
    
    <form id="edit_project_form" action="action_update_project.php" method="post">

        <input type="text" name="id" id="id" value="<?=$list['id']?>">
        <input type="text" name="projectdeadline" value="<?=$foundproj['projDateDue']?>">

        <label for="title">Title </label>  
        <input type="text" name="title" id="title" value=<?='"'.$foundproj['projTitle'].'"'?>/>

       
        <label for="datedue">Deadline </label>  
        <input id="datedue "type="date" name="deadline" value="<?=date('Y-m-d',$foundproj['projDateDue']);?>" max="<?=date('Y-m-d',$project['projDateDue']);?>">

        <label for="description"> Description </label>
        <textarea name="description" id="description"><?=$foundproj['projDescription']?></textarea>

        <input type = "submit" value="Confirm">

    </form>

    <h2> PROJECTS </h2>

    <table id="projects">

        <tr>
            <th>TODO Lists</th>
            <th>Completition</th>
            <th>Deadline</th>
            <th>Responsable</th>
            <th></th>
        </tr>

        <?php foreach($todoListsOfProject as $todolist) { ?>

            <tr>
           <?php $tdPercentageCompleted = calculateProjectCompletition($foundproj['id']); ?>

                <td><?=$todolist['tdlTitle']?></td>
                <td><?=$tdPercentageCompleted;?> % </td>
                <td><?=date('d/m/Y',$todolist['tdlDateDue'])?></td>
                <td id="taskdeadline"><?=$todolist['tdlDateDue']?></td>
                <td><img src="<?=getUserImagePathTN($todolist['userResponsable'])?>"</td>

            </tr>

        <?php } ?>

        <tr id="add_new_task">

            <td><input type="text" name="task_title" placeholder="New Task Title"></td>
            <td id="range"><input id="compl" type="range" min="0" max="100" step="1" name="task_completition" value="0"><label for="compl">0</label>%</td>
            <td><input type="date" name="task_deadline" value="<?=date('Y-m-d',$foundlist['tdlDateDue']);?>" max="<?=date('Y-m-d',$foundlist['tdlDateDue']);?>"></td>
            <td><input type="text" name="task_responsable" placeholder="New Task Responsable"><ul id="suggestions"></ul></td>
            <td><input type="button" value="Add"></td>

        </tr>

    </table>


</section>


<?php include('templates/common/footer.php'); ?>