<?php include_once('templates/common/header.php'); 

include_once('database/project.php');

$username = $_SESSION['username'];
$userOwnsProjects = getUserProjects($username);

// var_dump($userOwnsProjects);

?>

<section id="main_area">

<table>
    <tr>
        <th>Name</th>
        <th>Detail</th>
        <th>Completion</th>
        <th>Deadline</th>
        <th>Owner</th>
    </tr>

    <?php foreach($userOwnsProjects as $proj) { ?>

    <tr>
        <td><a href="#"><?=$proj['projTitle'];?></a></td>
        <td><?=$proj['projDescription'];?></td>
        <td>PERCENT</td>
        <td><?=$proj['projDateDue'];?></td>
        <td><a href="#"><?=$proj['fullName'];?></a></td>
    </tr>

    <?php } ?>

</table>

</section>

<?php include_once('templates/common/footer.php'); ?>