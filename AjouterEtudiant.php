<?php
error_reporting(0);
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Ajouter Etudiant</title>
    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link rel="stylesheet" href="./AjouterEtudiant2.css">
    <!-- Bootstrap core JS-JQUERY -->
<script src="./assets/dist/js/jquery.min.js"></script>
<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet">
    <!-- conformité de mot de passe -->
    <script>
        function validate(){

            var a = document.getElementById("pwd").value;
            var b = document.getElementById("cpwd").value;
            if (a!=b) {
               alert("Passwords do no match");
               return false;
            }
        }
     </script>
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
 <form id="myform" method="POST" action="ajouter.php" onSubmit="return validate();">
 <div class="title">Register Student!</div>
     <div class="input-box underline">
    <label for="nom" class="sr-only"> </label>
     <input type="text" id="nom" name="nom" class="form-control" placeholder="Last name" required autofocus>
    <div class="underline"></div>
    </div>
    <div class="input-box underline">
    <label for="prenom" class="sr-only"> </label>
    <input type="text" id="prenom" name="prenom" class="form-control" placeholder="First name" required autofocus>
    <div class="underline"></div>
    </div>
    
    <div class="input-box underline">
    <label for="cin" class="sr-only"> </label>
    <input type="number_format" id="cin" name="cin" class="form-control " placeholder="Cin" required  pattern="[0-9]{8}" class="form-control" minlength="8"  maxlength="8" title="8 chiffres">
    <div class="underline"></div> 
    </div>
    
    <div class="input-box underline" >
    <label for="pwd" class="sr-only"> </label>
    <input type="password" id="pwd" name="pwd" class="form-control" placeholder="Password" required pattern="[a-zA-Z0-9]{8,}" title="Au moins 8 lettres et nombres">
    <div class="underline"></div>
    <i class="far fa-eye" id="togglePassword" style="
                cursor: pointer;transform: translateY(-36px) translateX(720px);
                color: #7a797a;"></i>
    </div>
    
    <div class="input-box underline">
    <label for="cpwd" class="sr-only"> </label>
    <input type="password" id="cpwd" name="cpwd" class="form-control" placeholder="Confirm password" required >
    <div class="underline"></div>
    <i class="far fa-eye" id="togglePassword2" style="
                cursor: pointer;transform: translateY(-36px) translateX(720px);
                color: #7a797a;"></i>
    </div>
    
    <div class="input-box underline">
    <label for="Mail" class="sr-only"> </label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
    <div class="underline"></div>
    </div>
    <div class="input-box underline">
    <label for="adresse" class="sr-only"> </label>
    <input type="text" id="adresse" name="adresse" class="form-control" placeholder="Adresse" required autofocus>
    <div class="underline"></div>
    </div>
    
  
        <div class="form-group" >
          <label for="classe" ></label><br>
          <select id="classe" name="classe" class="custom-select custom-select-sm custom-select-lg" style="transform:translateX( -240px); ">
          <option>--Class--</option>
            <option value="1-INFOA">1-INFOA</option>
            <option value="1-INFOB">1-INFOB</option>
            <option value="1-INFOC">1-INFOC</option>
            <option value="1-INFOD">1-INFOD</option>
            <option value="1-INFOE">1-INFOE</option>
          </select>
        </div>
      

        <style>
    select {
        min-width: 750px;
        width: auto;
    }
  
</style>
    
    <div class="input-box button">
    <input type="submit" name="ajouter" style="transform:translateX(-250px)" onclick="ajouter()" value=" Register" />
    <b></b>
    <input type="button" value="Annuler" style="transform:translateX(-250px)" onclick="history.back()"  />
    </div>
    </form>
</div>
</p>
<div id="demo"></div>
<script>
    function ajouter()
    {
        var xmlhttp = new XMLHttpRequest();
        var url="http://localhost/Projet/ajouter.php";
        
        //Envoie Req
        xmlhttp.open("POST",url,true);

        form=document.getElementById("myForm");
        formdata=new FormData(form);

        xmlhttp.send(formdata);

        //Traiter Res

        xmlhttp.onreadystatechange=function()
            {   
                if(this.readyState==4 && this.status==200){
                // alert(this.responseText);
                    if(this.responseText=="OK")
                    {
                        document.getElementById("demo").innerHTML="L'ajout de l'étudiant a été bien effectué";
                        document.getElementById("demo").style.backgroundColor="green";
                    }
                    else
                    {
                        document.getElementById("demo").innerHTML="L'étudiant est déjà inscrit, merci de vérifier le CIN";
                        document.getElementById("demo").style.backgroundColor="#fba";
                    }
                }
            }
        
        
    }
    </script>
      <script>
        const togglePassword = document.querySelector('#togglePassword');
        const pwd = document.querySelector('#pwd');
        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = pwd.getAttribute('type') === 'password' ? 'text' : 'password';
            pwd.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
        const togglePassword2 = document.querySelector('#togglePassword2');
        const cpwd = document.querySelector('#cpwd');
        togglePassword2.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = cpwd.getAttribute('type') === 'password' ? 'text' : 'password';
            cpwd.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
 
</body>
</html>