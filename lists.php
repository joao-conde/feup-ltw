<?php include_once('templates/common/header.php'); 

include_once('database/list.php');

$username = $_SESSION['username'];
$userOwnsLists = getUserLists($username);

// var_dump($userOwnsLists);

?>

<section id="main_area">

<table>
    <tr>
        <th>Name</th>
        <th>Detail</th>
        <th>Deadline</th>
        <th>Project</th>
    </tr>

    <?php foreach($userOwnsLists as $list) { ?>

    <tr>
        <td><a href="#"><?=$list['tdlTitle'];?></a></td>
        <td><?=$list['tdlDescription'];?></td>
        <td><?=$list['tdlDateDue'];?></td>
        <td><a href="#"><?=$list['projTitle'];?></a></td>
    </tr>

    <?php } ?>

</table>

</section>

<?php include_once('templates/common/footer.php'); ?>