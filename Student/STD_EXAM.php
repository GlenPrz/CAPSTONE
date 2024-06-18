<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BTS Driving school</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="STUDENT_PORTAL.css">
	<link href="studentstyle/stdexam.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script>
    function validateForm() {
      var questions = document.getElementsByClassName("question");
      var error = document.getElementById("error-msg");

      for (var i = 0; i < questions.length; i++) {
        var options = questions[i].getElementsByTagName("input");
        var isChecked = false;

        for (var j = 0; j < options.length; j++) {
          if (options[j].checked) {
            isChecked = true;
            break;
          }
        }

      }

      return true;
    }
  </script>
</head>

<body>
	<img src="../img/bts_logo.png" class="examBTS_logo">
	<div class="exam_Container">
		<div class="Exam_smallcontainer">
			<header><h1>THEORETICAL DRIVING COURES EXAM</h1></header><br>
 <form action="STD_EXAM_RESULT.php" method="post" onsubmit="return validateForm()">

			   
      <?php
        // Connect to the MySQL database
        $servername = "localhost";
        $username = "u896821908_bts";
        $password = "a*5E4UEhsHa]";
        $dbname = "u896821908_bts";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
		

		if (isset($_POST['ExamButton'])) {
			$selectedTopic = $_POST['ExamButton'];
			// Use the $selectedValue as needed
			echo "<h2>". $selectedTopic . " Exam</h2>";
			echo "<h3>Instructions: read each questions carefully and choose the best answer. Good luck</h3>";
		}
		session_start();
		$_SESSION['Topic'] = $selectedTopic;
		
        // Check connection
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve questions from the database
        $sql = "SELECT * FROM questions WHERE topic = '$selectedTopic'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
    $questionNumber = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $qid = $row['qid'];
        $question = $row['question'];
        $ans1 = $row['ans1'];
        $ans2 = $row['ans2'];
        $ans3 = $row['ans3'];
        $ans4 = $row['ans4'];
        $ques_img = $row['ques_img']; // Add this line to get the image path

        echo '<div class="question">';
        echo '<h4>' . $questionNumber . '. ' . $question . '</h4>';

        // Adding container for image
        echo '<div class="image-container">';
        // Display the image if the path is available
        if (!empty($ques_img) && file_exists($ques_img)) {
            echo '<img src="' . $ques_img . '" alt="Image" width="100" height="100">';
        } 
        echo '</div>';

        echo '</div>';

        echo '<div class="options">';
        echo '<label><input type="radio" name="answer' . $qid . '" value="A" required> a. ' . $ans1 . '</label>';
        echo '<label><input type="radio" name="answer' . $qid . '" value="B" required> b. ' . $ans2 . '</label>';
        echo '<label><input type="radio" name="answer' . $qid . '" value="C" required> c. ' . $ans3 . '</label>';
        echo '<label><input type="radio" name="answer' . $qid . '" value="D" required> d. ' . $ans4 . '</label>';
        echo '<hr class="exam_Hr">';
        echo '</div>';

        $questionNumber++;
    }
} else {
    echo 'No questions found.';
}

        // Close the database connection
        mysqli_close($conn);
      ?>
	
      
		</div>
	</div>
		<button type="submit" class="Exambutton submit">Submit</button>
					<a href="STD_MODULE_EXAM.php" class="Exambutton quit">Quit</a>
    </form>		
</body>

</html>

