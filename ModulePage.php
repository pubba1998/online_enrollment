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
$sql = "SELECT * FROM module" ;
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
<table id="module_table" class="table" >
<thead class="thead-dark">
<tr>
<th>ID</th>
<th>Name</th>
<th>Credit</th>
<th>Level </th>

</tr>
</thead>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Add module
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter Module Information</h5>
      </div>
      <div class="modal-body">
          
          <label for="blid">MID:</label>
          <input type="text" id="bmid" name="bmid"><br><br>
          <label for="bfname">Name:</label>
          <input type="text" id="bname" name="bname"><br><br>
          <label for="bcredit">Credit:</label>
          <input type="text" id="bcredit" name="bcrerdit" ><br><br>
          <label for="blevel">Level:</label>
          <input type="text" id="blevel" name="blevel" ><br><br>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button onclick="add_module()" type="button" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>

</div>
</div>
<script language="JavaScript">
var result = <?php echo json_encode($rows); ?>;
let table = document.getElementById("module_table");
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
 

    cell1.innerHTML =  "<div contenteditable='false'>"+result[i].MID+" </div>";
    cell2.innerHTML = "<div contenteditable='true'>"+result[i].Name+" </div>";
    cell3.innerHTML = "<div contenteditable='true'>"+result[i].Credit+" </div>";
    cell4.innerHTML = "<div contenteditable='true'>"+result[i].Level+" </div>";
   

    var a = document.createElement("button");//Creating the button
    a.setAttribute("id", "deletst-"+i);
    a.setAttribute("style", "width:100%");
    a.className="btn" ;
    a.innerHTML = '<span class="fa fa-trash"></span>';
    a.onclick = function() {delete_module(table,this);}
    cell6.appendChild(a); //Appending the button to the end of the list

    var z = document.createElement("button");
    z.setAttribute("id", "applyeditst-"+i);
    z.setAttribute("style", "width:33%");
    z.className="btn" ;
    z.innerHTML = '<span class="fa fa-check"></span>';
    z.onclick = function() {edit_module(table,this);}
    cell5.appendChild(z);
    }
      
  function delete_module(table, element){
      let row = element.parentElement.parentElement;
      let MID = row.cells[0].innerText;
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      table.deleteRow(row.rowIndex); // Record has been successfully deleted
      }
      };
      xmlhttp.open("GET", "deleteModule.php?MID="+MID, true);
      xmlhttp.send();
}
  function edit_module(table,element){
      let row = element.parentElement.parentElement;
      let rMID = row.cells[0].innerText;
      let rName = row.cells[1].innerText;
      let rCredit = row.cells[2].innerText;
      let rLevel = row.cells[3].innerText;
      var rxmlhttp = new XMLHttpRequest();
      xmlhttp.open("GET", "editModule.php?MID="+rMID + "&Name=" + rName + "&Credit" + rCredit+ "&Level=" + rLevel, true);

      xmlhttp.send();
  }

  function add_module(){
      let sMID = document.getElementById("bmid").value;
      let sName = document.getElementById("bname").value;
      let sCredit = document.getElementById("bcredit").value;
      let sLevel= document.getElementById("blevel").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "addModule.php?MID="+sMID + "&Name=" + sName + "&Credit" + sCredit+ "&Level=" + sLevel, true);

    xmlhttp.send();
  }
</script>
</script>
</HTML>
