<?php
session_start();
if (!isset($_SESSION['user_ID'])) {
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="stylesheet" href="css/mine.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="icon" type="image/x-icon" href="./img/icon.png">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
</head>

<body>
  <?php include 'header.php'; ?>

  <div class="account">
    <div class="container p-5 text-center">
      <div class="d-flex justify-content-center">
        <nav class="navbar rounded-3 justify-content-center title fs-3 p-3 mb-2 bg-secondary text-white">
          -- Account Details --
        </nav>
      </div>
      <div class="container">
        <?php
        if (isset($_GET["ac"])) {
          $ac = htmlspecialchars($_GET["ac"]);
          echo '<div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
          ' . $ac . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        } ?>
      </div>
      <?php
      $user_ID = $_SESSION['user_ID'];
      $sql = "SELECT * FROM users WHERE user_ID = '$user_ID'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      ?>
      <div class="row d-flex justify-content-center pt-5">
        <h3 class="col-lg-12 pb-3"> User ID : <?php echo $row['user_ID'] ?></h3>
        <h3 class="col-lg-5 pb-3"> First Name : <?php echo $row['user_First'] ?> </h3>
        <h3 class="col-lg-5 pb-3"> Last Name : <?php echo $row['user_Last'] ?> </h3>
        <h3 class="col-lg-5 pb-3"> Email Adress : <?php echo $row['user_Email'] ?> </h3>
        <h3 class="col-lg-5 pb-3"> Birth Year : <?php echo $row['user_Year'] ?> </h3>
        <h3 class="col-lg-5 pb-3"> Created at : <?php echo $row['acc_Created'] ?> </h3>

        <div class="col-lg-12 d-flex justify-content-center gap-5">
          <a href="./edituser.php?id=<?php echo $_SESSION['user_ID']; ?>" class="btn btn-warning mt-5">Edit Account</a>
          <a href="./deleteuser.php?id=<?php echo $_SESSION['user_ID']; ?>" class="btn btn-danger mt-5">Delete Account</a>


        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/all.min.js"></script>

</html>