?<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_attendance";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
die("Connection failed: " . $conn->connect_error);
else
// echo "Successfully Connection to the database!";
$sql = "SELECT * FROM student" ;
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$i = 0;
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
$rows[$i] = $row;
$i++;
}
} else {
echo "0 results";
}

?>
<<HTML>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<h1>Student Information</h1>
<div class=" col-sm-6">
<table id="student_table" class="table" >
<thead class="thead-dark">
<tr>
<th>ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email </th>
<th>Address</th>
</tr>
</thead>
</div>
<script language="JavaScript">
var result = <?php echo json_encode($rows); ?>;
let table = document.getElementById("student_table");
let nrow = table.rows.length; //Number of rows in the table (1 at the beginning)
for(i=0; i < result.length; i++){
table.insertRow(nrow);
let row = table.rows[nrow];
let cell1 = row.insertCell(0);
let cell2 = row.insertCell(1);
let cell3 = row.insertCell(2); 
let cell4 = row.insertCell(3);
let cell5 = row.insertCell(4);
let cell6 = row.insertCell(5);
let cell7 = row.insertCell(6);
cell1.innerHTML = "<div contenteditable='false'>"+result[i].STID+" </div>";
cell2.innerHTML = "<div contenteditable='true'>"+result[i].Name+" </div>";
cell3.innerHTML = "<div contenteditable='true'>"+result[i].Lastname+" </div>";
cell4.innerHTML = "<div contenteditable='true'>"+result[i].Email+" </div>";
cell5.innerHTML = "<div contenteditable='true'>"+result[i].Address+" </div>";
var x = document.createElement("button");//Creating the button
x.setAttribute("id", "deletst-"+i);
x.setAttribute("style", "width:100%");
x.className="btn" ;
x.innerHTML = '<span class="fa fa-trash"></span>';
x.onclick = function() {delete_student(table,this);}
cell6.appendChild(x); //Appending the button to the end of thelist
var z = document.createElement("button");
z.setAttribute("id", "applyeditst-"+i);
z.setAttribute("style", "width:33%");
z.className="btn" ;
z.innerHTML = '<span class="fa fa-check"></span>';
z.onclick = function() {apply_edit_student(table,this);}
cell7.appendChild(z);

}
function delete_student(table, element){
let row = element.parentElement.parentElement;
let STID = row.cells[0].innerText;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
table.deleteRow(row.rowIndex); // Record has been successfully deleted
}
{
    function update_student(table,element){
        let row = element.parentElement.parentElement;
        let STID = row.cells[0];
        let Name = row.cells[1];
        let Lastname = row.cells[2];
        let Email = row.cells[3];
        let Address = row.cells[4];
        var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
table.updateRow(row.rowIndex); // Record has been successfully deleted    
        
    }
}
};
xmlhttp.open("GET", "deletestudent.php?STID="+STID, true);
xmlhttp.send();
}
</script>
</HTML>