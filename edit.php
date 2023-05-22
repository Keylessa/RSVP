<?php

				$servername = "localhost";
				$username = "root";
				$password = "";
				$database = "rezervari";
				
				//create mysql connection
				$connection = new mysqli($servername, $username, $password, $database);


$id="";
$data="";
$nume="";
$telefon="";
$eveniment="";
$numar_persoane="";

$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD']== 'GET'){
	if(!isset($_GET["id"])){
		header("location: /index.php");
		exit;
	}
	
	$id = $_GET["id"];
	
	$sql="SELECT * FROM employees WHERE id=$id";
	$result = $connection->query($sql);
	$row = $result->fetch_assoc();
	
	if(!$row){
		header("location: /index.php");
		exit;
	}
	
	$data= $row["data"];
	$nume= $row["nume"];
	$telefon= $row["telefon"];
	$eveniment= $row["eveniment"];
	$numar_persoane= $row["numar_persoane"];
}
else{
	$id= $_POST["id"];
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
		
		$sql = "UPDATE employees SET data = '$data', nume = '$nume', telefon = '$telefon', eveniment = '$eveniment', numar_persoane = '$numar_persoane' WHERE id = $id";
		
		$result = $connection->query($sql);
		
		if(!$result){
			$errorMessage = "Invalid query: " . $connection->error;
			break;
		}
		$successMessage = "Rezervare editata cu succes!";
		
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
<title>Rezervari LeCroc</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<body>
	<div class="container my-5">
		<h2>Rezervare Noua</h2>
		
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
		<input type="hidden" name="id" value="<?php echo $id; ?>">
			<div class="row mb-3">
				<label class="col-sm-3 col-form-label">Data</label>
					<div class="col-sm-6">
					<input type="date" id="start" name="data"
					value="<?php echo $data; ?>"
					min="2023-01-01" max="2024-12-31">
						
					</div>
			
			</div>
			
			<div class="row mb-3">
				<label class="col-sm-3 col-form-label">Nume</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="nume" value="<?php echo $nume; ?>">
					</div>
			
			</div>
			
			<div class="row mb-3">
				<label class="col-sm-3 col-form-label">Telefon</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="telefon" value="<?php echo $telefon; ?>">
					</div>
			
			</div>
			
			<div class="row mb-3">
				<label class="col-sm-3 col-form-label">Eveniment</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="eveniment" value="<?php echo $eveniment; ?>">
					</div>
			
			</div>
			
			<div class="row mb-3">
				<label class="col-sm-3 col-form-label">Numar Persoane</label>
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