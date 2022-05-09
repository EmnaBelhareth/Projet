<?php 
session_start();
$error = array();

require "mail.php";

	if(!$con = mysqli_connect("localhost","root","","forgot_db")){

		die("could not connect");
	}

	$mode = "enter_email";
	if(isset($_GET['mode'])){
		$mode = $_GET['mode'];
	}

	//something is posted
	if(count($_POST) > 0){

		switch ($mode) {
			case 'enter_email':
				// code...
				$email = $_POST['email'];
				//validate email
				if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
					$error[] = "Veuillez entrer une adresse email valide.";
				}elseif(!valid_email($email)){
					$error[] = "E-mail n existe pas";
				}else{

					$_SESSION['forgot']['email'] = $email;
					send_email($email);
					
					header("Location: forgot.php?mode=enter_code");
					die;
				}
				break;

			case 'enter_code':
				// code...
				$code = $_POST['code'];
				$result = is_code_correct($code);

				if($result == "code  correct"){

					$_SESSION['forgot']['code'] = $code;
					header("Location: forgot.php?mode=enter_password");
					die;
				}else{
					$error[] = $result;
				}
				break;

			case 'enter_password':
				// code...
				$password = $_POST['password'];
				$password2 = $_POST['password2'];

				if($password !== $password2){
					$error[] = "Passwords do not match";
				}elseif(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
					header("Location: forgot.php");
					die;
				}else{
					
					save_password($password);
					if(isset($_SESSION['forgot'])){
						unset($_SESSION['forgot']);
					}

					header("Location: login.php");
					die;
				}
				break;
			
			default:
				// code...
				break;
		}
	}

	function send_email($email){
		
		global $con;

		$expire = time() + (60 * 1);
		$code = rand(10000,99999);
		$email = addslashes($email);

		$query = "insert into codes (email,code,expire) value ('$email','$code','$expire')";
		mysqli_query($con,$query);

		//send email here
		send_mail($email,'Reinitialisation du mot de passe',"votre code: " . $code);
	}
	
	function save_password($password){
		
		global $con;

		$password = password_hash($password, PASSWORD_DEFAULT);
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "update users set password = '$password' where email = '$email' limit 1";
		mysqli_query($con,$query);

	}
	
	function valid_email($email){
		global $con;

		$email = addslashes($email);

		$query = "select * from users where email = '$email' limit 1";		
		$result = mysqli_query($con,$query);
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				return true;
 			}
		}

		return false;

	}

	function is_code_correct($code){
		global $con;

		$code = addslashes($code);
		$expire = time();
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "select * from codes where code = '$code' && email = '$email' order by id desc limit 1";
		$result = mysqli_query($con,$query);
		if($result){
			if(mysqli_num_rows($result) > 0)
			{
				$row = mysqli_fetch_assoc($result);
				if($row['expire'] > $expire){

					return "code correct";
				}else{
					return "code expiré";
				}
			}else{
				return "code  incorrect";
			}
		}

		return "code  incorrect";
	}

	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Forgot</title>
    <link rel="stylesheet" href="./forgot.css">
</head>
<body>

		<?php 

			switch ($mode) {
				case 'enter_email':
					// code...
					?>
						<div class="container">
						<form method="post" action="forgot.php?mode=enter_email"> 
						<div class="title">Mot de passe oublié</div>
						<div class="input-box underline">
						<label for="inputEmail" class="sr-only"> </label>
						<input type="email" name="email" class="form-control"  placeholder="E-mail" required autofocus>
        			    <div class="underline"></div>
        				</div>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>
							<div style="transform: translateY(10px);"><a href="/login.php">Login</a></div>
							<div class="input-box button">
							<input type="submit" onclick="myFunction()" value="Next">
							</div>
						</form>
						</div>
					<?php				
					break;

				case 'enter_code':
					// code...
					?>
						<div class="container">
						<form method="post" action="forgot.php?mode=enter_code"> 
							<div class="title">Mot de passe oublié</div>
							<div class="input-box underline">
							<input class="textbox" type="text" name="code" placeholder="Saisir le code"><br>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>
							</div>
							<div class="input-box">
							<input type="submit" value="Next" style="float: right; width: 50px;">
							<a href="forgot.php">
								<input type="button" value="Restart" style="float: left; width: 70px; background: linear-gradient(to right, #0ae7e7 0%, #106bda 100%); color:white;">
							</a>
							</div>
						</form>
						
					<?php
					break;

				case 'enter_password':
					// code...
					?>
						
						<form method="post" action="forgot.php?mode=enter_password"> 
						<div class="title">Mot de passe oublié</div>
						<div class="input-box underline">
							<h3>Enter your new password</h3>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>

							<input class="textbox" type="text" name="password" placeholder="Mot de passe"><br>
							<input class="textbox" type="text" name="password2" placeholder="Confirmer le mot de passe"><br>
							<br style="clear: both;">
							<input type="submit" value="Next" style="float: right;">
							<a href="forgot.php">
								<input type="button" value="Start Over">
							</a>
							<br><br>
							<div><a href="./login.php">Login</a></div>
						</form>
						</div>
					<?php
					break;
				
				default:
					// code...
					break;
			}

		?>


</body>
</html>
