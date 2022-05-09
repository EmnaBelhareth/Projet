

<?php

include 'connexion.php';
if(isset($_POST['submit']))
{
    $nm=$_POST['email'];
  
   $pass=$_POST['password'];
   if( isset($nm) && isset($pass))
 {
   if(!empty($nm) && !empty($pass) )
   {


     

     $stmt = $pdo->prepare("SELECT uid, email FROM enseignant WHERE email= ? AND password=?"); 
       $stmt->execute(array($nm,$pass));

        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
         // print_r($result);
       if(count($result))
       {
       
       $uid = $result[0]['uid'];
                   $uname = $result[0]['email'];
                   session_start();
       // Use $HTTP_SESSION_VARS with PHP 4.0.6 or less
       
           $_SESSION['islogin'] ="1";
                           $_SESSION['uid'] = $uid;
                           $_SESSION['email'] = $uname;
       
                       header("location:index.php");
       }
       else
       {
          header("location:index.php");
       }
       
       
     }else
     {
        header("location:index.php");
     }
   }
 }

?>