  $(document).ready(function () {
    // Handle form submission
    $("#SignUp_StudentTDC_Payment").submit(function (event) {
      event.preventDefault();
      if (true) {
        var formData = new FormData(this);
      

        // Disable the submit button and show loading text
        var submitButton = $('.Submit');
        submitButton.prop('disabled', true);
        submitButton.html('<span class="loading-spinner"></span>Loading...');
    
        if (true) {
          // Show checkmarks for each requirement
          $('#letter').addClass('valid');
          $('#capital').addClass('valid');
          $('#number').addClass('valid');
          $('#length').addClass('valid');
        
          // Call additional functions when all requirements are satisfied
          submitForm();
          clearInputFields();

          $('#emailInput').removeClass('input-error');
          $('.username').removeClass('input-error');
        
        } else {
          // Remove checkmarks for each requirement
          $('#letter').removeClass('valid');
          $('#capital').removeClass('valid');
          $('#number').removeClass('valid');
          $('#length').removeClass('valid');
        
          return false; 
        }
      } else {
        $('#letter').removeClass('valid');
        $('#capital').removeClass('valid');
        $('#number').removeClass('valid');
        $('#length').removeClass('valid');
        
        return false; 
      }
    });
    
    
    
    
    function submitForm() {
      var formData = new FormData($("#SignUp_StudentTDC_Payment")[0]);

      var selectedOption = $("#available-schedule").val(); // Get the selected option

      if (selectedOption) {
        var parts = selectedOption.split(" | ");
        
        if (parts.length === 2) {
            var selectedSchedule1 = parts[0].split(" -- ")[0];
            var selectedTime1 = parts[1].split(" -- ")[0];
            
            var selectedSchedule2 = parts[0].split(" -- ")[1];
            var selectedTime2 = parts[1].split(" -- ")[1];
        
            console.log("selectedSchedule1"+" " +selectedSchedule1 +" "+"selectedTime1"+" " + selectedTime1);
            console.log("selectedSchedule2"+" " +selectedSchedule2 +" "+"selectedTime2"+" " + selectedTime2);


            // Append the four values to formData
            formData.append("schedule1", selectedSchedule1);
            formData.append("time1", selectedTime1);
            formData.append("schedule2", selectedSchedule2);
            formData.append("time2", selectedTime2);
        }
    }
      
      $.ajax({
        url: "script_login_TDC.php",
        type: "POST",
        data: formData, // Use the original formData object
        contentType: false,
        processData: false,
        success: function (response) {
          console.log(response);

          if(response.includes("OnPersonCash")){
            var locationhref = './WelcomePage(Pending).php';
          }
          else if(response.includes("GCASH")){
            var locationhref = './OnlinePayment.php';
          }

          if (response.includes("Success")) {
            setTimeout(function() {
              window.location.href = locationhref; 
            }, 100);
            alert("Submitted");
            
          }else if (response.includes("No slot left.")) {
            alert("No Slot left for:" + selectedOption);
            window.location.reload();
          } 
          else {
            // Handle other responses or errors
            // console.error("Unexpected response: " + response);
            // console.log(response);

          }
        },
        error: function (xhr, status, error) {
          console.error(error);
          // Handle form submission error
        }
      });
    }
    
    function clearInputFields() {
      var inputFields = $("#SignUp_StudentTDC").find("input");
      inputFields.val("");
    }

    // Check if passwords match on input change
    $('#confirmPassword').on('input', function () {
      var password = $('#password').val();
      var confirmPassword = $(this).val();

      if (password !== confirmPassword) {
        $(this).get(0).setCustomValidity("Passwords do not match");
      } else {
        $(this).get(0).setCustomValidity("");
      }
    });

   
    var emailInput = $('#emailInput');

    emailInput.on('input', function () {
      var email = emailInput.val();
      var emailRegex = /^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/;

      if (emailRegex.test(email)) {
        emailInput[0].setCustomValidity('');
      } else {
        emailInput[0].setCustomValidity('Please enter a valid email address.');
      }
    });

   
  });