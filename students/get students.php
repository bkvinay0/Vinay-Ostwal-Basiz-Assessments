<?php

require_once "database.php";

header("Content-Type: application/json");

$sql = "SELECT
            name,
            gender,
            standard,
            date_of_birth,
            age,
            father_name,
            father_mobile,
            email
        FROM students
        ORDER BY id DESC";

$result = $conn->query($sql);

$students = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

echo json_encode($students);

$conn->close();

?>