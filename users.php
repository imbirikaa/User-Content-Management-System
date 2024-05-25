<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Users</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/mine.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="icon" type="image/x-icon" href="./img/icon.png">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet" />
</head>

<body>
    <?php include 'header.php';
    if (isset($_SESSION['user_ID'])) {
        if (!isSuperAdmin($_SESSION['user_ID']))
            header('location:index.php');
    } ?>
    <div class="d-flex justify-content-center">
        <nav class="navbar rounded-3 justify-content-center title bg-info-subtle text-info-emphasis  fs-4 p-3 mb-2 mt-5 ">
            -- Users --
        </nav>
    </div>
    <div class="container d-flex justify-content-center  ">
        <div class="container d-flex justify-content-center row text-center">
            <?php
            if (isset($_GET["ac"])) {
                $ac = htmlspecialchars($_GET["ac"]);
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      ' . $ac . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
            }
            ?>
            <table class="table table-hover text-center col-5 col-lg-8">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row["user_ID"] ?></td>
                            <td><?php echo $row["user_First"] ?></td>
                            <td><?php echo $row["user_Last"] ?></td>
                            <td><?php echo $row["user_Email"] ?></td>
                            <td>
                                <a href="edituser.php?id=<?php echo $row["user_ID"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                                <a href="deleteuser.php?id=<?php echo $row["user_ID"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
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