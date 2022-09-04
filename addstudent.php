<?php
$servername = "localhost";
$username = "root";
$password = ""; //Your password here
$dbname = "online_attendance";
$id = $_REQUEST["STID"];
$name = $_REQUEST["Name"];
$lname = $_REQUEST["Lastname"];
$email = $_REQUEST["Email"];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
die("Connection failed: " . $conn->connect_error);
$sql = "INSERT INTO student (STID, Name, Lastname, Email) VALUES (?, ?, ?, ?)";
if ($stmt = $conn->prepare($sql))
$stmt->bind_param("isss", $id, $name, $lname, $email);
else
{
$error = $conn->errno . ' ' . $conn->error;
echo $error;
}
$stmt->execute();
$conn->close();
