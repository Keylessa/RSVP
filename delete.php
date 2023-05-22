<?php  
if(isset($_GET["id"])){
	$id=$_GET["id"];
	
				$servername = "localhost";
				$username = "root";
				$password = "";
				$database = "rezervari";
				
				//create mysql connection
				$connection = new mysqli($servername, $username, $password, $database);

	$sql = "DELETE FROM employees WHERE id=$id";
	$connection->query($sql);
	
	header("location: /welcome.php");
		exit;
}
?>