// Form submission
document.addEventListener("DOMContentLoaded", function () {
    // Function to submit the form
    function submitForm() {
        // Create FormData object
        var formData = new FormData();
        formData.append('Meno', document.getElementById('name').value);
        formData.append('Vozidlo', document.getElementById('vehicle').value);
        formData.append('KM pred jazdou', document.getElementById('kmBefore').value);
        formData.append('KM po jazde', document.getElementById('kmAfter').value);
        formData.append('Dátum', document.getElementById('date').value);
        formData.append('Čas odjazdu', document.getElementById('time1').value);
        formData.append('Čas príjazdu', document.getElementById('time2').value);
        formData.append('Účel jazdy', document.querySelector('.radio-list input[type="radio"]:checked').value);
        formData.append('Posádka', document.getElementById('persons').value);

        var detailTextarea = document.getElementById('detail');
        formData.append('Detail jazdy', detailTextarea.value);

        formData.append('Cieľ jazdy', document.getElementById('where').value);

        // Create a new row in the table
        var recordTableBody = document.getElementById('recordTableBody');
        var newRow = recordTableBody.insertRow(0);
        newRow.id = 'highlighted-row'; // Add an ID to the new row
        newRow.innerHTML = `
            <td>${document.getElementById('name').value}</td>
            <td>${document.getElementById('vehicle').value}</td>
            <td>${document.getElementById('persons').value}</td>
            <td>${document.getElementById('kmBefore').value}</td>
            <td>${document.getElementById('kmAfter').value}</td>
            <td>${document.getElementById('date').value}</td>
            <td>${document.getElementById('time1').value}</td>
            <td>${document.getElementById('time2').value}</td>
            <td>${document.getElementById('where').value}</td>
            <td>${document.querySelector('.radio-list input[type="radio"]:checked').value}</td>
            <td>${document.getElementById('detail').value}</td>
        `;

        // Create XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Set up the request
        xhr.open('POST', 'process_form.php', true);

        // Define the callback function
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);

                    if (response.status === 'success') {
                        // Display success message
                        var successMessage = document.getElementById('successMessage');
                        successMessage.textContent = 'Successfully recorded!';
                        successMessage.style.display = 'block';

                        // Hide success message after 3 seconds
                        setTimeout(function () {
                            successMessage.style.display = 'none';
                        }, 3000);

                        // Form reset
                        var form = document.querySelector('form');
                        form.reset();
                    } else {
                        // Display error message to the user
                        alert(response.message);
                    }
                } else {
                    // Display error message to the user
                    alert('Chyba pri spracovaní. Skúste to prosím znova.');
                }
            }
        };

        // Send the form data
        xhr.send(formData);
    }
});
