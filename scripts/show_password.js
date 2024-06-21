// Made by Jycko
function showPassword(id) {
    var field = document.getElementById(id);
    var button = document.getElementById(id + "toggle");
    if (field.type !== "password") {
        field.type = "password";
        button.textContent = "Show";
        return;
    }
    field.type = "text";
    button.textContent = "Hide";
    return;
}