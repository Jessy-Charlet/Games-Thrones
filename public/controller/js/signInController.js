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

        var values = {
            email: email.value,
            password: password.value
        };
        
        var queryString = '';
        for (var key in values) {
            if (values.hasOwnProperty(key)) {
                queryString += '&' + key + '=' + encodeURIComponent(values[key]);
            }
        }
        fetch('controller/php/signInController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: queryString
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            var user = data['id'];
            var firstName = data['firstName'];
            //window.location.href = '/';
        })
        .catch(error => {
            self.location = 'connexion?error=error'
        })
    });
});