<?php
session_start();
@$prenom = $_POST["prenom"];
@$nom = $_POST["nom"];
@$email = $_POST["email"];
@$password = $_POST["password"];
@$repassword = $_POST["repassword"];
@@$id = $_POST["id"];
/* @$dateNaissance=date('Y-m-d', strtotime($_POST['dateNaissance'])); */



@$dateNaissance = $_REQUEST['dateNaissance'];

if ($dateNaissance) {
    $dateNaissance = date('Y-m-d', strtotime($dateNaissance));
} else {
    $dateNaissance = '';
}


@$sexe = $_POST["sexe"];
@$valider = $_POST["valider"];
$erreur = "";
if (isset($valider)) {
    if (empty($nom)) $erreur = "First name mandatory!";
    elseif (empty($prenom)) $erreur = "Last name mandatory!";
    elseif (empty($email)) $erreur = "Email adress mandatory!";
    elseif (empty($password)) $erreur = "Password mandatory!";
    elseif ($password != $repassword) $erreur = "passwords do not match!";
    else {
        include("connexion.php");
        $sel = $pdo->prepare("select uid from enseignant where email=? limit 1");
        $sel->execute(array($email));
        $tab = $sel->fetchAll();
        if (count($tab) > 0)
            $erreur = "Login already exist!";
        else {
            $ins = $pdo->prepare("insert into enseignant(nom,prenom,email,password,dateNaissance,sexe,id) values (?,?,?,?,?,?,?)");
            if ($ins->execute(array($nom, $prenom, $email, md5($password), $dateNaissance, $sexe, $id)))
                header("location:login.php");
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./inscript2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>SCO-ENICAR Inscription Enseignant</title>
</head>

<body>
    <style>
        .erreur {
            color: #CC0000;
            transform: translateY(50px);
        }

        .required-field::after {
            content: "*";
            color: red;
        }
    </style>
    <div class="container">
        <div class="erreur"><?php echo $erreur ?></div>
        <div class="title"> Registration</div>
        <div class="content">
            <form name="fo" method="post" action="">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">First Name <span class="required-field"></span> </span>
                        <input type="text" id="prenom" name="prenom" value="<?php echo $prenom ?>" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Last Name <span class="required-field"></span> </span>
                        <input type="text" id="nom" name="nom" value="<?php echo $nom ?>" required>
                    </div>

                    <div class="input-box" style="transform: translateY(5px);">
                        <span class="details">Birthdate </span>
                        <input type="date" id="dateNaissance" name="dateNaissance">
                        <asp:RegularExpressionValidator ID="RegularExpressionValidator6" value="0000-00-01" runat="server" ControlToValidate="TextBox12" ErrorMessage="Date d’expiration" ForeColor="Red" ValidationExpression="\d\d/\d\d" Display="Dynamic">
                    </div>
                    <div class="gender-details" style="margin-left: 345px;transform: translateY(-85px);">
                        <input type="radio" name="sexe" id="dot-1" value="Masculin">
                        <input type="radio" name="sexe" id="dot-2" value="Feminin">
                        <span class="gender-title" id="sexe">Gender </span>
                        <div class="category">
                            <label for="dot-1">
                                <span class="dot one"></span>
                                <span class="gender">Male</span>
                            </label>
                            <label for="dot-2" style="transform: translateX(40px);">
                                <span class="dot two"></span>
                                <span class="gender" value="Féminin">Female</span>
                            </label>
                        </div>
                    </div>
                    <div class="input-box" style="transform:translateY(-64px)">
                        <span class="details">Email <span class="required-field"></span></span>
                        <input type="email" id="email" name="email" placeholder="default@gmail.com" value="<?php echo $email ?>" required>
                    </div>

                    <div class="input-box" style="transform: translateY(-60px);">
                        <label for="subject"> <span class="details">Subject <span class="required-field"></span></span></label>
                        <div class="col-sm-20" >
                            <select id="subject" name="id" class="input-box">
                                <option value="1">POO</option>
                                <option value="2">Mathematics</option>
                                <option value="3">English</option>
                                <option value="4">Web developement</option>
                                <option value="5">Architecture</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="input-box" style="transform:translateY(-60px)">
                        <span class="details">Password <span class="required-field"></span> </span>
                        <input type="password" id="password" name="password" required>
                        <i class="far fa-eye" id="togglePassword" style="
                cursor: pointer;transform: translateY(-36px) translateX(270px);
                color: #7a797a;"></i>
                    </div>
                    <div class="input-box" style="transform:translateY(-62px)">
                        <span class="details"> Password confirmation <span class="required-field"></span> </span>
                        <input type="password" id="repassword" name="repassword" required>
                        <i class="far fa-eye" id="togglePassword2" style="
                cursor: pointer;transform: translateY(-36px) translateX(270px);
                color: #7a797a;"></i>
                    </div>
                </div>
                <div class="button">
                    <input type="submit" id="valider" name="valider" value="Submit" style="transform: translateY(-90px); height: 40px;"><br>
                    <a href="./login.php"><input type="button" value="Return " style="transform: translateY(-130px);margin-left: 480px; height: 40px;" /></a>
                </div>
            </form>
        </div>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
        const togglePassword2 = document.querySelector('#togglePassword2');
        const repassword = document.querySelector('#repassword');
        togglePassword2.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = repassword.getAttribute('type') === 'password' ? 'text' : 'password';
            repassword.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');

        });
    </script>

</body>

</html>