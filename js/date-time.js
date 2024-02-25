document.addEventListener("DOMContentLoaded", function () {
    // Current date
    var currentDate = new Date();
    var year = currentDate.getFullYear();
    var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
    var day = currentDate.getDate().toString().padStart(2, '0');
    var formattedDate = year + '-' + month + '-' + day;
    document.getElementById('date').value = formattedDate;

    // Current time
    var currentTime = new Date();
    var hours = currentTime.getHours().toString().padStart(2, '0');
    var minutes = currentTime.getMinutes().toString().padStart(2, '0');
    var formattedTime = hours + ':' + minutes;
    document.getElementById('time1').value = formattedTime;
    document.getElementById('time2').value = formattedTime;
});