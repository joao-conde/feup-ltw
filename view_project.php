<?php 

include_once('templates/common/header.php');
include_once('database/project.php');
include_once('utils/utils_projects.php');
include_once('utils/utils_lists.php');
include_once('utils/utils_general.php');

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


$projectLists = getUserLists($_SESSION['username']);
    
?>

<section class=main_area id="view_project">

    <h1><span id="project_title">Project: </span><?=$foundproject['projTitle']?></h1>

    <label for="project_desc">What to Do</label>
    <div><textarea disabled id="project_desc"><?=$foundproject['projDescription']?></textarea></div>

    <table>

        <tr>
            <th>TODO List</th>
            <th>%</th>
            <th>Deadline</th>
            <th>Responsable</th>
            <th></th>
        </tr>

        <?php foreach($projectLists as $list) { ?>

            <tr>

                <td><?=$list['tdlTitle']?></td>
                <td><?=calculateTODOListCompletition($list['id'])?> % </td>
                <td><?=date('d/m/Y',$list['tdlDateDue'])?></td>
                <td><?=$foundproject['usernameCreator']?></td>
                <td><img src="<?=getUserImagePathTN($foundproject['usernameCreator'])?>"</td>

            </tr>

        <?php } ?>

    </table>

</section>


<?php include_once('templates/common/footer.php'); ?>


