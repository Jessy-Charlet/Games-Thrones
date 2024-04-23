document.addEventListener('DOMContentLoaded', function() {
    var errorMessages = document.getElementById('errorMessage');

    var email = document.getElementById('emailId');
    var password = document.getElementById('password');

    var signInButton = document.getElementById('signInButton');

    signInButton.addEventListener('click', function(event) {
        event.preventDefault();


        if (email.value === '' || password.value === '') {
            var errorMessage = 'Please fill in all fields.';
            errorMessages.innerHTML = errorMessage;
            return;
        }

        const formdata = new FormData();
        formdata.append('email', email.value);
        formdata.append('password', password.value);

        const requestOptions = {
            method: "POST",
            header: "Content-Type: application/form-data",
            body: formdata
        };

        fetch("http://localhost:8080/controller/php/signInController.php", requestOptions)
            .then(response => response.text())
            .then((body) => {
                window.location.href = '/';
            })
            .catch(error => 
                self.location = 'inscription?error=error'
            );
    });
});