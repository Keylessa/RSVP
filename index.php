<?php

				$servername = "localhost";
				$username = "root";
				$password = "";
				$database = "rezervari";
				
				//create mysql connection
				$connection = new mysqli($servername, $username, $password, $database);



$data="";
$nume="";
$telefon="";
$eveniment="";
$numar_persoane="";

$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD']=='POST'){
	$data= $_POST["data"];
	$nume= $_POST["nume"];
	$telefon= $_POST["telefon"];
	$eveniment= $_POST["eveniment"];
	$numar_persoane= $_POST["numar_persoane"];
	
	do{
		if(empty($data)|| empty($nume)|| empty($telefon)||empty($numar_persoane)){
			$errorMessage = "Esti rugat sa completezi campurile Data, Nume,Telefon,Numar Persoane";
			break;
		}
		
		//adauga rezervare noua in baza de date
		
		$sql = "INSERT INTO employees (data,nume,telefon,eveniment,numar_persoane)" . 
				"VALUES ('$data','$nume','$telefon','$eveniment','$numar_persoane')";
		$result = $connection->query($sql);
		
		if(!$result){
			$errorMessage = "Invalid query: " . $connection->error;
			break;
		}
		
		
		$data="";
		$nume="";
		$telefon="";
		$eveniment="";
		$numar_persoane="";
		
		$successMessage= "Rezervare adaugata cu succes!";
		
		header("location: /index.php");
		exit;
		
		
	}while(false);
}
?>



<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./CSS/style.css">
<title>Rezervari LeCroc</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body style="background-color:black;">

	<div class="topnav">
		<a href="./login.php">Login</a>
		<a href="http://lecroc.ro/contact-us/">Contact</a>
		<a href="http://lecroc.ro/menu/">Menu</a>
		<a href="http://lecroc.ro/about-us/">About Us</a>
		<a class="login_btn" href="http://lecroc.ro">Home</a>
	</div>
<!-- 
	<video autoplay muted loop class="my_video">
  <source src="./assets/intro.mp4" type="video/mp4">
	</video>
-->


	<div class="container my-5 container_rsvp">
		<h2 class="text_color">Rezervare Noua</h2>
		
		<?php 
		
		if(!empty($errorMessage)){
			echo"
			<div class='alert alert-warning alert-dismissible afde show' role='alert'>
				<strong>$errorMessage</strong>
				<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>
			";
		}
		
		?>
		
		<form method="post">
			<div class="row mb-3">
				<label class="col-sm-3 col-form-label text_color">Data</label>
					<div class="col-sm-6">
					<input type="datetime-local" id="start" name="data"
					value="<?php echo $data; ?>"
					min="2023-01-01" max="2024-12-31">

					<small class="text_color">Interval orar Marti - Vineri 18 - 24 Sambata - Duminica 14 - 24</small>
						
					</div>
			
			</div>

		
			
			<div class="row mb-3">
				<label class="col-sm-3 col-form-label text_color">Nume</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="nume" value="<?php echo $nume; ?>">
					</div>
			
			</div>
			
			<div class="row mb-3">
				<label class="col-sm-3 col-form-label text_color">Telefon</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="telefon" value="<?php echo $telefon; ?>">
					</div>
			
			</div>
			
			<div class="row mb-3">
				<label class="col-sm-3 col-form-label text_color">Eveniment</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="eveniment" value="<?php echo $eveniment; ?>">
					</div>
			
			</div>
			
			<div class="row mb-3">
				<label class="col-sm-3 col-form-label text_color">Numar Persoane</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="numar_persoane" value="<?php echo $numar_persoane; ?>">
					</div>
			
			</div>
			
			<?php 
		
		if(!empty($successMessage)){
			echo"
			<div class='alert alert-success alert-dismissible fade show' role='alert'>
				<strong>$successMessage</strong>
				<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
			</div>
			";
		}
		
		?>
		
			<div class="row mb-3">
				<div class="offset-sm-3 col-sm-3 d-grid">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
				<div class="col-sm-3 d-grid">
					<a class="btn btn-outline-primary" href="/" role="button">Cancel</a>
				</div>
			</div>
		</form>
	</div>


</body>
</html>