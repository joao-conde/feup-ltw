<?php

include_once('database/project.php');

$message_text =  htmlentities(trim($_POST['message_text']));
$message_username = $_POST['message_username'];
$message_date = $_POST['message_date'];
$message_proj_id = $_POST['message_proj_id'];
$message_project_Name = $_POST['message_proj_name'];

if($message_text == '')
    $errorCode = "empty"; 

else
    $errorCode = insertMessageInProojectChat($message_text, $message_username, $message_date, $message_proj_id, $message_project_Name);





echo json_encode(array("error" => $errorCode));


?>