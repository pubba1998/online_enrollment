<?php
include 'connection.php';
// $servername = "localhost";
// $username = "root";
// $password = ""; //Your password here
// $dbname = "online_attendance";
// $id = $_REQUEST["MID"];
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
die("Connection failed: " . $conn->connect_error);
$sql = "DELETE FROM module WHERE MID=?";
if ($stmt = $conn->prepare($sql))
$stmt->bind_param("s", $id);
else
{
$error = $conn->errno . ' ' . $conn->error;
echo $error;
}
$stmt->execute();
$conn->close();
//header("Location:PHPJavaScript.php");