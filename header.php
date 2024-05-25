<?php 
include_once 'dbcon.php';
include_once 'func.php';


if (!isset($_SESSION['user_ID'])) {
  header("Location: login.php");
}
?>

<nav class="navbar navbar-expand-lg sticky-top">
      <div class="container">
        <a class="navbar-brand" href="./index.php"
          ><img class="ms-auto mb-2 mb-lg-0" src="./img/logo.png" alt=""
        /></a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a
                class="nav-link active p-lg-3 p-2 fs-lg-4"
                aria-current="page"
                href="./index.php"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link p-lg-3 p-2 fs-lg-4" href="./myposts.php"
                >My Posts</a
              >
            </li>

            <li class="nav-item">
              <a class="nav-link p-lg-3 p-2 fs-lg-4" href="./Account.php"
                >Account</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link text-info p-lg-3 p-2 fs-lg-4"
                href="./createpost.php"
                >Create Post</a
              >
            </li>
            <?php if (isSuperAdmin($_SESSION['user_ID']))
            echo '<li class="nav-item">
            <a
              class="nav-link text-warning p-lg-3 p-2 fs-lg-4"
              href="./users.php"
              >Users</a
            >
          </li>'
            ?>
            <li class="nav-item">
              <a class="nav-link p-lg-3 p-2 text-danger fs-lg-4" href="./logout.php"
                >LogOut</a
              >
            </li>
          </ul>
          <div class="search ps-3 pe-3 d-none d-lg-block text-light fs-lg-4">
            <a class="search text-light" href="./search.php"><i class="fa-solid fa-magnifying-glass ps-4"></i></a>
          </div>
        </div>
      </div>
    </nav>