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

        fetch("http://localhost:8080/controller/php/signUpController.php", requestOptions)
            .then(response => response.json())
            .then(data => {
                if(data.status == 'error') {
                    if (data.error === 'mailNotFound') {
                        self.location = 'connexion?error=mailNotFound';
                    } else if (data.error === 'wrongPassword') {
                        self.location = 'connexion?error=wrongPassword';
                    }
                }else if(data.status == 'success') {
                    self.location = '/';
                }
            })
            .catch(error => 
                self.location = 'connexion?error=UnexpectedError'
            );
    });
});