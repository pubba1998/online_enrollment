<?php
    include("OPDBS.php");
    
    class Lecturer extends OPDBS{
        
        public function __construct(){
            parent::__construct();
        }

        public function PrintAll(){
            $sql = "SELECT * from lecture";
            $result = $this->conn->query($sql);
            return $result;
        }

        public function Show($lid){
            $sql = "SELECT * from lecture WHERE LID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $lid);
            if ($stmt->execute()) {
                return $stmt->get_result();
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }

        public function Delete($lid){
            $sql = "DELETE from lecture WHERE LID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $lid);
            if ($stmt->execute()) {
                echo "Delete record successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }

        public function Insert($lid, $name, $lastname, $email, $address, $salary, $qualification){
            $sql = "INSERT INTO lecture (LID, Name, Lastname, Email, Address, Salary, Qualification) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("issssis", $lid, $name, $lastname, $email, $address, $salary, $qualification);
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }            
        }

        public function Update($lid, $name, $lastname, $email, $address, $salary, $qualification){
            $sql = "UPDATE lecture SET Name=?, Lastname=?, Email=?, Address=?, Salary=?, Qualification=? WHERE LID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssssisi", $name, $lastname, $email, $address, $salary, $qualification, $lid);
            
            if ($stmt->execute()) {
                echo "Record updated successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }
    }

    $lecturer = new Lecturer();

    //To show all Lecture
    $result = $lecturer->PrintAll();
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
                <td><?php echo $row["LID"]; ?></td>
                <td><?php echo $row["Name"]; ?></td>
                <td><?php echo $row["Lastname"]; ?></td>
                <td><?php echo $row["Email"]; ?></td>
                <td><?php echo $row["Address"]; ?></td>
                <td><?php echo $row["Salary"]; ?></td>
                <td><?php echo $row["Qualification"]; ?></td>
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
    $result = $lecturer->Show($stid);
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
                <td><?php echo $row["LID"]; ?></td>
                <td><?php echo $row["Name"]; ?></td>
                <td><?php echo $row["Lastname"]; ?></td>
                <td><?php echo $row["Email"]; ?></td>
                <td><?php echo $row["Address"]; ?></td>
                <td><?php echo $row["Salary"]; ?></td>
                <td><?php echo $row["Qualification"]; ?></td>
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

    //To insert a lecturer
    //$lecturer ->Insert(300, "pubudu", "dasun", "pubudu@gmail.com", "auckland", 500, "PHD");

    //To update a lecturer
    //$lecturer ->Update();

    //To delete a lecturer
    //$lecturer ->Delete();

?>
<a href="Enrolment.php">Enrolment</a><br><a href="Module.php">Module</a><br><a href="Lecturer.php">Lecturer</a><br><a href="Student.php">Student</a>
