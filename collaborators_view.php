<?php 
    include_once('templates/common/header.php'); 
    include_once('utils/utils_general.php');
    include_once('database/collaborators.php');
    include_once('utils/utils_user.php');
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
            <th></th
        </tr>
        
        <?php 
        $collaborators = getColaborators($_SESSION['username']);
       
        foreach ($collaborators as $value) { 
            $colabpic = getUserImagePathTN($value['User.username']);
            echo '<tr><td>'.htmlspecialchars($value['User.fullName'])
                    .'</td><td>'.htmlspecialchars($value['Project.projTitle'])
                            .'</td><td>'.htmlspecialchars($value['User_Project.userRole']).'</td>';
        ?>
                        
            <td><img src="<?=$colabpic?>"></td></tr>
        <?php                
        } ?>
    </table>
</section>
<?php include_once('templates/common/footer.php'); ?>
