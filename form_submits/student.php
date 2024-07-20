<?php
session_start();
require_once('../database.php');
$errors = array();

$rollNo = $_POST['roll_no'];
$studentName = $_POST['student_name'];
$standard = $_POST['standard'];
$english = $_POST['english'];
$language = $_POST['language'];
$maths = $_POST['maths'];
$science = $_POST['science'];
$social = $_POST['social'];
$stud_id = isset($_POST['student_id']) ? $_POST['student_id'] : '';

if (empty($stud_id)) {
    $sql = "SELECT * FROM students WHERE student_name = ?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $studentName);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount > 0) {
            $response = [
                'status' => 'error',
                'message' => 'Student record already exists'
            ];
            echo json_encode($response);
            exit();
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Database query error'
        ];
        echo json_encode($response);
        exit();
    }
    $sql = "INSERT INTO students (roll_no, student_name, standard, english, language, maths, science, social) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_stmt_init($conn)) {
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssss", $rollNo, $studentName, $standard, $english, $language, $maths, $science, $social);
            mysqli_stmt_execute($stmt);
            $response = [
                'status' => 'success',
                'message' => 'Student created successfully'
            ];
            echo json_encode($response);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Failed to prepare the statement'
            ];
            echo json_encode($response);
            exit();
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Failed to initialize the statement'
        ];
        echo json_encode($response);
        exit();
    }
} else {
    $sql = "UPDATE students SET roll_no = ?, 
            student_name = ?, standard = ?, english = ?, language = ?, maths = ?, 
            science = ?, social = ? WHERE id = ?";
    if ($stmt = mysqli_stmt_init($conn)) {
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssssss", $rollNo, $studentName, $standard, $english, $language, $maths, $science, $social, $stud_id);
            mysqli_stmt_execute($stmt);
            $response = [
                'status' => 'success',
                'message' => 'Student record updated successfully'
            ];
            echo json_encode($response);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Failed to prepare the statement'
            ];
            echo json_encode($response);
            exit();
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Failed to initialize the statement'
        ];
        echo json_encode($response);
        exit();
    }
}

?>
