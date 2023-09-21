<?php
require 'db.php';
$title = $_POST['title'];
$description = $_POST['new-task'];
$sql = "insert into `task-log` values('$title','$description')";
if ($conn->query($sql) == true) {
    echo "<script>alert('Successfully Registered!')</script>";
}
header("Location:Home.php");
exit;
