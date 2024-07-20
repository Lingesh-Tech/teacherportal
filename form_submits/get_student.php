<?php
require_once('../database.php');

$id = isset($_POST['id']) ? $_POST['id'] : '';

$sql = "SELECT * FROM students WHERE id = ?";
$stmt = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $data = array();
    foreach ($rows as $row) {
        $data = array(
            "id" => $row['id'],
            "roll_no" => $row['roll_no'],
            "student_name" => $row['student_name'],
            "standard" => $row['standard'],
            "english" => $row['english'],
            "language" => $row['language'],
            "maths" => $row['maths'],
            "science" => $row['science'],
            "social" => $row['social']
        );
    }
    echo json_encode(["data" => $data]);
}

mysqli_close($conn);
?>
