<?php
session_start();
if (!isset($_SESSION['teacher'])) {
    header("Location: login.php");
}
?>