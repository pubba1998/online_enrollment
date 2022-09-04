<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_attendance";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error)
die("Connection failed: " . $conn->connect_error);
else
// echo "Successfully Connection to the database!";
$sql = "SELECT * FROM enrolment" ;
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
<table id="enrolment_table" class="table" >
<thead class="thead-dark">
<tr>
<th>STID</th>
<th>MID</th>
<th>LID</th>
<th>Block </th>
<th>Mark </th>
</tr>
</thead>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Add enrollment
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter enrollment Information</h5>
      </div>
      <div class="modal-body">
          
          <label for="estid">STID:</label>
          <input type="text" id="estid" name="estid"><br><br>
          <label for="emid">MID:</label>
          <input type="text" id="emid" name="emid"><br><br>
          <label for="elid">LID:</label>
          <input type="text" id="elid" name="elid" ><br><br>
          <label for="eblock">Block:</label>
          <input type="text" id="eblock" name="eblock" ><br><br>
          <label for="emark">Mark:</label>
          <input type="text" id="emark" name="emark" ><br><br>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button onclick="add_enrolment()" type="button" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>

</div>
</div>
<script language="JavaScript">
var result = <?php echo json_encode($rows); ?>;
let table = document.getElementById("enrolment_table");
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
 
    cell1.innerHTML =  "<div contenteditable='true'>"+result[i].STID+" </div>";
    cell2.innerHTML = "<div contenteditable='true'>"+result[i].MID+" </div>";
    cell3.innerHTML = "<div contenteditable='true'>"+result[i].LID+" </div>";
    cell4.innerHTML = "<div contenteditable='true'>"+result[i].Block+" </div>";
    cell5.innerHTML = "<div contenteditable='true'>"+result[i].Mark+" </div>";
  

    var a = document.createElement("button");//Creating the button
    a.setAttribute("id", "deletst-"+i);
    a.setAttribute("style", "width:100%");
    a.className="btn" ;
    a.innerHTML = '<span class="fa fa-trash"></span>';
    a.onclick = function() {delete_enrolment(table,this);}
    cell6.appendChild(a); //Appending the button to the end of the list

    var z = document.createElement("button");
    z.setAttribute("id", "applyeditst-"+i);
    z.setAttribute("style", "width:33%");
    z.className="btn" ;
    z.innerHTML = '<span class="fa fa-check"></span>';
    z.onclick = function() {edit_enrolment(table,this);}
    cell6.appendChild(z);
    }
    
    function delete_enrolment(table, element){
    let row = element.parentElement.parentElement;
    let MID = row.cells[0].innerText;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    table.deleteRow(row.rowIndex); // Record has been successfully deleted
    }
    };
    xmlhttp.open("GET", "deleteEnrollment.php?MID="+MID, true);
    xmlhttp.send();
}

function edit_enrolment(table,element){
    let row = element.parentElement.parentElement;
    let STID = row.cells[0].innerText;
    let MID = row.cells[1].innerText;
    let LID = row.cells[2].innerText;
    let Block = row.cells[3].innerText;
    let Mark = row.cells[4].innerText;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "EditEnrolment.php?STID="+STID + "&MID=" + MID + "&LID" + LID+ "&Block=" + Block + "&Mark="+ Mark, true);

    xmlhttp.send();
}

function add_enrolment(){
    let eSTID = document.getElementById("estid").value;
    let eMID = document.getElementById("emid").value;
    let eLID = document.getElementById("elid").value;
    let eBlock= document.getElementById("eblock").value;
    let mark = document. getElementById("emark").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "AddEnrollment.php?STID="+eSTID + "&MID=" + eMID + "&LID=" + eLID+ "&Block=" + eBlock + "&Mark="+ mark, true);

     xmlhttp.send();
}
</script>
</script>
</HTML>