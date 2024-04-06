/*
	Student Name: Joseph Garwood
	Student Number: 041085246
	Date: March 14 2024
	Prof: Alem Legesse
	Course: CST 8285
*/

// function that will run to ensure the form is validated
function validated() {
    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var appName = document.getElementById("appName").value;
    var appType = document.getElementById("appType").value;
    var reason = document.getElementById("reason").value;
    var date = document.getElementById("appointmentDate").value;
    var time = document.getElementById("appointmentTime").value;
    var errors = false;

    // Check if the email textbox is blank. If so, prompt user to enter email.
    if (email.trim() == ''){
        errorMessage("emailError", "Please enter a valid email");
        errors = true;
    }

    // Check email format is correct
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        errors = true;
        errorMessage("emailError", "x Invalid email format");
    }

    // Check if the firstName textbox is blank. If so, prompt user to enter username.
    if (firstName.trim() ==''){
        errorMessage("firstNameError", "x Please enter a first name");
        errors = true;
    }

    // Check if the lastName textbox is blank. If so, prompt user to enter username.
    if (lastName.trim() ==''){
        errorMessage("lastNameError", "x Please enter a last name");
        errors = true;
    }

    // Check if the phone textbox is blank. If so, prompt user to enter username.
    if (phone.trim() ==''){
        errorMessage("phoneError", "x Please enter a phone number");
        errors = true;
    }

    //check if a date has been entered. if not, prompt user to enter a date.
    if (date == ''){
        errorMessage("dateError", "x Please enter a date");
        errors = true;
    }
    //check if a time has been entered. if not, prompt user to enter a time.
    if (time == ''){
        errorMessage("timeError", "x Please enter a time");
        errors = true;
    }

    //check if an appliance name has been entered. if not, prompt user to enter an appliance name.
    if (appName == ''){
        errorMessage("appNameError", "x Please enter an appliance name");
        errors = true;
    }
    //check if an appliance type has been entered. if not, prompt user to enter an appliance type
    if (appType == ''){
        errorMessage("appTypeError", "x Please enter an appliance type");
        errors = true;
    }

    // Stop the form from submitting if there are errors.
    return !errors;
}

// function that creates the error messages that will display when form isn't correctly validated 
function errorMessage(id, message){
    var errorSpan = document.getElementById(id);
    errorSpan.innerHTML = message;
}
