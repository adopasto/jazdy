document.querySelectorAll('.flash-message').forEach(function (flashMessage) {
    setTimeout(function () {
        flashMessage.style.display = 'none';
    }, 3000);    
})