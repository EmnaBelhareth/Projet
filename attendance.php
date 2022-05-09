<?php
error_reporting(0);
include 'connexion.php';
$updateFlag = 0;
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCO-ENICAR Attendance</title>
    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link rel="stylesheet" href="./attendance3.css">
    <!-- Bootstrap core JS-JQUERY -->
<script src="./assets/dist/js/jquery.min.js"></script>
<script src="./assets/dist/js/bootstrap.bundle.min.js"></script>

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
                <a class="dropdown-item" href="afficherEtudiantsParClasse.php">Students by class</a>
                <a class="dropdown-item" href="./createclass.php">Add Class</a>
                <a class="dropdown-item" href="./createclass.php">Modify Class</a>
                <a class="dropdown-item" href="./createclass.php">Delete Class</a>
      
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-expanded="false">Students Managment</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="ajouterEtudiant.php">Add student</a>
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
    <div class="row ">
        <div class="col-md-12 col-lg-12">
            <center><h1 class="title" style=" transform: translateY(-25px);">Take Attendance</h1></center>
            <div class="input-box underline">
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-12 col-lg-12">
            <form action="attendance.php" method="get" class="form-inline" id="subjectForm" data-toggle="validator">
                <div class="form-group">
                    <label for="select" class="control-label">Subject:</label>
                    <?php
               
                    $query_subject = "SELECT distinct subject.name, subject.id from subject inner join 
					 user_subject WHERE subject.id=user_subject.id and user_subject.uid={$_SESSION['uid']} ORDER BY subject.name";
                    $sub = $pdo->query($query_subject);
                    $rsub = $sub->fetchAll(PDO::FETCH_ASSOC);
                    echo "<select name='subject' class='form-control' required='required'>";
                    for ($i = 0; $i < count($rsub); $i++) {
                        if ($_GET['subject'] == $rsub[$i]['id']) {
                            echo "<option value='" . $rsub[$i]['id'] . "' selected='selected'>" . $rsub[$i]['name'] . "</option>";
                        } else {
                            echo "<option value='" . $rsub[$i]['id'] . "'>" . $rsub[$i]['name'] . "</option>";
                        }
                    }
                    echo "</select>";
                    ?>
                </div>

                <div class="form-group" data-provide="datepicker">
                    <label for="select" class="control-label">Date:</label>
                    <input type="date" class="form-control" name="date" value="<?php print isset($_GET['date']) ? $_GET['date'] : ''; ?>" required>
                </div>

                <button type="submit" class="btn btn-danger" style='border-radius:0%;' name="sbt_stn"><i class="glyphicon glyphicon-filter"></i> Load</button>
            </form>



            <?php
            if (isset($_GET['date']) && isset($_GET['subject'])) :
            ?>

                <?php
                $todayTime = time();
                $submittedDate = strtotime($_GET['date']);
                if ($submittedDate <= $todayTime) :
                ?>
                    <form action="attendance.php" method="post">

                        <div class="margin-top-bottom-medium">
                            <button type="submit" class="btn btn-success btn-block" style='border-radius:0%;' name="sbt_top"><i class="glyphicon glyphicon-ok-sign"></i> Save Attendance</button>
                        </div>

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">Roll</th>
                                    <th class="text-center">Student </th>
                                    <th class="text-center"><input type="checkbox" class="chk-head" /> All Present</th>
                                </tr>
                            </thead>

                            <?php
                            $dat = $_GET['date'];
                            $ddate = strtotime($dat);
                            $sub = $_GET['subject'];
                            $que = "SELECT sid, aid, ispresent  from attendance  WHERE date  =$ddate
					AND id=$sub ORDER BY sid";
                            $ret = $pdo->query($que);
                            $attData = $ret->fetchAll(PDO::FETCH_ASSOC);
                            if (count($attData)) {
                                $updateFlag = 1;
                            } else {
                                $updateFlag = 0;
                            }

                            $qu = "SELECT etudiant.sid, etudiant.nom,etudiant.prenom, etudiant.sid from etudiant INNER JOIN student_subject WHERE etudiant.sid = student_subject.sid AND student_subject.id  = {$_GET['subject']}  ORDER BY etudiant.sid";
                            $stu = $pdo->query($qu);
                            $rstu = $stu->fetchAll(PDO::FETCH_ASSOC);

                            echo "<tbody>";
                            for ($i = 0; $i < count($rstu); $i++) {
                                echo "<tr>";

                                if ($updateFlag) {
                                    echo "<td>" . $rstu[$i]['sid'] . "<input type='hidden' name='st_sid[]' value='" . $rstu[$i]['sid'] . "'>" . "<input type='hidden' name='att_id[]' value='" . $attData[$i]['aid'] . "'>" .  "</td>";
                                    echo "<td>" . $rstu[$i]['nom'] ."  " . $rstu[$i]['prenom'] .  "</td>";
                                   
                                 


                                    if (($rstu[$i]['sid'] ==  $attData[$i]['sid']) && ($attData[$i]['ispresent'])) {

                                        echo "<td><input class='chk-present' checked type='checkbox' name='chbox[]' value='" . $rstu[$i]['sid'] . "'></td>";
                                    } else {
                                        echo "<td><input class='chk-present' type='checkbox' name='chbox[]' value='" . $rstu[$i]['sid'] . "'></td>";
                                    }
                                } else {
                                    echo "<td>" . $rstu[$i]['sid'] . "<input type='hidden' name='st_sid[]' value='" . $rstu[$i]['sid'] . "'></td>";
                                    echo "<td>" . $rstu[$i]['nom'] ." ". $rstu[$i]['prenom'] ."</td>";
                                  
                                    echo "<td><input class='chk-present' type='checkbox' name='chbox[]' value='" . $rstu[$i]['sid'] . "'></td>";
                                }


                                echo "</tr>";
                            }
                            echo "</tbody>";

                            ?>
                        </table>

                        <?php if ($updateFlag) : ?>
                            <input type="hidden" name="updateData" value="1">
                        <?php else : ?>
                            <input type="hidden" name="updateData" value="0">
                        <?php endif; ?>

                        <input type="hidden" name="date" value="<?php print isset($_GET['date']) ? $_GET['date'] : ''; ?>">
                        <input type="hidden" name="subject" value="<?php print isset($_GET['subject']) ? $_GET['subject'] : ''; ?>">
                        <button type="submit" class="btn btn-success btn-block" style='border-radius:0%;' name="sbt_top"><i class="glyphicon glyphicon-ok-sign"></i> Save Attendance</button>

                    </form>

                <?php
                else :
                ?>

                    <p>&nbsp;</p>
                    <div class="alert alert-dismissible alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Sorry!</strong> Attendance cannot be recorded for future dates!.
                    </div>

                <?php
                endif;
                ?>

            <?php endif; ?>

            <?php

            if (isset($_POST['sbt_top'])) {
                if (isset($_POST['updateData']) && ($_POST['updateData'] == 1)) {

                    // prepare sql and bind parameters

                    $id = $_POST['subject'];
                    $uid = $_SESSION['uid'];
                    $p = 0;
                    $st_sid =  $_POST['st_sid'];
                    $attt_aid =  $_POST['att_id'];
                    $ispresent = array();
                    if (isset($_POST['chbox'])) {
                        $ispresent =  $_POST['chbox'];
                    }

                    for ($j = 0; $j < count($st_sid); $j++) {
                        //echo "hii";
                        // UPDATE `attendance` SET `ispresent` = '1' WHERE `attendance`.`aid` = 79;

                        $stmtInsert = $pdo->prepare("UPDATE attendance SET ispresent = :isMarked WHERE aid = :aid");

                        if (count($ispresent)) {
                            $p = (in_array($st_sid[$j], $ispresent)) ? 1 : 0;
                        }

                        $stmtInsert->bindParam(':isMarked', $p);
                        $stmtInsert->bindParam(':aid', $attt_aid[$j]);
                        $stmtInsert->execute();
                        //echo "data upadted";
                    }
                    echo '<p>&nbsp;</p><div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Well done!</strong> Attendance Recorded Successfully!.
              </div>';
                } else {

                    // prepare sql and bind parameters
                    $date = $_POST['date'];
                    $tstamp = strtotime($date);
                    $id = $_POST['subject'];
                    $uid = $_SESSION['uid'];
                    $p = 0;
                    $st_sid =  $_POST['st_sid'];
                    $ispresent = array();
                    if (isset($_POST['chbox'])) {
                        $ispresent =  $_POST['chbox'];
                    }

                    for ($j = 0; $j < count($st_sid); $j++) {
                        //echo "hii";
                        $stmtInsert = $pdo->prepare("INSERT INTO attendance (sid, date, ispresent, uid, id) 
								VALUES (:sid, :date, :ispresent, :uid, :id)");

                        if (count($ispresent)) {
                            $p = (in_array($st_sid[$j], $ispresent)) ? 1 : 0;
                        }


                        $stmtInsert->bindParam(':sid', $st_sid[$j]);
                        $stmtInsert->bindParam(':date', $tstamp);
                        $stmtInsert->bindParam(':ispresent', $p);
                        $stmtInsert->bindParam(':uid', $uid);
                        $stmtInsert->bindParam(':id', $id);
                        $stmtInsert->execute();
                        //	echo "data upadted".$j;
                    }
                    echo '<p>&nbsp;</p><div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Well done!</strong> Attendance Recorded Successfully!.
              </div>';
                }
            }
            ?>
        </div>
    </div>
</div>


<script src="js/bootstrap.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>