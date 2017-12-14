<?php 

include_once('templates/common/header.php');
include_once('database/project.php');
include_once('utils/utils_projects.php');
include_once('utils/utils_lists.php');
include_once('utils/utils_general.php');
include_once('utils/utils_user.php');

if(!logged())
    redirect('index.php');

$userWorkingProjects = getUserProjectIsWorking($_SESSION['username']);

$foundproject = null;

foreach($userWorkingProjects as $proj) {
    if($proj['id'] == $_GET['project_id']){
        $foundproject = $proj;
        break;
    }
}

if($foundproject == null) 
    redirect('projects.php');


$collaborators = getUsersFromProject($foundproject['id']);
$projectLists = getUserLists($_SESSION['username']);

    
?>

<section class=main_area id="view_project">

    <h1><span id="project_title">Project: </span><?=$foundproject['projTitle']?></h1>

    <label for="project_desc">Project Description</label>
    <div><textarea disabled id="project_desc"><?=$foundproject['projDescription']?></textarea></div>

    <label for"proj_deadline">Deadline</label>
    <p><?= date('Y-m-d',$foundproject['projDateDue'])?></p>

    <ul>
        <?php 
            foreach($collaborators as $collaborator) { 
                
                $userPicPath = getUserImagePathTN($collaborator['username']);
        ?>

            <li title="<?=$collaborator['fullName']?>"><img src="<?=$userPicPath?>"></li>

        <?php } ?>

    </ul>

    <table>

        <tr>
            <th>TODO List</th>
            <th>Description</th>
            <th>Completition</th>
            <th>Deadline</th>
        </tr>

        <?php foreach($projectLists as $list) { ?>

            <tr>

                <td><?=$list['tdlTitle']?></td>
                <td><?=$list['tdlDescription']?></td>
                <td><?=calculateTODOListCompletition($list['id'])?> % </td>
                <td><?=date('d/m/Y',$list['tdlDateDue'])?></td>
            </tr>

        <?php } ?>

    </table>

</section>


<?php include_once('templates/common/footer.php'); ?>


