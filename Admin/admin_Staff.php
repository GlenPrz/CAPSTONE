<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
include "../conn.php";
include "./php_scripts/admin_Staffiles/AdminStaff_EDIT_ENROLL.php";
include "./php_scripts/admin_Staffiles/AdminStaff_DEL.php";
include "./php_scripts/admin_Staffiles/Admin_Edit/AdminEditing.php";

$roleStaff = $_SESSION['role'];
$none='none';
if ($roleStaff === "Sup_Admin") {
          //Dito ichecheck if teller or admin. pag teller then magiging none ang value nung $none
          $none=' ';
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="textbox.css">
    <link href="admin_styles/admin_nav.css" rel="stylesheet">
    <link href="./admin_styles/admin_Staff.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
 
</head>

<style>
 .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<body>
    <div class="Container_nav">
        <div class="nav_admin">
            <nav>
                <center>
                    <div class="logo_container">
                        <img src="../img/bts_logo.png" class="admin_logo">
                    </div>
                    <div class="nav_links">
                        <a href="admin_dash.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        <a href="admin_sched.php"><i class="far fa-calendar"></i> Schedule</a>
                        <a href="admin_enroll.php"><i class="fas fa-user-plus"></i> Enrollment</a>
                        <a href="admin_Pupdate.php"><i class="fas fa-bullhorn"></i> Post Updates</a>
                        <a href="admin_reports.php"><i class="fas fa-chart-bar"></i> Reports</a>
                        <a href="admin_Staff.php"><i class="fas fa-users"></i> Staff</a>
                        <a href="admin_Assign.php"><i class="fas fa-tasks"></i> Assign</a>
                        <a href="admin_view_feedback.php"><i class="fas fa-comment"></i> View Feedback</a>
                        <a href="admin_module_exam.php"><i class="fas fa-book"></i> Module/Exam</a>
                        <a href="" id="logoutLink"><i class="fas fa-sign-out-alt"></i> Log Out</a>

                    </div>
                </center>
            </nav>

        </div>
        <div>
        <div class="main_content">
            <div class="container">
                  <header>
                    <h2>Driver Instructors</h2>
                </header>
        
                <div class="add_row">
                    
                <button class ="Add_Staff" id='btn_sign'>+</button>
                <h3 class="addnew" style="margin-top: 1%; color: green;">Add New Driver Instructor</h3>
                </div>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email Address</th>
                        <th>Contact Number</th>
                        <th colspan="4" style="text-align:center;">Action</th>
        
                    </tr>
                    <?php
                    try {
                        // Get the selected limit from the dropdown or set it to 5 as default
                        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
                        // Get the current page number from the URL parameters or use 1 as the default
                        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        
                        // Calculate the offset for pagination
                        $offset = ($page - 1) * $limit;
        
                        // Prepare and execute the SQL query with LIMIT and OFFSET
                        $query = "SELECT * FROM u896821908_bts.di";
                        $stmt = $conn->prepare($query);
                       
                        $stmt->execute();
        
                        // Check if there are any rows in the result
                        if ($stmt->rowCount() > 0) {
                            // Loop through the rows and populate the table
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td>' . $row['id_DI'] . '</td>';
                                echo '<td>' . $row['Username'] . '</td>';
                                echo '<td>' . $row['Lastname'] . ', ' . $row['Firstname'] . '</td>';
                                echo '<td>' . $row['Email'] . '</td>';
                                echo '<td>' . $row['ContactNumber'] . '</td>';
                                echo '<td><span class="fa fa-pencil edit-icon pen-icon" style="display:'.$none.';" data-id="' . $row['Username'] . '"></span></td>';
                                echo '<td><span class="fa fa-trash del-icon trash-icon" style="display:'.$none.';" data-id="' . $row['id_DI'] . '"></span></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="4">No data found.</td></tr>';
                            // Set page to 1 and limit to 5 when no data found
                            $page = 1;
                            $limit = 5;
                            echo '<script>';
                            echo 'var rowsPerPageSelect = document.getElementById("rowsPerPage");';
                            echo 'rowsPerPageSelect.selectedIndex = 0;'; // Select the first option (5 rows)
                            echo 'var currentURL = new URL(window.location.href);';
                            echo 'currentURL.searchParams.set("page", 1);'; // Set page to 1
                            echo 'currentURL.searchParams.set("limit", 5);'; // Set limit to 5
                            echo '</script>';
                        }
                    
                        // Close the database connection
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </table>
        
            </div>
            <div class="container">
                  <header>
                    <h2>Admin & Teller</h2>
                </header>
        
                <div class="add_row">
                    
                <button class ="Add_Staff" id='btn_addAdmin'>+</button>
                <h3 class="addnew" style="margin-top: 1%; color: green;">Add Admin/Teller</h3>
                </div>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email Address</th>
                        <th>Contact Number</th>
                        <th>Role</th>
                        <th colspan="4" style="text-align:center;">Action</th>
        
                    </tr>
                    <?php
                    try {
                        // Get the selected limit from the dropdown or set it to 5 as default
                        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
                        // Get the current page number from the URL parameters or use 1 as the default
                        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        
                        // Calculate the offset for pagination
                        $offset = ($page - 1) * $limit;
        
                        // Prepare and execute the SQL query with LIMIT and OFFSET
                        $query = "SELECT * FROM u896821908_bts.admin
                                    WHERE Role = 'Admin' OR Role = 'Teller'
                                    ORDER BY CASE WHEN Role = 'Admin' THEN 0 ELSE 1 END, Role DESC;";
                        $stmt = $conn->prepare($query);
                       
                        $stmt->execute();
        
                        // Check if there are any rows in the result
                        if ($stmt->rowCount() > 0) {
                            // Loop through the rows and populate the table
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td>' . $row['idadmin'] . '</td>';
                                echo '<td>' . $row['Username'] . '</td>';
                                echo '<td>' . $row['Lastname'] . ', ' . $row['Firstname'] . '</td>';
                                echo '<td>' . $row['EmailAddress'] . '</td>';
                                echo '<td>' . $row['Contactnumber'] . '</td>';
                                echo '<td>' . $row['Role'] . '</td>';
        
                                echo '<td><span class="fa fa-pencil editAdmin-icon pen-icon" style="display:' . $none . ';" data-id="' . $row['idadmin'] . '"></span></td>';
                                echo '<td><span class="fa fa-trash delAdmin-icon trash-icon" style="display:'.$none.';" onclick="confirmDelete(' . $row['idadmin'] . ')"></span></td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="4">No data found.</td></tr>';
                            // Set page to 1 and limit to 5 when no data found
                            $page = 1;
                            $limit = 5;
                            echo '<script>';
                            echo 'var rowsPerPageSelect = document.getElementById("rowsPerPage");';
                            echo 'rowsPerPageSelect.selectedIndex = 0;'; // Select the first option (5 rows)
                            echo 'var currentURL = new URL(window.location.href);';
                            echo 'currentURL.searchParams.set("page", 1);'; // Set page to 1
                            echo 'currentURL.searchParams.set("limit", 5);'; // Set limit to 5
                            echo '</script>';
                        }
                    
                        // Close the database connection
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </table>
        
                </div>
    </div>
    
   
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src = "./php_scripts/admin_Staffiles/script_login_staff.js"></script>
    <script>
        
     

     function data_added() {
                // Your JavaScript function logic here
                alert("Data of the staff has been saved");
    
    		// Reset the URL to the original state (without "success") after 2 seconds
                setTimeout(function() {
                    history.replaceState({}, document.title, window.location.pathname);
                }, 1);
            }
     function data_deleted() {
            // Your JavaScript function logic here
            alert("Staff Record Deleted");

		// Reset the URL to the original state (without "success") after 2 seconds
            setTimeout(function() {
                history.replaceState({}, document.title, window.location.pathname);
            }, 1);
        }
        
     if(window.location.href.indexOf("Added") !== -1) {
                data_added();
     } else if(window.location.href.indexOf("deleted") !== -1) {
                data_deleted();
     } 
    // Function to handle the click event on the edit icon

    function handleEditClick(username) {
        // Redirect to Admin_EDIT_ENROLL.php with the Username data in the URL
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.set('Username', username);
        window.location.href = currentURL.href;
    }
    
    function handleEditAdminClick(Admin_username) {
        // Redirect to Admin_EDIT_ENROLL.php with the Username data in the URL
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.set('Admin', Admin_username);
        window.location.href = currentURL.href;
    }
    
    function handleDelClick(del_username) {
        // Redirect to Admin_EDIT_ENROLL.php with the Username data in the URL
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.set('DelUsername', del_username);
        window.location.href = currentURL.href;
    }

    

    // Function to change the rows per page
    function changeRowsPerPage() {
        var rowsPerPageSelect = document.getElementById('rowsPerPage');
        var selectedLimit = rowsPerPageSelect.options[rowsPerPageSelect.selectedIndex].value;
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.set('limit', selectedLimit);
        window.location.href = currentURL.href;
    }

 // Get all the elements with class "editAdmin-icon"
    var editAdminIcons = document.getElementsByClassName('editAdmin-icon');

    // Loop through the edit icons and attach a click event listener to each
    for (var i = 0; i < editAdminIcons.length; i++) {
        editAdminIcons[i].addEventListener('click', function () {
            // Get the data-id attribute, which contains the Username
            var Admin_username = this.getAttribute('data-id');
            // Call the function to handle the edit click event and pass the Username
            handleEditAdminClick(Admin_username);
        });
    }




    // Get all the elements with class "edit-icon"
    var editIcons = document.getElementsByClassName('edit-icon');

    // Loop through the edit icons and attach a click event listener to each
    for (var i = 0; i < editIcons.length; i++) {
        editIcons[i].addEventListener('click', function () {
            // Get the data-id attribute, which contains the Username
            var username = this.getAttribute('data-id');
            // Call the function to handle the edit click event and pass the Username
            handleEditClick(username);
        });
    }
        // Get all the elements with class "del-icon"

    var delIcons = document.getElementsByClassName('del-icon');

    for (var i = 0; i < delIcons.length; i++) {
        delIcons[i].addEventListener('click', function () {
            // Get the data-id attribute, which contains the Username
            var del_username = this.getAttribute('data-id');
            // Call the function to handle the edit click event and pass the Username
            handleDelClick(del_username);
        });
    }

    var PaymentIcons = document.getElementsByClassName('payment-icon');

    for (var i = 0; i < PaymentIcons.length; i++) {
        PaymentIcons[i].addEventListener('click', function () {
            // Get the data-id attribute, which contains the Username
            var Pusername = this.getAttribute('data-id');
            // Call the function to handle the edit click event and pass the Username
            handlePaymentClick(Pusername);
        });
    }

    var EducIcons = document.getElementsByClassName('education-icon');

    for (var i = 0; i < EducIcons.length; i++) {
        EducIcons[i].addEventListener('click', function () {
            // Get the data-id attribute, which contains the Username
            var Enrolled = this.getAttribute('data-id');
            // Call the function to handle the edit click event and pass the Username
            handleEdit_EnrolledClick(Enrolled);
        });
    }

    
    // Check if the 'Username' exists and is not empty
    var userdataret = "<?php echo isset($_GET['Username']) && !empty($_GET['Username']) ? $_GET['Username'] : ''; ?>";
    var userdatadel = "<?php echo isset($_GET['DelUsername']) && !empty($_GET['DelUsername']) ? $_GET['DelUsername'] : ''; ?>";
    //ADMIN
    var userdataAdmin = "<?php echo isset($_GET['Admin']) && !empty($_GET['Admin']) ? $_GET['Admin'] : ''; ?>";

    var modal_AdminEditProf = document.getElementById("AdminEditProf");
    var span_AdminEditProf = document.getElementsByClassName("Adminclose_SignUp")[0];

    // Get the Edit modal element by ID
    var modal_EditProf = document.getElementById("EditProf");
    var span_EditProf = document.getElementsByClassName("close_SignUp")[0];

    // Get the Delete modal element by ID
    var modal_Del = document.getElementById('modal_Del_Del');
    var span_del = document.getElementsByClassName('close_del')[0];

    // Set modal display to "block" if userdataret has a value
    if (userdataret) {
        modal_EditProf.style.display = "block";
    }
      if (userdataAdmin) {
        modal_AdminEditProf.style.display = "block";
    }
    if (userdatadel) {
        modal_Del.style.display = "block";
    }
   
    // Handle the close button click event to hide the modal
     span_AdminEditProf.onclick = function () {
        modal_AdminEditProf.style.display = "none";
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.delete('Admin');
        window.history.replaceState({}, document.title, currentURL.href);
    };
    
    
    
    span_EditProf.onclick = function () {
        modal_EditProf.style.display = "none";
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.delete('Username');
        window.history.replaceState({}, document.title, currentURL.href);
    };

    span_del.onclick = function() {
        modal_Del.style.display = "none";
        var currentURL = new URL(window.location.href);
        currentURL.searchParams.delete('DelUsername');
        window.history.replaceState({}, document.title, currentURL.href);
    }


    // When the user clicks anywhere outside the modal, close it
    window.onclick = function (event) {
        if (event.target == modal_EditProf) {
            modal_EditProf.style.display = "none";
            var currentURL = new URL(window.location.href);
            currentURL.searchParams.delete('Username');
            window.history.replaceState({}, document.title, currentURL.href);
        }else if (event.target == modal_Del) {
             modal_Del.style.display = "none";
             var currentURL = new URL(window.location.href);
            currentURL.searchParams.delete('DelUsername');
            window.history.replaceState({}, document.title, currentURL.href);
        }
    };

    
</script>
<script>
    // var genderField = document.querySelector('.gender');
    // genderField.setCustomValidity('Choose your gender');

    // // Reset validation message when an option is selected
    // genderField.addEventListener('change', function () {
    //   this.setCustomValidity('');
    // });

    function capitalizeWords(value) {
      value = value.replace(/\s{2,}/g, ' '); // Replace consecutive spaces with a single space

      return value.replace(/\b\w/g, function (match) {
        return match.toUpperCase();
      }).replace(/\b\w+/g, function (match) {
        return match.charAt(0).toUpperCase() + match.slice(1).toLowerCase();
      });
    }

    var passwordInput = document.getElementById("password");
var checkIcons = document.querySelectorAll("#check-icon");
var xIcons = document.querySelectorAll("#x-icon");

// When the user interacts with the password input
passwordInput.addEventListener("focus", function() {
  document.getElementById("message").style.display = "block";
});

passwordInput.addEventListener("blur", function() {
  document.getElementById("message").style.display = "none";
});

passwordInput.addEventListener("keyup", function() {
  var lowercaseRegex = /[a-z]/;
  var uppercaseRegex = /[A-Z]/;
  var numberRegex = /[0-9]/;
  var minLength = 8;

  var lowercaseValid = lowercaseRegex.test(passwordInput.value);
  var uppercaseValid = uppercaseRegex.test(passwordInput.value);
  var numberValid = numberRegex.test(passwordInput.value);
  var lengthValid = passwordInput.value.length >= minLength;

  document.getElementById("letter").classList.toggle("invalid", !lowercaseValid);
  document.getElementById("capital").classList.toggle("invalid", !uppercaseValid);
  document.getElementById("number").classList.toggle("invalid", !numberValid);
  document.getElementById("length").classList.toggle("invalid", !lengthValid);

  for (var i = 0; i < checkIcons.length; i++) {
    checkIcons[i].style.display = "none";
  }
  for (var i = 0; i < xIcons.length; i++) {
    xIcons[i].style.display = "inline-block";
  }

  if (lowercaseValid) {
    document.getElementById("letter").querySelector("#check-icon").style.display = "inline-block";
    document.getElementById("letter").querySelector("#x-icon").style.display = "none";
  }
  if (uppercaseValid) {
    document.getElementById("capital").querySelector("#check-icon").style.display = "inline-block";
    document.getElementById("capital").querySelector("#x-icon").style.display = "none";
  }
  if (numberValid) {
    document.getElementById("number").querySelector("#check-icon").style.display = "inline-block";
    document.getElementById("number").querySelector("#x-icon").style.display = "none";
  }
  if (lengthValid) {
    document.getElementById("length").querySelector("#check-icon").style.display = "inline-block";
    document.getElementById("length").querySelector("#x-icon").style.display = "none";
  }
});

// Set default image placeholder

  </script>
        
  <script>
var defaultImage = $("<img id='defaultProfileImage'>");
        defaultImage.attr("src", "../uploads/Di_uploads/<?php echo basename($profilePicture); ?>");
        defaultImage.addClass("preview-image");
        defaultImage.css("max-width", "150px");
        defaultImage.css("max-height", "150px");
        defaultImage.css("border-radius", "50%");
        defaultImage.css("object-fit", "cover");
        defaultImage.css("border", "2px solid black");
        $("#profilePicturePreview").empty();
        $("#profilePicturePreview").append(defaultImage);


    $("#btn_sign").click(function() {
      // Specify the URL you want to redirect to
      var specificURL = "./admin_addDi.php"; // Replace with your desired URL
      
      // Redirect to the specific URL
      window.location.href = specificURL;
    });
    
    $("#btn_addAdmin").click(function() {
      // Specify the URL you want to redirect to
      var specificURL2 = "./admin_AddTellerAdmin.php"; // Replace with your desired URL
      
      // Redirect to the specific URL
      window.location.href = specificURL2;
    });

        // Function to prevent navigation via the back button
        function disableBackButton() {
            window.history.pushState(null, '', window.location.href);
            window.onpopstate = function(event) {
                window.history.pushState(null, '', window.location.href);
            };
        }

        // Call the function when the page loads
        window.onload = function() {
            disableBackButton();
        };
    </script>
    </div>


    <!-- LOGOUT -->
<script>
$('#logoutLink').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
    
    var userConfirmed = window.confirm("To confirm Logging out, click Ok");
    
    if (userConfirmed) {
        $.ajax({
            url: '../logout.php',
            type: 'POST',
            success: function(response) {
                // Redirect to login.php on successful logout
                window.location.href = '../login.php';
            },
            error: function(xhr, status, error) {
                console.error(error); // Log any errors to the console
            }
        });
    }
    // If the user clicks "No" or cancels, do nothing
});
function confirmDelete(userId) {
          var confirmation = confirm("Are you sure you want to delete this user?");
        
          if (confirmation) {
            // User clicked OK, perform the deletion or redirect to a delete script
            window.location.href = "./php_scripts/delete_AdStaff.php?userId=" + userId;
          }
    }
</script>
</body>

</html>