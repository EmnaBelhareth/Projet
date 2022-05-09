<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Liste of students</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
	<link rel="stylesheet" href="./afficherEtudiants.css">
	<style>
		.height10{
			height:10px;
		}
		.mtop10{
			margin-top:10px;
		}
		.modal-label{
			position:relative;
			top:7px
		}
	</style>
</head>
<body >
<div class="container">
	<h1 class="page-header text-center" >List of students</h1>
	<div class="row" >
		<div class="col-sm-8 col-sm-offset-2"  >
			<div class="row"  >
			<?php
				if(isset($_SESSION['error'])){
					echo
					"
					<div class='alert alert-danger text-center'>
						<button class='close'>&times;</button>
						".$_SESSION['error']."
					</div>
					";
					unset($_SESSION['error']);
				}
				if(isset($_SESSION['success'])){
					echo
					"
					<div class='alert alert-success text-center'>
						<button class='close'>&times;</button>
						".$_SESSION['success']."
					</div>
					";
					unset($_SESSION['success']);
				}
			?>
			</div>
			<div class="row"   >
				<a href="./AjouterEtudiant.php" data-toggle="modal" style="transform:translateY(45px) translateX(-100px)"class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> New</a>
				<a href="./index.php" data-toggle="modal" style="transform:translateY(45px) translateX(720px)"class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Home</a>
			</div>
			<div class="height10" style="transform:translateX(-100px); ">
			</div>

			<div class="row" >
				<table id="myTable" class="table table-bordered table-striped" style='transform:translateX(-100px) ; color:black;'>
					<thead>
						<th>CIN</th>
						<th>LastName</th>
						<th>FirstName</th>
						<th>Address</th>
						<th>E-mail</th>
            <th>Class</th>
            <th>Action</th>
			
					</thead>
					<tbody>
						<?php
							include_once('connexion.php');
							$sql = "select * from etudiant e inner join groupe g where e.idg=g.idg";

							
							$query = $pdo->query($sql);
							while($row = $query->fetch()){
								echo 
								"<tr>
									<td>".$row['cin']."</td>
									<td>".$row['nom']."</td>
									<td>".$row['prenom']."</td>
									<td>".$row['adresse']."</td>
                  					<td>".$row['email']."</td>
                 				    <td>".$row['nomg']."</td>
									<td>
										<a href='#edit_".$row['cin']."' class='btn btn-success btn-sm'style='width: 200px;' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Edit</a>
										
										
										<a href='#delete_".$row['cin']."' class='btn btn-danger btn-sm' style='width: 200px;' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Delete</a>
									</td>
								</tr>";
								include('edit_delete_modal.php');
							}

						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="datatable/jquery.dataTables.min.js"></script>
<script src="datatable/dataTable.bootstrap.min.js"></script>
<!-- generate datatable on our table -->
<script>
$(document).ready(function(){
	//inialize datatable
    $('#myTable').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});
</script>
</body>
<footer><div class="PP"><p>&copy; ENICAR 2021-2022</p></div></footer>
<style>
.PP{
	text-align: center;
}
</style>
</html>