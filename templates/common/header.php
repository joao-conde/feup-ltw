<?php 
include_once('utils/utils_user.php');
include_once('utils/utils_general.php');

?>
<!DOCTYPE html>

<html lang="en-US"> 
<head>
    <script src="https://use.fontawesome.com/8518b8a976.js"></script>
    <title>Task Manager</title>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/style.css" rel="stylesheet">
    <link href="css/forms.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <script src="scripts/utils.js" defer></script>

    
</head>

<body>
    <header id="header_top">
        <div id="logo"> 
            <h1><img src="images/logo.svg"><a href="index.php">Task Manager</a></h1>
            <h2>Manage your time</h2>
        </div>
        <?php if(logged())
        include('templates/common/profile.php'); 
        ?>
    </header>

    <?php if(logged())
    include('templates/common/menu.php'); 
    ?>
   
