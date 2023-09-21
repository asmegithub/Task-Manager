<?php
require "db.php";
$s = $_SERVER["QUERY_STRING"];
parse_str($s, $a);
$param = $a['task'];
$sql = "Update `sub-tasks` set complete= true where task='$param'";
echo $param;
$conn->query($sql);
if ($conn->query($sql) == TRUE)
    echo "<script> alert('Updated')</script>";
header("Location:fetch.php");
exit;
