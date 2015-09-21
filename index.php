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
<?php 
//Collect data to show the email list
$email_list = "";
$sql = mysqli_query($link, "SELECT * FROM `imported_email` WHERE username='$user'") or die (mysqli_error($link));;
$number = 0;
$email_count = mysqli_num_rows($sql); // count the amount of email in database
if ($email_count > 0) {
	while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
		$email_ID = $row["email_ID"];
		$email = $row["email"];
		$number = $number + 1;
		$email_list .= '<tr>
							<td width="40"><span style="font-size:15px; color:black;">'.$number.'</span></td>
                            <td width="373" height="63"><span style="font-size:15px">'.$email.'</span></td>
                            <td width="134"><input type="checkbox" name="check[]" value="'.$email.'" style="transform: scale(1.5)"></td>
                        </tr>';
		}
}
else {
	$email_list = "You have no email yet!";
}
?>
<?php
//Add selected email to badminton_list
if (isset ($_POST['badminton']))
{	
	if (isset ($_POST['check']))
	{
			$emails = $_POST['check'];

	foreach($emails as $email)
		{
			$sql = "INSERT INTO `badminton_list` (`id`, `email`, `username`) VALUES (NULL, '$email', '$user');";
			$query = mysqli_query($link, $sql) or die(mysqli_error($link));
		}
	echo '<script>
 			alert ("Imported DONE!");
			window.location = "badminton.php";
		  </script>';
	exit();
	}
	
	else 
	{
		echo '<script>
				alert ("Please choose at least 1 email to import!!!");
				isValid = false;
		  	  </script>';
	}

}

?>
<?php
//Add selected email to floor ball list
if (isset ($_POST['floorball']))
{	
	if (isset ($_POST['check']))
	{
			$emails = $_POST['check'];

	foreach($emails as $email)
		{
			$sql = "INSERT INTO `floorball_list` (`id`, `email`, `username`) VALUES (NULL, '$email', '$user');";
			$query = mysqli_query($link, $sql) or die(mysqli_error($link));
		}
	echo '<script>
 			alert ("Imported DONE!");
			window.location = "floorball.php";
		  </script>';
	exit();
	}
	
	else 
	{
		echo '<script>
				alert ("Please choose at least 1 email to import!!!");
				isValid = false;
		  	  </script>';
	}

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
<!--<link href="css_pirobox/white/style.css" media="screen" title="white" rel="stylesheet" type="text/css" />
<link href="css_pirobox/black/style.css" media="screen" title="black" rel="stylesheet" type="text/css" />-->
<!--////// END  \\\\\\\-->

<!--////// INCLUDE THE JS AND PIROBOX OPTION IN YOUR HEADER  \\\\\\\-->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$().piroBox({
			my_speed: 600, //animation speed
			bg_alpha: 0.5, //background opacity
			radius: 4, //caption rounded corner
			scrollImage : false, // true == image follows the page, false == image remains in the same open position
			pirobox_next : 'piro_next', // Nav buttons -> piro_next == inside piroBox , piro_next_out == outside piroBox
			pirobox_prev : 'piro_prev',// Nav buttons -> piro_prev == inside piroBox , piro_prev_out == outside piroBox
			close_all : '.piro_close',// add class .piro_overlay(with comma)if you want overlay click close piroBox
			slideShow : 'slideshow', // just delete slideshow between '' if you don't want it.
			slideSpeed : 4 //slideshow duration in seconds(3 to 6 Recommended)
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
            <li><a href="https://accounts.google.com/o/oauth2/auth?client_id=822743733345-kgbatntpncb9l0v8829n5l15t98k333m.apps.googleusercontent.com&redirect_uri=http://localhost/jolly_v1/import.php&scope=https://www.google.com/m8/feeds/&response_type=code">Import Contact</a></li>
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
        
        <!--            <div class="content_box">
            	<h2>Web Design Company</h2>
                <a href="#"><img class="image_wrapper image_fl" src="img/templatemo_image_01.jpg" alt="Image 1" /></a>
                <h5>Duis vitae velit sed dui malesuada</h5>
                <p>Sliquet ligula. Maecenas adipiscing  um ipsum. Pelsti lentesque vitae magna. Suspendisse a nibh tristique jus us volutpat. Suspos endisse vitae neque eget ante.</p>
                <p><a href="#">Read More</a></p>
              <div class="cleaner h30"></div>
                <a href="#"><img class="image_wrapper image_fl" src="img/templatemo_image_02.jpg" alt="Image 2" /></a>
              <h5>Savitae velit sed dui malesu donec</h5>
              <p> Maecenas adipiscing elementum ipsum. lentesque vitae magna. Sed nec est. Suspendisse a nibh tristique justo rhoncus volutpat. endisse vitae neque eget ante.</p>
              <p> <a href="#">Read More</a></p>
          </div>
-->
        <div class="content_box">
          <div>
            <h2>Hello <span style="text-transform:uppercase; color:rgba(96,85,85,1.00)"><?php echo $user;?></span> , here is your contact list:</h2>
          </div>
          <form action="index.php" method="post">
            <table width="600" height="118" border="1" style="">
              <tbody>
                <?php echo $email_list;?>
                <tr > </tr>
              </tbody>
              <table width="600" border="1" style="margin-top:30px">
                <tbody>
                  <tr>
                    <td align="center" style="height:60px">
                      <input type="submit" name="floorball" id="floorball" value="Add to Floor Ball Group" style="width:auto" />
                      <input type="submit" name="badminton" id="badminton" value="Add to Badminton Group" style="width:auto" />
                  </tr>
                </tbody>
              </table>
            </table>
          </form>
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