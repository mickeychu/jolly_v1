<?php
ini_set('session.save_path', dirname(__FILE__));
session_start();
if (!isset($_SESSION["user"])) {
    header("location: login.php"); 
    exit();
}
// Be sure to check that this admin SESSION value is in fact in the database

$user = $_SESSION["user"];
$user_ID = $_SESSION["user_ID"];

// Run mySQL query to be sure that this person is an admin and that their password session var equals the database information
// Connect to the MySQL database  
require "scripts/connect.php"; 
$sql = mysqli_query($link, "SELECT * FROM `users` WHERE username='$user' "); // query the person
// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysqli_num_rows($sql); // count the row nums
if ($existCount == 0) { // evaluate the count
	 echo 'Your login session data is not on record in the database and try again <a href="login.php">Click Here</a>';
     exit();
}
?><?php 
include "scripts/class.php";
if(isset($_POST['chatMessage'])){
	$chat = new chat();
	$message = $_POST['chatMessage'];
	//$chat->setUserID($user_ID);
	//$chat->setMessage($message);
	$chat->insertMessage($user_ID, $message);
	}
?>