<?php

require_once "database.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request."
    ]);
    exit;
}

$name = trim($_POST["name"] ?? "");
$gender = trim($_POST["gender"] ?? "");
$standard = trim($_POST["standard"] ?? "");
$dateOfBirth = trim($_POST["dateOfBirth"] ?? "");
$age = trim($_POST["age"] ?? "");
$fatherName = trim($_POST["fatherName"] ?? "");
$fatherMobile = trim($_POST["fatherMobile"] ?? "");
$email = trim($_POST["email"] ?? "");

$errors = [];

// Check the details entered by the user.
if ($name === "") {
    $errors[] = "Name is mandatory.";
}

if ($standard === "") {
    $errors[] = "Standard is mandatory.";
}

if ($dateOfBirth === "") {
    $errors[] = "Date of birth is mandatory.";
}

if ($age === "") {
    $errors[] = "Age is mandatory.";
}

if (!preg_match("/^[0-9]{10}$/", $fatherMobile)) {
    $errors[] = "Mobile number must contain exactly 10 digits.";
}

$emailIsValid = false;

if ($email === "") {
    $errors[] = "Email is mandatory.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email address.";
} else {
    $emailIsValid = true;
}

// Check if the email is already registered.
if ($emailIsValid) {
    $checkSql = "SELECT id FROM students WHERE email = ? LIMIT 1";

    $checkStmt = $conn->prepare($checkSql);

    if ($checkStmt) {
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $errors[] = "This email address is already registered.";
        }

        $checkStmt->close();
    }
}

if (!empty($errors)) {
    echo json_encode([
        "success" => false,
        "errors" => $errors
    ]);

    $conn->close();
    exit;
}

// Save the student details in the database.
$sql = "INSERT INTO students
        (
            name,
            gender,
            standard,
            date_of_birth,
            age,
            father_name,
            father_mobile,
            email
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "message" => "Unable to save student."
    ]);

    $conn->close();
    exit;
}

$stmt->bind_param(
    "ssssisss",
    $name,
    $gender,
    $standard,
    $dateOfBirth,
    $age,
    $fatherName,
    $fatherMobile,
    $email
);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Student added successfully."
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Unable to save student."
    ]);
}

$stmt->close();
$conn->close();

?>