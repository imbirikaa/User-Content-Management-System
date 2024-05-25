<?php

include "dbcon.php";


function isAdmin($id){
    global $conn;
    $query = "SELECT * FROM admins WHERE user_ID = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if($row){
        return true;
    }else{
        return false;
    }
}

function isSuperAdmin($id){
    global $conn;
    $query = "SELECT * FROM admins WHERE user_ID = $id AND is_Super = 'Y';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if($row){
        return true;
    }else{
        return false;
    }
}