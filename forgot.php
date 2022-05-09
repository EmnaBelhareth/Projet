<?php 
session_start();
$error = array();

require "mail.php";

	if(!$con = mysqli_connect("localhost","root","","gestion_etudiant")){

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
					$error[] = "Please enter a valid email";
				}elseif(!valid_email($email)){
					$error[] = "That email was not found";
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

				if($result == "the code is correct"){

					$_SESSION['forgot']['code'] = $code;
					header("Location: forgot.php?mode=enter_password");
					die;
				}else{
					$error[] = $result;
				}
				break;

			case 'enter_password':
				// code...
				$password = md5($_POST['password']);
				$password2 = md5($_POST['password2']);

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
		send_mail($email,'Password reset',"Your code is " . $code);
	}
	
	function save_password($password){
		
		global $con;

		
		$email = addslashes($_SESSION['forgot']['email']);

		$query = "update enseignant set password = '$password' where email = '$email' limit 1";
		mysqli_query($con,$query);

	}
	
	function valid_email($email){
		global $con;

		$email = addslashes($email);

		$query = "select * from enseignant where email = '$email' limit 1";		
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

					return "the code is correct";
				}else{
					return "the code is expired";
				}
			}else{
				return "the code is incorrect";
			}
		}

		return "the code is incorrect";
	}

	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./forgot.css">
	<title>Forgot</title>
	<script>
		function myfunction()
		{
			alert("Enter your the code sent to your email")
		}
	</script>
</head>
<body>

		<?php 

			switch ($mode) {
				case 'enter_email':
					// code...
					?>
						<div class="container">
						<form method="post" action="forgot.php?mode=enter_email"> 
						<div class="title">Forgot Password</div>
         				<div class="input-box underline">
							<label for="email" class="sr-only"> </label>
         					<input type="email" id="email"name="email" class="form-control" placeholder="Enter your email " required autofocus>
         					<div class="underline"></div>
							 <span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>
							<br style="clear: both;">
							<input type="submit" value="Next">
							<br><br>
							<div><a href="login.php">Login</a></div>
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
						<div class="title">Forgot Password</div>
         				<div class="input-box underline">
						 
							<label for="code" class="sr-only"> </label>
							<input class="textbox" type="text" name="code" id="code" placeholder="code"  onclick="myfunction()"><br>
							<div class="underline"></div>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>
							<br style="clear: both;">
							<input type="submit" value="Next" style="float: right;">
							<a href="forgot.php">
								<input type="button" value="Start Over">
							</a>
							<br><br>
							<div><a href="login.php">Login</a></div>
							</div>
						</form>
						</div>
					<?php
					break;

				case 'enter_password':
					// code...
					?>
						<div class="container">
						<form method="post" action="forgot.php?mode=enter_password"> 
						<div class="title">Forgot Password</div>
         				<div class="input-box underline">
							<label for="password" class="sr-only"> </label>
							<input class="password" type="password"  name="password"  id="password" placeholder="New password"><br>
							<div class="underline"></div>
							<label for="password2" class="sr-only"> </label>
							<input class="password" type="password"  name="password2"  id="password2" placeholder="Retype Password"><br>
							<div class="underline"></div>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>
							<br style="clear: both;">
							<input type="submit" value="Next" style="float: right;">
							<a href="forgot.php">
								<input type="button" value="Start Over">
							</a>
							<br><br>
							<div><a href="login.php">Login</a></div>
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