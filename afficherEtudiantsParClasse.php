<?php
error_reporting(0);
include 'connexion.php';
session_start();

$idg = $_REQUEST['idg'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SCO-ENICAR Etudiants Par CLasse</title>
  <!-- Bootstrap core CSS -->
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap core JS-JQUERY -->
  <script src="./assets/dist/js/jquery.min.js"></script>
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./afficherEtudiantsParClasse3.css">

  <!-- Custom styles for this template -->
  <link href="./assets/jumbotron.css" rel="stylesheet">

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
                <a class="dropdown-item" href="./createclass.php">Add Class</a>
                <a class="dropdown-item" href="./createclass.php">Modify Class</a>
                <a class="dropdown-item" href="./createclass.php">Delete Class</a>
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Students Managment</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="ajouterEtudiant.php">Add Student</a>
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

 
  <div class="container">
    <h1 class="display-5" >Display list of students by class</h1>



 
      <form>
        <div class="form-group">
          <label for="classe">Select class:</label><br>
          <select id="classe" name="idg" class="custom-select custom-select-sm custom-select-lg">
          <option>--Select--</option>
            <option value="1">1-INFOA</option>
            <option value="2">1-INFOB</option>
            <option value="3">1-INFOC</option>
            <option value="4">1-INFOD</option>
            <option value="5">1-INFOE</option>
          </select>
          <input type="submit" class="btn btn-outline-success my-2 my-sm-0" style="transform:translateX(620px) translateY(10px);" name="envoyer"  value="valider">
        </div>
      </form>
   
    <?php
    if (isset($_GET['envoyer'])) {
      $idg = $_GET['idg'];
    }
    ?>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th class="text">Roll</th>
          <th class="text-center">Student </th>
        </tr>
      </thead>

      <?php

      $qu = "SELECT etudiant.sid, etudiant.nom,etudiant.prenom from etudiant where etudiant.idg='$idg' ORDER BY etudiant.sid";
      $stu = $pdo->query($qu);
      $rstu = $stu->fetchAll(PDO::FETCH_ASSOC);

      echo "<tbody>";
      for ($i = 0; $i < count($rstu); $i++) {
        echo "<tr>";


        echo "<td>" . $rstu[$i]['sid'] . "<input type='hidden' name='st_sid[]' value='" . $rstu[$i]['sid'] . "'>";
        echo "<td  class='text-center'>" . $rstu[$i]['nom'] . "  " . $rstu[$i]['prenom'] .  "</td>";






        echo "</tr>";
      }
      echo "</tbody>";

      ?>
    </table>

  </main>
</div>
  <footer>
    <p>&copy; ENICAR 2021-2022</p>
  </footer>
</body>

</html>