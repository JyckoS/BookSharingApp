// Made by Jycko

function validatePassword() {
    var pw = document.getElementById("password").value;
    var conpw = document.getElementById("passwordConfirmation").value;
    if (pw !== conpw) {
        alert("Your password confirmation mismatched.");

        return false;
    }
    return true;

}