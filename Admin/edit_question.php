<?php
// Fetch the 'id' parameter from the URL query string
$qid = $_GET['id'] ?? 'none';
$qidPDCQuestion = $_GET['Pdcid'] ?? 'none';

// Connect to the database
$servername = "localhost";
$username = "u896821908_bts";
$password = "a*5E4UEhsHa]";
$dbname = "u896821908_bts";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($qid) && !empty($qid) or $qid == 'none'){
// Get the question based on the qid
$sql = "SELECT * FROM questions WHERE qid = '$qid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>Edit Question (ID: " . $row['qid'] . ")</h2>";
    echo "<form action='update_question.php?id=$qid' method='post' enctype='multipart/form-data'>";
    	
    echo "<label for='question'>Question:</label>";
    echo "<input type='text' name='question' value='" . $row['question'] . "'><br>";
    
    echo "<label for='image'>Upload Image:</label>
    <input type='file' name='ques_img'  value=" . $row['ques_img'] . "><br>";
	
	 echo "<label for='ans1'>Answer 1:</label>";
    echo "<input type='text' name='ans1' value='" . $row['ans1'] . "'><br>";
	
	 echo "<label for='ans2'>Answer 2:</label>";
    echo "<input type='text' name='ans2' value='" . $row['ans2'] . "'><br>";
	
	 echo "<label for='ans3'>Answer 3:</label>";
    echo "<input type='text' name='ans3' value='" . $row['ans3'] . "'><br>";
	
	 echo "<label for='ans4'>Answer 4:</label>";
    echo "<input type='text' name='ans4' value='" . $row['ans4'] . "'><br>";
	
    echo "<label for='correct_answer'>Correct Answer:</label>";
    echo "<select name='correct_answer'>";
    echo "<option value='" . $row['correct_answer'] . "' selected hidden >" . $row['correct_answer'] . "</option>";
    echo "<option value='A'>A</option>";
    echo "<option value='B'>B</option>";
    echo "<option value='C'>C</option>";
    echo "<option value='D'>D</option>";
    echo "</select><br>";
	
	echo "<label for='topic'>Topic:</label>";
    echo "<select name='topic'>";
    echo "<option value='" . $row['topic'] . "' selected hidden >" . $row['topic'] . "</option>";
    echo "<option value='Module 1'>Module 1</option>";
    echo "<option value='Module 2'>Module 2</option>";
    echo "<option value='Module 3'>Module 3</option>";
    echo "</select><br>";
	
    echo "<button type='button' class='cancel-button' onclick='closeModal()'>Cancel</button>";
    echo "<button type='submit' class='proceed-button' name='proceed' onclick='confirmUpdate()'>Proceed</button>";

    
    echo "</form>";
} else {
    // echo "Question not found.<br><br>";
    // echo "<br><br>";
    }
}

//PDC QUESTION


if(isset($qidPDCQuestion) && !empty($qidPDCQuestion) or $qidPDCQuestion == 'none'){
    
$sqlPDCQ = "SELECT * FROM pdc_questions WHERE ques_id = '$qidPDCQuestion'";
$resultPDCQ = $conn->query($sqlPDCQ);

if ($resultPDCQ->num_rows > 0) {
    $rowPDCQ = $resultPDCQ->fetch_assoc();
    echo "<h2>Edit Question (ID: " . $rowPDCQ['ques_id'] . ")</h2>";
    echo "<form action='update_question.php?Pdcid=$qidPDCQuestion' method='post' id='PDCQ'>";
	
	 echo "<label for='qtitle'>Title:</label>";
    echo "<input type='text' name='qtitle' value='" . $rowPDCQ['q_title'] . "'><br>";
	
	 echo "<label for='desciption'>Desciption:</label>";
    echo "<input type='text' name='desciption' value='" . $rowPDCQ['desciption'] . "'><br>";

    echo "<label for='Session_PDCQ'>Session:</label>";
    echo "<select name='Session_PDCQ'>";
    echo "<option value='" . $rowPDCQ['session'] . "' selected hidden >" .$rowPDCQ['session'] . "</option>";
    echo "<option value='1'>1</option>";
    echo "<option value='2'>2</option>";
    echo "</select>";
	
    echo "<button type='button' class='cancel-button' onclick='closeModalPDCQUESTION()'>Cancel</button>";
    echo "<button type='submit' class='proceed-button' name='proceed' onclick='confirmUpdatePDCQ()'>Proceed</button>";

    
    echo "</form>";
} else {
    // echo "Question not found. BatPDC QUESTION";
    // echo "<br><br>";
    // echo $qidPDCQuestion;
    // echo "<br>QID<br>";
    // echo $qid;
    }

}

// Close the connection
$conn->close();
?>


