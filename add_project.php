<?php include_once('templates/common/header.php');

include_once('database/list.php');
include_once('database/project.php');
include_once('utils/utils_projects.php');

if(!logged())
    redirect('index.php');

$username = $_SESSION['username'];

if(isset($_SESSION['updateProjectMessage']))
    $message = $_SESSION['updateProjectMessage'];

?>

<script src="scripts/add_project.js" defer></script>
<section class="main_area" id="edit_project">

    <h1> Add Project </h1>

    <p class="messages"> 
            <?php 
                if(isset($message))
                    echo $message;
                $_SESSION['updateProjectMessage'] = '';
            ?>
    </p>
    
    <form id="add_project_form" action="action_add_project.php" method="post">

        <label for="title">Title </label>  
        <input type="text" name="title" id="title" placeholder="New Project Name">

       
        <label for="datedue">Deadline </label>  
        <input id="datedue "type="date" name="deadline">

        <label for="description"> Description </label>
        <textarea name="description" id="description" placeholder="New Project Description"></textarea>

        <label for="collaborators">Add Collaborators</label>
        <input type="text" list="collaborators" name="collaborators" placeholder="Search by Name">
        <datalist id="collaborators">
        </datalist>
        

        <select id="selectCollaborator" name="selectCollaborator[]" multiple class="hidden">
        </select>

        <ul>
        </ul>

        <input type = "submit" value="Add">

    </form>

</section>


<?php include_once('templates/common/footer.php'); ?>