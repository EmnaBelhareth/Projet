<?php
include('connexion.php');
$cin = $_REQUEST['cin'];
$pdo_statement = $pdo->prepare("delete from etudiant where cin=" . $cin);
$result = $pdo_statement->execute();
if (!empty($result) ){
  echo '<div class="alert alert-success">Data deleted successfully.</div>';
}
else{
  echo '<div class="alert alert-danger">Data deleting failed.</div>';
}



?>