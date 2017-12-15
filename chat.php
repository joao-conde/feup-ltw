<?php
include_once('templates/common/header.php');
include_once('database/user.php');
include_once('database/project.php');
include_once('utils/utils_user.php');
include_once('utils/utils_general.php');

if(!logged())
    redirect('index.php');

$userWorkingProjects = getUserProjectIsWorking($_SESSION['username']);
$userOwnProjects = getUserProjects($_SESSION['username']);
$allprojects = array_merge($userWorkingProjects, $userOwnProjects);

$project_id = $_GET['project_id'];

foreach($allprojects as $proj) {

    if($proj['id'] == $project_id){
        $foundproj = $proj;
        break;
    }

}

if($foundproj == null)
    redirect('projects.php');


$project = getProject($project_id);
$participants = getUsersFromProject($project_id);
$messages = getMessagesFromProjectChat($project_id);
$lastMessageId = count($messages) > 0 ?  $messages[count($messages)-1]['messageId'] : 0;

?>

<link href="css/chat.css" rel="stylesheet">
<script src="scripts/chat.js" defer></script>
<p id="proj_id" class="hidden"><?=$project_id?></p>
<p id="proj_name" class="hidden"><?=$project['projTitle']?></p>
<p id="username" class="hidden"><?=$_SESSION['username']?></p>
<p id="lastMessageId" class="hidden"><?=$lastMessageId?></p>
<audio id="new_messages">
  <source src="images/new_message.mp3" type="audio/mp3">
</audio>
<section class="main_area" id="chat">

    <h1>Chat: <?=$project['projTitle']?></h1>

    <section id="messages">

        <?php 
        foreach($messages as $message) { 
            $userPicPath = getUserImagePathTN($message['usernameSrc']);
            $user = getUser($message['usernameSrc']);        
        ?>
            
            <div id="message">
                <img src="<?=$userPicPath?>">
                <span id="sender"><?=$user['fullName']?></span>
                <span id="date"><?=date('j/m/Y G:i:s',$message['messageDate'])?></span>
                <span id="message_body"><?=$message['messageText']?></span> 
            </div>

        <?php } ?>


    </section>

    <section id="chat_participants">

        <ul id="chat_participants">

            <?php 
            foreach($participants as $participant) { 
                $userPicPath = getUserImagePathTN($participant['username']);        
            ?>

                <li><img src="<?=$userPicPath?>"><span id="participant"><?=$participant['fullName']?></span></li>
 
            <?php } ?>

        </ul>
    
    </section>

    <section id="send_message">
        <textarea placeholder="Say something but be polite, do not raise your voice.    "></textarea>
        <input id ="send" type="button" value="send">
    </section>

</section>


<?php include_once('templates/common/footer.php');