<?php
session_start();
require_once "inc/config.inc.php";

if(!isset($_SESSION['email'])) {
	header('Location: login.php');
}

$name = $_SESSION['name'];
$id = $_SESSION['id'];

$sth = $conn->prepare("SELECT c.*, cl.name FROM contracts c INNER JOIN clients cl ON c.client_id = cl.id");
		$sth->bindParam(':client_id', $id, PDO::PARAM_STR);
		$sth->execute();	
		
//Check session is already set, otherwise redirect to login page
if(empty($name)) {
	header("Location:login.php");
	exit;
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Dashboard</title>
 	<script src="js/jquery.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="css/all.css" rel="stylesheet"  integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row mt-4">
			<h2 class="col-8">Bienvenido <?php echo $name ?></h2>
			<div class="col-4">
				<a class="btn btn-primary float-right" href="logout.php">Logout</a>
			</div>
		</div>
		<input id="search" class="form-control col-3 mt-2" type="text" placeholder="Buscar solo por Id. Cliente" aria-label="Buscar solo por Id. Cliente">
		<table id='contracts_table' class="table table-striped table-bordered mt-3" style="width:100%">
				<thead>
					<tr>
						<th>Id. Contrato</th>
						<th>Id. Cliente</th>
						<th>Nombre de cliente</th>
					</tr>
				</thead>		
				<tbody>
					<?php while($row = $sth->fetch()):?>
					<tr>
					<?php echo "<td>" . $row['id'] . "</td>";?>
					<?php echo "<td>" . $row['client_id'] . "</td>";?>
					<?php echo "<td>" . $row['name'] . "</td>";?>
					</tr>
					<?php endwhile;?>
				</tbody>
		</table>

		<h4 id='errorFound'>No results found.</h4>
	</div>
</body>

<script>
$(document).ready(function() {
	
	$('#errorFound').hide();
	$("#search").on("keyup", function() {
		var value = $(this).val();
		var found = false;
		$("#contracts_table tr td:nth-child(2)").filter(function() {	
			found = $(this).text().indexOf(value) > -1;			
			$(this).parent().toggle(found)
		});
		
		if(found) {
			$('#errorFound').hide();			
		} else {
			$('#errorFound').show();
		}
	});
} );
</script>