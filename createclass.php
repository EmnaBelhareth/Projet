<?php
error_reporting(0);
include 'connexion.php';
session_start();

//------------------------SAVE--------------------------------------------------

if (isset($_POST['save'])) {

    $nomg = $_POST['nomg'];

    $query = $pdo->prepare('select * from groupe where nomg ="' . $nomg . '"');
    $query->execute();
    $ret = $query->fetch(PDO::FETCH_ASSOC);

    if ($ret > 0) {

        $statusMsg = "<div class='alert alert-danger' style='transform:translateX(3px);'>This Class Already Exists!</div>";
    } else {

        $query = $pdo->prepare("insert into groupe(nomg) value('$nomg')");
        $query->execute();

        if ($query) {

            $statusMsg = "<p class='alert alert-success'  style='transform:translateX(3px);'>Created Successfully!</p>";
        } else {
            $statusMsg = "<div class='alert alert-danger' style='transform:translateX(3px);'>An error Occurred!</div>";
        }
    }
}

//--------------------EDIT------------------------------------------------------------

if (isset($_GET['idg']) && isset($_GET['action']) && $_GET['action'] == "edit") {
    $idg = $_GET['idg'];

    $query = $pdo->prepare("select * from groupe where idg ='$idg'");
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    //------------UPDATE-----------------------------
    if (isset($_POST['update'])) {

        $nomg = $_POST['nomg'];

        $query = $pdo->prepare("update groupe set nomg='$nomg' where idg='$idg'");
        $query->execute();

        if ($query) {

            echo "<script type = \"text/javascript\">
            window.location = (\"createclass.php\")
            </script>";
        } else {
            $statusMsg = "<div class='alert alert-danger' style='transform:translateX(3px);'>An error Occurred!</div>";
        }
    }
}
//-----------------------------------------DELETE--------------------------------------//
if (isset($_GET['idg']) && isset($_GET['action']) && $_GET['action'] == "delete") {
    $idg = $_GET['idg'];

    $query = $pdo->prepare("DELETE FROM groupe WHERE idg='$idg'");
    $query->execute();

    if ($query == TRUE) {

        echo "<script type = \"text/javascript\">
            window.location = (\"createclass.php\")
            </script>";
    } else {

        $statusMsg = "<div class='alert alert-danger' style='transform:translateX(3px);'>An error Occurred!</div>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap core CSS -->
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap core JS-JQUERY -->
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./createclass1.css">

    <!-- Custom styles for this template -->
    <link href="./assets/jumbotron.css" rel="stylesheet">


    <link href="./createclass.css" rel="stylesheet">
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
      
            <div class="col-lg-12">
                <div class="card mb-2">
                    <div class="card-header">
    
        <h1 class="h3 mb-0 text-gray-800">Create Class</h1>
        
        <?php echo $statusMsg; ?>
</div>
        <div class="card-body" >
            <form method="post">
                <div class="form-group row mb-3">
                    <div class="col-xl-10" >
                        <label class="form-control-label" >Class Name<span class="text-danger ml-2">*</span></label>
                        <input type="text" class="form-control" name="nomg" value="<?php echo $row['nomg']; ?>" id="exampleInputFirstName" placeholder="Class Name" required>
                    </div>
                </div>
                <?php
                if (isset($idg)) {
                ?>
                    <button type="submit" name="update" class="btn btn-warning">Update</button>

                <?php
                } else {
                ?>
                    <button type="submit" name="save" class="btn btn-primary" style="transform:translateX(800px)">Save</button>
                <?php
                }
                ?>
            </form>
        </div>
        
        </div>
        </div>
        </div>

        <!-- Input Group -->
        
            <div class="col-lg-12" >
                <div class="card mb-4" style=" table-layout :auto ;width:900px;">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">All Classes</h6>
                    </div>
                    <div class="table-responsive p-3" >
                        <table class="table align-items-center table-flush table-hover" id="dataTableHover" >
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Class Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $query = "SELECT * FROM groupe";
                                $rs = $pdo->query($query);
                                $rs->execute();
                                $count = $rs->rowCount();
                                $sn = 0;
                                if ($count > 0) {
                                    while ($rows = $rs->fetch()) {
                                        $sn = $sn + 1;
                                        echo "
                              <tr>
                                <td>" . $sn . "</td>
                                <td>" . $rows['nomg'] . "</td>
                                <td><a href='?action=edit&idg=" . $rows['idg'] . "'><i class='fas fa-fw fa-edit'></i>Edit</a></td>
                                <td><a href='?action=delete&idg=" . $rows['idg'] . "'><i class='fas fa-fw fa-trash'></i>Delete</a></td>
                              </tr>";
                                    }
                                } else {
                                    echo
                                    "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>

        </div>
        <!---Container Fluid-->
        </div>
        <!-- Footer -->
        <?php include "Includes/footer.php"; ?>
        <!-- Footer -->
        </div>
        </div>
        <!-- Page level custom scripts -->
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable(); // ID From dataTable 
                $('#dataTableHover').DataTable(); // ID From dataTable with Hover
            });
        </script>
</body>

</html>