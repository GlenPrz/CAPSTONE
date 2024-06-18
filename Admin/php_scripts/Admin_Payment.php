<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@500&display=swap" rel="stylesheet">
    <?php
      include "../conn.php";

      $userdataPayment = $_GET['PUsername'] ?? '';
      $userdataPaymentID = $_GET['UserPayment-data'] ?? '';

      if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["Edit_payment_form"]) && !empty($_POST["Edit_payment_form"])) {
            // Loop through the submitted form data to update the database
            $paymentType = $_POST["payment_type"];
            $week = $_POST['payment-week'];
            $date = $_POST['payment-date'];
            $payment = $_POST['payment-payment'];
            $totalPaid = $_POST['payment-Total_paid'];
            $paymentStatus = $_POST['payment-status'];
            try {
                $query = "UPDATE u896821908_bts.student_payment 
                SET
                    u896821908_bts.student_payment.payment_type = :paymentType, 
                    u896821908_bts.student_payment.week = :week, 
                    u896821908_bts.student_payment.date = :date, 
                    u896821908_bts.student_payment.payment = :payment, 
                    u896821908_bts.student_payment.Total_paid = :totalPaid, 
                    u896821908_bts.student_payment.payment_status = :paymentStatus
                WHERE u896821908_bts.student_payment.idstudent_payment = :paymentId";
                
                $stmt = $conn->prepare($query);
    
                // Bind the variables to the placeholders
                $stmt->bindParam(':paymentType', $paymentType);
                $stmt->bindParam(':week', $week);
                $stmt->bindParam(':date', $date);
                $stmt->bindParam(':payment', $payment);
                $stmt->bindParam(':totalPaid', $totalPaid);
                $stmt->bindParam(':paymentStatus', $paymentStatus);
              

                // Assuming 'username' is the primary key or unique identifier for the row you want to update
                $paymentId = $userdataPaymentID;
                $stmt->bindParam(':paymentId', $paymentId);
    
                $stmt->execute();
                $isUserPUpdate = true;
            if ($isUserPUpdate) {
                echo "<script>
                    var currentURL = new URL(window.location.href);
                    currentURL.searchParams.delete('UserPayment-data');
                    window.history.replaceState({}, document.title, currentURL.href);
                    window.location.reload();
                    </script>";
            }
              } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
    
?>
      
      
     
</head>
<style>
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
  background-color: #fefefe;
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
.close_payment {
  color: black;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close_payment:hover,
.close_payment:focus {
  color: red;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

/*Modal 2 for edit payment*/
.modal-payment {
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
.modal-content-payment {
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
.close-payment {
  color: white;
  float: right;
  font-size: 30px;
  font-weight: bold;
}

.close-payment:hover,
.close-payment:focus {
  color: red;
  text-decoration: none;
  cursor: pointer;
}

.modal-header-payment {
  padding:5px 30px;
  background-color: #5cb85c;
  color: white;
}

.modal-body-payment {padding: 2px 16px;}

.modal-footer-payment {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
.table_payment_edit{
  margin:20px 0px 20px 0px;
}

.table_payment_edit th{
  width:1%;
  padding:20px;
  text-align: center;
}
.table_payment_edit td{
  padding:0;
  width:10%;
  text-align: center;
}
.table_payment_edit .editable_payment-date{
  font-size: 20px;
  padding:10px;
}
.table_payment_edit .Enroll-payment-status,.role-status,.payment-status{
font-size: 20px;
padding:10px;
}
.table_payment_edit .payment_type_editable,.editable_payment-payment,.editable_payment-Total_paid{
font-size: 20px;
width: 80%;
margin:10px;
padding:10px;
}
.modal-footer-payment .footer-cancel{
  padding:10px;
  border-radius: 5px;
  margin:20px;
  background-color:#ff0000;
  color:black;
  font-weight: 100px;
  font-size:20px;
  font-family: 'Roboto Mono', monospace;
}
.modal-footer-payment .footer-submit{
  padding:10px;
  border-radius: 5px;
  margin:20px 20px 20px -2px;
  background-color:green;
  color:black;
  font-weight: 100px;
  font-size:20px;
  font-family: 'Roboto Mono', monospace;
}
.modal-footer-payment .align-buttons{
  display: flex;
  justify-content: flex-end;
}
</style>

<body>
    
<!-- The Modal -->
<div id="Payment_Modal" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <div class="modal-header">
    <span class="close_payment">&times;</span>
    <h2>Payment Information</h2>
  </div>
  <div class="modal-body">
    <div style="overflow-x:auto;">
  <table>
            <tr>
                <th>Username</th>
                <th>payment_type</th>
                <th>week</th>
                <th>date</th>
                <th>payment</th>
                <th>Total</th>
                <th>payment_status</th>

            </tr>
            <?php
try {
    $paymentId = $userdataPayment; // Replace with the actual value

    $query2 = "
        SELECT
            student.Username,
            student_payment.idstudent_payment,
            student_payment.payment_type,
            student_payment.week,
            student_payment.date,
            student_payment.payment,
            student_payment.Total_paid,
            student_payment.payment_status
        FROM u896821908_bts.student_payment
        INNER JOIN u896821908_bts.student ON student_payment.username = student.Username
        WHERE student_payment.username = :studentUsername;
    ";

    $stmt2 = $conn->prepare($query2);
    $stmt2->execute([':studentUsername' => $paymentId]);

    if ($stmt2->rowCount() > 0) {
        while ($row_payment1 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row_payment1['Username'] . '</td>';
            echo '<td>' . $row_payment1['payment_type'] . '</td>';
            echo '<td>' . $row_payment1['week'] . '</td>';
            echo '<td>' . $row_payment1['date'] . '</td>';
            echo '<td>' . $row_payment1['payment'] . '</td>';
            echo '<td>' . $row_payment1['Total_paid'] . '</td>';
            echo '<td>' . $row_payment1['payment_status'] . '</td>';
            echo '<td><span class="fa fa-pencil edit_payment-icon" data-id="' . $row_payment1['idstudent_payment'] . '"></span></td>';
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
  </div>
</div>
</div>

<div id="Modal-edit-payment" class="modal-payment">

  <!-- Modal content -->
  <div class="modal-content-payment">
    <div class="modal-header-payment">
      <span class="close-payment">&times;</span>
      <h2>Edit Payment</h2>
    </div>
    <div class="modal-body-payment">
      <div style="overflow-x:auto;">
      <form action = '#' method="post" id="payment-form">
    <table class = "table_payment_edit">
                <th>Username</th>
                <th>payment_type</th>
                <th>week</th>
                <th>date</th>
                <th>payment</th>
                <th>Total</th>
                <th>payment_status</th>

                <?php
  try {
    $query = "SELECT
    idstudent_payment, username, payment_type, week, date, payment, Total_paid, payment_status
    FROM
    u896821908_bts.student_payment
    WHERE
    u896821908_bts.student_payment.idstudent_payment = :studentUsername;";
    
$stmt = $conn->prepare($query);
 $stmt->bindParam(':studentUsername', $userdataPaymentID);
$stmt->execute();


    // Check if there are any rows in the result
    if ($stmt->rowCount() > 0) {
      // Loop through the rows and populate the table
      while ($row_payment = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';

        echo '<td>' . $row_payment['username'] . '</td>';
        echo '<td><input type = "text" class="payment_type_editable" name="payment_type" data-field="payment_type" data-id="' . $row_payment['username'] . '" value="' . $row_payment['payment_type'] . '"></td>';
        echo '<td><input type = "text" class="editable" name="payment-week" data-field="week" data-id="' . $row_payment['username'] . '" value="' . $row_payment['week'] . '"></td>';
        echo '<td><input type = "date" class="editable_payment-date" name="payment-date" data-field="date" data-id="' . $row_payment['username'] . '" value="' . $row_payment['date'] . '"></td>';
        $paymentValue = ($row_payment['payment'] !== null && $row_payment['payment'] !== '') ? $row_payment['payment'] : 0;
        echo '<td><input type="number" class="editable_payment-payment" name="payment-payment" data-field="payment" data-id="' . $row_payment['username'] . '" value="' . $paymentValue . '"></td>';     
        $totalPaidValue = ($row_payment['Total_paid'] !== null && $row_payment['Total_paid'] !== '') ? $row_payment['Total_paid'] : 0;
        echo '<td><input type="number"  class="editable_payment-Total_paid" name="payment-Total_paid" data-field="Total_paid" data-id="' . $row_payment['username'] . '" value="' . $totalPaidValue . '"></td>';

        echo '<td>';
        echo '<select class="payment-status" name="payment-status" data-id="' . $row_payment['username'] . '">'; // Added the closing bracket here
        echo '<option value="Paid"' . ($row_payment['payment_status'] === 'Paid' ? ' selected' : '') . '>Paid</option>';
        echo '<option value="Pending"' . ($row_payment['payment_status'] === 'pending' ? ' selected' : '') . '>Pending</option>';
        echo '</select>';
        echo '</td>';

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

    <div class="modal-footer-payment">
      <div class = "align-buttons">
    <input type="Reset" value = "Cancel" class="footer-cancel">
    <input type="Submit" value = "Submit" name = "Edit_payment_form" class="footer-submit">   
    </form>
    </div>
  </div>
  </div>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><script>
  // $(document).ready(function() {
  //   $("#payment-form").submit(function(event) {
  //     event.preventDefault(); 

  //     var formData = $(this).serialize();

  //     console.log("Form data:", formData);

  //       });
  // });
</script>


<script>
var modal_Payment = document.getElementById("Payment_Modal");
var PaymentModal_btn = document.getElementById("myBtn");
var Payment_span = document.getElementsByClassName("close_payment")[0];

var userdataeditpayment = "<?php echo isset($_GET['UserPayment-data']) && !empty($_GET['UserPayment-data']) ? $_GET['UserPayment-data'] : ''; ?>";

 // Get all the elements with class "edit-icon"
var edit_payment = document.getElementsByClassName('edit_payment-icon');

// Loop through the edit icons and attach a click event listener to each
for (var i = 0; i < edit_payment.length; i++) {
  edit_payment[i].addEventListener('click', function () {
        // Get the data-id attribute, which contains the Username
        var payment = this.getAttribute('data-id');
        // Call the function to handle the edit click event and pass the Username
        handleEdit_paymentClick(payment);
    });
}

function handleEdit_paymentClick(payment) {
        // Redirect to Admin_EDIT_ENROLL.php with the Username data in the URL
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.set('UserPayment-data', payment);
        window.location.href = currentURL.href;
    }

// Get the modal
var modal_edit_payment = document.getElementById("Modal-edit-payment");

// Get the <span> element that closes the modal
var span_edit_payment = document.getElementsByClassName("close-payment")[0];

// When the user clicks the button, open the modal 


// When the user clicks on <span> (x), close the modal
span_edit_payment.onclick = function() {
  modal_edit_payment.style.display = "none";
            var currentURL = new URL(window.location.href);
            currentURL.searchParams.delete('UserPayment-data');
            window.history.replaceState({}, document.title, currentURL.href);
}

if (userdataeditpayment) {
      modal_edit_payment.style.display = "block";
    }

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal_edit_payment) {
    modal_edit_payment.style.display = "none";
  }
}
</script>
</body>
</html>