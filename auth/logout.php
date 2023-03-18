<?php
session_start();

if (!isset($_SESSION['session_id'])) {
    unset($_SESSION['session_id']);
    unset($_SESSION['name']);
    unset($_SESSION['id']);
    unset($_SESSION['id']);
    unset($_SESSION['loggedin']);
}
header('Location: ../index.php');
exit;
?>