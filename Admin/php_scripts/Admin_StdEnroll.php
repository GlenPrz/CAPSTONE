<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
      include "../conn.php";
      $userdataEnrolled = $_GET['UserEnrolled'] ?? '';

          if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["Edit_Enrolled_form"]) && !empty($_POST["Edit_Enrolled_form"])) {
    
                $TDC_Status = $_POST["TDC-status"];
                $DEP_Status = $_POST['DEP-status'];
                $PDC_MOTOR = $_POST['PDC-MOTOR-status'];
                $PDC_CAR = $_POST['PDC-CAR-status'];
                $Expiration_number = $_POST['Expiration_number'];
                $License_number = $_POST['License_number'];
                $EnrolledId = $userdataEnrolled;

            try {
              $query = "UPDATE `u896821908_bts`.`student_enrolled`
              SET
              `TDC` = :TDC,
              `DEP` = :DEP,
              `PDC-MOTOR` = :PDC_MOTOR,
              `PDC-CAR` = :PDC_CAR,
              `LicenseNumber` = :LicenseNumber,
              `ExpirationDate` = :ExpirationDate
              WHERE `Username` = :EnrolledId";
                
                $stmt = $conn->prepare($query);
    
                $stmt->bindParam(':TDC', $TDC_Status);
                $stmt->bindParam(':DEP', $DEP_Status);
                $stmt->bindParam(':PDC_MOTOR', $PDC_MOTOR);
                $stmt->bindParam(':PDC_CAR', $PDC_CAR);
                $stmt->bindParam(':LicenseNumber', $License_number);
                $stmt->bindParam(':ExpirationDate', $Expiration_number);                
                // Bind EnrolledId
                $stmt->bindParam(':EnrolledId', $userdataEnrolled);
            
                // Execute the statement
                $stmt->execute();
                    echo '<script>alert("' . $userdataEnrolled . ' has been successfully updated");</script>';
              } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
    
?>


<style>
  .TDC_CERT{
background-color: gold;
padding: 10px 20px;
  }
  .PDC_CERT{
    background-color: gold;
    padding: 10px 20px;
    margin-bottom: 2%;
  }

  .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color:  #f6faf5;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close_Enrolled {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close_Enrolled:hover,
.close_Enrolled:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: transparent;
  color: black;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: transparent;
  color: white;
}

