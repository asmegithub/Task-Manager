<?php
if (empty($_POST["firstname"]) || empty($_POST["lastname"])) {
    die("Name is required");
}
if (!filter_var($_POST["email"] . FILTER_VALIDATE_EMAIL)) {
    die("Valid Email is Required");
}
if (strlen($_POST['password']) < 8) {
    die("password must be at least 8 character");
}
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$conn = require __DIR__ . "/signup_db.php";
$sql = "insert into signup_db (firstname,lastname,email,password_hash)
        values(?,?,?,?)";
$stmt = $conn->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL Error: " . $conn->error);
}
$stmt->bind_param(
    "ssss",
    $_POST['firstname'],
    $_POST['lastname'],
    $_POST['email'],
    $password_hash
);
if ($stmt->execute()) {
    header("Location: signup-successful.html");
    exit;
} else {
    die("Error: " . $conn->errno);
}
