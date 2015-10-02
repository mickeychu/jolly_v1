<?php 

require "scripts/connect.php";

$check = mysqli_query($link, "SELECT email FROM `floorball_list` WHERE username='mickey' ");
 
 while ($data = mysqli_fetch_array($check, MYSQLI_ASSOC))
{
    foreach($data as $key => $var)
    {	
		if($var === "opetus.seure@hel.fi"){
        	echo 'duplicate'. '<br />';
			}
		else{
			echo $key . ' = ' . $var . '<br />';
			}
    }
    
}


?>