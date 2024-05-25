<?php
session_start();
include "dbcon.php";
include "func.php";

if (isset($_SESSION['user_ID'])) {
  header("location:index.php");
  exit();
}

if (isset($_POST['submit'])) {
  $user_Email = htmlspecialchars($_POST['user_Email']);
  $user_Pswd = htmlspecialchars($_POST['user_Pswd']);
  $sql = "SELECT * FROM users WHERE user_Email = '$user_Email';";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  echo $row;
  if (mysqli_num_rows($result) > 0) {
    if (password_verify($user_Pswd,$row['user_Pswd']) ) {
      $_SESSION['right'] = true;
      $_SESSION['user_ID'] = $row['user_ID'];
      $_SESSION['user_First'] = $row['user_First'];
      $first = $_SESSION['user_First'];
      header("location:index.php?cr=Welcome $first !");
      exit();
    } else {
      $_SESSION['right'] = false;
      
      header("location:login.php?wr=Email or Password is incorrect");
      exit();
    }
  } else {
    $_SESSION['right'] = false;
    header("location:login.php?wr=Email or Password is incorrect");
    exit();
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LOG IN</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="stylesheet" href="css/mine.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="icon" type="image/x-icon" href="./img/icon.png">

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
</head>

<body>
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container d-flex justify-content-center ">
      <a class="navbar-brand" href="./index.php"><img class="ms-auto mb-2 mb-lg-0" src="./img/logo.png" alt="" /></a>
    </div>
  </nav>
  <div class="con d-flex justify-content-center">
    <div class="d-flex justify-content-center col-6">
      <nav class="navbar rounded-3 d-flex justify-content-center title fs-4 p-3 bg-success-subtle text-success-emphasis ">
        -- LOG IN --
      </nav>
    </div>
  </div>

  <div class="create pb-5 d-flex justify-content-center">
    <div class="container d-flex justify-content-center row">
      <div class="container d-flex justify-content-center col-8">
        <?php
    if (isset($_GET["cr"])) {
      $cr = htmlspecialchars($_GET["cr"]);
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      ' . $cr . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if (isset($_GET["wr"])) {
      $wr = htmlspecialchars($_GET["wr"]);
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      ' . $wr . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
      </div>
    
      <form action="" method="POST" class="d-flex justify-content-center">
        <div class="row col-10 d-flex justify-content-center">
          <div class="mb-3 col-lg-8">
            <label class="form-label">Email Address :</label>
            <input type="email" class="form-control" name="user_Email" maxlength="50" required />
          </div>

          <div class="mb-3 col-lg-8">
            <label class="form-label">Password : </label>
            <input type="password" class="form-control" name="user_Pswd" minlength="6" required />
          </div>
          <div class="d-flex justify-content-center gap-4 mt-4">
            <button type="submit" name="submit" class="btn btn-success">LOG IN</button>
            <a href="./createuser.php" class="btn btn-warning">Don't have an account</a>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php include 'footer.php'; ?>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/all.min.js"></script>

</html>