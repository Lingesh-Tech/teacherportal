<?php
require_once('../database.php');

$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$data = array();
foreach ($rows as $row) {
    $data[] = array(
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

mysqli_close($conn);
?>
