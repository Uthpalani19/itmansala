function checkPassword() {
    var password = document.getElementById("password");
    var confirmPassword = document.getElementById("confirmPassword");
    if (password.value != confirmPassword.value) {
        confirmPassword.setCustomValidity("Passwords Don't Match");
    } else {
        confirmPassword.setCustomValidity('');
    }
}

function makeEditable()
{
    if(10>2)
    {
        $('new-password').removeAttr('readonly');
        $('confirm-new-password').removeAttr('readonly');
    }
}