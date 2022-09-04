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
// echo "Successfully Connection to the database!";
$sql = "SELECT * FROM lecture" ;
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
<body>
<div class=" col-sm-6">
<table id="lecture_table" class="table" >
<thead class="thead-dark">
<tr>
<th>ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email </th>
<th>Address</th>
<th>Salary</th>
<th>Qualification</th>
</tr>
</thead>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Add Lecture
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter Lecture Information</h5>
      </div>
      <div class="modal-body">
          
          <label for="blid">LID:</label>
          <input type="text" id="blid" name="blid"><br><br>
          <label for="bfname">First name:</label>
          <input type="text" id="bfname" name="bfname"><br><br>
          <label for="blastname">Last name:</label>
          <input type="text" id="blname" name="blname" ><br><br>
          <label for="bemail">Email:</label>
          <input type="text" id="bemail" name="bemail" ><br><br>
          <label for="baddress">Address:</label>
          <input type="text" id="baddress" name="baddress" ><br><br>
          <label for="bsalary">Salary:</label>
          <input type="text" id="bsalary" name="bsalary" ><br><br>
          <label for="bqualification">Qualification:</label>
          <input type="text" id="bqualification" name="bqualification" ><br><br>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button onclick="add_lecture()" type="button" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>

</div>
</div>
<script language="JavaScript">
var result = <?php echo json_encode($rows); ?>;
let table1 = document.getElementById("lecture_table");
let nrow1 = table1.rows.length; //Number of rows in the table1 (1 at the beginning)

for(i=0; i < result.length; i++){
    table1.insertRow(nrow1);
    let row = table1.rows[nrow1];
    let cell1 = row.insertCell(0);
    let cell2 = row.insertCell(1);
    let cell3 = row.insertCell(2); 
    let cell4 = row.insertCell(3);
    let cell5 = row.insertCell(4);
    let cell6 = row.insertCell(5);
    let cell7 = row.insertCell(6);
    let cell8 = row.insertCell(7);

    cell1.innerHTML =  "<div contenteditable='false'>"+result[i].LID+" </div>";
    cell2.innerHTML = "<div contenteditable='true'>"+result[i].Name+" </div>";
    cell3.innerHTML = "<div contenteditable='true'>"+result[i].Lastname+" </div>";
    cell4.innerHTML = "<div contenteditable='true'>"+result[i].Email+" </div>";
    cell5.innerHTML = "<div contenteditable='true'>"+result[i].Address+" </div>";
    cell6.innerHTML = "<div contenteditable='true'>"+result[i].Salary+" </div>";
    cell7.innerHTML = "<div contenteditable='true'>"+result[i].Qualification+" </div>";

    var a = document.createElement("button");//Creating the button
    a.setAttribute("id", "deletst-"+i);
    a.setAttribute("style", "width:100%");
    a.className="btn" ;
    a.innerHTML = '<span class="fa fa-trash"></span>';
    a.onclick = function() {delete_lecture(table,this);}
    cell8.appendChild(a); //Appending the button to the end of the list

    var z = document.createElement("button");
    z.setAttribute("id", "applyeditst-"+i);
    z.setAttribute("style", "width:33%");
    z.className="btn" ;
    z.innerHTML = '<span class="fa fa-check"></span>';
    z.onclick = function() {edit_lecture(table,this);}
    cell8.appendChild(z);
    }
    
    function delete_lecture(table, element){
    let row = element.parentElement.parentElement;
    let LID = row.cells[0].innerText;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    table.deleteRow(row.rowIndex); // Record has been successfully deleted
    }
    };
    xmlhttp.open("GET", "deleteLecture.php?LID="+LID, true);
    xmlhttp.send();
}


function edit_lecture(table,element){
    let row = element.parentElement.parentElement;
    let LID = row.cells[0].innerText;
    let Name = row.cells[1].innerText;
    let Lastname = row.cells[2].innerText;
    let Email = row.cells[3].innerText;
    let Address = row.cells[4].innerText;
    let Salary = row.cells[5].innerText;
    let Qualification = row.cells[6].innerText;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "editLecture.php?LID="+LID + "&Name=" + Name + "&Lastname=" + Lastname + "&Email=" + Email+ "&Address="+Address+"&Salary="+ Salary+"&Qualification="+ Qualification, true);

    xmlhttp.send();
}

function add_lecture(){
    let sLID = document.getElementById("blid").value;
    let sName = document.getElementById("bfname").value;
    let sLastname = document.getElementById("blname").value;
    let sEmail = document.getElementById("bemail").value;
    let sAddress = document.getElementById("baddress").value;
    let sSalary =document.getElementById("bsalary").value;
    let sQualification =document.getElementById("bqualification").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "AddLecture.php?LID="+sLID + "&Name=" + sName + "&Lastname=" + sLastname + "&Email=" + sEmail+ "&Address="+sAddress+"&Salary="+ sSalary+"&Qualification="+ sQualification, true);
    xmlhttp.send();
}
</script>
</script>
</HTML>
