<?php
ini_set('session.save_path', dirname(__FILE__));
session_start();
if (!isset($_SESSION["user"])) {
    header("location: login.php"); 
    exit();
}
// Be sure to check that this admin SESSION value is in fact in the database
//$adminID = $_SESSION["id"]; // filter everything but numbers and letters
$user = $_SESSION["user"]; // filter everything but numbers and letters
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Jolly V1 - Home</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/templatemo_style.css" rel="stylesheet" type="text/css" />
<!--////// CHOOSE ONE OF THE 3 PIROBOX STYLES  \\\\\\\-->
<link href="css/white/style.css" media="screen" title="shadow" rel="stylesheet" type="text/css" />

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
<script>
	$(document).ready(function() {
      	$("#chatMessage").keyup(function(e){
			//When press ENTER do 
			if(e.keyCode==13){
				var chatMessage = $("#chatMessage").val();
				$.ajax({
					type:'POST',
					url:'insertMessage.php',
					data:{chatMessage:chatMessage}, 
					success: function(){
						$("#chatMessage").val("");
						}
					});
				}
			
			});
    });
</script>
<!--////// END  \\\\\\\-->
</head>
<body>
<div id="templatemo_body_wrapper">
  <div id="templatemo_wrapper">
    <div id="tempaltemo_header"> <span id="header_icon"></span>
      <div id="header_content">
        <div id="site_title"> <a href="#"><img src="img/jolly_logo.png" alt="LOGO" /></a> </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <!--<a href="#" class="detail float_r">Detail</a>--> 
      </div>
    </div>
    <!-- end of header -->
    
    <div id="templatemo_main_top"></div>
    <div id="templatemo_main"><span id="main_top"></span><span id="main_bottom"></span>
      <div id="templatemo_sidebar">
        <div id="templatemo_menu">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Full List</a></li>
            <li><a href="badminton.php">Badminton List</a></li>
            <li><a href="floorball.php">Floor Ball List</a></li>
            <li><a href="chat.php">Chat</a></li>
            <li><a href="logout.php">Sign Out</a></li>
          </ul>
        </div>
        <!-- end of templatemo_menu -->
        
        <div class="sidebar_box">
          <div class="sb_title">Latest Updates</div>
          <div class="sb_content">
            <div class="sb_news_box"> <a href="#">Maecenas adipiscing elem sum ipsum.</a> <span>25 September 2048</span> </div>
            <div class="sb_news_box"> <a href="#">Aser ecenas adipiscing de lorem ipsum.</a> <span>18 September 2048</span> </div>
            <a href="#"><strong>View All</strong></a> </div>
          <div class="sb_bottom"></div>
        </div>
        <center>
          &nbsp;&nbsp;&nbsp;
        </center>
        <div class="cleaner"></div>
      </div>
      <!-- end of sidebar -->
      
      <div id="templatemo_content"> 
        <div class="content_box">
          <div>
            <h2>Hello <span style="text-transform:uppercase; color:rgba(96,85,85,1.00)"><?php echo $user;?></span> , welcome to chat box:</h2>
          </div>
          
       		<div id="chatBig">
           	  <div id="chatDisplay">
              </div>
              <textarea id="chatMessage" name="chatText"></textarea>
            </div>
          
          <div class="cleaner"></div>
        </div>
      </div>
      <div class="cleaner"></div>
    </div>
    <div id="templatemo_main_bottom"> </div>
  </div>
  <!-- end of wrapper --> 
</div>
<div id="templatemo_footer_wrapper">
  <div id="templatemo_footer"> Copyright © 2048 <a href="#">Your Company Name</a><!-- Credit: www.templatemo.com -->| 
    Validate <a href="http://validator.w3.org/check?uri=referer">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> </div>
</div>
<!-- templatemo 243 web design --> 
<!-- 
Web Design Template 
http://www.templatemo.com/preview/templatemo_243_web_design 
-->
</body>
</html>