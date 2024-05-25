<?php
include 'dbcon.php';
include 'func.php';

session_start();



if (!isset($_SESSION['user_ID'])) {
  header("Location: index.php");
}

$id = htmlspecialchars($_GET['id']);
if (isset($_POST['submit'])) {
  $post_cont = htmlspecialchars($_POST['post_cont']);
  $sql = "UPDATE posts SET post_cont = '$post_cont' WHERE post_ID = '$id'";
  $result = mysqli_query($conn, $sql);
  header("location: myposts.php?cr=The post has been updated successfully");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Post</title>
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
  <div class="d-flex justify-content-center">
    <nav class="navbar rounded-3 justify-content-center title bg-info-subtle text-info-emphasis  fs-4 p-3 mb-2 mt-5 ">
      -- Edit Your Post --
    </nav>
  </div>
  <div class="cpost pt-4 pb-4 d-flex justify-content-center">
    <form action="" method="post" class="d-flex justify-content-center col-lg-12 col-8">
      <div class="row">
        <div class="d-flex justify-content-center  row">
          <label class="form-label text-center fs-5 fs-lg-4">Write What U Want To Share </label>
          <textarea class="form-control " name="post_cont" required maxlength="255"><?php
                                                                                    $sql = "SELECT post_cont FROM posts WHERE post_ID = '$id'";
                                                                                    $result = mysqli_query($conn, $sql);
                                                                                    $row = mysqli_fetch_assoc($result);
                                                                                    echo $row['post_cont'];
                                                                                    ?></textarea>
        </div>

        <div class="mt-5 d-flex justify-content-center gap-4">
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
  <div class="footer d-flex justify-content-center align-items-center p-3 mt-5">
    <p class="text-center text-light fs-4">
      ALI IMBIRIKA - Copyright &copy; 2024
    </p>
  </div>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/all.min.js"></script>

</html>