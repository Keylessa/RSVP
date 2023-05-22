<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Rezervari LeCroc</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body style="margin: 50px;">
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