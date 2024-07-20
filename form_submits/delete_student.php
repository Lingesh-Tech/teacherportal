<?php
session_start();
require_once('../database.php');

$stud_id = isset($_POST['id']) ? $_POST['id'] : '';


if (empty($stud_id)) {
    echo json_encode(['status' => 'error', 'message' => 'Student ID is required']);
    exit();
}

$sql = "DELETE FROM students WHERE id = ?";
$stmt = mysqli_stmt_init($conn);

if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $stud_id);
    if (mysqli_stmt_execute($stmt)) {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Student record deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No student record found with the given ID']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to execute the statement']);
    }
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the statement']);
}

mysqli_close($conn);
?>
