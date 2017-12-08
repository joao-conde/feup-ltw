<?php 

include_once('templates/common/header.php'); 
include_once('database/list.php');
include_once('utils/utils_lists.php');
include_once('utils/utils_general.php');

if(!logged())
    redirect('index.php');

$username = $_SESSION['username'];
$userOwnsLists = getUserLists($username);
$userWorkingLists = getUserListIsWorking($username);

?>

<section class="main_area" id="todo_lists">

<table>
    <tr>
        <th>Name</th>
        <th>Detail</th>
        <th>Deadline</th>
        <th> % </th>
        <th>Project</th>
        <th></th>
        <th></th>
    </tr>
    
    <?php foreach($userOwnsLists as $list) { 

        $owner_pic = getUserImagePathTN($list['usernameCreator']);
        
        $tdPercentageCompleted = calculateTODOListCompletition($list['id']);
        
    ?>

    <tr>
        <td><a href="#"><?=$list['tdlTitle'];?></a></td>
        <td><?=$list['tdlDescription'];?></td>
        <td><?=$list['tdlDateDue'];?></td>
        <td><?=$tdPercentageCompleted;?> % </td>
        <td><a href="#"><?=$list['projTitle'];?></a></td>
        <td><img src="<?=$owner_pic?>"></td>
        <td><a href="#"><img class="edit" src="images/edit.svg"></a></td>

    </tr>

    <?php } ?>

    <?php foreach($userWorkingLists as $list) { 

        $owner_pic = getUserImagePathTN($list['usernameCreator']);
        
        $tdPercentageCompleted = calculateTODOListCompletition($list['id']);
        
    ?>

    <tr>
        <td><a href="#"><?=$list['tdlTitle'];?></a></td>
        <td><?=$list['tdlDescription'];?></td>
        <td><?=$list['tdlDateDue'];?></td>
        <td><?=$tdPercentageCompleted;?> % </td>
        <td><a href="#"><?=$list['projTitle'];?></a></td>
        <td><img src="<?=$owner_pic?>"></td>
        <td><a href="view_list.php?list_id=<?=$list['id'];?>"><img class="view" src="images/eye.svg"></a></td>

    </tr>

    <?php } ?>

</table>



</section>

<?php include_once('templates/common/footer.php'); ?>