<?php 

include_once('templates/common/header.php'); 
include_once('database/list.php');
include_once('database/task.php');
include_once('utils/utils_lists.php');
include_once('utils/utils_general.php');


if(!logged())
    redirect('index.php');

$username = $_SESSION['username'];
$userOwnsLists = getUserLists($username);
$userWorkingLists = getUserListIsWorking($username);

if(isset($_SESSION['deleteListMessage']))
    $message = $_SESSION['deleteListMessage'];

?>

<section class="main_area">

<p class="messages"> 
    <?php 
        if(isset($message))
            echo $message;
        $_SESSION['deleteListMessage'] = '';
    ?>
</p>

<table id="lists_list">
    <tr>
        <th>Name</th>
        <th>Detail</th>
        <th>Deadline</th>
        <th> % </th>
        <th>Project</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    
    <?php foreach($userOwnsLists as $list) { 

        $owner_pic = getUserImagePathTN($list['usernameCreator']);
        $tdPercentageCompleted = calculateTODOListCompletition($list['id']);
        $number_tasks = count(getTasksFromList($list['id']));
        
    ?>

    <tr>
        <td><?=$list['tdlTitle'];?></td>
        <td><?=$list['tdlDescription'];?></td>
        <td><?=date('d/m/Y',$list['tdlDateDue']);?></td>
        <td><?=$tdPercentageCompleted;?> % </td>
        <td><a href="edit_project.php?project_id=<?=$list['id_project']?>"><?=$list['projTitle'];?></a></td>
        <td><img src="<?=$owner_pic?>"></td>
        <td><a href="edit_list.php?list_id=<?=$list['id'];?>"><img src="images/edit.svg" class="edit"></a></td>
        <td><form action="action_delete_list.php" method="post" <?php if($number_tasks > 0) echo("class = disabled") ?>>
                <input type="text" name="list_id" class="hidden" value=<?=$list['id']?>>
                <input id="delete_list" type="submit" value="" <?php if($number_tasks > 0) echo("disabled title=Disabled") ?>>
            </form>
        </td>

    </tr>

    <?php } ?>

    <?php foreach($userWorkingLists as $list) { 

        $owner_pic = getUserImagePathTN($list['usernameCreator']);
        
        $tdPercentageCompleted = calculateTODOListCompletition($list['id']);
        
    ?>

    <tr>
        <td><?=$list['tdlTitle'];?></td>
        <td><?=$list['tdlDescription'];?></td>
        <td><?=date('d/m/Y',$list['tdlDateDue']);?></td>
        <td><?=$tdPercentageCompleted;?> % </td>
        <td><a href="view_project.php?project_id=<?=$list['id_project']?>"><?=$list['projTitle'];?></a></td>
        <td><img src="<?=$owner_pic?>"></td>
        <td><a href="view_list.php?list_id=<?=$list['id'];?>"><img class="view" src="images/eye.svg"></a></td>
        <td></td>
        

    </tr>

    <?php } ?>

</table>



</section>

<?php include_once('templates/common/footer.php'); ?>