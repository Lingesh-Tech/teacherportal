<?php
session_start();
if (isset($_SESSION['teacher'])) {
    header("Location: home.php");
}
?>