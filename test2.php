<?php
   session_start();
   if($_SESSION["autoriser"]!="oui"){
      header("location:login.php");
      exit();
   }
   if(date("H")<18)
      $bienvenue="Bonjour et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
   else
      $bienvenue="Bonsoir et bienvenue ".
      $_SESSION["prenomNom"].
      " dans votre espace personnel";
?>
<link href="https://fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet">
<link rel="stylesheet" href="./index5.css">
<p id='head1' class='header'><?php echo $bienvenue?>!</p>
<p id='head2' class='header'>INFORMATIQUE</p>
<p id='head3' class='header'>INDUSTRIEL</p>
<p id='head4' class='header'>Mecatronique</p>
<a href="./index.php">
<button>Continue</button>
</a>
  <div class='light x1'></div>
  <div class='light x2'></div>
  <div class='light x3'></div>
  <div class='light x4'></div>
  <div class='light x5'></div>
  <div class='light x6'></div>
  <div class='light x7'></div>
  <div class='light x8'></div>
  <div class='light x9'></div>