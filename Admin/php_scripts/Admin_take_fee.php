
<?php
include "../../conn.php";
session_start();
// Fetch data for the selected student using the provided 'id'

$currentDate = date("Y-m-d");

// Calculate the minimum date (1 week before today)
$minDate = date("Y-m-d", strtotime("-1 week"));


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $Stud_id = $_GET['id'];
// Prepare and execute the SQL query
    $sql = "SELECT * FROM u896821908_bts.student WHERE idStudent = :Stud_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Stud_id', $Stud_id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the data
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //min and max for the payment
    $min = 0.1 * $row['balance'];
    $max = $row['balance'];
	
	if (empty($row['PDC-MOTOR'])) {
		$course_enrolled_for_transaction = "TDC";
	} else {
		$course_enrolled_for_transaction = "PDC";
	}
	
    if ($row) {
		if (empty($row['PDC-MOTOR'])) {
			$course_enrolled_for_transaction = "TDC";
		} else {
			$course_enrolled_for_transaction = "PDC";
		}
    	
	if (empty($row['PDC-MOTOR']) && empty($row['PDC-MOTOR'])) {
		$permit_istrue = false;
		$Permit_btn = 'none';
	} else {
		$permit_istrue = true;
		$Permit_btn = 'block';
	}
	$birth_Id_btn_val = '';
	if (empty($row['TDC'])) {
		$birthID_istrue = false;
		$BirthC_id_btn = 'none';
	} else {
		$birthID_istrue = true;
		$BirthC_id_btn = 'block';
		if ($row['BirthCertType'] === 'Id') {
	       	$birth_Id_btn_val= 'Valid ID';
		}else if ($row['BirthCertType'] === 'Birth Certificate') {
	        $birth_Id_btn_val= 'Birth Certificate';
		}
	}

		$buttonDisplay = 'none'; // Default to 'block'
		if ($row['Enroll_Status'] === "pending") {
			$buttonDisplay = 'block';
		}
	
		$date_enrolled = $row['DateOfEnrolled']; 
		$email = $row['EmailAddress']; 
		$Firstname = $row['Firstname'];
		$birthcert = basename($row['BirthCert']);
		$student_permit_img = basename($row['Student_permit_img']);
		
		echo "<div id='take_fee_modal' class='modal'>
  <div class='modal-content'>
    <span class='close' onclick='closeModal()'>&times;</span>
    <div id='modalContent'>
		<form action='./php_scripts/save_std_transaction.php' method='post'>
		<input type='hidden'  name='stud_id' value='$Stud_id'>
		<input type='hidden'  name='course_enrolled_for_transaction' value='$course_enrolled_for_transaction'>
		<input type='hidden'  name='email' value='$email'>
		<input type='hidden'  name='firstname1' value='$Firstname'>
		<input type='hidden'  name='date_enrolled' value='$date_enrolled'>
		  <div>
		  <div class='row'>
			  <div class='col'>
					<h1 class='modal_title'>Take Fee</h1>
				</div>
			</div>
			
			<div class='row'>
			  <div class='col'>
					<h2>Student Data</h2>
				</div>
			</div>
			
			<div class='row'>
			  <div class='col'>
				<label for='lastname'>Last Name</label>
				<input type='text' class='data_placement' id='lastname' name='lastname' placeholder='" . $row['Lastname']  . "' readonly>
			  </div>
			  <div class='col'>
				<label for='firstname'>First Name</label>
				<input type='text' class='data_placement' id='firstname' name='firstname' placeholder='" . $row['Firstname']  . "' readonly>
			  </div>
			  <div class='col'>
				<label for='middlename'>Middle Name</label>
				<input type='text' class='data_placement' id='middlename' name='middlename' placeholder='" . $row['Middlename']  . "' readonly>
			  </div>
			</div>
			
			<div class='row'>
			  <div class='col'>
				<label for='birthdate'>Birthdate</label>
				<input type='text' class='data_placement' id='birthdate' name='birthdate' placeholder='" . $row['Birthdate']  . "' readonly>
			  </div>
			  <div class='col'>
				<label for='civilstatus'>Civil Status</label>
				<input type='text' class='data_placement' id='civilstatus' name='civilstatus' placeholder='" . $row['Civilstatus']  . "' readonly>
			  </div>
			  <div class='col'>
				<label for='contactnum'>Contact Number</label>
				<input type='text' class='data_placement' id='contactnum' name='contactnum' placeholder='" . $row['Contactnumber']  . "' readonly>
			  </div>
			  <div class='col'>
				<label for='gender'>Gender</label>
				<input type='text' class='data_placement' id='gender' name='gender' placeholder='" . $row['Sex']  . "' readonly>
			  </div>
			</div>
			
			<div class='row'>
			  <div class='col'>
				<label for='completeaddress'>Complete Address</label>
				<input type='text' class='data_placement' id='completeaddress' name='completeaddress' placeholder='" . $row['Address']  . ", " . $row['City'] . "' readonly>
			  </div>
			  
			  
			        <a href='../uploads/pdf_Student/$birthcert' target='_blanks' style='display: $BirthC_id_btn'>
                    <button type='button' class='BirtStudBtn'>$birth_Id_btn_val</button>
                    </a>
                    <a href='../uploads/pdf_Student/$student_permit_img' target='_blanks' style='display: $Permit_btn'>
                    <button type='button' class='BirtStudBtn'>Student Permit</button>
                    </a>
                            
			  </div>
				
			  <div class='col small'>
			  	<input type='hidden' id='enrollmentstatus' name='enrollmentstatus' value='" . $row['Enroll_Status']   . "'>
				
			  </div>
			</div>
			
			 <div class='row'>
			  <div class='col'>
					<h2>Course Enrolled</h2>
				</div>
			</div>
			
			 <div class='row'>
			  <div class='col'>
				<label for='paid'>TDC</label>
				<input type='text' class='data_placement' id='tdc' name='tdc' placeholder='N/A' value='" . $row['TDC']   . "' readonly>
			</div>
			<div class='col'>
				<label for='pdcM'>PDC Motorcycle</label>
				<input type='text' class='data_placement' id='pdcM' name='pdcM' placeholder='N/A' value='" . $row['PDC-MOTOR']   . "' readonly>
			</div>
			<div class='col'>
				<label for='pdcC'>PDC Car</label>
				<input type='text' class='data_placement' id='pdcC' name='pdcC' placeholder='N/A' value='" . $row['PDC-CAR']   . "' readonly>
				</div>
				<div class='col'>
				
				</div>
			</div>
			
			
			<div class='row'>
			  <div class='col'>
					<h2 style='color:  #022DB8;'>Gcash Payment</h2>
				</div>
			</div>
			<div class='row'>
				<div class='col'>
					<div class='OP_table'>
						<table>
							<tr>
								<th>Date</th>
								<th>Gcash Number</th>
								<th>Reference Number</th>
								<th>Receipt</th>
								<th>View</th>
							</tr>";

				
							// Prepare and execute the SQL query for olpayment_tb
							$sql = "SELECT ol_id, student_id, Gcash_num, Receipt_pic,Refence_num, date FROM olpayment_tb WHERE student_id = :Stud_id";
							$stmt = $conn->prepare($sql);
							$stmt->bindParam(':Stud_id', $Stud_id, PDO::PARAM_INT);
							$stmt->execute();

							// Fetch the data from olpayment_tb
							if ($stmt->rowCount() > 0) {
								// Output data to the table
								while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
									echo "<tr>";
									echo "<td>" . $row2["date"] . "</td>";
									echo "<td>" . $row2["Gcash_num"] . "</td>";
									echo "<td>" . $row2["Refence_num"] . "</td>";
									echo "<td><img width='50' height='80' src='../uploads/imgs_gcash_student/" . basename($row2['Receipt_pic']) . "'></td>";
									
									// Create the "View" button that opens the image in a new window
									echo "<td><a class='fee'onclick=\"window.open('../uploads/imgs_gcash_student/" . basename($row2['Receipt_pic']) . "', '_blank');\">View</a></td>";
									
									echo "</tr>";
								}
							} else {
								echo "<tr><td colspan='4'>No Online Payment</td></tr>";
							}

						 echo "
						</table>
					</div>
				</div>
			</div>


           

			
			<div class='row'>
			  <div class='col'>
				<label for='balance'>Balance</label>
				<input type='text' class='data_placement' id='balance' name='balance'  placeholder='" . $row['balance']  . "' readonly>
			  </div>
			  
			  <div class='col'>
				<label for='paid'>Amount Paid</label>
				 <input type='number' class='data_placement' id='paid' name='paid' required max='$max'>
			  </div>
			  
			  <div class='col'>
				<label for='date'>Date of Payment</label>
