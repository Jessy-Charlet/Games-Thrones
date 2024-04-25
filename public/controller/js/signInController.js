document.addEventListener('DOMContentLoaded', function() {
    var errorMessages = document.getElementById('errorMessage');

    const emailI = document.getElementById('emailId');
    const passwordI = document.getElementById('password');

    var signInButton = document.getElementById('signInButton');

    signInButton.addEventListener('click', function(event) {
        event.preventDefault();


        if (emailI === '' || passwordI === '') {
            var errorMessage = 'Please fill in all fields.';
            errorMessages.innerHTML = errorMessage;
            return;
        }

        const email = document.getElementById('emailId').value;
        const password = document.getElementById('password').value;

        const formdata = new FormData();
        formdata.append('email', email);
        formdata.append('password', password);

        const requestOptions = {
            method: "POST",
            Header: "Content-Type: multipart/form-data",
            body: formdata
        };

        fetch("http://localhost:8080/controller/php/signInController.php", requestOptions)
            .then(response => response.json())
            .then(data => {
                if(data.status == 'error') {
                    if (data.error === 'mailNotFound') {
                        self.location = '/connexion?error=mailNotFound';
                    } else if (data.error === 'wrongPassword') {
                        self.location = '/connexion?error=wrongPassword';
                    }
                }else if(data.status == 'success') {
                    self.location = '/';
                }
            })
            .catch(error => 
                self.location = '/connexion?error=UnexpectedError'
            );
    });
});