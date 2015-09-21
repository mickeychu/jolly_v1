<?php
session_start();
// If user is logged in, header them away
if(isset($_SESSION["username"])){
	header("location: message.php?msg=NO to that weenis");
    exit();
}
?>
<?php
// Ajax calls this NAME CHECK code to execute
if(isset($_POST["usernamecheck"])){
	include_once("scripts/connect.php");
	$username = preg_replace('#[^a-z0-9]#i', '', $_POST['usernamecheck']);
	$sql = "SELECT user_ID FROM users WHERE username='$username' LIMIT 1";
    $query = mysqli_query($link, $sql); 
    $uname_check = mysqli_num_rows($query);
    if (strlen($username) < 3 || strlen($username) > 16) {
	    echo '<strong style="color:#F00;">3 - 16 characters please</strong>';
	    exit();
    }
	if (is_numeric($username[0])) {
	    echo '<strong style="color:#F00;">Usernames must begin with a letter</strong>';
	    exit();
    }
    if ($uname_check < 1) {
	    echo '<strong >Username: <span style="color:blue;">' . $username . '</span> is OK</strong>';
	    exit();
    } else {
	    echo '<strong style="color:#F00;">Username: <span style="color:blue;">' . $username . '</span> is taken. Please choose another username</strong>';
	    exit();
    }
}
?>
<?php
// Ajax calls this REGISTRATION code to execute
if(isset($_POST["u"])){
	// CONNECT TO THE DATABASE
	include_once("scripts/connect.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES
	$u = preg_replace('#[^a-z0-9]#i', '', $_POST['u']);
	$e = mysqli_real_escape_string($link, $_POST['e']);
	$p = $_POST['p'];
/*	$g = preg_replace('#[^a-z]#', '', $_POST['g']);
	$c = preg_replace('#[^a-z ]#i', '', $_POST['c']);*/
	// GET USER IP ADDRESS
    //$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// DUPLICATE DATA CHECKS FOR USERNAME AND EMAIL
	$sql = "SELECT user_ID FROM users WHERE username='$u' LIMIT 1";
    $query = mysqli_query($link, $sql); 
	$u_check = mysqli_num_rows($query);
	// -------------------------------------------
	$sql = "SELECT user_ID FROM users WHERE email='$e' LIMIT 1";
    $query = mysqli_query($link, $sql); 
	$e_check = mysqli_num_rows($query);
	// FORM DATA ERROR HANDLING
	if($u == "" || $e == "" || $p == ""){
		echo "The form submission is missing values.";
        exit();
	} else if ($u_check > 0){ 
        echo "The username you entered is alreay taken";
        exit();
	} else if ($e_check > 0){ 
        echo "That email address is already in use in the system";
        exit();
	} else if (strlen($u) < 3 || strlen($u) > 16) {
        echo "Username must be between 3 and 16 characters";
        exit(); 
    } else {
	// END FORM DATA ERROR HANDLING
	    // Begin Insertion of data into the database
		// Hash the password and apply your own mysterious unique salt
		$cryptpass = crypt($p);
		include_once ("scripts/randStrGen.php");
		$p_hash = randStrGen(20)."$cryptpass".randStrGen(20);
		// Add user info into the database table for the main site table
		$sql = "INSERT INTO `users` (`user_ID`, `username`, `email`, `password`, `signup_date`) VALUES (NULL, '$u', '$e', '$p', now());";
		$query = mysqli_query($link, $sql) or die (mysqli_error($link)); 
		$uid = mysqli_insert_id($link);
	
		echo "ok";
		exit();
	}
	exit();
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
<script>
function restrict(elem){
	var tf = _(elem);
	var rx = new RegExp;
	if(elem == "email"){
		rx = /[' "]/gi;
	} else if(elem == "username"){
		rx = /[^a-z0-9]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}
function emptyElement(x){
	_(x).innerHTML = "";
}
function checkusername(){
	var u = _("username").value;
	if(u != ""){
		_("unamestatus").innerHTML = 'checking ...';
		var ajax = ajaxObj("POST", "sign_up.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            _("unamestatus").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("usernamecheck="+u);
	}
}
function signup(){
	var u = _("username").value;
	var e = _("email").value;
	var p1 = _("pass1").value;
	var p2 = _("pass2").value;
/*	var c = _("country").value;
	var g = _("gender").value;*/
	var status = _("status");
	if(u == "" || e == "" || p1 == "" || p2 == ""){
		status.innerHTML = "Fill out all of the form data";
	} else if(p1 != p2){
		status.innerHTML = "Your password fields do not match";
	} else {
		_("signupbtn").style.display = "none";
		status.innerHTML = 'please wait ...';
		var ajax = ajaxObj("POST", "sign_up.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
					window.scrollTo(0,0);
					
					_("signup_content").innerHTML = '<h1 style="color:rgba(57,96,221,1.00); font-weight:bold;">Congratulation <span style="color:rgba(243,25,39,1.00)">'+u+'</span>, now you can log in and HAVE MORE FUN</h1>';
				
	        }
        }
        ajax.send("u="+u+"&e="+e+"&p="+p1);
	}
}
/*function openTerms(){
	_("terms").style.display = "block";
	emptyElement("status");
}*/
/* function addEvents(){
	_("elemID").addEventListener("click", func, false);
}
window.onload = addEvents; */
</script>

</head>
<body>
<div class="wrapper">
  <div class="container">
    <div id="signup_content">
  <h1>Welcome to JOLLY DRAGON</h1>
      <h2>Let's sign up to have more fun!</h2>
      <form class="form" name="signupform" id="signupform" onsubmit="return false;">
        <input id="username" type="text" onblur="checkusername()" onkeyup="restrict('username')" maxlength="16" placeholder="User Name">
        <span id="unamestatus"></span>
        <input id="email" type="text" onfocus="emptyElement('status')" onkeyup="restrict('email')" maxlength="88" placeholder="Email Address">
        <input id="pass1" type="password" onfocus="emptyElement('status')" maxlength="50" placeholder="Password">
        <input id="pass2" type="password" onfocus="emptyElement('status')" maxlength="50" placeholder="Confirm Password">
        <br/>
        <button id="signupbtn" onclick="signup()">Create Account</button>
        <br/>
        <div id="status" style="color:red; font-size:18px; margin-top:20px; margin-bottom:10px;"></div>
        <p>By Creating an account, you agreed with our <a href="#">terms and conditions</a></p>
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
