  $(document).ready(function () {
    // Handle form submission
    $("#SignUp_Staff").submit(function (event) {
      event.preventDefault();
    
      var password = $('#passwordStaff').val();
      var confirmPasswordStaff = $('#confirmPasswordStaff').val();
      
      // Validate all input fields
      var inputs = $(this).find('input');
      var isValid = true;
      inputs.each(function () {
        if (!$(this)[0].checkValidity()) {
          isValid = false;
          $(this).addClass('input-error');
        } else {
          $(this).removeClass('input-error');
        }
      });
    
      if (password !== confirmPasswordStaff) {
        alert("Passwords do not match");
        isValid = false;
      }
    
      // Check password requirements
      var lowercaseRegex = /[a-z]/;
      var uppercaseRegex = /[A-Z]/;
      var numberRegex = /[0-9]/;
      var minLength = 8;
    
      var isLowerCaseValid = lowercaseRegex.test(password);
      var isUpperCaseValid = uppercaseRegex.test(password);
      var isNumberValid = numberRegex.test(password);
      var isLengthValid = password.length >= minLength;
    
      if (!isLowerCaseValid || !isUpperCaseValid || !isNumberValid || !isLengthValid) {
        alert("Password does not meet the requirements");
        isValid = false;
      }
    
      if (isValid) {
        var formData = new FormData(this);
    
        // Disable the submit button and show loading text
        var submitButton = $('.Submit');
        submitButton.prop('disabled', true);
        submitButton.html('<span class="loading-spinner"></span>Loading...');
    
        $.ajax({
          url: "./php_scripts/admin_Staffiles/check_existingStaff_Enrolled.php",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            if (response.trim() === "email_conflict") {
              alert("Email already exists");
              $('#emailInput').addClass('input-error');
            } else if (response.trim() === "username_conflict") {
              alert("Username already exists");
              $('.Usernam').addClass('input-error');
            } else if (response.trim() === "success") {
              // Show checkmarks for each requirement
              $('#letter').addClass('valid');
              $('#capital').addClass('valid');
              $('#number').addClass('valid');
              $('#length').addClass('valid');
    
              // Call additional functions when all requirements are satisfied
              submitForm();
              clearInputFields();
              closeModal();
    
              $('#emailInput').removeClass('input-error');
              $('.Usernam').removeClass('input-error');
    
              alert("Submitted");
            } else {
              console.log(response);       
                 }
          },
          error: function (xhr, status, error) {
            console.error(error);
            alert("Error occurred");
          },
          complete: function () {
            // Enable the submit button and restore the original text
            submitButton.prop('disabled', false);
            submitButton.text('SUBMIT');
          }
        });
      } else {
        // Remove checkmarks for each requirement
        $('#letter').removeClass('valid');
        $('#capital').removeClass('valid');
        $('#number').removeClass('valid');
        $('#length').removeClass('valid');
        
        return false; // Prevent form submission
      }
    });
    
    
    
    

    function submitForm() {
      var formData = new FormData($("#SignUp_Staff")[0]);
      $.ajax({
        url: "./php_scripts/admin_Staffiles/script_loginStaff.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          console.log("AJAX success:", response); // Log the success response
          // Handle successful form submission
        },
        error: function (xhr, status, error) {
          console.error("AJAX error:", error); // Log the error message
          // Handle form submission error
        }
      });
    }

    function clearInputFields() {
      var inputFields = $("#SignUp_Student").find("input");
      inputFields.val("");
    }

    // Handle file input change event
    $("#profile_pictureStaff").change(function () {
      var file = this.files[0];
      if (file instanceof Blob) {
        var reader = new FileReader();
        reader.onload = function (e) {
          var imgElement = $("<img>");
          imgElement.attr("src", e.target.result);
          imgElement.addClass("preview-image");
          imgElement.css("max-width", "150px");
          imgElement.css("max-height", "150px");
          imgElement.css("border-radius", "50%");
          imgElement.css("object-fit", "cover");
          imgElement.css("border", "2px solid black"); // Add black border
          $(".imgPrev").empty();
          $(".imgPrev").append(imgElement);
        };
        reader.readAsDataURL(file);
      } else {
        console.error("Invalid file object.");
      }
    });

    

    // Check if passwords match on input change
    $('#confirmPasswordStaff').on('input', function () {
      var password = $('#passwordStaff').val();
      var confirmPasswordStaff = $(this).val();

      if (password !== confirmPasswordStaff) {
        $(this).get(0).setCustomValidity("Passwords do not match");
      } else {
        $(this).get(0).setCustomValidity("");
      }
    });

    var passwordInput = $("#passwordStaff");
    var confirmPasswordStaffInput = $("#confirmPasswordStaff");

    passwordInput.on("input", validatePassword);
    confirmPasswordStaffInput.on("input", validatePassword);

    function validatePassword() {
      var password = passwordInput.val();
      var confirmPasswordStaff = confirmPasswordStaffInput.val();

      var regexPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/;

      if (regexPattern.test(password) && regexPattern.test(confirmPasswordStaff)) {
        console.log("Passwords are valid.");
      } else {
        console.log("Passwords are invalid.");
      }
    }

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

    var modal = $('#myModal');
    var closeSpan = $('.close_SignUp');

    function clearInputFields() {
      var inputFields = modal.find("input");
      inputFields.val("");

      var selectFields = modal.find("select");
      selectFields.prop('selectedIndex', 0);
    }

    function closeModal() {
     
      modal.css('display', 'none');
      clearInputFields();
    }

    // Close the modal when close span is clicked
    closeSpan.on("click", closeModal);

    // Close the modal when clicked outside of it
    $(window).on("click", function (event) {
      if (event.target == modal.get(0)) {
        closeModal();
      }
    });

  });