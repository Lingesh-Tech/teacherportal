<?php
session_start();
require_once('../database.php');
$errors = array();
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $errors = array();
        if (empty($email) || empty($password)) {
            array_push($errors, "All fields are required");
        }
        $sql = "SELECT * from teachers where email = '$email'";
        $result = mysqli_query($conn,$sql);
        $teacher = mysqli_fetch_array($result,MYSQLI_ASSOC);
        if ($teacher) {
            if (password_verify($password, $teacher['password'])) {
                session_start();
                $_SESSION['teacher'] = $teacher['first_name'];
                header("Location: ../home.php");
                die();
            } else {
                array_push($errors, "Password does not match");
                $_SESSION['errors'] = $errors;
                header("Location: ../registration.php");
                exit();
            }
        } else {
            array_push($errors, "Email does not exist");
            $_SESSION['errors'] = $errors;
            header("Location: ../registration.php");
            exit();
        }
    }
?>