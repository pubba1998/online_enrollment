<?php
include 'connection.php';
// $servername = "localhost";
// $username = "root";
// $password = ""; //Your password here
// $dbname = "online_attendance";
$stid = $_REQUEST["STID"];
$mid = $_REQUEST["MID"];
$lid = $_REQUEST["LID"];
$block = $_REQUEST["Block"];
$mark = $_REQUEST["Mark"];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
die("Connection failed: " . $conn->connect_error);
$sql = "INSERT INTO enrolment (STID,MID,LID, Block, Mark) VALUES (?, ?, ?, ?,?)";
if ($stmt = $conn->prepare($sql))
$stmt->bind_param("isiii", $stid, $mid, $lid, $block,$mark);
else
{
$error = $conn->errno . ' ' . $conn->error;
echo $error;
}
$stmt->execute();
$conn->close();