<input type='date' class='data_placement' id='date123' name='date_of_payment' required min='{$minDate}' max='{$currentDate}'>
			  </div>
			  
			</div>
			
			<div class='row'>
			  <div class='col'>
				<label for='remarks'>Remarks</label>
				<input type='text' class='data_placement' id='remarks' name='remarks' required> 
			  </div>
			</div>
			
			<div class='row'>
			  <div class='col'>
				   <center>
				  <div class='button-container'>
					<button type='submit' class='submit-btn' name='submit'>Submit</button>
					<button type='button' class='cancel-btn' onclick='closeModal()'>Cancel</button>
					<button type='button' style='display:$buttonDisplay;'class='Deny-btn' id='denyButton' onclick='denyFormSubmit()'>Deny</button>
				  </div>
				  </center>
			  </div>
		   </div>
		   
		</form>
      </div>
    </div>
  </div>
</div>
<form id='denyForm' action='./adminDenied.php' method='post'>
	<input type='hidden'  name='stud_id' value='$Stud_id'>
	<input type='hidden'  name='email' value='$email'>
	<input type='hidden'  name='firstname' value='$Firstname'>
</form>
";


echo "<script>
    // Get the current date
    var today = new Date();

    // Calculate the minimum date (1 week before today)
    var minDate = new Date();
    minDate.setDate(today.getDate() - 7);

    // Format the minimum date as 'YYYY-MM-DD' for the input element
    var minDateFormatted = minDate.toISOString().split('T')[0];

    // Format the maximum date as 'YYYY-MM-DD' for the input element
    var maxDateFormatted = today.toISOString().split('T')[0];

    // Set the minimum and maximum attributes of the input element
    document.getElementById('date123').setAttribute('min', minDateFormatted);
    document.getElementById('date123').setAttribute('max', maxDateFormatted);
</script>";

    }
}
?>
  