document.addEventListener('DOMContentLoaded', function() {

    let mailInput = document.getElementById('email');
    let passwordInput = document.getElementById('password');
    let submitButton = document.getElementById('submit');
    let errorMessageInput = document.getElementById('error');

    submitButton.addEventListener('click', (event) => {
        event.preventDefault();

        let clean_url = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.pushState({path: clean_url}, '', clean_url);

        let mail = mailInput.value;
        let password = passwordInput.value;
        let errorMessage = "";

        if(mail === '' || password === '') {
            errorMessage = "Veuillez remplir tous les champs";
            errorMessageInput.innerHTML = errorMessage;
            return;
        }

        const formdata = new FormData();
        formdata.append('email', mail);
        formdata.append('password', password);

        const requestOptions = {
            method: "POST",
            body: formdata
        };

        fetch("http://localhost:8080/controller/php/backOfficeController.php", requestOptions)
        .then(response => response.json())
        .then(data => {
            if(data.status == 'error') {
                if (data.error === 'mailNotFound') {
                    self.location = '/gt-admin?error=mailNotFound';
                } else if (data.error === 'wrongPassword') {
                    self.location = '/gt-admin?error=wrongPassword';
                } else if (data.error === "notAdmin") {
                    self.location = '/gt-admin?error=notAdmin';
                }
            }else if(data.status == 'success') {
                window.location.href = '/gt-admin';
            }
        })
        .catch(error => 
            self.location = '/gt-admin?error=UnexpectedError'
        );
        
    });

});