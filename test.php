<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script src="js/main.js"></script>
<script>
	function change(){
		_("div1").innerHTML = '<h1 style="color:rgba(57,96,221,1.00)">Congratulation <span style="color:rgba(243,25,39,1.00)">"+u+"</span>, now you can log in and HAVE MORE FUN</h1>';
		}
</script>
</head>

<body>
<div id="div1">Content for  id "div1" Goes Here</div>
<!--<h1 style="color:rgba(57,96,221,1.00);">Congratulation <span style="color:rgba(243,25,39,1.00)">"+u+"</span>, now you can log in and HAVE MORE FUN</h1>-->
<input type="button" value="change content" onClick="change()">
</body>
</html>