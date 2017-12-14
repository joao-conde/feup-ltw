<?php

include_once('templates/common/header.php');
include_once('database/list.php');
include_once('database/project.php');
include_once('utils/utils_projects.php');
include_once('utils/utils_lists.php');
include_once('utils/utils_user.php');

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
$collaborators = getUsersFromProject($foundproj['id']);

if(isset($_SESSION['updateProjectMessage']) && $_SESSION['updateProjectMessage'] != '')
    $message = $_SESSION['updateProjectMessage'];

if(isset($_SESSION['insertProjectMessage']) && $_SESSION['insertProjectMessage'] != '')
    $message = $_SESSION['insertProjectMessage'];

?>

<script src="scripts/edit_project.js" defer></script>
<section class="main_area" id = "edit_project">

    <h1> Edit Project <?=$foundproj['projTitle']?> </h1>

    <p class="messages"> 
            <?php 
                if(isset($message))
                    echo $message;
                $_SESSION['updateProjectMessage'] = '';
                $_SESSION['insertProjectMessage'] = '';
            ?>
    </p>
    
    <form id="edit_project_form" action="action_update_project.php" method="post">

        <input type="text" name="id" id="id" value="<?=$foundproj['id']?>">
        <input type="text" name="projectdeadline" value="<?=$foundproj['projDateDue']?>">

        <label for="title">Title </label>  
        <input type="text" name="title" id="title" value=<?='"'.$foundproj['projTitle'].'"'?>/>

       
        <label for="datedue">Deadline </label>  
        <input id="datedue "type="date" name="deadline" value="<?=date('Y-m-d',$foundproj['projDateDue']);?>" max="<?=date('Y-m-d',$project['projDateDue']);?>">

        <label for="description"> Description </label>
        <textarea name="description" id="description"><?=$foundproj['projDescription']?></textarea>

        <input type = "submit" value="Save">

    </form>

<h2> Project Team </h2>
    <ul>
        <?php 
            foreach($collaborators as $collaborator) { 
                
                $userPicPath = getUserImagePathTN($collaborator['username']);
        ?>

            <li title="<?=$collaborator['fullName']?>"><img src="<?=$userPicPath?>"></li>

        <?php } ?>

    </ul>

    <a href="edit_project_team.php?project_id=<?=$foundproj['id']?>"> Edit Project Team </a>

    <h2> TODO Lists </h2>

    <table id="project_lists">

        <tr>
            <th id="title">List Title</th>
            <th>Description</th>
            <th>Deadline</th>
            <th>%</th>
            <th></th>
        </tr>

        <?php 
        
            foreach($todoListsOfProject as $todolist) { 
                
                $list_percentage = calculateTODOListCompletition($todolist['id']);
            
        ?>
            <tr>
                <td><?=$todolist['tdlTitle']?></td>
                <td><?=$todolist['tdlDescription']?></td>
                <td><?=date('d/m/Y',$todolist['tdlDateDue'])?></td>
                <td><?=$list_percentage?>%</td>
                <td class="hidden" id="taskdeadline"><?= $todolist['tdlDateDue'];?></td>
                <td><a href="edit_list.php?list_id=<?=$todolist['id']?>"><img src="images/edit.svg" class="edit"></a></td>
            </tr>

        <?php } ?>

        <tr id="add_new_list">

            <td><input type="text" name="list_title" placeholder="New List Title"></td>
            <td id="td_list_desc"><textarea name="list_desc" placeholder="New List Description"></textarea></td>
            <td><input type="date" name="list_deadline" value="<?=date('Y-m-d',$foundproj['projDateDue']);?>"  max="<?=date('Y-m-d',$foundproj['projDateDue']);?>"></td>
            <td></td>
            <td><input name="add_new_list_button" type="button" value="Add"></td>

        </tr>

    </table>


</section>


<?php include('templates/common/footer.php'); ?>