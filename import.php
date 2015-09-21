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
<title>Jolly V1 - Import</title>
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
<script type="text/javascript" src="js/piroBox.1_2.js"></script>
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
            <li><a href="#">Badminton List</a></li>
            <li><a href="#">Floor Ball List</a></li>
            <li><a href="#">Add To Your List</a></li>
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
          <?php
                $client_id = '822743733345-kgbatntpncb9l0v8829n5l15t98k333m.apps.googleusercontent.com';
                $client_secret = '59PfA6LumFJSyipvw5xsv8xV';
                $redirect_uri = 'http://localhost/jolly_v1/import.php';
                $max_results = 20;
                
                $auth_code = $_GET["code"];
                
                function curl_file_get_contents($url)
                {
                 $curl = curl_init();
                 $userAgent = 'Mozilla/40.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
                 
                 curl_setopt($curl,CURLOPT_URL,$url);	//The URL to fetch. This can also be set when initializing a session with curl_init().
                 curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);	//TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
                 curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5);	//The number of seconds to wait while trying to connect.	
                 
                 curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);	//The contents of the "User-Agent: " header to be used in a HTTP request.
                 curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);	//To follow any "Location: " header that the server sends as part of the HTTP header.
                 curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);	//To automatically set the Referer: field in requests where it follows a Location: redirect.
                 curl_setopt($curl, CURLOPT_TIMEOUT, 10);	//The maximum number of seconds to allow cURL functions to execute.
                 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);	//To stop cURL from verifying the peer's certificate.
                 curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                 
                 $contents = curl_exec($curl);
                 curl_close($curl);
                 return $contents;
                }
                
                $fields=array(
                    'code'=>  urlencode($auth_code),
                    'client_id'=>  urlencode($client_id),
                    'client_secret'=>  urlencode($client_secret),
                    'redirect_uri'=>  urlencode($redirect_uri),
                    'grant_type'=>  urlencode('authorization_code')
                );
                $post = '';
                foreach($fields as $key=>$value) { $post .= $key.'='.$value.'&'; }
                $post = rtrim($post,'&');
                
                $curl = curl_init();
                curl_setopt($curl,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token');
                curl_setopt($curl,CURLOPT_POST,5);
                curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
                $result = curl_exec($curl);
                curl_close($curl);
                
                $response =  json_decode($result);
                $accesstoken = $response->access_token;
                
                $url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&oauth_token='.$accesstoken;
                $xmlresponse =  curl_file_get_contents($url);
                if((strlen(stristr($xmlresponse,'Authorization required'))>0) && (strlen(stristr($xmlresponse,'Error '))>0)) //At times you get Authorization error from Google.
                {
                    echo "<h2>OOPS !! Something went wrong. Please try reloading the page.</h2>";
                    exit();
                }
                echo "<h3>These emails has been added to your address:</h3>";
                $xml =  new SimpleXMLElement($xmlresponse);
                $xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
                $result = $xml->xpath('//gd:email');
                $count = 1;
                $email_list = '';
                require 'scripts/connect.php';
                foreach ($result as $title) {
                  $email = $title->attributes()->address;
                  $email_list.= '<tr>
                                    <td width="413" height="63">'.$count.'--'.$email.'</td>
                                    <td width="134"><input type="checkbox" name="check[]" value="badminton" style="transform: scale(1.5)"></td>
                                </tr>';
                  
                  $count++;
                  
                  $sql = "INSERT INTO `imported_email` (`email_ID`, `email`, `username`) VALUES (NULL, '$email', '$user');";
                  
                  $query = mysqli_query($link, $sql) or die (mysqli_error($link));
                }
                ?>
          <div class="cleaner"></div>
          <h2>Your contacts are imported to your list</h2>
          <table width="563" height="118" border="1" style="">
  <tbody>
		<?php echo $email_list;?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>

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