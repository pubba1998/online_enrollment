<?php
include 'connection.php';
// $servername = "localhost";
// $username = "root";
// $password = ""; //Your password here
// $dbname = "online_attendance";
$id = $_REQUEST["MID"];
$name = $_REQUEST["Name"];
$credit = $_REQUEST["Credit"];
$level = $_REQUEST["Level"];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
die("Connection failed: " . $conn->connect_error);
$sql = "INSERT INTO module (MID, Name, Credit, Level) VALUES (?, ?, ?, ?)";
if ($stmt = $conn->prepare($sql))
$stmt->bind_param("ssii", $id, $name, $credit, $level);
else
{
$error = $conn->errno . ' ' . $conn->error;
echo $error;
}
$stmt->execute();
$conn->close();
