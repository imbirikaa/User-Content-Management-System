<?php
session_start();
include 'dbcon.php';
include 'func.php';

if (!isset($_SESSION['user_ID'])) {
  header("Location: login.php");
}
$id = htmlspecialchars($_GET['id']);
if (isSuperAdmin($_SESSION['user_ID']) || $_SESSION['user_ID'] == $id)
{
$sql = "DELETE FROM users WHERE user_ID = '$id';";
mysqli_query($conn, $sql);
if($_SESSION['user_ID'] == $id)
header("Location: logout.php?de=The account has been deleted successfully");
else 
header("Location: users.php");

}