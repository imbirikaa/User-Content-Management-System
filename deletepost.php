<?php
session_start();
include 'dbcon.php';
include 'func.php';

if (!isset($_SESSION['user_ID'])) {
    header("Location: login.php");
}

$id = htmlspecialchars($_GET['id']);
$sql = "SELECT post_Creator FROM posts WHERE post_ID = '$id'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
if (isAdmin($_SESSION['user_ID']) || $_SESSION['user_ID'] == $row['post_Creator']) {
    $cID = $row['post_Creator'];
    $sql = "DELETE FROM posts WHERE post_ID = '$id';";
    mysqli_query($conn, $sql);
    if (htmlspecialchars($_GET['w']) == 'y')
        header("Location: myposts.php?de=The post has been deleted successfully");
    else
        header("Location: index.php?de=The post has been deleted successfully");
}
