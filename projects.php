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

<section class="main_area" id="projects_list">

<table>
    <tr>
        <th>Name</th>
        <th>Detail</th>
        <th>Deadline</th>
        <th>%</th>
        <th>Owner</th>
    </tr>

    <?php foreach($userOwnsProjects as $proj) { 
        
        $owner_pic = getUserImagePathTN($proj['usernameCreator']);
        
        $tdPercentageCompleted = calculateProjectCompletition($proj['id']);
        
    ?>

    <tr>
        <td><a href="#"><?=$proj['projTitle'];?></a></td>
        <td><?=$proj['projDescription'];?></td>
        <td><?=date('d/m/Y',$proj['projDateDue']);?></td>
        <td><?=$tdPercentageCompleted;?> % </td>
        <td><img src="<?=$owner_pic?>"></td>
        <td><a href="edit_project.php?project_id=<?=$proj['id'];?>"><img src="images/edit.svg" class="edit"></a></td>
        
    </tr>

    <?php } ?>

</table>

</section>

<?php include_once('templates/common/footer.php'); ?>