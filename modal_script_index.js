var modalforgot = document.getElementById("modalforgot");
var btn_forgot = document.getElementById("ForgotPassModal");
var span_forgot = document.getElementsByClassName("close-button_forgot")[0];

var modal_Contact = document.getElementById("modal_cntct");
var btn_Contact = document.getElementById("ContactUs_nav");
var span_Contact = document.getElementsByClassName("close-button")[0];

var modal_Service = document.getElementById("ServiceModal");
var btn_Service = document.getElementById("Service_nav");
var span_Service = document.getElementsByClassName("close_Service")[0];

var modal_Signup = document.getElementById("myModal");
var btn_SignUp = document.getElementById("btn_sign");
var span_SignUp = document.getElementsByClassName("close_SignUp")[0];
var cancel_Signup = document.getElementsByClassName("Cancel")[0] //NOT WORKING



// const input = document.getElementById('birthdate');
// const today = new Date();
// const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate())
//     .toISOString()
//     .split('T')[0];

// input.setAttribute('max', maxDate);
 // Use querySelector here

if (btn_SignUp) {
    btn_SignUp.onclick = function () {
        modal_Signup.style.display = "block";
    }
}
if (span_SignUp) {
    span_SignUp.onclick = function () {
        modal_Signup.style.display = "none";
    }
}

if (cancel_Signup) {
    cancel_Signup.onclick = function () {
        modal_Signup.style.display = "none";
    }
}

// btn_Service.onclick = function () {
//     modal_Service.style.display = "block";
// }
// span_Service.onclick = function () {
//     modal_Service.style.display = "none";
// }
if (btn_Contact) {
    btn_Contact.onclick = function () {
        modal_Contact.style.display = "block";
    }
}
if (span_Contact) {
    span_Contact.onclick = function () {
        modal_Contact.style.display = "none";
    }
}

// btn_forgot.onclick = function () {
//     modalforgot.style.display = "block";
// }
// span_forgot.onclick = function () {
//     modalforgot.style.display = "none";
// }

window.onclick = function (event) {
    if (event.target == modal_Contact) {
        modal_Contact.style.display = "none";
    }
    if (event.target == modal_Service) {
        modal_Service.style.display = "none";
    }
    if (event.target == modal_Signup) {
        modal_Signup.style.display = "none";
    }
    if (event.target == modal_Signup) {
        modal_Signup.style.display = "none";
    }
    // if (event.target == modal_Payments_Details1) {
    //     modal_Payments_Details1.style.display = "none";
    // }
}