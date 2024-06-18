<?php
include "../conn.php";
$CoursedId = $_GET['CourseInfo'] ?? 'none';
$infoId = $_GET['Info'] ?? 'none';
$feedid = $_GET['feedid'] ?? 'none';
$evalid = $_GET['evalid'] ?? 'none';
$vehicleid = $_GET['vehicleid'] ?? 'none';
$Stdid_res = $_GET['Stdid_res'] ?? 'none';
$stdRelation = $_GET['stdRelation'] ?? 'none';
$newevquesid = $_GET['newevques'] ?? 'none';
$voucherid = $_GET['voucherid'] ?? 'none';


//  echo $CoursedId;
//  echo $infoId;

    // Get the question based on the qid
   
    
    if (isset($CoursedId) && !empty($CoursedId) || $CoursedId == 'none') {
        try {
           
            // Prepare and execute the query using the existing $conn connection
            $stmt = $conn->prepare("SELECT * FROM u896821908_bts.course_enrolled WHERE idCourse_Enrolled = :CoursedId");
            $stmt->bindParam(":CoursedId", $CoursedId, PDO::PARAM_STR);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                echo "<h2>Edit Course Information (ID: " . $row['idCourse_Enrolled'] . ")</h2>";
                echo "<form action='update_question.php?CourseInfo=$CoursedId' method='post'>";
    
                echo "<label for='question'>Course:</label>";
                echo "<input type='text' name='Course' value='" . $row['Course'] . "' readonly><br>";

    
                echo "<label for='question'>Course Info:</label>";
                echo "<input type='text' name='Courseinformation' value='" . $row['Course_info'] . "'><br>";
    
                echo "<label for='VechileType'>Vechile(Type)</label>";
                echo "<select name='VechileType'>";
                echo "<option value='" . $row['Vechile(Type)'] . "' selected hidden >" . $row['Vechile(Type)'] . "</option>";
                echo "<option value='Manual'>Manual</option>";
                echo "<option value='Automatic'>Automatic</option>";
                echo "</select><br>";

              
                echo "<label for='question'>Info:</label>";
                echo "<input type='text' name='Info' value='" . $row['Info'] . "'><br>";
    
                echo "<label for='question'>Price:</label>";
                echo "<input type='number' name='Price' value='" . $row['Price'] . "'><br><br>";
                
                // Repeat the same pattern for other input fields
    
              
    
                echo "<button type='button' class='cancel-button' onclick='closeModal()'>Cancel</button>";
                echo "<button type='submit' class='proceed-button' name='proceed' onclick='confirmUpdate()'>Proceed</button>";
    
                echo "</form>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
    }

    if (isset($infoId) && !empty($infoId) || $infoId == 'none') {
        try {
            // Prepare and execute the query using the existing $conn connection
            $stmt = $conn->prepare("SELECT * FROM u896821908_bts.info_tb WHERE info_id = :infoId");
            $stmt->bindParam(":infoId", $infoId, PDO::PARAM_STR);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                echo "<h2>Edit Information (ID: " . $row['info_id'] . ")</h2>";
                echo "<form action='update_question.php?infoId=$infoId' method='post'>";
                echo "<label for='info_title'>Title:</label>";
                echo "<input type='text' name='info_title' value='" . $row['title'] . "'><br>";
                
                echo "<label for='information'>Description:</label>";
                echo "<textarea name='information' rows='5' cols='70' style='resize: none;'>" . $row['description'] . "</textarea>";
                
                echo "<button type='button' class='cancel-button' onclick='closeModal()'>Cancel</button>";
                echo "<button type='submit' class='proceed-button' name='proceed'>Proceed</button>";
                
                echo "</form>";
                
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }

    if (isset($feedid) && !empty($feedid) || $feedid == 'none') {
        try {
            // Prepare and execute the query using the existing $conn connection
            $stmt = $conn->prepare("SELECT * FROM u896821908_bts.feedques_tb WHERE qID = :feed_id");
            $stmt->bindParam(":feed_id", $feedid, PDO::PARAM_STR);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                echo "<h2>Edit Feedback Information (ID: " . $row['qID'] . ")</h2>";
                echo "<form action='update_question.php?feedid=$feedid' method='post'>";
                echo "<label for='question_id'>Qid:</label>";
                echo "<input type='text' name='question_id' value='" . $row['qID'] . "' readonly><br>";
                
                echo "<label for='QuestionFeedback'>Question:</label>";
                echo "<textarea name='QuestionFeedback' rows='5' cols='70' style='resize: none;'>" . $row['Question'] . "</textarea>";
                
                echo "<button type='button' class='cancel-button' onclick='closeModal()'>Cancel</button>";
                echo "<button type='submit' class='proceed-button' name='proceed'>Proceed</button>";
                
                echo "</form>";
                
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }
    

    if (isset($evalid) && !empty($evalid) || $evalid == 'none') {
        try {
            // Prepare and execute the query using the existing $conn connection
            $stmt = $conn->prepare("SELECT * FROM u896821908_bts.evalques_tb WHERE eval_id = :eval_id");
            $stmt->bindParam(":eval_id", $evalid, PDO::PARAM_STR);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                echo "<h2>Edit Evaluation Information (ID: " . $row['eval_id'] . ")</h2>";
                echo "<form action='update_question.php?evalid=$evalid' method='post'>";
                
                echo "<label for='QuestionFeedback'>Question:</label>";
                echo "<textarea name='QuestionEval' rows='5' cols='70' style='resize: none;'>" . $row['question'] . "</textarea>";
                
                echo "<button type='submit' class='proceed-button' name='proceed'>Proceed</button>";
                
                echo "</form>";
                
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }
    
     //STD RelationShip
      if (isset($stdRelation) && !empty($stdRelation) || $stdRelation == 'none') {
        try {
            // Prepare and execute the query using the existing $conn connection
            $stmt = $conn->prepare("SELECT * FROM u896821908_bts.std_emergency_relationship WHERE idStd_Emergency_relationship = :stdRelation");
            $stmt->bindParam(":stdRelation", $stdRelation, PDO::PARAM_STR);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                echo "<h2>Edit Relationship Information (ID: " . $row['idStd_Emergency_relationship'] . ")</h2>";
                echo "<form action='update_question.php?StdRelationship=$stdRelation' method='post'>";
                echo "<label for='stdRelationship'>Relationship:</label>";
                echo "<input type='text' name='stdRelationship' value='" . $row['Relationship'] . "'><br>";
                
                echo "<button type='submit' class='proceed-button' name='proceed'>Proceed</button>";
                
                echo "</form>";
                
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }
    
    if (isset($vehicleid) && !empty($vehicleid) || $vehicleid == 'none') {
    try {
        // Prepare and execute the query using the existing $conn connection
        $stmt = $conn->prepare("SELECT * FROM u896821908_bts.vehicle_tbl WHERE vhcl_id = :vhcl_id");
        $stmt->bindParam(":vhcl_id", $vehicleid, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Output the data or use it in your HTML form
            echo "<h2>Edit Vehicle (ID: $vehicleid)</h2>";
            echo "<form action='Vehicle_add_del.php?vehicleid=$vehicleid' method='post'>";
            // Add your form fields here, pre-filled with the fetched data
            echo "<label for='vehicle_type'>Vehicle Type:</label>";
            echo "<select name='Type'>
                        <option value='". $row['Type'] ."' selected hidden>". $row['Type'] ."</option>
                        <option value='Car(Manual)'>Car(Manual)</option>
                        <option value='Car(Automatic)'>Car(Automatic)</option>
                        <option value='Motorcyle(Manual)'>Motorcyle(Manual)</option>
                        <option value='Motorcyle(Automatic)'>Motorcyle(Automatic)</option>
                    </select><br>";
            
            echo "<label for='vehicle_brand'>Vehicle Brand & Model:</label>";
            echo "<input type='text' name='vehicle_brand_model' value='". $row['vehicle_brand_model'] ."'><br>";
            
            // Add more fields as needed
            echo "<button type='button' class='cancel-button' onclick='closeModal()'>Cancel</button>";
            echo "<button type='submit' class='proceed-button'>Update Vehicle</button>";
            echo "</form>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

  if (isset($Stdid_res) && !empty($Stdid_res) || $Stdid_res == 'none') {
    try {
        // Prepare and execute the query using the existing $conn connection
        $stmt = $conn->prepare("SELECT * FROM `student_result` WHERE `username` = :Stdid_res");
        $stmt->bindParam(":Stdid_res", $Stdid_res, PDO::PARAM_STR);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            echo "<h2>Student Result (Username: $Stdid_res)</h2>";
            echo "<table border='1'>";
            echo "<tr>
                    <th>Session Number</th>
                    <th>Score</th>
                    <th>Result</th>
                    <th>Number of Wrong Answers</th>
                  </tr>";
    
            // Output data in a table row
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['Session_num'] . "</td>";
                echo "<td>" . $row['Score'] . "</td>";
                echo "<td>" . $row['result'] . "</td>";
                echo "<td>" . $row['num_of_wrong_ans'] . "</td>";
                echo "</tr>";
            }
    
            echo "</table><br>";
            echo "<button type='button' class='cancel-button' onclick='closeModal()'>Cancel</button>";
        } 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    }

    if (isset($newevquesid) && !empty($newevquesid) || $newevquesid == 'none') {
        try {
            $stmt = $conn->prepare("SELECT * FROM u896821908_bts.Added_evalques_tb WHERE new_evalques_id = :newevques");
            $stmt->bindParam(":newevques", $newevquesid, PDO::PARAM_STR);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                // Output the data or use it in your HTML form
                echo "<h2>Edit Evaluation Information (ID: $newevquesid)</h2>";
                echo "<form action='Vehicle_add_del.php?newevalquesidtest=$newevquesid' method='post'>";
                echo "<label for='Questiontitle'>Question:</label>";
                echo "<input type='text' name='Questiontitle' value='" . $row['title'] . "'>";
            
                echo "<label for='QuestionEval'>Question:</label>";
                echo "<textarea name='QuestionEval' rows='5' cols='70' style='resize: none;'>" . $row['new_question'] . "</textarea>";
            
                // Add more fields as needed
                echo "<button type='button' class='cancel-button' onclick='closeModal()'>Cancel</button>";
                echo "<button type='submit' class='proceed-button'>Update Vehicle</button>";
                echo "</form>";
            }

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
        if (isset($voucherid) && !empty($voucherid) || $voucherid == 'none') {
                try {
                    // Prepare and execute the query using the existing $conn connection
                    $stmt = $conn->prepare("SELECT * FROM disc_voucher WHERE voucher_id = :voucher_id");
                    $stmt->bindParam(":voucher_id", $voucherid, PDO::PARAM_STR);
                    $stmt->execute();
            
                    if ($stmt->rowCount() > 0) {
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        // Output the data or use it in your HTML form
                        echo "<h2>Edit Voucher (ID: $voucherid)</h2>";
                        echo "<form action='Vehicle_add_del.php?voucherid_edit=$voucherid' method='post'>";
                            // Add your form fields here, pre-filled with the fetched data
                            echo "<label for='voucher_code'>Voucher Code:</label>
                                    <div style='position: relative;'>
                                        <input type='password' id='voucherCodeInput' name='voucher_code2' value='". $row['code'] ."' required  style='width: 92%; padding: 8px; margin-bottom: 12px; box-sizing: border-box;'>
                                        <i id='togglePasswordIcon' class='fas fa-eye' onclick='togglePassword()'></i>
                                    </div>";
                
                            echo "<label for='applied_for'>Applied For:</label>";
                            echo "<select name='applied_for2'>
                                        <option value='". $row['applied_for'] ."' selected hidden>". $row['applied_for'] ."</option>
                                        <option value='TDC'>TDC</option>
                                        <option value='PDC'>PDC</option>
                                    </select><br>";
                
                            echo "<label for='slot'>Slot:</label>";
                            echo "<input type='number' name='slot2' value=". $row['slot'] ." required min='1' max='100' style='width: 100%; padding: 8px; margin-bottom: 12px; box-sizing: border-box;'><br>";
                
                            echo "<label for='discount'>Discount (1% to 100%):</label>";
                            echo "<input type='number' name='discount2' value=". $row['discount'] ." required min='1' max='100' style='width: 100%; padding: 8px; margin-bottom: 12px; box-sizing: border-box;'><br>";
                
                
                            // Add more fields as needed
                            echo "<button type='button' class='cancel-button' onclick='closeModal()'>Cancel</button>";
                            echo "<button type='submit' class='proceed-button'>Update Voucher</button>";
                        echo "</form>";
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
 

?>













