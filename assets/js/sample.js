document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.php-email-form');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const loading = document.querySelector('.loading');
        const errorMsg = document.querySelector('.error-message');
        const sentMsg = document.querySelector('.sent-message');

        errorMsg.classList.remove('d-block');
        sentMsg.classList.remove('d-block');
        loading.classList.add('d-block');

        const formData = new FormData(form);

        fetch('sample-request.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            loading.classList.remove('d-block');
            if (!response.ok) throw new Error("Failed to send. Please try again.");
            return response.text();
        })
        .then(data => {
            sentMsg.innerHTML = data;
            sentMsg.classList.add('d-block');
            form.reset();
        })
        .catch(error => {
            errorMsg.innerHTML = error.message;
            errorMsg.classList.add('d-block');
        });
    });
});
