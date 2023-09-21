<?php
$conn = new mysqli("localhost", "root", "mysql2123", "testDb");
if ($conn->connect_error) {
    echo die("Connection failed: " . $conn->connect_error);
}
return $conn;
