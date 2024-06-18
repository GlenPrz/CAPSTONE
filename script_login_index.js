  $(document).ready(function () {
    // Handle form submission
    $("#SignUp_Student").submit(function (event) {
       event.preventDefault(); 
    
      var password = $('#password').val();
      var confirmPassword = $('#confirmPassword').val();
      
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
    
      if (password !== confirmPassword) {
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
          url: "check_existing.php",
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
              $('.username').addClass('input-error');
            } else if (response.trim() === "success") {
              // Show checkmarks for each requirement
              $('#letter').addClass('valid');
              $('#capital').addClass('valid');
              $('#number').addClass('valid');
              $('#length').addClass('valid');
        
              console.log("Redirecting...");
              // Redirect to the desired URL after a successful submission
              Email_Verification_form();        
              $('#emailInput').removeClass('input-error');
              $('.username').removeClass('input-error');
        
              alert("Submitted");
               // Reset the form
          $("#SignUp_Student")[0].reset();
            } else {
              console.log("test");
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
    
    function Email_Verification_form() {
      var formData = new FormData($("#SignUp_Student")[0]);

    //   formData.forEach(function(value, key){
    //     console.log(key + ": " + value);
    //   });

      var profilePicture = formData.get('profile_picture');
//   console.log('Profile Picture:', profilePicture);

      $.ajax({
        url: "./EmailVerification/EmailVerification_Data.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          // Handle successful form submission
          // You can handle the PHP response here if needed
        //   console.log(formData);
    
          // Redirect to the new URL
          var redirectUrl = "./EmailVerification/EmailVerification.php";
           window.location.href = redirectUrl;
        },
        error: function (xhr, status, error) {
          console.error(error);
          // Handle form submission error
        }
      });
    }
    
    
    
    
    
    

    function submitForm() {
      var formData = new FormData($("#SignUp_Student")[0]);
      $.ajax({
        url: "script_login.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          // Handle successful form submission
        },
        error: function (xhr, status, error) {
          console.error(error);
          // Handle form submission error
        }
      });
    }

    function clearInputFields() {
      var inputFields = $("#SignUp_Student").find("input");
      inputFields.val("");
    }

    // Handle file input change event
    $("#profile_picture").change(function () {
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

    // Set default image placeholder
    var defaultImage = $('<img id="defaultProfileImage">');
    defaultImage.attr("src", "./img/user_icon.png"); // Replace "default-image.png" with the path to your default image
    defaultImage.addClass("preview-image");
    defaultImage.css("max-width", "150px");
    defaultImage.css("max-height", "150px");
    defaultImage.css("border-radius", "50%");
    defaultImage.css("object-fit", "cover");
    defaultImage.css("border", "2px solid black"); // Add black border
    $(".imgPrev").empty();
    $(".imgPrev").append(defaultImage);

    // Test if file is selected
    $("#profile_picture").change(function () {
      var file = this.files[0];
      if (file) {
        console.log('File selected:', file.name);
      } else {
        console.log('No file selected.');
      }
    });

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

    var passwordInput = $("#password");
    var confirmPasswordInput = $("#confirmPassword");

    passwordInput.on("input", validatePassword);
    confirmPasswordInput.on("input", validatePassword);

    function validatePassword() {
      var password = passwordInput.val();
      var confirmPassword = confirmPasswordInput.val();

      var regexPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/;

      if (regexPattern.test(password) && regexPattern.test(confirmPassword)) {
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
      var defaultImage = $('<img id="defaultProfileImage">');

      defaultImage.attr("src", "./img/user_icon.png");
      defaultImage.css({
        'max-width': '150px',
        'max-height': '150px',
        'border-radius': '50%',
        'object-fit': 'cover',
        'border': '2px solid black'
      });
      $(".imgPrev").empty().append(defaultImage);

   var form = document.getElementById("SignUp_Student");

            // Reset the form
            form.reset();

      clearInputFields();

      modal.css('display', 'none');
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