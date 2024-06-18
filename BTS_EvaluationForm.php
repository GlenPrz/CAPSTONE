<!DOCTYPE html>
<html lang="en">
<?php

include "conn.php";

try {

	$sqlEvalInfoData = "SELECT * FROM u896821908_bts.evalques_tb;";
	$stmtEvalInfoData = $conn->query($sqlEvalInfoData);
	
	$Question = [];

	
	 // Fetch and store values in arrays
	 while ($rowEvalInfoData = $stmtEvalInfoData->fetch(PDO::FETCH_ASSOC)) {
		$Question[] = $rowEvalInfoData['question'];
	}
	
	
	}catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}


?>
<head>
    <title>BTS Driving School Evaluation Form</title>
	<link rel="icon" type="image/x-icon" href="../img/favicon.ico">
</head>
<style>
        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', sans-serif;
        border: none;
    }
 body {
            font-family: Arial, sans-serif;
            background-color: #E5FFE5;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 90%;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"], input[type="date"] {
            width: 100%;
            font-size: 16px;
            background-color: white;
            outline: solid green 1px;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }

        input[type="radio"] {
            width: auto;
            margin-right: 10px;
        }

        textarea {
            width: 100%;
            font-size: 16px;
            background-color: white;
            outline: solid green 1px;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px 20px;
            border-radius: 20px;
            font-size: 18px;
            cursor: pointer;
            
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .header{
            margin-top: 3%;
            text-align: center;
            margin-right: 5%;
            margin-left: 5%;
            box-shadow: 2px 7px 8px rgba(0, 0, 0, 0.2);
            background-color: white;
            border-radius: 20px;
        
        }.header p{
            font-size: 20px;
            margin: 2%;
        }.header h1{
            font-size: 40px;
            margin: 2%
        }.evalForm{
            font-size: 20px;
            margin-top: 3%;
            margin-right: 5%;
            margin-left: 5%;
            box-shadow: 2px 7px 8px rgba(0, 0, 0, 0.2);
            border-radius: 20px;
            background-color: white;
        }label{
            font-weight: normal;
        }img{
            width: 100px;
        }
        #additional_comments {
    resize: none;
}
.star-rating {
      display: inline-block;
    }

    .star-rating input[type="radio"] {
      display: none;
    }

    .star-rating label {
      font-size: 30px;
      color: #ccc;
      float: right;
      padding: 0 5px;
      cursor: pointer;
    }

    .star-rating input[type="radio"]:checked~label {
      color: #ffcc00;
    }

    .star-rating label:hover,
    .star-rating label:hover~label {
      color: #ffcc00;
    }
    table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 2%;
        }

        th, td {
            border: none;
            text-align: center;

        }

        th {
            background-color: #f2f2f2;
            color: black;
            font-size: 24px;

        }

        tr:nth-child(even) {
            
        }
        td:nth-child(1){
            text-align: left;
        }th:nth-child(1){
            text-align: left;
        }
        .student{
            display: block;
            column-gap: 1%;
            
        }.license{
            margin-top: 1%;
            
            
        }label{
            font-weight:bold;
            
        }.namedate{
            display:flex;
            width:100%;
            column-gap: 1%;
        }.namedate label{
            width:100%;
            column-gap: 1%;
            margin-bottom:1%;
        }
        /* Style for the label */
.license label {
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
}

/* Style for the dropdown (select) */
.license select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    color: #333;
    outline: none;
    transition: border-color 0.3s ease;
}

/* Style for dropdown options (when opened) */
.license select option {
    background-color: #fff;
    color: #333;
}

/* Style for hover/focus effect */
.license select:hover,
.license select:focus {
    border-color: green;
}

/* Style for when the dropdown is open */
.license select:active,
.license select:focus {
    border-color: green;
    box-shadow: green;
}

</style>

<body>
    <div class="header">
        <br>
    <img src=".\img\bts_logo.png" alt="logo Image">
    <h1>BTS Driving School Evaluation Form</h1>
    <p>Please take a moment to provide your feedback regarding your experience with BTS Driving School and how it helped you obtain your Driver's License from LTO.</p><br>
    </div>

<div class="evalForm">
    <form method="post" id = "evaluation_form">
        <br>
        <br>
         <div class="namedate"><label for="student_name"><?php echo $Question[0];?></label>
        <label for="dateEnroll"><?php echo $Question[2];?></label></div>
        <div class="namedate">
        <input type="text" id="student_name" name="student_name" required>
        <input type="date" id="dateEnroll" name="dateEnroll" required>
        </div>
        <div class="student">
        <label for="license"><?php echo $Question[1];?></label><br>
        
        <div class="license">
    <label for="license_std">Select License Type:</label>
    <select id="license_std" name="license_std">
        <option value="TDC">Theoretical Driving Course "TDC"</option>
        <option value="PDC_Motor">Practical Driving Course Motorcycle "PDC"</option>
        <option value="PDC_Car">Practical Driving Course Car "PDC"</option>
    </select>
