<?php
$servername = "localhost";
$username = "root";
$password = ""; //Your password here
$dbname = "online_attendance";
$stid = $_REQUEST["STID"];
$mid = $_REQUEST["MID"];
$lid = $_REQUEST["LID"];
$block = $_REQUEST["Block"];
$mark = $_REQUEST["Mark"];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
die("Connection failed: " . $conn->connect_error);

// $sql = "UPDATE enrolment SET STID=?, MID=?, LID=?, Block=?, ?,Qualification=? WHERE LID=?";
// stid MID(s) lid BLOCK mark

$sql = "UPDATE enrolment SET Mark=?  WHERE (STID, MID, Block) IN ((?, ?, ?))";

if ($stmt = $conn->prepare($sql))
$stmt->bind_param("iisi", $mark, $stid, $mid, $block);
else
{
$error = $conn->errno . ' ' . $conn->error;
echo $error;
}
$stmt->execute();
$conn->close();
//header("Location:PHPJavaScript.php");
