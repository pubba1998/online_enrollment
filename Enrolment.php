<?php
    include("OPDBS.php");
    
    class Enrolment extends OPDBS{
        
        public function __construct(){
            parent::__construct();
        }

        public function PrintAll(){
            $sql = "SELECT * from enrolment";
            $result = $this->conn->query($sql);
            return $result;
        }

        public function Show($stid){
            $sql = "SELECT * from enrolment WHERE STID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $stid);
            if ($stmt->execute()) {
                return $stmt->get_result();
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }

        public function Delete($stid){
            $sql = "DELETE from enrolment WHERE STID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $stid);
            if ($stmt->execute()) {
                echo "Delete record successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }

        public function Insert($stid, $mid, $lid, $block, $mark){
            $sql = "INSERT INTO enrolment (STID, MID, LID, Block, Mark) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("isiii", $stid, $mid, $lid, $block, $mark);
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }            
        }

        public function Update($stid, $mid, $lid, $block, $mark){
            $sql = "UPDATE enrolment SET MID = ?, LID = ?, Block = ?, Mark= ? WHERE STID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("siiii", $mid, $lid, $block, $mark, $stid);
            
            if ($stmt->execute()) {
                echo "Record updated successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }
    }

    $enrolment = new Enrolment();

    //To show all Enrolment
    $result = $enrolment->PrintAll();
    if ($result->num_rows > 0) {
        ?>
            <table>
                <thead>
                    <tr>
                        <th colspan="4">Enrolment</th>
                    </tr>
                    <tr>
                        <th>STID</th>
                        <th>MID</th>
                        <th>LID</th>
                        <th>Block</th>
                        <th>Mark</th>
                    </tr>
                </thead>
            <tbody>
        <?php
        while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $row["STID"]; ?></td>
                <td><?php echo $row["MID"]; ?></td>
                <td><?php echo $row["LID"]; ?></td>
                <td><?php echo $row["Block"]; ?></td>
                <td><?php echo $row["Mark"]; ?></td>
            </tr>
        <?php
        }
        ?>
            </tbody>
        </table>
        <?php
    } else {
        echo ("<br>");
    }
    echo ("<br>"); 
    //To show specific student with student id
    $stid = 123; //put the specific student id which you want to show
    $result = $enrolment->Show($stid);
    if ($result->num_rows > 0) {
        ?>
            <table>
                <thead>
                    <tr>
                        <th colspan="4">Enrolment</th>
                    </tr>
                    <tr>
                        <th>STID</th>
                        <th>MID</th>
                        <th>LID</th>
                        <th>Block</th>
                        <th>Mark</th>
                    </tr>
                </thead>
            <tbody>
        <?php
        while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $row["STID"]; ?></td>
                <td><?php echo $row["MID"]; ?></td>
                <td><?php echo $row["LID"]; ?></td>
                <td><?php echo $row["Block"]; ?></td>
                <td><?php echo $row["Mark"]; ?></td>
            </tr>
        <?php
        }
        ?>
            </tbody>
        </table>
        <?php
    } else {
        echo ("<br>");
    }
    ?>
    <?php
    echo ("<br>"); 

    //To insert a enrolment
    //$enrolment ->Insert();

    //To update a enrolment
    //$enrolment ->Update();

    //To delete a enrolment
    //$enrolment ->Delete();

?>
<a href="Enrolment.php">Enrolment</a><br><a href="Module.php">Module</a><br><a href="Lecturer.php">Lecturer</a><br><a href="Student.php">Student</a>
