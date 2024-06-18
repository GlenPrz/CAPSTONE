
var modal_Contact = document.getElementById("modal_cntct");
var btn_Contact = document.getElementById("ContactUs_nav");
var span_Contact = document.getElementsByClassName("close-button")[0];

var modal_Service = document.getElementById("ServiceModal");
var btn_Service = document.getElementById("Service_nav");
var span_Service = document.getElementsByClassName("close_Service")[0];


btn_Contact.onclick = function () {
    modal_Contact.style.display = "block";
}
span_Contact.onclick = function () {
    modal_Contact.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal_Contact) {
        modal_Contact.style.display = "none";
    }
    if(event.target == myModal_popUPQuestion){

    }
}