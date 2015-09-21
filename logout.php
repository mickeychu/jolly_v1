<?php
// Initialize the session.
// If you are using session_name("something"), don't forget it now!
ini_set('session.save_path', dirname(__FILE__));
session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name("admin"), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
header("location: login.php");
exit();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Log out successful</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="../css/tooplate_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="tooplate_wrapper"><span id="top"></span>
  <div id="tooplate_header">
    <div id="site_title">
      <h1><a href="#">Personal Website</a></h1>
    </div>
    <div id="tooplate_menu">
      <ul>
        <li><a href="../index.php"><span class="home"></span>Home</a></li>
        <!--<li><a href="admin_logout.php"><span class="aboutus"></span>Log out</a></li>--> 
        <!--                <li><a href="#services"><span class="services"></span>Services</a></li>
                <li><a href="#portfolio"><span class="portfolio"></span>Portfolio</a></li>
                <li class="last"><a href="#contact"><span class="contactus"></span>Contact</a></li>-->
      </ul>
    </div>
    <!-- end of tooplate_menu -->
    
    <div class="cleaner"></div>
  </div>
  <!-- end of header -->
  
  <div id="tooplate_main">
    <div class="content_bottom"></div>
    <div class="content_top"><span id="portfolio"></span></div>
    <div class="content">
      <h2>You have logged out!</h2>
      <div class="cleaner h30"></div>
      <div align="center"> <a href="login.php">
        <button class="myButton">Home Page</button>
        </a> </div>
      <div class="cleaner h30"></div>
      <div class="cleaner"></div>
    </div>
    <div class="content_bottom"></div>
    <div class="cleaner"></div>
  </div>
  <!-- end of main -->
  
  <div id="tooplate_footer"> Copyright © <a href="mickeychu.cf">Mickey</a> </div>
  <!-- end of tooplate_footer --> 
  
</div>
</body>
</html>
