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


// $Address =$_REQUEST["Address"];
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
die("Connection failed: " . $conn->connect_error);
$sql = "UPDATE lecture SET Name=?, Lastname=?, Email=?, Address=?, Salary=?,Qualification=? WHERE LID=?";
if ($stmt = $conn->prepare($sql))
$stmt->bind_param("ssssisi", $name, $lname, $email,$addres,$salary,$qualification,$id);
else
{
$error = $conn->errno . ' ' . $conn->error;
echo $error;
}
$stmt->execute();
$conn->close();
//header("Location:PHPJavaScript.php");