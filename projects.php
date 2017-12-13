<?php 

include_once('templates/common/header.php'); 
include_once('database/project.php');
include_once('utils/utils_projects.php');
include_once('utils/utils_general.php');

if(!logged())
    redirect('index.php');

$username = $_SESSION['username'];
$userOwnsProjects = getUserProjects($username);
$userWorkingProjects = getUserProjectIsWorking($username);


?>

<script src="scripts/project.js" defer></script>

<section class="main_area" id="projects_list">

<table id = "projects">
    <tr>
        <th>Name</th>
        <th class="mobileHidden">Detail</th>
        <th>Deadline</th>
        <th class="mobileHidden">%</th>
        <th class="mobileHidden">Owner</th>
        <th class="mobileHidden"></th>
    </tr>

    <?php foreach($userOwnsProjects as $proj) { 
        
        $owner_pic = getUserImagePathTN($proj['usernameCreator']);
        
        $projPercentageCompleted = calculateProjectCompletition($proj['id']);
         
    ?>

    <tr>
        <td><a href="#"><?=$proj['projTitle'];?></a></td>
        <td class="mobileHidden"><?=$proj['projDescription'];?></td>
        <td><?=date('d/m/Y',$proj['projDateDue']);?></td>
        <td class="mobileHidden"><?=$projPercentageCompleted;?> % </td>
        <td class="mobileHidden"><img src="<?=$owner_pic?>"></td>
        <td class="mobileHidden"><a href="edit_project.php?project_id=<?=$proj['id'];?>"><img src="images/edit.svg" class="edit"></a></td>
        
    </tr>

    <?php } ?>


    <?php foreach($userWorkingProjects as $proj) { 
        
        $owner_pic = getUserImagePathTN($proj['usernameCreator']);
        
        $projPercentageCompleted = calculateProjectCompletition($proj['id']);
        
    ?>

    <tr>
        <td><a href="#"><?=$proj['projTitle'];?></a></td>
        <td class="mobileHidden"><?=$proj['projDescription'];?></td>
        <td><?=date('d/m/Y',$proj['projDateDue']);?></td>
        <td class="mobileHidden"><?=$projPercentageCompleted;?> % </td>
        <td class="mobileHidden"><img src="<?=$owner_pic?>"></td>
        <td class="mobileHidden"><a href="view_project.php?project_id=<?=$proj['id'];?>"><img src="images/eye.svg" class="view"></a></td>
        
    </tr>

    <?php } ?>

    <tr id="add_new_project">

            <td><input type="text" name="proj_title" placeholder="New Project Title"></td>
            <td class="mobileHidden"><textarea name="proj_desc" placeholder="New Project Description"></textarea></td>
            <td><input id="proj_deadline" type="date" name="proj_deadline" min="<?=date('Y-m-d',time());?>" value="<?=date('Y-m-d',time());?>" ></td>
            <td class="mobileHidden" id="complete">0 %</td>
            <td class="mobileHidden" id="user"><input type="text" name="proj_responsable" value=<?=$username?>></td>
            <td><input type="button" value="Add"></td>

    </tr>

</table>

</section>

<?php include_once('templates/common/footer.php'); ?>