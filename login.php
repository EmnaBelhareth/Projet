<?php
   session_start();
   @$email=$_POST["email"];
   @$password=md5($_POST["password"]);
   @$valider=$_POST["valider"];
   $erreur="";
   if(isset($valider)){
      include("connexion.php");
      $sel=$pdo->prepare("select * from enseignant where email=? and password=? limit 1");
      $sel->execute(array($email,$password));
      $tab=$sel->fetchAll();
      if(count($tab)>0){
         $_SESSION["prenomNom"]=ucfirst(strtolower($tab[0]["prenom"])).
         " ".strtoupper($tab[0]["nom"]);
         $_SESSION["autoriser"]="oui";
         header("location:test2.php");
      }
      else
      $erreur="Email or password incorrect, please try again!";
   }
   
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>SCO-ENICAR Se Connecter</title>
    <link rel="stylesheet" href="./login2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
   </head>
   <body onLoad="document.fo.login.focus()">
      <div class="container">
      <form name="fo" method="post" action="">
         <form id="myForm" class="form-signin" >
         <div class="title">Login Form</div>
         <div class="input-box underline">
         <label for="email" class="sr-only"> </label>
         <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required autofocus>
         <div class="underline"></div>
         </div>
         <div class="input-box">
        <label for="password" class="sr-only"></label>
        <input type="password" id="password" name="password"class="form-control" placeholder="Password" required autofocus>
        <i class="far fa-eye" id="togglePassword" style=" margin-left: 260px; 
             cursor: pointer;transform: translateY(-35px); color: #7a797a;"></i>
        <div class="underline"></div>
      </div>
      <div class="erreur" style="transform:translateY(20px);  font-size: 0.775em; color:red;"><?php echo $erreur ?></div>
      <div class="input-box button">
         <input type="submit" name="valider" value="Login"   />
      </div>
      <div class="pass"><a href="./forgot.php"style="color: blue;">Forget Password ?</a></div>
      <a href="inscript.php" style="color:black">Create an account</a>
      </form>
   </form>
   </div>
   <p class="mt-5 mb-3 text-muted" style="transform: translateY(-110px) translateX(-30px); color:grey;">&copy; SOC-Enicar 2021-2022</p>
   <script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');
  togglePassword.addEventListener('click', function (e) {
  // toggle the type attribute
  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', type);
  // toggle the eye slash icon
  this.classList.toggle('fa-eye-slash');
});
</script>  
</body>
<script>
	$('#myForm').validator();
	
</script>

</html>
