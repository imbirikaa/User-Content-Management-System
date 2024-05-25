<?php
session_start();

if (!isset($_SESSION['user_ID'])) {
    header("Location: login.php");
}
$id = $_SESSION['user_ID'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Search</title>
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
    <div class="posts d-flex justify-content-center row">
        <div class="container d-flex justify-content-center mt-5">
            <form action="" method="POST" class="row col-6">
                <div class="mb-3 col-12 d-flex justify-content-center gap-4">
                    <input type="text" class="form-control col-lg-10 col-7 col" name="search" placeholder="Write Search Words" value='<?php if (isset($_POST['submit'])) echo $_POST['search'];
                                                                                                                                        else echo ''; ?>' required>
                    <button type="submit" class="btn btn-primary col-lg-2 col-5 text-center col " name="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="container text-center row d-flex column-gap-5 justify-content-center pt-5">
            <?php
            if (isset($_GET["cr"])) {
                $cr = $_GET["cr"];
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                ' . $cr . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }

            ?>
            <?php
            if (isset($_POST['submit'])) {
                $word = htmlspecialchars($_POST['search']);
                $sql = "SELECT users.user_First , users.user_Last , posts.post_cont ,posts.post_ID,posts.post_Creator, posts.post_Date FROM users RIGHT JOIN posts ON users.user_ID = posts.post_Creator WHERE posts.post_cont LIKE '%$word%' ORDER BY posts.post_Date DESC ;";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                ' . mysqli_num_rows($result) . ' Post(s) Found ...
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                    while ($row = mysqli_fetch_assoc($result)) {
            ?>
                        <div class="post mt-5 p-5 rounded-3 text-center col-8 ">
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
          Try to use other words to search 
        </nav>
      </div>';
                }
            }
            ?>
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