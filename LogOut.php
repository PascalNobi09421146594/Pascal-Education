<?php
session_start();

// Check if admin is logged in
if (isset($_SESSION['admin'])) {
    unset($_SESSION['admin']);
    session_destroy();
    header("Location: ../Login.php");
    exit();
}

// Check if user is logged in
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    session_destroy();
    header("Location: Login.php");
    exit();
}

// If no session exists, just go to user login
header("Location: Login.php");
exit();
?>