/*Modal 2 for edit payment*/
.modal-Enrolled {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 2; /* Sit on top */
  padding-top: 200px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content-Enrolled {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop-payment;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop-payment;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop-payment {
  from {top:-500px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop-payment {
  from {top:-500px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close-Enrolled {
  color: white;
  float: right;
  font-size: 30px;
  font-weight: bold;
}

.close-Enrolled:hover,
.close-Enrolled:focus {
  color: red;
  text-decoration: none;
  cursor: pointer;
}

.modal-header-Enrolled {
  padding:5px 30px;
  background-color: #5cb85c;
  color: white;
}

.modal-body-Enrolled {padding: 2px 16px;}

.modal-footer-Enrolled {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
.table_Enrolled_edit{
  margin:20px 0px 20px 0px;
}

.table_Enrolled_edit th{
  width:1%;
  padding:20px;
  text-align: center;
}
.table_Enrolled_edit td{
  padding:2;
  width:10%;
  text-align: center;
}
.table_Enrolled_edit{
  font-size: 20px;
  padding:10px;
}
.table_Enrolled_edit .License_number_editable{
  width: 80%;
  height: 80%;
  font-size: 20px;
}
.table_Enrolled_edit .Expiration_number_editable{
  width: 80%;
  height: 80%;
  font-size: 20px;
}
.modal-footer-Enrolled .footer-cancel{
  padding:10px;
  border-radius: 5px;
  margin:20px;
  background-color:#ff0000;
  color:black;
  font-weight: 100px;
  font-size:20px;
  font-family: 'Roboto Mono', monospace;
}
.modal-footer-Enrolled .footer-submit{
  padding:10px;
  border-radius: 5px;
  margin:20px 20px 20px -2px;
  background-color:green;
  color:black;
  font-weight: 100px;
  font-size:20px;
  font-family: 'Roboto Mono', monospace;
}
.modal-footer-Enrolled .align-buttons{
  display: flex;
  justify-content: flex-end;
}
</style>

<body>
<!-- The Modal -->
<div id="Enrolled_Modal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <span class="close_Enrolled">&times;</span>
        <h2>Enrolled Information</h2>
      </div>
      <div class="modal-body">
        <div style="overflow-x:auto;">
      <table>
                <tr>
                    <th>Username</th>
                    <th>TDC</th>
                    <th>DEP</th>
                    <th>PDC-MOTOR</th>
                    <th>PDC-CAR</th>
                    <th>LicenseNumber</th>
                    <th>ExpirationDate</th>
                    <th>Edit</th>
    
                </tr>
                <?php
                try {            
                  $query = "SELECT * FROM u896821908_bts.student_enrolled WHERE username = :studentUsername;";
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':studentUsername', $userdataEnrolled);
                    $stmt->execute();
    
                    // Check if there are any rows in the result
                    if ($stmt->rowCount() > 0) {
                        // Loop through the rows and populate the table
                        while ($row_Enrolled = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . $row_Enrolled['Username'] . '</td>';
                            echo '<td>' . $row_Enrolled['TDC'] . '</td>';
                            echo '<td>' . $row_Enrolled['DEP'] . '</td>';
                            echo '<td>' . $row_Enrolled['PDC-MOTOR'] . '</td>';
                            echo '<td>' . $row_Enrolled['PDC-CAR'] . '</td>';
                            echo '<td>' . $row_Enrolled['LicenseNumber'] . '</td>';
                            echo '<td>' . $row_Enrolled['ExpirationDate'] . '</td>';
                            echo '<td><span class="fa fa-pencil edit_Enrolled-icon" data-id="' . $row_Enrolled['Username'] . '"></span></td>';
                            echo '</tr>';
                        }
                    }        
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>
            </table>
            </div>
      </div>
      <div class="modal-footer">
        <h3>&nbsp;</h3>
        <button class="TDC_CERT" id="generateButtonTDC">GENERATE TDC CERT</button>
        <button class = "PDC_CERT" id="generateButtonPDC">GENERATE PDC CERT</button>
                <br>
      </div>
    </div>
    </div>
    
    <div id="Modal_edit_Enrolled" class="modal-Enrolled">
    
      <!-- Modal content -->
      <div class="modal-content-Enrolled">
        <div class="modal-header-Enrolled">
          <span class="close-Enrolled">&times;</span>
          <h2>Edit Enrolled</h2>
        </div>
        <div class="modal-body-Enrolled">
          <div style="overflow-x:auto;">
          <form action = '#' method="post" id="Enrolled-form">
        <table class = "table_Enrolled_edit">
                    <th>Username</th>
                    <th>TDC</th>
                    <th>DEP</th>
                    <th>PDC-MOTOR</th>
                    <th>PDC-CAR</th>
                    <th>LicenseNumber</th>
                    <th>ExpirationDate</th>
                    <?php
      try {
        $query = "SELECT * FROM u896821908_bts.student_enrolled WHERE username = :studentUsername;";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':studentUsername', $userdataEnrolled);
        $stmt->execute();
    
        // Check if there are any rows in the result
        if ($stmt->rowCount() > 0) {
          // Loop through the rows and populate the table
          while ($row_Enrolled = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row_Enrolled['Username'] . '</td>';
            //TDC
            echo '<td>';
            echo '<select class="TDC-status" name="TDC-status" data-id="' . $row_Enrolled['Username'] . '">'; // Added the closing bracket here
            echo '<option value="Enrolling"' . ($row_Enrolled['TDC'] === 'Enrolling' ? ' selected' : '') . '>Enrolling</option>';
            echo '<option value=""' . (empty($row_Enrolled['TDC']) ? ' selected' : '') . '>Not Enrolled</option>';
            echo '</select>';
            echo '</td>';

            //DEP
            echo '<td>';
            echo '<select class="DEP-status" name="DEP-status" data-id="' . $row_Enrolled['Username'] . '">'; // Added the closing bracket here
            echo '<option value="Enrolling"' . ($row_Enrolled['TDC'] === 'Enrolling' ? ' selected' : '') . '>Enrolling</option>';
            echo '<option value=""' . (empty($row_Enrolled['TDC']) ? ' selected' : '') . '>Not Enrolled</option>';
            echo '</select>';
            echo '</td>';    
            

            //PDC-MOTOR
            echo '<td>';
            echo '<select class="PDC-MOTOR-status" name="PDC-MOTOR-status" data-id="' . $row_Enrolled['Username'] . '">';
            echo '<option value="Motorcycle(Automatic)"' . ($row_Enrolled['PDC-MOTOR'] === 'Motorcycle(Automatic)' ? ' selected' : '') . '>Motorcycle(Automatic)</option>';
            echo '<option value="Motorcycle(Manual)"' . ($row_Enrolled['PDC-MOTOR'] === 'Motorcycle(Manual)' ? ' selected' : '') . '>Motorcycle(Manual)</option>';
            echo '</select>';
            echo '</td>';

            //PDC-CAR
            echo '<td>';
            echo '<select class="PDC-CAR-status" name="PDC-CAR-status" data-id="' . $row_Enrolled['Username'] . '">';
            echo '<option value="CAR(Automatic)"' . ($row_Enrolled['PDC-CAR'] === 'CAR(Automatic)' ? ' selected' : '') . '>CAR(Automatic)</option>';
            echo '<option value="CAR(Manual)"' . ($row_Enrolled['PDC-CAR'] === 'CAR(Manual)' ? ' selected' : '') . '>CAR(Manual)</option>';
            echo '</select>';
            echo '</td>';


            echo '<td><input type = "text" class="License_number_editable" name="License_number" data-field="Enrolled_type"  value="' . $row_Enrolled['LicenseNumber'] . '"></td>';
            echo '<td><input type = "text" class="Expiration_number_editable" name="Expiration_number" data-field="week" value="' . $row_Enrolled['ExpirationDate'] . '"></td>';

            echo '</tr>';
          }
        }
      } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
      ?>
    </table>
    </div>
    </div>
    
        <div class="modal-footer-Enrolled">
          <div class = "align-buttons">
          <input type="reset" value="Cancel" class="footer-cancel" name="Cancel_Enrolled_form" id="Cancel_Enrolled_form">
        <input type="Submit" value = "Submit" name = "Edit_Enrolled_form" class="footer-submit">   
        </form>
        </div>
      </div>
      </div>
    
    </div>
    
    <script>
   function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }
//GENERATE TDC CERT
        // Function to handle button click
        function generateCertificateTDC() {
            var userEnrolled = getUrlParameter('UserEnrolled');

            if (userEnrolled) {
                // Redirect to the printable_CERT_TDC.php page with the UserEnrolled parameter
              window.open('../Pdf/printable_CERT_TDC.php?UserEnrolled=' + userEnrolled, '_blank');

            } else {
                // Handle the case when UserEnrolled parameter is not provided
                alert('UserEnrolled parameter is missing from the URL.');
            }
        }

        // Attach click event to the button
        document.getElementById('generateButtonTDC').addEventListener('click', generateCertificateTDC);
   //GENERATE TDC CERT

   //GENERATE PDC CERT
   function generateCertificatePDC() {
            var userEnrolled = getUrlParameter('UserEnrolled');

            if (userEnrolled) {
                // Open the printable_CERT_PDC.php page in a new tab with the UserEnrolled parameter
                window.open('../Pdf/printable_CERT_PDC.php?UserEnrolled=' + userEnrolled, '_blank');
            } else {
                // Handle the case when UserEnrolled parameter is not provided
                alert('UserEnrolled parameter is missing from the URL.');
            }
        }

        // Attach click event to the PDC certificate button
        document.getElementById('generateButtonPDC').addEventListener('click', generateCertificatePDC);
    //GENERATE PDC CERT


    var modal_Enrolled = document.getElementById("Enrolled_Modal");
    var Enrolled_span = document.getElementsByClassName("close_Enrolled")[0];
    
    var userdataeditEnrolled = "<?php echo isset($_GET['UserEnrolled-data']) && !empty($_GET['UserEnrolled-data']) ? $_GET['UserEnrolled-data'] : ''; ?>";
    
     // Get all the elements with class "edit-icon"
    var edit_Enrolled = document.getElementsByClassName('edit_Enrolled-icon');
    
    // Loop through the edit icons and attach a click event listener to each
    for (var i = 0; i < edit_Enrolled.length; i++) {
      edit_Enrolled[i].addEventListener('click', function () {
            // Get the data-id attribute, which contains the Username
            var Enrolled = this.getAttribute('data-id');
            // Call the function to handle the edit click event and pass the Username
            handleEdit_STDEnrolledClick(Enrolled);
        });
    }
    
    function handleEdit_STDEnrolledClick(Enrolled) {
            var currentURL = new URL(window.location.href);
            currentURL.searchParams.set('UserEnrolled-data', Enrolled);
            window.location.href = currentURL.href;
        }
    
    // Get the modal
    var modal_edit_Enrolled = document.getElementById("Modal_edit_Enrolled");
    
    var span_edit_Enrolled = document.getElementsByClassName("close-Enrolled")[0];    
    
    // When the user clicks on <span> (x), close the modal
    span_edit_Enrolled.onclick = function() {
      modal_edit_Enrolled.style.display = "none";
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.delete('UserEnrolled-data');
        window.history.replaceState({}, document.title, currentURL.href);
    }
    
    document.addEventListener("DOMContentLoaded", function () {
        var cancelButton = document.getElementById("Cancel_Enrolled_form");

        cancelButton.addEventListener("click", function () {
            modal_edit_Enrolled.style.display = "none";
            var currentURL = new URL(window.location.href);
            currentURL.searchParams.delete('UserEnrolled-data');
            window.history.replaceState({}, document.title, currentURL.href);
        });
    });


    if (userdataeditEnrolled) {
      modal_edit_Enrolled.style.display = "block";
        }
    
    window.onclick = function(event) {
      if (event.target == modal_edit_Enrolled) {
        modal_edit_Enrolled.style.display = "none";
        console.log("test");
      }
    }
    </script>
</html>