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
  <title>Home</title>
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
  <div class="posts d-flex justify-content-center ">
    <div class="container text-center row d-flex column-gap-5 justify-content-center">
      <?php
      if (isset($_GET["cr"])) {
        $cr = htmlspecialchars($_GET["cr"]);
        echo '<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
      ' . $cr . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
      }
      if (isset($_GET["de"])) {
        $de = htmlspecialchars($_GET["de"]);
        echo '<div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
      ' . $de . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
      }
      ?>
      <?php
      $sql = "SELECT users.user_First , users.user_Last , posts.post_cont , posts.post_Date , posts.post_ID , posts.post_Creator
        FROM users
        RIGHT JOIN posts ON users.user_ID = posts.post_Creator ORDER BY posts.post_Date DESC ; ";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
      ?>
          <div class="post mt-5 p-5 rounded-3 text-center col-lg-5">
            <h2><?php echo $row["user_First"] . " " . $row["user_Last"] ?></h2>
            <p class="text-black-50"><?php echo $row["post_Date"] ?></p>
            <?php if (isAdmin($_SESSION['user_ID']) || $row['post_Creator'] == $_SESSION['user_ID']) { ?>
              <a href="deletepost.php?id=<?php echo $row["post_ID"] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
            <?php }
            if ($row['post_Creator'] == $_SESSION['user_ID']) { ?>
              <a href="editpost.php?id=<?php echo $row["post_ID"] ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>

            <?php
            }
            ?>
            <hr />
            <p class="fs-4">
              <?php echo $row["post_cont"] ?>
            </p>
          </div>
      <?php
        }
      } else {
        echo '<div class="d-flex justify-content-center">
        <nav class="navbar rounded-3 justify-content-center title fs-4 p-3 mb-2 bg-danger-subtle text-danger-emphasis">
          -- NO POSTS FOUND -- <br>
          Try to Refresh the Page or Create a Post 
        </nav>
      </div>';
      }
      ?>



    </div>
  </div>
  <?php include 'footer.php'; ?>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/all.min.js"></script>

</html>