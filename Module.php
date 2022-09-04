<?php
    include("OPDBS.php");
    
    class Module extends OPDBS{
        
        public function __construct(){
            parent::__construct();
        }

        public function PrintAll(){
            $sql = "SELECT * from module";
            $result = $this->conn->query($sql);
            return $result;
        }

        public function Show($mid){
            $sql = "SELECT * from module WHERE MID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $mid);
            if ($stmt->execute()) {
                return $stmt->get_result();
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }

        public function Delete($mid){
            $sql = "DELETE from module WHERE LID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $mid);
            if ($stmt->execute()) {
                echo "Delete record successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }

        public function Insert($mid, $name, $credit, $level){
            $sql = "INSERT INTO module (MID, Name, Credit, Level) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssii", $mid, $name, $credit, $level);
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }            
        }

        public function Update($mid, $name, $credit, $level){
            $sql = "UPDATE module SET Name=?, Credit=?, Level=? WHERE MID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("siis", $mid, $name, $credit, $level);
            
            if ($stmt->execute()) {
                echo "Record updated successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }
    }

    $module = new Module();

    //To show all Modules
    $result = $module->PrintAll();
    if ($result->num_rows > 0) {
        ?>
            <table>
                <thead>
                    <tr>
                        <th colspan="4">Module</th>
                    </tr>
                    <tr>
                        <th>MID</th>
                        <th>Name</th>
                        <th>Credit</th>
                        <th>Level</th>
                    </tr>
                </thead>
            <tbody>
        <?php
        while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $row["MID"]; ?></td>
                <td><?php echo $row["Name"]; ?></td>
                <td><?php echo $row["Credit"]; ?></td>
                <td><?php echo $row["Level"]; ?></td>
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
    $result = $module->Show($stid);
    if ($result->num_rows > 0) {
        ?>
            <table>
                <thead>
                    <tr>
                        <th colspan="4">Lecturer</th>
                    </tr>
                    <tr>
                        <th>LID</th>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Salary</th>
                        <th>Qualification</th>
                    </tr>
                </thead>
            <tbody>
        <?php
        while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $row["MID"]; ?></td>
                <td><?php echo $row["Name"]; ?></td>
                <td><?php echo $row["Credit"]; ?></td>
                <td><?php echo $row["Level"]; ?></td>
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

    //To insert a module
    //$module ->Insert();

    //To update a module
    //$module ->Update();

    //To delete a module
    //$module ->Delete();
?>
<a href="Enrolment.php">Enrolment</a><br><a href="Module.php">Module</a><br><a href="Lecturer.php">Lecturer</a><br><a href="Student.php">Student</a>
