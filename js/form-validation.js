// form-validation.js
document.addEventListener("DOMContentLoaded", function () {
    // Get form elements
    var nameSelect = document.getElementById('name');
    var vehicleSelect = document.getElementById('vehicle');
    var kmBeforeInput = document.getElementById('kmBefore');
    var kmAfterInput = document.getElementById('kmAfter');
    var dateInput = document.getElementById('date');
    var time1Input = document.getElementById('time1');
    var time2Input = document.getElementById('time2');
    var radioButtons = document.querySelectorAll('.radio-list input[type="radio"]');
    var detailTextarea = document.getElementById('detail');
    var submitBtn = document.getElementById('submitBtn');
    var whereInput = document.getElementById('where');
    var personsSelect = document.getElementById('persons');

    // Validate form on load
    validateForm();

    // Event listeners for form validation
    var radioList = document.querySelectorAll('.radio-list input[type="radio"]');
    var detailTextarea = document.getElementById('detail');
    var personsSelect = document.getElementById('persons');

    for (var i = 0; i < radioList.length; i++) {
        radioList[i].addEventListener('change', function () {
            validateForm();
        });
    }

    whereInput.addEventListener('input', function () {
        validateForm();
    });

    detailTextarea.addEventListener('input', function () {
        validateForm();
    });

    personsSelect.addEventListener('change', function () {
        validateForm();
    });

    // Function to validate the form
    function validateForm() {
        var isNameValid = nameSelect.value.trim() !== '';
        var isVehicleValid = vehicleSelect.value.trim() !== '';
        var isKmBeforeValid = kmBeforeInput.value.trim() !== '';
        var isKmAfterValid = kmAfterInput.value.trim() !== '';
        var isDateValid = dateInput.value.trim() !== '';
        var isTime1Valid = time1Input.value.trim() !== '';
        var isTime2Valid = time2Input.value.trim() !== '';
        var isWhereValid = whereInput.value.trim() !== '';
        var isRadioSelected = false;
        var isDetailValid = true;
        var isPersonsValid = personsSelect.value.trim() !== '';

        // Check if a radio button is selected
        for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].checked) {
                isRadioSelected = true;
                break;
            }
        }

        // If a radio button is selected, validate detailTextarea
        if (isRadioSelected) {
            detailTextarea.style.display = 'block';
            isDetailValid = detailTextarea.value.trim() !== '';
        } else {
            detailTextarea.style.display = 'none';
        }

        // Convert values to numbers for comparison
        var kmBeforeValue = parseFloat(kmBeforeInput.value);
        var kmAfterValue = parseFloat(kmAfterInput.value);

        // Check if the form is valid
        var isKmRelationshipValid = !isNaN(kmBeforeValue) && !isNaN(kmAfterValue) && kmAfterValue >= kmBeforeValue;

        var isFormValid =
            isNameValid &&
            isVehicleValid &&
            isKmBeforeValid &&
            isKmAfterValid &&
            isDateValid &&
            isTime1Valid &&
            isTime2Valid &&
            isRadioSelected &&
            isWhereValid &&
            isDetailValid &&
            isPersonsValid &&
            isKmRelationshipValid;

        // Enable/disable the submit button based on form validity
        if (isFormValid) {
            submitBtn.classList.add('valid');
            submitBtn.disabled = false;
        } else {
            submitBtn.classList.remove('valid');
            submitBtn.disabled = true;
        }
    }
});
