<?php

include realpath(dirname(__FILE__)) . '/app_config.php';
$link = mysqli_connect($database_host, $username, $password) // Making connection to host
or die("<p>Error connecting to database: " .
mysqli_error() . "</p>");

mysqli_select_db($link, $database_name) //Select the database in the host server
or die("<p>Error selecting the database " . $database_name .
mysqli_error() . "</p>");
?>