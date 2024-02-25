// Fecth data
const vehicleSelect = document.getElementById('vehicle');
const kmBeforeInput = document.getElementById('kmBefore');

vehicleSelect.addEventListener('change', function () {
    const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];
    const vehicleName = selectedOption.value;

    fetch(`fetch_last_km_after.php?vehicleName=${encodeURIComponent(vehicleName)}`)
        .then(response => response.json())
        .then(data => {
            if (data && data.kmAfter !== null) {
                kmBeforeInput.value = data.kmAfter;
                kmBeforeInput.setAttribute('readonly', true);
                validateForm();
            } else {
                kmBeforeInput.value = '';
                kmBeforeInput.removeAttribute('readonly');
                validateForm();
            }
        })
        .catch(error => console.error('Error fetching last kmAfter:', error));
});
