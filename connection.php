<?php

// $servername = "localhost";
// $username = "root";
// $password = ""; //Your password here
// $dbname = "online_attendance";
    $servername ="us-cdbr-east-06.cleardb.net";
    $username = "b7b4811bf969ec";
    $password = "3c546781";
    $dbname  = "heroku_9a4f37509a948de";
$conn = new mysqli($servername, $username, $password, $dbname); 
// Check connection
if ($conn->connect_error)
die("Connection failed: " . $conn->connect_error);
else
echo "Successfully Connected to the database!";
?>