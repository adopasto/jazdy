document.querySelector("#register-form").addEventListener("submit", function (event) {
    let isValid = true;

    document.querySelectorAll('.column.error').forEach(function (column) {
        column.innerHTML = '';
    });
    document.querySelectorAll('#register-form input').forEach(function (input) {
        if (input.value === '') {            
            input.parentElement.nextElementSibling.innerHTML = 'This field is required';
            isValid = false;
        }
        else if (input.type == 'email' && /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,7}$/.test(input.value) == false) {
            input.parentElement.nextElementSibling.innerHTML = 'Please enter a valid email';
            isValid = false;
        }
        else if (input.name == 'data[password]' && /(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{5,}/.test(input.value) == false) {
            input.parentElement.nextElementSibling.innerHTML = 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character';
            isValid = false;
        }
        else if (input.name == 'data[repeat-password]' && input.value != document.getElementById('password').value) {
            input.parentElement.nextElementSibling.innerHTML = 'Passwords do not match';
            isValid = false;
        }
    });

    if (!isValid) {
        event.preventDefault();
    }
});