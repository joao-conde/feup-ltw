<?php

include_once('database/project.php');
include_once('database/user.php');
include_once('utils/utils_user.php');


$last_message_id = $_GET['last_message_id'];
$proj_id = $_GET['project_id'];

$new_messages = getLastMessagesFromProject($proj_id, $last_message_id);

for($i = 0; $i < count($new_messages); $i++) {

    $new_messages[$i]['userPicPath'] = getUserImagePathTN($new_messages[$i]['usernameSrc']);
    $new_messages[$i]['fullName'] = getUser($new_messages[$i]['usernameSrc'])['fullName'];

}

echo json_encode($new_messages);


?>