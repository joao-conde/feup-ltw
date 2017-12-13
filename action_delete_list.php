<?php
session_start();
include('database/list.php');
include('utils/utils_general.php');


$list_id = $_POST['list_id'];

$error = deleteList($list_id);

if($error == '00000')
    $_SESSION['deleteListMessage'] = 'List correctly deleted';

else
    $$_SESSION['deleteListMessage'] = 'Error deleting list';


redirect('lists.php');

?>



