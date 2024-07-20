<?php
session_start();
require_once('../database.php');
$errors = array();

    if (isset($_POST['submit'])) {
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['repeat_password'];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        if (empty($firstName) && empty($lastName) && empty($email) && empty($password) && empty($passwordRepeat)) {
            array_push($errors, "All fields are required");
        } else {
            if (empty($firstName)) {
                array_push($errors, "First name is required");
            }  
            if (empty($lastName)) {
                array_push($errors, "Last name is required");
            }
            if (empty($email)) {
                array_push($errors, "Email is required");
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid");
                }
            }
            if (empty($password)) {
                array_push($errors, "Password is required");
            } else {
                if (strlen($password) < 8) {
                    array_push($errors, "Password must be at least 8 characters");
                } 
            }
            if (empty($passwordRepeat)) {
                array_push($errors, "Confirm Password is required");
            } else {
                if ($password !== $passwordRepeat) {
                    array_push($errors, "Password fields mismatch");
                }
            }
        }
        $sql = "SELECT * FROM teachers WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount > 0) {
                array_push($errors, "The email already exists!");
            }
        } else {
            array_push($errors, "Database query error");
        }
        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            header("Location: ../registration.php");
            exit();
        } else {
            $sql = "Insert into teachers (first_name,last_name,email,password) VALUES (?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                $_SESSION['success'] = "You are registered successfully";
                header("Location: ../registration.php");
                exit();
            } else {
                array_push($errors, "Something went wrong");
                $_SESSION['errors'] = $errors;
                header("Location: ../registration.php");
                exit();
            }
        }
    }

?>