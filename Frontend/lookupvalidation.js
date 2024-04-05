// function that will run to ensure the form is validated
function validated() {
    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var date = document.getElementById("appointmentDate").value;
    var errors = false;

// Check if the firstName textbox is over 30 characters.


// Check if the lastName textbox is over 30 characters

// Check the firstName, lastName and date fields are all empty.
if (firstName.trim() =='', lastName.trim() =='', date.trim() == '') {
    errorMessage("noEntryError", "x Please submit at least a first name, last name or date.");
    errors = true;
}

    // Stop the form from submitting if there are errors.
return !errors;
}

// function that creates the error messages that will display when form isn't correctly validated 
function errorMessage(id, message) {
    var errorSpan = document.getElementById(id);
    errorSpan.innerHTML = message;
}