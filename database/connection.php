<?php

$dbh = new PDO('sqlite:'.dirname(__DIR__).'\database\taskManager.db');
$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$dbh->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);

?>