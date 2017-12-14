<?php

include_once('templates/common/header.php');
include_once('database/project.php');
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

$collaborators = getUsersFromProject($foundproj['id']);

?>

<script src="scripts/edit_team.js" defer></script>

<section class="main_area" id="edit_proj_team">

    <?php $href = 'edit_project.php?project_id='.$foundproj['id']; ?>
    <h1> Edit Project Team: <a href=<?=$href?>>  <?=$foundproj['projTitle']?></a> </h1>
    <label for="team_members"> Team Members </label>
    <ul id="team_members">

    <?php 
            foreach($collaborators as $collaborator) { 
                
                $userPicPath = getUserImagePathTN($collaborator['username']);
    ?>
            
            <li>
                <input type="text" class="hidden" id="username" value="<?=$collaborator['username']?>">
                <input type="text" class="hidden" id="fullName" value="<?=$collaborator['fullName']?>"> 
                <?=$collaborator['fullName']?><img src="<?=$userPicPath?>"> <button <?php if($collaborator['username'] == $foundproj['usernameCreator']) echo "disabled=disabled"; ?>  id="delete_member"></button>  
                <?php if($collaborator['username'] == $foundproj['usernameCreator']) echo '<span id="owner"> - Owner </span>'; ?>
            </li>

    <?php       } ?>

    </ul>

    <input type="number" class="hidden" id="proj_id" value=<?=$foundproj['id']?>>
    <label for="new_member">Add New Member</label>
    <input type="text" id="new_member" placeholder="search by name" list="collaborators">
    <datalist id="collaborators">
    </datalist>
    
</section>



<?php include('templates/common/footer.php'); ?>