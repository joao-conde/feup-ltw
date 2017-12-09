<?php

include('database/list.php');
include('utils/utils_general.php');
session_start();

$id = $_POST['id'];
$title = $_POST['title'];
$desc = $_POST['description'];
$date = strtotime($_POST['deadline']);

if(updateList($id, $title, $desc, $date) == '000000')
    $_SESSION['updateListMessage'] = 'TODO List Updated Successfully';
else
    $_SESSION['updateListMessage'] = 'Error Updating TODO List';

redirect('edit_list.php?list_id='.$id);



?>