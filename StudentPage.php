<?php 
include 'connection.php';
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "online_attendance";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
die("Connection failed: " . $conn->connect_error);
else
//  echo "Successfully Connection to the database!";
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
echo "0 results"; }
?> 

<h1>Student Information</h1>
<div class=" col-sm-6">
<table id="student_table" class="table" >
<thead class="thead-dark">
<tr>
<th>ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email </th>
</tr>
</thead>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Add Student
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter Student Information</h5>
      </div>
      <div class="modal-body">
          
          <label for="astid">STID:</label>
          <input type="text" id="astid" name="astid"><br><br>
          <label for="afname">First name:</label>
          <input type="text" id="afname" name="afname"><br><br>
          <label for="alastname">Last name:</label>
          <input type="text" id="alname" name="alname" ><br><br>
          <label for="aemail">Email:</label>
          <input type="text" id="aemail" name="aemail" ><br><br>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button onclick="add_student()" type="button" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>

</div>

<script language="JavaScript">
    var result = <?php echo json_encode($rows); ?>;
    let table = document.getElementById("student_table");
    let brow = table.rows.length; //Number of rows in the table (1 at the beginning)


for(i=0; i < result.length; i++){
    table.insertRow(brow);
    let row = table.rows[brow];
    let cell1 = row.insertCell(0);
    let cell2 = row.insertCell(1);
    let cell3 = row.insertCell(2); 
    let cell4 = row.insertCell(3);
    let cell5 = row.insertCell(4);

    cell1.innerHTML = "<div contenteditable='false'>"+result[i].STID+" </div>";
    cell2.innerHTML = "<div contenteditable='true'>"+result[i].Name+" </div>";
    cell3.innerHTML = "<div contenteditable='true'>"+result[i].Lastname+" </div>";
    cell4.innerHTML = "<div contenteditable='true'>"+result[i].Email+" </div>";

    var x = document.createElement("button");//Creating the button
    x.setAttribute("id", "deletst-"+i);
    x.setAttribute("style", "width:100%");
    x.className="btn" ;
    x.innerHTML = '<span class="fa fa-trash"></span>';
    x.onclick = function() {delete_student(table,this);}
    cell5.appendChild(x); //Appending the button to the end of the list

    
    var z = document.createElement("button");
    z.setAttribute("id", "applyeditst-"+i);
    z.setAttribute("style", "width:33%");
    z.className="btn" ;
    z.innerHTML = '<span class="fa fa-check"></span>';
    z.onclick = function() {edit_student(table,this);}
    cell5.appendChild(z);
}

function delete_student(table, element){
    let row = element.parentElement.parentElement;
    let STID = row.cells[0].innerText;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    table.deleteRow(row.rowIndex); // Record has been successfully deleted
    }
};
    xmlhttp.open("GET", "deletestudent.php?STID="+STID, true);
    xmlhttp.send();
}

function edit_student(table,element){
    let row = element.parentElement.parentElement;
    let STID = row.cells[0].innerText;
    let Name = row.cells[1].innerText;
    let Lastname = row.cells[2].innerText;
    let Email = row.cells[3].innerText;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "editstudent.php?STID="+STID + "&Name=" + Name + "&Lastname=" + Lastname + "&Email=" + Email, true);

    xmlhttp.send();
}

function add_student(){

  let name = document.getElementById("afname").value;
  let lastname = document.getElementById("alname").value;
  let stid = document.getElementById("astid").value;
  let email = document.getElementById("aemail").value;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "addstudent.php?STID="+stid + "&Name=" + name + "&Lastname=" + lastname + "&Email=" + email, true);
  xmlhttp.send();

}
</script>
