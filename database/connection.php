<?php

$dbh = new PDO('sqlite:database/taskManager.db');
$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$dbh->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
$dbh->exec('PRAGMA foreign_keys = ON;');

?>