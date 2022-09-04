<?php
    include("OPDBS.php");
    
    class Student extends OPDBS{
        
        public function __construct(){
            parent::__construct();
        }

        public function PrintAll(){
            $sql = "SELECT * from student";
            $result = $this->conn->query($sql);
            return $result;
        }

        public function Show($stid){
            $sql = "SELECT * from student WHERE STID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $stid);
            if ($stmt->execute()) {
                return $stmt->get_result();
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }

        public function Delete($stid){
            $sql = "DELETE from student WHERE STID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $stid);
            if ($stmt->execute()) {
                echo "Delete record successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }

        public function Insert($stid, $name, $Lastname, $Email, $address){
            $sql = "INSERT INTO student (STID, Name, Lastname, Email, Address) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("issss", $stid, $name, $Lastname, $Email, $address);
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }            
        }

        public function Update($stid, $name, $Lastname, $Email, $address){
            $sql = "UPDATE student SET Name = ?, Lastname = ?, Email = ?, address= ? WHERE STID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssi", $name, $Lastname, $Email, $address, $stid);
            
            if ($stmt->execute()) {
                echo "Record updated successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }
    }

    $student = new Student();

    //To show all students
    $result = $student->PrintAll();
    if ($result->num_rows > 0) {
        ?>
            <table>
                <thead>
                    <tr>
                        <th colspan="4">Students</th>
                    </tr>
                    <tr>
                        <th> ID </th>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Email </th>
                        <th>Address </th>
                    </tr>
                </thead>
            <tbody>
        <?php
        while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $row["STID"]; ?></td>
                <td><?php echo $row["Name"]; ?></td>
                <td><?php echo $row["Lastname"]; ?></td>
                <td><?php echo $row["Email"]; ?></td>
                <td><?php echo $row["Address"]; ?></td>
            </tr>
        <?php
        }
        ?>
            </tbody>
        </table>
        <?php
    } else {
        echo "0 results";
        echo ("<br>");
    }
    echo ("<br>"); 
    echo ("<br>"); 
    //To show specific student with student id
    $stid = 123; //put the specific student id which you want to show
    $result = $student->Show($stid);
    if ($result->num_rows > 0) {
        ?>
            <table>
                <thead>
                    <tr>
                        <th colspan="4">Student</th>
                    </tr>
                    <tr>
                        <th> ID </th>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Email </th>
                        <th>Address </th>
                    </tr>
                </thead>
            <tbody>
        <?php
        while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $row["STID"]; ?></td>
                <td><?php echo $row["Name"]; ?></td>
                <td><?php echo $row["Lastname"]; ?></td>
                <td><?php echo $row["Email"]; ?></td>
                <td><?php echo $row["Address"]; ?></td>
            </tr>
        <?php
        }
        ?>
            </tbody>
        </table>
        <?php
    } else {
        echo "0 results";
        echo ("<br>");
    }
    ?>
    <?php
    echo ("<br>"); 

    //To insert a student
    //$student ->Insert();

    //To update a student
    //$student ->Update();

    //To delete a student
    //$student ->Delete();
?>
<a href="Enrolment.php">Enrolment</a><br><a href="Module.php">Module</a><br><a href="Lecturer.php">Lecturer</a><br><a href="Student.php">Student</a>
