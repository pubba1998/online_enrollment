<html>
<body>

<?php 
  require_once('Student.php');

  
  $y = new Opdbs("localhost","root","","online_attendance");

  $n = new Student("Infaz");
  $x = $n -> some_message();
  echo "$x"
  //$n -> insert_student($n -> $Name);
    
?>

<form action="addstudent.php" method="post">
Student ID: <input type="text" name="STID"><br>
Name: <input type="text" name="name"><br>
Last name: <input type="text" name="lname"><br>
E-mail: <input type="text" name="email"><br>
Address: <input type="text" name="address"><br>
<input type="submit">
</form>
</body>
</html>