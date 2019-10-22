<?php
session_start();
require_once "config.inc.php";

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
 


<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
 

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

<script>
$(document).ready(function() {
	
	$('#errorFound').hide();
	$("#search").on("keyup", function() {
		var found = false;
		var value = $(this).val().toLowerCase();
		$("#contracts_table tr td:nth-child(2)").filter(function() {
		 $(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)		 
		 if($(this).text().toLowerCase().indexOf(value) > -1) {
			found = true;
		 }		 
		});
		if(found) {
			$('#errorFound').hide();			
		} else {
			$('#errorFound').show();
		}
	});
} );
</script>