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
        <th class="mobileHidden">Detail</th>
        <th>Deadline</th>
        <th> % </th>
        <th class="mobileHidden">Project</th>
        <th></th>
        <th></th>
    </tr>
    
    <?php foreach($userOwnsLists as $list) { 

        $owner_pic = getUserImagePathTN($list['usernameCreator']);
        
        $tdPercentageCompleted = calculateTODOListCompletition($list['id']);
        
    ?>

    <tr>
        <td><a href="#"><?=$list['tdlTitle'];?></a></td>
        <td class="mobileHidden"><?=$list['tdlDescription'];?></td>
        <td><?=date('d/m/Y',$list['tdlDateDue']);?></td>
        <td><?=$tdPercentageCompleted;?> % </td>
        <td class="mobileHidden"><a href="#"><?=$list['projTitle'];?></a></td>
        <td class="mobileHidden"><img src="<?=$owner_pic?>"></td>
        <td><a href="edit_list.php?list_id=<?=$list['id'];?>"><img src="images/edit.svg" class="edit"></a></td>

    </tr>

    <?php } ?>

    <?php foreach($userWorkingLists as $list) { 

        $owner_pic = getUserImagePathTN($list['usernameCreator']);
        
        $tdPercentageCompleted = calculateTODOListCompletition($list['id']);
        
    ?>

    <tr>
        <td><a href="#"><?=$list['tdlTitle'];?></a></td>
        <td class="mobileHidden"><?=$list['tdlDescription'];?></td>
        <td><?=date('d/m/Y',$list['tdlDateDue']);?></td>
        <td><?=$tdPercentageCompleted;?> % </td>
        <td class="mobileHidden"><a href="#"><?=$list['projTitle'];?></a></td>
        <td class="mobileHidden"><img src="<?=$owner_pic?>"></td>
        <td><a href="view_list.php?list_id=<?=$list['id'];?>"><img class="view" src="images/eye.svg"></a></td>

    </tr>

    <?php } ?>

</table>



</section>

<?php include_once('templates/common/footer.php'); ?>