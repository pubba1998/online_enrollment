<?php
include 'connection.php';
// $servername = "localhost";
// $username = "root";
// $password = ""; //Your password here
// $dbname = "online_attendance";
$id = $_REQUEST["LID"];
$name = $_REQUEST["Name"];
$lname = $_REQUEST["Lastname"];
$email = $_REQUEST["Email"];
$addres=$_REQUEST["Address"];
$salary =$_REQUEST["Salary"];
$qualification =$_REQUEST["Qualification"];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
die("Connection failed: " . $conn->connect_error);
$sql = "INSERT INTO lecture (LID, Name, Lastname, Email,Address,Salary,Qualification) VALUES (?, ?, ?, ?,?,?,?)";
if ($stmt = $conn->prepare($sql))
$stmt->bind_param("issssis", $id, $name, $lname, $email,$addres,$salary,$qualification);
else
{
$error = $conn->errno . ' ' . $conn->error;
echo $error;
}
$stmt->execute();
$conn->close();