</div>


        </div>
        <br><br>

        

        <h2>Evaluation Questions:</h2>
        <table>
            <tr>
                <td><label for="overall_experience"><?php echo $Question[3];?></label></td>
                <td><div class="star-rating">
            <input type="radio" id="star5_overall_experience" name="rating_overall_experience" value="5">
            <label for="star5_overall_experience">&#9733;</label>
            <input type="radio" id="star4_overall_experience" name="rating_overall_experience" value="4">
            <label for="star4_overall_experience">&#9733;</label>
            <input type="radio" id="star3_overall_experience" name="rating_overall_experience" value="3">
            <label for="star3_overall_experience">&#9733;</label>
            <input type="radio" id="star2_overall_experience" name="rating_overall_experience" value="2">
            <label for="star2_overall_experience">&#9733;</label>
            <input type="radio" id="star1_overall_experience" name="rating_overall_experience" value="1">
            <label for="star1_overall_experience">&#9733;</label>
            </div></td>
            </tr>

            <tr>
                <td><label for="instructor_quality"><?php echo $Question[4];?></label></td>
                <td>
                    <div class="star-rating">
            <input type="radio" id="star5_instructor_quality" name="rating_instructor_quality" value="5">
            <label for="star5_instructor_quality">&#9733;</label>
            <input type="radio" id="star4_instructor_quality" name="rating_instructor_quality" value="4">
            <label for="star4_instructor_quality">&#9733;</label>
            <input type="radio" id="star3_instructor_quality" name="rating_instructor_quality" value="3">
            <label for="star3_instructor_quality">&#9733;</label>
            <input type="radio" id="star2_instructor_quality" name="rating_instructor_quality" value="2">
            <label for="star2_instructor_quality">&#9733;</label>
            <input type="radio" id="star1_instructor_quality" name="rating_instructor_quality" value="1">
            <label for="star1_instructor_quality">&#9733;</label>
            </div></td>
            </tr>

            <tr>
                <td> <label for="curriculum_effectiveness"><?php echo $Question[5];?></label></td>
                <td><div class="star-rating">
            <input type="radio" id="star5_curriculum_effectiveness" name="rating_curriculum_effectiveness" value="5">
            <label for="star5_curriculum_effectiveness">&#9733;</label>
            <input type="radio" id="star4_curriculum_effectiveness" name="rating_curriculum_effectiveness" value="4">
            <label for="star4_curriculum_effectiveness">&#9733;</label>
            <input type="radio" id="star3_curriculum_effectiveness" name="rating_curriculum_effectiveness" value="3">
            <label for="star3_curriculum_effectiveness">&#9733;</label>
            <input type="radio" id="star2_curriculum_effectiveness" name="rating_curriculum_effectiveness" value="2">
            <label for="star2_curriculum_effectiveness">&#9733;</label>
            <input type="radio" id="star1_curriculum_effectiveness" name="rating_curriculum_effectiveness" value="1">
            <label for="star1_curriculum_effectiveness">&#9733;</label>
            </div></td>
            </tr>
        </table>

        <label for="additional_comments"><?php echo $Question[6];?></label><br>
        <textarea id="additional_comments" name="additional_comments" rows="4" cols="50"></textarea><br><br>

        
        <div class="">
            <table>
        <?php
        try {
            // Fetch questions from the database
            $query = "SELECT * FROM u896821908_bts.Added_evalques_tb ";
            $stmt = $conn->query($query);

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td>
                            <label for="curriculum_effectiveness"><?php echo $row['new_question'];?></label>
                            <input type="hidden" name="questions[]" value="<?php echo $row['new_question'];?>">
                            <input type="hidden" name="titles[]" value="<?php echo $row['title'];?>">
                        </td>
                        <td>
                            <div class="star-rating" style="margin-left: 13%;">
                                <?php
                                for ($i = 5; $i >= 1; $i--) {
                                    $inputId = "star{$i}_question{$row['new_evalques_id']}";
                                ?>
                                    <input type="radio" id="<?php echo $inputId; ?>" name="rating[<?php echo $row['new_evalques_id']; ?>]" value="<?php echo $i; ?>" required>
                                    <label for="<?php echo $inputId; ?>">&#9733;</label>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>    
    </table>
        </div>

        

        <input type="submit" value="Submit">
        <br>
        <br>

    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>

$(document).ready(function() {
    $('#evaluation_form').submit(function(event) {
        // Prevent the form from submitting the traditional way
        event.preventDefault();
        // Get form data
        var formData = $(this).serialize();
        var form = this;
        // Send the form data using AJAX
        $.ajax({
            type: 'POST',
            url: 'submit_evaluation.php',
            data: formData,
            success: function(response) {
                // Handle the successful response here
                alert('Evaluation submitted successfully.');
                $(form)[0].reset();
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle errors here
                console.error('Error: ' + error);
            }
        });
    });
});
</script>

</body>

</html>