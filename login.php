<?php 
ini_set('session.save_path', dirname(__FILE__));
session_start();
if (isset($_SESSION["user"])) {
    header("location: index.php"); 
    exit();
}
?>
<?php 
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["username"]) && isset($_POST["password"])) {

	$user = $_POST["username"]; 
    $pass = $_POST["password"];
	
    // Connect to the MySQL database  
    require "scripts/connect.php"; 
	
    $sql = mysqli_query($link, "SELECT * FROM `users` WHERE username='$user' AND password='$pass'"); // query the person
    while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
		$username = $row["username"];
		$password = $row["password"];
		$user_ID = $row["user_ID"];
		}
    if ($user == $username && $pass == $password ) { 
		 $_SESSION["user"] = $user;
		 $_SESSION["user_ID"] = $user_ID;
		 header("location: index.php");
         exit();
    } else {
		echo 'That information is incorrect, try again <a href="index.php">Click Here</a>';
		exit();
	}
}
?>

<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<title>Sign Up for FUN</title>
<link rel="stylesheet" href="css/style.css">
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
</head>
<body>
<div class="wrapper">
  <div class="container">
    <div id="signup_content">
      <h1>Welcome to JOLLY DRAGON</h1>
      <h2>Please log in to have more fun!</h2>
      <form class="form" action="login.php" id="lg-form" name="lg-form" method="post">
        <div>
          <input type="text" name="username" id="username" placeholder="username"/>
        </div>
        <div>
          <input type="password" name="password" id="password" placeholder="password" />
        </div>
        <div>
          <button type="submit" id="login">Login</button>
        </div>
        <div style="margin-top:30px">
        	<p>Don't have an acount, <a href="sign_up.php">let's sign up</a></p>
        </div>
      </form>
    </div>
  </div>
  <ul class="bg-bubbles">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
  </ul>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> 
<script src="js/index.js"></script>
</body>
</html>
