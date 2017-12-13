<?php


include('database/list.php');

$proj_id = $_POST['proj_id'];
$list_title = $_POST['list_title'];
$list_desc = $_POST['list_desc'];
$list_deadline = $_POST['list_deadline'];

$dbh->beginTransaction();

$error_code_insert_list = insertNewList($proj_id, $list_title, $list_desc, $list_deadline);
$list_id = $dbh->lastInsertId();


if($error_code_insert_list == '00000') {
    $inserted_list = getListFromId($list_id);
    $dbh->commit();
}

$inserted_list['error'] = $error_code_insert_list;

echo json_encode($inserted_list);



?>