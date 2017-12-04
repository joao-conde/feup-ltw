<?php

$dbh = new PDO('sqlite:database/taskManager.db');
$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

?>