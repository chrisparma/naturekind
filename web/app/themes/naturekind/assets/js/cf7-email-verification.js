document.addEventListener('DOMContentLoaded', function () {
    const button = document.querySelector('.verify-email-button');
    const emailInput = document.querySelector('#cf7-email');
    const codeInput = document.querySelector('#cf7-email-code');
    const submitButton = document.querySelector('input[type="submit"]');
    let countdown = null;
    let verified = false;

    // Auto-fill email if user is logged in
    if (cf7_email_ajax.user_email && emailInput) {
        emailInput.value = cf7_email_ajax.user_email;
    }

    // Handle "focused" class on .form-group
    document.querySelectorAll('.wpcf7-form .form-group input, .wpcf7-form .form-group textarea, .wpcf7-form .form-group select').forEach(field => {
        const formGroup = field.closest('.form-group');

        function toggleFocusClass() {
            if (!formGroup) return;

            if (field === document.activeElement || field.value.trim() !== '') {
                formGroup.classList.add('focused');
            } else {
                formGroup.classList.remove('focused');
            }
        }

        // On focus/blur
        field.addEventListener('focus', toggleFocusClass);
        field.addEventListener('blur', toggleFocusClass);

        // On input change
        field.addEventListener('input', toggleFocusClass);

        // Run once on load in case some fields are prefilled
        toggleFocusClass();
    });
    function startCountdown(seconds) {
        button.disabled = true;
        let timeLeft = seconds;

        button.textContent = `Resend in ${timeLeft}s`;

        countdown = setInterval(() => {
            timeLeft--;
            button.textContent = `Resend in ${timeLeft}s`;

            if (timeLeft <= 0) {
                clearInterval(countdown);
                button.textContent = 'Send Verification Code';
                button.disabled = false;
            }
        }, 1000);
    }

    async function sendCode() {
        const email = emailInput.value.trim();
        if (!email) return alert('Please enter your email.');

        const response = await fetch(cf7_email_ajax.ajax_url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action: 'send_email_verification',
                email: email
            })
        });

        const data = await response.json();
        alert(data.data || (data.success ? 'Verification code sent!' : 'Error sending code.'));
        if (data.success) startCountdown(60);
    }

    function checkVerificationBeforeSubmit(e) {
        if (!verified) {
            e.preventDefault();
            alert('Please verify your email first.');
        }
    }

    // Listen to code input changes
    if (codeInput) {
        codeInput.addEventListener('blur', () => {
            const email = emailInput.value.trim();
            const code = codeInput.value.trim();

            if (!email || !code) return;

            fetch(cf7_email_ajax.ajax_url + '?action=validate_code', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ email, code })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    verified = true;
                    alert('Email verified successfully!');
                    button.style.display = 'none';
                    if (submitButton) submitButton.disabled = false;
                } else {
                    verified = false;
                    alert('Incorrect or expired code.');
                }
            });
        });
    }

    if (button) button.addEventListener('click', sendCode);
    if (submitButton) submitButton.addEventListener('click', checkVerificationBeforeSubmit);
});