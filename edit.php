<?php
	session_start();
	include_once('connexion.php');

	if(isset($_POST['edit'])){
		$cin = $_POST['cin'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$address = $_POST['adresse'];
        $email = $_POST['email'];
		$idg = $_POST['idg'];
		$sql = "UPDATE etudiant SET nom = '$nom', prenom = '$prenom', adresse = '$address', email = '$email', idg = '$idg' WHERE cin = '$cin'";

		//use for MySQLi OOP
		if($pdo->query($sql)){
			$_SESSION['success'] = 'etudiant updated successfully';
		}
		
		else{
			$_SESSION['error'] = 'Something went wrong in updating etudiant';
		}
	}
	else{
		$_SESSION['error'] = 'Select etudiant to edit first';
	}

	header('location: AfficherEtudiants.php');

?>