  $(document).ready(function () {
    // Handle form submission
    var $selects = $('.aviSched');

    // Attach change event listener to all select elements
    $selects.change(function() {
        // Get the selected value of the current select element
        var selectedValue = $(this).val();

        // Check if any other select element has the same selected value
        var $otherSelects = $selects.not(this);
        var isDuplicate = $otherSelects.filter(function() {
            return $(this).val() === selectedValue;
        }).length > 0;

        if (isDuplicate) {
            alert("Selected values are the same!");

            // Clear the selected value in other select elements
            $otherSelects.val('');

        }
    });



    $("#SignUp_StudentPDC").submit(function (event) {
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

          alert("Submitted");
        } 
      } 
    });




    function submitForm() {
      var formData = new FormData($("#SignUp_StudentPDC")[0]);

      function processSelectedOption(selectedOption, formData, scheduleName) {
        if (selectedOption) {
            var parts = selectedOption.split(" | ");
            
            if (parts.length === 2) {
                var selectedSchedule1 = parts[0].split(" -- ")[0];
                var selectedTime1 = parts[1].split(" -- ")[0];

                var selectedSchedule2 = parts[0].split(" -- ")[1];
                var selectedTime2 = parts[1].split(" -- ")[1];
        
                console.log("selectedSchedule1"+" " +selectedSchedule1 +" "+"selectedTime1"+" " + selectedTime1);
                console.log("selectedSchedule2"+" " +selectedSchedule2 +" "+"selectedTime2"+" " + selectedTime2);
    

                // Append the four values to formData with scheduleName prefix
                formData.append(`${scheduleName}_schedule1`, selectedSchedule1);
                formData.append(`${scheduleName}_time1`, selectedTime1);
                formData.append(`${scheduleName}_schedule2`, selectedSchedule2);
                formData.append(`${scheduleName}_time2`, selectedTime2);
            }
        }
    }
    
  // Process selectedOption_sched_motor_manual
var selectedOption_sched_motor_manual = $("#available-schedule-pdc1").val();
if (selectedOption_sched_motor_manual) {
    processSelectedOption(selectedOption_sched_motor_manual, formData, "motor_manual");
}

// Process selectedOption_sched_motor_automatic
var selectedOption_sched_motor_automatic = $("#available-schedule_pdc2").val();
if (selectedOption_sched_motor_automatic) {
    processSelectedOption(selectedOption_sched_motor_automatic, formData, "motor_automatic");
}

// Process selectedOption_sched_car_manual
var selectedOption_sched_car_manual = $("#available-schedule_pdc3").val();
if (selectedOption_sched_car_manual) {
    processSelectedOption(selectedOption_sched_car_manual, formData, "car_manual");
}

// Process selectedOption_sched_car_automatic
var selectedOption_sched_car_automatic = $("#available-schedule_pdc4").val();
if (selectedOption_sched_car_automatic) {
    processSelectedOption(selectedOption_sched_car_automatic, formData, "car_automatic");
}



      $.ajax({
        url: "script_login_PDC.php",
        type: "POST",
        data: formData, // Use the original formData object
        contentType: false,
        processData: false,
        success: function (response) {
          console.log(response);

          if(response.includes("No slot left for Motorcycle_Manual")){
            alert("No slot left for Date of Motorcycle_Manual");
            window.location.reload();
            
          }
          if(response.includes("No slot left for Car_Manual")){
            alert("No slot left for Date of Car_Manual");
            window.location.reload();
            
          }
          if(response.includes("No slot left for Car_Automatic")){
            alert("No slot left for Date of Car_Automatic");
            window.location.reload();
            
          }
          if(response.includes("No slot left for Motorcycle_Automatic")){
            alert("No slot left for Date of Motorcycle_Automatic");
            window.location.reload();
          }

          if (!response.includes("No slot left")) {
            response += "Success";
            console.log(response);
          }

          if(response.includes("OnPersonCash")){
            var locationhref = './WelcomePage(Pending).php';
          }
          else if(response.includes("GCASH")){
            var locationhref = './OnlinePayment.php';
          }


                if (response.includes("Success")) {
                  setTimeout(function () {
                    window.location.href = locationhref; 
                  }, 1000);
                  console.log("SUCESS TEST");
                } else{
                  // Handle other responses or errors
                  console.error("Unexpected response: " + response);
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