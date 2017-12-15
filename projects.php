<?php 

include_once('templates/common/header.php'); 
include_once('database/project.php');
include_once('database/list.php');
include_once('utils/utils_projects.php');
include_once('utils/utils_general.php');

if(!logged())
    redirect('index.php');

$username = $_SESSION['username'];
$userOwnsProjects = getUserProjects($username);
$userWorkingProjects = getUserProjectIsWorking($username);

if(isset($_SESSION['deleteProjMessage']))
    $message = $_SESSION['deleteProjMessage'];


?>
<script src="scripts/project.js" defer></script>

<section class="main_area" id="projects_list">

<p class="messages"> 
    <?php 
        if(isset($message))
            echo $message;
        $_SESSION['deleteProjMessage'] = '';
    ?>
</p>

<table id = "projects">
    <tr>
        <th>Project</th>
        <th class="mobileHidden">Description</th>
        <th>Deadline</th>
        <th>%</th>
        <th class="mobileHidden">Owner</th>
        <th><a href="add_project.php"><img id="add_proj_image" src="images/add.svg"></a></th>
        <th></th>
        <th></th>
    </tr>

    <?php foreach($userOwnsProjects as $proj) { 
        
        $owner_pic = getUserImagePathTN($proj['usernameCreator']);
        $projPercentageCompleted = calculateProjectCompletition($proj['id']);
        $numberOfLists = count(getListsFromProject($proj['id']));
         
    ?>

    <tr>
        <td><?=$proj['projTitle'];?></td>
        <td class="mobileHidden"><?=$proj['projDescription'];?></td>
        <td><?=date('d/m/Y',$proj['projDateDue']);?></td>
        <td><?=$projPercentageCompleted;?> % </td>
        <td class="mobileHidden"><img src="<?=$owner_pic?>"></td>
        <td><a href="edit_project.php?project_id=<?=$proj['id'];?>"><img src="images/edit.svg" class="edit"></a></td>
        <td><a href="chat.php?project_id=<?=$proj['id']?>">Chat</a></td>
        <td><form action="action_delete_project.php" method="post" <?php if($numberOfLists > 0) echo("class = disabled") ?>>
                <input type="text" name="project_id" class="hidden" value=<?=$proj['id']?>>
                <input id="delete_proj" type="submit" value="" <?php if($numberOfLists > 0) echo("disabled title=Disabled") ?>>
            </form>
        </td>
        
        
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
        <td><?=$projPercentageCompleted;?> % </td>
        <td class="mobileHidden"><img src="<?=$owner_pic?>"></td>
        <td><a href="view_project.php?project_id=<?=$proj['id'];?>"><img src="images/eye.svg" class="view"></a></td>
        <td><a href="chat.php?project_id=<?=$proj['id']?>">Chat</a></td>
        <td></td>

        
    </tr>

    <?php } ?>

</table>

</section>

<?php include_once('templates/common/footer.php'); ?>