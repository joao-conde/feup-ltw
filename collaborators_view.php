<?php 
    include_once('templates/common/header.php'); 
    include_once('utils/utils_general.php');
    include_once('database/collaborators.php');
    if(!logged()){
        redirect('index.php');
    }
?>
<section class="main_area" id="collaborators_list">
    <table>
        <tr>
            <th>Collaborator</th>
            <th>Project</th>
            <th>User Role</th>
        </tr>
        
        <?php 
        $collaborators = getColaborators($_SESSION['username']);
        
        foreach ($collaborators as $value) { 
            echo '<tr><td>'.htmlspecialchars($value['User.fullName'])
                .'</td><td>'.htmlspecialchars($value['Project.projTitle'])
                .'</td><td>'.htmlspecialchars($value['User_Project.userRole']).'</td></tr>';
        } ?>
    </table>
</section>
<?php include_once('templates/common/footer.php'); ?>
