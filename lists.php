<?php 

include_once('templates/common/header.php'); 
include_once('database/list.php');
include_once('utils/utils_lists.php');
include_once('utils/utils_general.php');

if(!logged())
    redirect('index.php');

$username = $_SESSION['username'];
$userOwnsLists = getUserLists($username);

?>

<section id="main_area">

<table>
    <tr>
        <th>Name</th>
        <th>Detail</th>
        <th>Deadline</th>
        <th> % </th>
        <th>Project</th>
    </tr>

    <?php foreach($userOwnsLists as $list) { 
        
        $tdPercentageCompleted = calculateTODOListCompletition($list['id']);
        
    ?>

    <tr>
        <td><a href="#"><?=$list['tdlTitle'];?></a></td>
        <td><?=$list['tdlDescription'];?></td>
        <td><?=$list['tdlDateDue'];?></td>
        <td><?=$tdPercentageCompleted;?> % </td>
        <td><a href="#"><?=$list['projTitle'];?></a></td>
    </tr>

    <?php } ?>

</table>

</section>

<?php include_once('templates/common/footer.php'); ?>