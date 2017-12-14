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
    <h2><label for="team_members"> Team Members </label></h2>
    <ul id="team_members">

    <?php 
            foreach($collaborators as $collaborator) { 
                
                $userPicPath = getUserImagePathTN($collaborator['username']);
    ?>
            
            <li>
                <input type="text" class="hidden" id="username" value="<?=$collaborator['username']?>">
                <input type="text" class="hidden" id="fullName" value="<?=$collaborator['fullName']?>"> 
                <div><?=$collaborator['fullName']?><img src="<?=$userPicPath?>"> <button <?php if($collaborator['username'] == $foundproj['usernameCreator']) echo "class=hidden"; ?>  id="delete_member"></button> </div> 
                <?php if($collaborator['username'] == $foundproj['usernameCreator']) echo '<span id="owner">Owner </span>'; ?>
            </li>

    <?php       } ?>

    </ul>

    <input type="number" class="hidden" id="proj_id" value=<?=$foundproj['id']?>>
    <div id="new_member_div">
        <label for="new_member">Add New Member</label>
        <input type="text" id="new_member" placeholder="search by name" list="collaborators">
    </div>
    <datalist id="collaborators">
    </datalist>
    
</section>



<?php include('templates/common/footer.php'); ?>