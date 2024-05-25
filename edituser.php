<?php
include 'dbcon.php';
include 'func.php';

session_start();



if (!isset($_SESSION['user_ID']) || ($_SESSION['user_ID'] != $_GET['id'] && !isSuperAdmin($_SESSION['user_ID']))) {
  header("Location: index.php?cd=true");
}
$id = htmlspecialchars($_GET['id']);
if (isset($_POST['submit'])) {

  $user_First = htmlspecialchars($_POST['user_First']);
  $user_Last = htmlspecialchars($_POST['user_Last']);
  $user_Year = htmlspecialchars($_POST['user_Year']);
  $user_Email = htmlspecialchars($_POST['user_Email']);
  $admin = htmlspecialchars($_POST['admin']);
  $sql = "SELECT * FROM users WHERE user_Email = '$user_Email' AND user_ID <> '$id';";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result)) {
    header("Location: edituser.php?id=$id&wr=The Email Address is already used by another user");
    exit();
  } else {
    $sql = " UPDATE `users` SET `user_First`='$user_First',`user_Last`='$user_Last',`user_Email`='$user_Email',`user_Year`='$user_Year' WHERE user_ID = '$id';";
    $result = mysqli_query($conn, $sql);
    $sql = " SELECT * FROM `admins` WHERE user_ID = '$id';";
    $result = mysqli_query($conn, $sql);

    if ($admin == 'U' && isAdmin($id)) {
      $sql = " DELETE FROM `admins` WHERE user_ID = '$id';";
      $result = mysqli_query($conn, $sql);
    }

    if ($admin != 'U' && isAdmin($id)) {
      $sql = "UPDATE `admins` SET `user_ID`='$id',`is_Super`='$admin' WHERE user_ID = '$id';";
      $result = mysqli_query($conn, $sql);
    } else if ($admin != 'U') {
      $sql = "INSERT INTO `admins` (`user_ID`, `is_Super`) VALUES ('$id', '$admin');";
      $result = mysqli_query($conn, $sql);
    }
    if (!isSuperAdmin($_SESSION['user_ID']) && !isset($_SESSION['user_ID']))
      header("Location: login.php?ac=UR account has Created Successfully");
    else if (!isSuperAdmin($_SESSION['user_ID']))
      header("Location: account.php?ac=The account has Been Edited Successfully");
    else
      header("Location: users.php?ac=The account has Been Edited Successfully");
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit User</title>
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
  <div class="container col-8 pb-5 mt-5">
    <div class="d-flex justify-content-center row">
      <nav class="navbar rounded-3 justify-content-center title fs-4 p-3 mb-2 bg-dark text-white ">
        -- Edit Account --
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
      <form action="" method="post" class="d-flex justify-content-center">
        <?php
        $sql = "SELECT * FROM users WHERE user_ID = '$id';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="row col-10">
          <div class="mb-3 col-lg-5">
            <label class="form-label">First Name : </label>
            <input type="text" class="form-control" name="user_First" value='<?php echo $row['user_First']; ?>' maxlength="30" required />
          </div>
          <div class="mb-3 col-lg-5">
            <label class="form-label">Last Name : </label>
            <input type="text" class="form-control" name="user_Last" value='<?php echo $row['user_Last']; ?>' maxlength="30" required />
          </div>
          <div class="mb-3 col-lg-2">
            <label class="form-label">Birth Year : </label>
            <input type="text" class="form-control" name="user_Year" value='<?php echo $row['user_Year']; ?>' maxlength="4" required />
          </div>
          <div class="mb-3 col-lg-8">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control" name="user_Email" value='<?php echo $row['user_Email']; ?>' maxlength="50" required />
            <div id="emailHelp" class="form-text">
              We'll never share your email with anyone else.
            </div>
          </div>

          <div class="mb-3 col-lg-4 d-flex align-items-center">
            <input type="radio" class="btn-check" name="admin" id="option1" value='U' autocomplete="off" <?php if (!isAdmin($_GET['id'])) echo 'checked' ?>>
            <label class="btn" for="option1">User</label>

            <input type="radio" class="btn-check" name="admin" id="option2" value='N' autocomplete="off" <?php if (!isSuperAdmin($_SESSION['user_ID'])) echo 'disabled' ?> <?php if (isAdmin($_GET['id'])) echo 'checked' ?>>
            <label class="btn" for="option2">Admin</label>

            <input type="radio" class="btn-check" name="admin" id="option3" value='Y' autocomplete="off" <?php if (!isSuperAdmin($_SESSION['user_ID'])) echo 'disabled' ?> <?php if (isSuperAdmin($_GET['id'])) echo 'checked' ?>>
            <label class="btn" for="option3">Super Admin</label>
          </div>

          <div class="d-flex justify-content-end gap-4">
            <button type="submit" name="submit" class="btn btn-warning">Update</button>
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
  <?php include 'footer.php'; ?>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/all.min.js"></script>

</html>