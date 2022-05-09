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
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.88.1">
    <title>SCO-ENICAR</title>
    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="./index3.css"  rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
<script src="./assets/dist/js/jquery.min.js"></script>
<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

  </head>
  <body>
    
  <nav class="navbar navbar-expand-md navbar-dark fixed-top " style="background:black">
        <a class="navbar-brand" href="#">SCO-Enicar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
        
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="index.php" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Class managment</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="afficherEtudiants.php">List of Students</a>
                <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Students by class</a>
                <a class="dropdown-item" href="./createclass.php">Add Class</a>
                <a class="dropdown-item" href="./createclass.php">Modify Class</a>
                <a class="dropdown-item" href="./createclass.php">Delete Class</a>
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Students Managment</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="ajouterEtudiant.php">Add Etudiant</a>
                <a class="dropdown-item" href="./AfficherEtudiants.php">Search student</a>
                <a class="dropdown-item" href="./AfficherEtudiants.php">Modify Student</a>
                <a class="dropdown-item" href="./AfficherEtudiants.php">Delete Student</a>
      
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Absences Managment</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="./attendance.php">Attendance</a>
                <a class="dropdown-item" href="etatAbsence.html">Reports</a>
              </div>
            </li>
      
            <li class="nav-item active">
            <a class="nav-link " href="./login.php" style="transform:translateX(600px)">Log out  <span class="sr-only">(current)</span></a>
            </li>
      
          </ul>
        
      
        
      </nav>
      
<main role="main">
<div class="image">
		<img src="./enic.jpg">
	
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron" >
    <!-- Example row of columns -->
    <div class="row"style="transform:translateY(300x)">
      <div class="col-md-4">
        <h2>INFO1</h2>
        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
        <p><a class="btn btn-secondary" href="#" role="button">Voir les Groupes &raquo;</a></p>
      </div>
      <div class="col-md-4">
        <h2>INFO2</h2>
        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
        <p><a class="btn btn-secondary" href="#" role="button">Voir les Groupes &raquo;</a></p>
      </div>
      <div class="col-md-4">
        <h2>INFO3</h2>
        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
        <p><a class="btn btn-secondary" href="#" role="button">Voir les Groupes &raquo;</a></p>
      </div>
    
      </div>
    <hr>

  </div> <!-- /container -->

</main>


<footer class="container" style="transform: translateY(200px);">
  <p>&copy; ENICAR 2021-2022</p>
</footer>


   
      
  </body>
</html>