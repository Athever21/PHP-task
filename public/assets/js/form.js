const form = document.getElementById('contact-form');

form.addEventListener('submit', function (e) {
    e.preventDefault();
    e.stopPropagation();

    const captchaResponse = grecaptcha.getResponse();

    if (captchaResponse.length == 0) {
        showError('captcha-error');
        return false;
    }

    form.submit();
});

function showError(errorId) {
    const errorField = document.getElementById(errorId);
    errorField.style.display = 'block';
}

function clearError(errorId) {
    const errorField = document.getElementById(errorId);
    errorField.style.display = 'none';
}

function captchaVerify() {
    clearError('captcha-error');
}