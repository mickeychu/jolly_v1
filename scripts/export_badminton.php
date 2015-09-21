
<?php
if (isset ($_GET['username']))
{
	// Connect to the MySQL database  
	require "connect.php";
	
	$user = $_GET['username'];
	$xls_filename = 'export_'.date('Y-m-d').'.xls'; // Define Excel (.xls) file name
	 
	/***** DO NOT EDIT BELOW LINES *****/
	// Create MySQL connection
	$result = mysqli_query($link, "SELECT email FROM `badminton_list` WHERE username = '$user'");
	
	
	 
	// Header info settings
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=$xls_filename");
	header("Pragma: no-cache");
	header("Expires: 0");
	 
	/***** Start of Formatting for Excel *****/
	// Define separator (defines columns in excel &amp; tabs in word)
	$sep = "\t"; // tabbed character
	 
	// Start of printing column names as names of MySQL fields
	while ($property = mysqli_fetch_field($result)) {
		echo $property->name.$sep;
	}
	print("\n");
	// End of printing column names
	 
	// Start while loop to get data
	while($row = mysqli_fetch_row($result))
	{
	  $schema_insert = "";
	  for($j=0; $j<mysqli_num_fields($result); $j++)
	  {
		if(!isset($row[$j])) {
		  $schema_insert .= "NULL".$sep;
		}
		elseif ($row[$j] != "") {
		  $schema_insert .= "$row[$j]".$sep;
		}
		else {
		  $schema_insert .= "".$sep;
		}
	  }
	  $schema_insert = str_replace($sep."$", "", $schema_insert);
	  $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
	  $schema_insert .= "\t";
	  print(trim($schema_insert));
	  print "\n";
	}
}

else 
{
	echo '<script>
 			alert ("ERROR!!!");
			window.location = "../badminton.php";
		  </script>';
}

?>