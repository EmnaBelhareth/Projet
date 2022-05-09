<?php
	session_start();
	include_once('connexion.php');

	if(isset($_GET['cin'])){
		$sql = "DELETE FROM etudiant WHERE cin = '".$_GET['cin']."'";

		if($pdo->query($sql)){
			$_SESSION['success'] = 'Member deleted successfully';
		}
		
		else{
			$_SESSION['error'] = 'Something went wrong in deleting member';
		}
	}
	else{
		$_SESSION['error'] = 'Select member to delete first';
	}

	header('location: AfficherEtudiants.php');
?>