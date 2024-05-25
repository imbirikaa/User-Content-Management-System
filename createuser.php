<?php
include 'dbcon.php';
include 'func.php';
session_start();
if (isset($_SESSION['user_ID']) && !isSuperAdmin($_SESSION['user_ID'])) {
  header("Location: index.php");
}

if (isset($_POST['submit'])) {
  $user_First = htmlspecialchars($_POST['user_First']);
  $user_Last = htmlspecialchars($_POST['user_Last']);
  $user_Year = htmlspecialchars($_POST['user_Year']);
  $user_Email = htmlspecialchars($_POST['user_Email']);
  $user_Pswd = htmlspecialchars($_POST['user_Pswd']);
  $sql = "SELECT * FROM users WHERE user_Email = '$user_Email' ";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result)) {
    header("Location: createuser.php?wr=The Email Address is already used by another user");
    exit();
  } else {
    $user_Pswd = password_hash(htmlspecialchars($_POST['user_Pswd']), PASSWORD_BCRYPT);
    $sql = " INSERT INTO users (user_First, user_Last, user_Year, user_Email, user_Pswd) VALUES ('$user_First','$user_Last','$user_Year','$user_Email','$user_Pswd')";
    $result = mysqli_query($conn, $sql);
    if (isset($_SESSION['user_ID']) && !isSuperAdmin($_SESSION['user_ID']))
      header("Location: login.php?ac=UR account has Created Successfully");
    else header("Location: users.php?ac=The account has Created Successfully");
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create User</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="stylesheet" href="css/mine.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="icon" type="image/x-icon" href="./img/icon.png">

  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
</head>

<body>
  <nav class="navbar navbar-expand-lg sticky-top">
    <div class="container d-flex justify-content-center ">
      <a class="navbar-brand" href="./index.php"><img class="ms-auto mb-2 mb-lg-0" src="./img/logo.png" alt="" /></a>
    </div>
  </nav>
  <div class="container col-8 pb-5 mt-5">
    <div class="d-flex justify-content-center row">
      <nav class="navbar rounded-3 justify-content-center title fs-4 p-3 mb-2 bg-dark text-white ">
        -- SIGN UP --
      </nav>
    </div>
  </div>

  <div class="create pb-5 d-flex justify-content-center">
    <div class="container d-flex justify-content-center row">
      <div class="container d-flex justify-content-center ">
        <?php
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
        <div class="row col-10">
          <div class="mb-3 col-lg-5">
            <label class="form-label">First Name : </label>
            <input type="text" class="form-control" name="user_First" maxlength="30" required />
          </div>
          <div class="mb-3 col-lg-5">
            <label class="form-label">Last Name : </label>
            <input type="text" class="form-control" name="user_Last" maxlength="30" required />
          </div>
          <div class="mb-3 col-lg-2">
            <label class="form-label">Birth Year : </label>
            <input type="text" class="form-control" name="user_Year" maxlength="4" required />
          </div>
          <div class="mb-3 col-lg-8">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control" name="user_Email" maxlength="50" required />
            <div id="emailHelp" class="form-text">
              We'll never share your email with anyone else.
            </div>
          </div>

          <div class="mb-3 col-lg-4">
            <label class="form-label">Password : </label>
            <input type="password" class="form-control" name="user_Pswd" minlength="6" required />
          </div>
          <div class="d-flex justify-content-end gap-4">
            <button type="submit" name="submit" class="btn btn-success">Create</button>
            <?php
            if (isset($_SERVER['HTTP_REFERER'])) {
              $previousPage = $_SERVER['HTTP_REFERER'];
            } else {
              $previousPage = "javascript:history.go(-1)";
            }
            ?>
            <a href="<?php echo $previousPage ?>" class="btn btn-danger">Cancel</a>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="footer d-flex justify-content-center align-items-center p-3 mt-5">
    <p class="text-center text-light fs-4">
      ALI IMBIRIKA - Copyright &copy; 2024
    </p>
  </div>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/all.min.js"></script>

</html>