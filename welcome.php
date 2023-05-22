<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>


<div class="topnav">
    <a href="logout.php" class="btn btn-danger ml-3">Sign Out</a>
		<a href="./login.php">Login</a>
		<a href="http://lecroc.ro/contact-us/">Contact</a>
		<a href="http://lecroc.ro/menu/">Menu</a>
		<a href="http://lecroc.ro/about-us/">About Us</a>
		<a class="login_btn" href="http://lecroc.ro">Home</a>
</div>

    <h1>Lista cu Rezervari</h1>
	<br>
	<a class='btn btn-primary' href="/create.php" role="button">Rezervare Noua</a>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Data</th>
					<th>Nume</th>
					<th>Telefon</th>
					<th>Eveniment</th>
					<th>Nr Pers</th>
					<th>Edit / Delete</th>
				</tr>
			</thead>
			
			<tbody>
				<?php
				$servername = "localhost";
				$username = "root";
				$password = "";
				$database = "rezervari";
				
				//create mysql connection
				$connection = new mysqli($servername, $username, $password, $database);
				
				//check if exist connection
				if($connection->connect_error){
					die("Connection failed: " . $connection->connect_error);
				}
				
				//Read all row from database
				$sql = "SELECT * FROM employees ORDER BY data";
				$result = $connection->query($sql);
				
				if(!$result){
					die("Invalid Query: " . $connection->error);
				}
				
				//read data of each row
				while($row = $result->fetch_assoc()){
					echo "<tr>
						<td>" . $row["id"] . "</td>
						<td>" . $row["data"] . "</td>
						<td>" . $row["nume"] . "</td>
						<td>" . $row["telefon"] . "</td>
						<td>" . $row["eveniment"] . "</td>
						<td>" . $row["numar_persoane"] . "</td>
						<td>
							<a class='btn btn-primary btn-sm' href='/edit.php?id=$row[id]'>Edit</a>
							<a class='btn btn-danger btn-sm' href='/delete.php?id=$row[id]'>Delete</a>
						</td>
					</tr>";
				}
				
				
				
					
				?>
			</tbody>
		</table>

</body>
</html>