$(document).ready(function () {

    function openClose() {
        $('.buttonBack').on('click', function () {
            const buttonBody = $(this).attr('id');
            $('#body' + buttonBody).slideDown();
            $('#head' + buttonBody).slideUp();
        });
        $('.resetForm').on('click', function () {
            const buttonId = $(this).attr('id');
            $('#bodybutton' + buttonId).slideUp();
            $('#headbutton' + buttonId).slideDown();
        });
    }

    function showCustomer(customer, i, liste) {
        // Container
        const blockBack = document.createElement('div');
        blockBack.classList.add("blockBack");

        // header
        const blockHead = document.createElement('div');
        blockHead.classList.add("blockHead");
        $(blockHead).attr('id', 'headbutton' + i);
        const nameH = document.createElement('p');
        nameH.textContent = customer[i]["first_name"] + " " + customer[i]["last_name"];
        const mailH = document.createElement('p');
        mailH.textContent = customer[i]["mail"];
        const cityH = document.createElement('p');
        const buttonH = document.createElement('div');
        const updateH = document.createElement('button');
        updateH.textContent = "Modifier";
        updateH.classList.add("buttonBack");
        $(updateH).attr('id', 'button' + i);
        const deleteH = document.createElement('button');
        deleteH.textContent = "X";
        blockHead.appendChild(nameH);
        blockHead.appendChild(mailH);
        blockHead.appendChild(cityH);
        blockHead.appendChild(buttonH);
        buttonH.appendChild(updateH);
        buttonH.appendChild(deleteH);

        // body
        const blockBody = document.createElement('div');
        blockBody.classList.add("blockBody");
        $(blockBody).attr('id', 'bodybutton' + i);
        // formulaire
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '';
        form.classList.add("formBack");
        // prénom
        const firstName = document.createElement('div');
        const firstNameLabel = document.createElement('label');
        firstNameLabel.for = 'first_name';
        firstNameLabel.textContent = 'Prénom';
        const firstNameForm = document.createElement('input');
        firstNameForm.type = 'TEXT';
        firstNameForm.name = 'first_name';
        firstNameForm.value = customer[i]["first_name"];
        firstName.appendChild(firstNameLabel);
        firstName.appendChild(firstNameForm);
        // nom
        const lastName = document.createElement('div');
        const lastNameLabel = document.createElement('label');
        lastNameLabel.for = 'lastName';
        lastNameLabel.textContent = 'Nom';
        const lastNameForm = document.createElement('input');
        lastNameForm.type = 'TEXT';
        lastNameForm.name = 'lastName';
        lastNameForm.value = customer[i]["last_name"];
        lastName.appendChild(lastNameLabel);
        lastName.appendChild(lastNameForm);
        // Email
        const mail = document.createElement('div');
        const mailLabel = document.createElement('label');
        mailLabel.for = 'mail';
        mailLabel.textContent = 'Email';
        const mailForm = document.createElement('input');
        mailForm.type = 'TEXT';
        mailForm.name = 'mail';
        mailForm.value = customer[i]["mail"];
        mail.appendChild(mailLabel);
        mail.appendChild(mailForm);
        // adresse
        const adresse = document.createElement('div');
        const adresseLabel = document.createElement('label');
        adresseLabel.for = 'adresse';
        adresseLabel.textContent = 'Adresse';
        const adresseForm = document.createElement('input');
        adresseForm.type = 'TEXT';
        adresseForm.name = 'adresse';
        adresseForm.value = customer[i]["adresse"];
        adresse.appendChild(adresseLabel);
        adresse.appendChild(adresseForm);
        // postal_code
        const postal_code = document.createElement('div');
        const postal_codeLabel = document.createElement('label');
        postal_codeLabel.for = 'postal_code';
        postal_codeLabel.textContent = 'Code postal';
        const postal_codeForm = document.createElement('input');
        postal_codeForm.type = 'TEXT';
        postal_codeForm.name = 'postal_code';
        postal_codeForm.value = customer[i]["postal_code"];
        postal_code.appendChild(postal_codeLabel);
        postal_code.appendChild(postal_codeForm);
        // ville
        const city = document.createElement('div');
        const cityLabel = document.createElement('label');
        cityLabel.for = 'city';
        cityLabel.textContent = 'Ville';
        const cityForm = document.createElement('input');
        cityForm.type = 'TEXT';
        cityForm.name = 'city';
        cityForm.value = customer[i]["city"];
        city.appendChild(cityLabel);
        city.appendChild(cityForm);
        // téléphone
        const phone = document.createElement('div');
        const phoneLabel = document.createElement('label');
        phoneLabel.for = 'phone';
        phoneLabel.textContent = 'Téléphone';
        const phoneForm = document.createElement('input');
        phoneForm.type = 'TEXT';
        phoneForm.name = 'phone';
        phoneForm.value = customer[i]["phone"];
        phone.appendChild(phoneLabel);
        phone.appendChild(phoneForm);

        // annuler valider
        const resetForm = document.createElement('button');
        resetForm.type = 'button';
        resetForm.classList.add("resetForm");
        resetForm.name = 'reset';
        resetForm.id = [i];
        resetForm.textContent = 'Annuler';

        const updateForm = document.createElement('button');
        updateForm.type = 'submit';
        updateForm.name = 'update';
        updateForm.value = customer[i]["id"];
        updateForm.textContent = 'valider';

        // Ajouter les éléments à la liste
        blockBack.appendChild(blockHead);
        blockBack.appendChild(blockBody);
        blockBody.appendChild(form);
        form.appendChild(firstName);
        form.appendChild(lastName);
        form.appendChild(mail);
        form.appendChild(adresse);
        form.appendChild(postal_code);
        form.appendChild(city);
        form.appendChild(phone);
        form.appendChild(resetForm);
        form.appendChild(updateForm);
        liste.appendChild(blockBack);
        return liste;
    }

    function showProduct(products, i, liste) {
        // Container
        const blockBack = document.createElement('div');
        blockBack.classList.add("blockBack");

        // header
        const blockHead = document.createElement('div');
        blockHead.classList.add("blockHead");
        $(blockHead).attr('id', 'headbutton' + i);
        const nameH = document.createElement('p');
        nameH.textContent = products[i]["name"];
        const priceH = document.createElement('p');
        priceH.textContent = products[i]["price"] + " €";
        const quantityH = document.createElement('p');
        quantityH.textContent = products[i]["quantity"] + " ❒";
        const buttonH = document.createElement('div');
        const updateH = document.createElement('button');
        updateH.textContent = "Modifier";
        updateH.classList.add("buttonBack");
        $(updateH).attr('id', 'button' + i);
        const deleteH = document.createElement('button');
        deleteH.textContent = "X";
        blockHead.appendChild(nameH);
        blockHead.appendChild(priceH);
        blockHead.appendChild(quantityH);
        blockHead.appendChild(buttonH);
        buttonH.appendChild(updateH);
        buttonH.appendChild(deleteH);

        // body
        const blockBody = document.createElement('div');
        blockBody.classList.add("blockBody");
        $(blockBody).attr('id', 'bodybutton' + i);
        // formulaire
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '';
        form.classList.add("formBack");
        // nom
        const name = document.createElement('div');
        name.classList.add("double");
        const nameLabel = document.createElement('label');
        nameLabel.for = 'name';
        nameLabel.textContent = 'Nom';
        const nameForm = document.createElement('input');
        nameForm.type = 'TEXT';
        nameForm.name = 'name';
        nameForm.value = products[i]["name"];
        name.appendChild(nameLabel);
        name.appendChild(nameForm);
        // prix
        const price = document.createElement('div');
        const priceLabel = document.createElement('label');
        priceLabel.for = 'price';
        priceLabel.textContent = 'Prix en €';
        const priceForm = document.createElement('input');
        priceForm.type = 'TEXT';
        priceForm.name = 'price';
        priceForm.value = products[i]["price"];
        price.appendChild(priceLabel);
        price.appendChild(priceForm);
        // Quantité
        const quantity = document.createElement('div');
        const quantityLabel = document.createElement('label');
        quantityLabel.for = 'quantity';
        quantityLabel.textContent = 'Stock';
        const quantityForm = document.createElement('input');
        quantityForm.type = 'TEXT';
        quantityForm.name = 'quantity';
        quantityForm.value = products[i]["quantity"];
        quantity.appendChild(quantityLabel);
        quantity.appendChild(quantityForm);
        // Couleur
        const color = document.createElement('div');
        const colorLabel = document.createElement('label');
        colorLabel.for = 'color';
        colorLabel.textContent = 'Couleur';
        const colorForm = document.createElement('input');
        colorForm.type = 'TEXT';
        colorForm.name = 'color';
        colorForm.value = products[i]["color"];
        color.appendChild(colorLabel);
        color.appendChild(colorForm);
        // Matière
        const material = document.createElement('div');
        const materialLabel = document.createElement('label');
        materialLabel.for = 'material';
        materialLabel.textContent = 'Matière';
        const materialForm = document.createElement('input');
        materialForm.type = 'TEXT';
        materialForm.name = 'material';
        materialForm.value = products[i]["material"];
        material.appendChild(materialLabel);
        material.appendChild(materialForm);
        // Marque
        const brand = document.createElement('div');
        const brandLabel = document.createElement('label');
        brandLabel.for = 'brand';
        brandLabel.textContent = 'Marque';
        const brandForm = document.createElement('input');
        brandForm.type = 'TEXT';
        brandForm.name = 'brand';
        brandForm.value = products[i]["brand"];
        brand.appendChild(brandLabel);
        brand.appendChild(brandForm);
        // Catégorie
        const category = document.createElement('div');
        const categoryLabel = document.createElement('label');
        categoryLabel.for = 'category';
        categoryLabel.textContent = 'Catégorie';
        const categoryForm = document.createElement('input');
        categoryForm.type = 'TEXT';
        categoryForm.name = 'category';
        // Write id but it's the name of the category
        categoryForm.value = products[i]["category_id"];
        category.appendChild(categoryLabel);
        category.appendChild(categoryForm);
        // Description
        const description = document.createElement('div');
        description.classList.add('textarea');
        const descriptionLabel = document.createElement('label');
        descriptionLabel.for = 'description';
        descriptionLabel.textContent = 'Description';
        const descriptionForm = document.createElement('textarea');
        descriptionForm.rows = '10';
        descriptionForm.name = 'description';
        descriptionForm.value = products[i]["description"];
        description.appendChild(descriptionLabel);
        description.appendChild(descriptionForm);
        // Main image ID
        const mainImageId = document.createElement('div');
        const mainImageIdLabel = document.createElement('label');
        mainImageIdLabel.for = "mainImageId";
        mainImageIdLabel.textContent = "ID Image principale";
        const mainImageIdForm = document.createElement('input');
        mainImageIdForm.type = 'TEXT';
        mainImageIdForm.name = 'mainImageId';
        mainImageIdForm.value = products[i][0][1];
        mainImageId.appendChild(mainImageIdLabel);
        mainImageId.appendChild(mainImageIdForm);

        // annuler valider
        const resetForm = document.createElement('button');
        resetForm.type = 'button';
        resetForm.classList.add("resetForm");
        resetForm.name = 'reset';
        resetForm.id = [i];
        resetForm.textContent = 'Annuler';

        const updateForm = document.createElement('button');
        updateForm.type = 'submit';
        updateForm.name = 'update';
        updateForm.value = products[i]["id"];
        updateForm.textContent = 'valider';

        // Ajouter les éléments à la liste
        blockBack.appendChild(blockHead);
        blockBack.appendChild(blockBody);
        blockBody.appendChild(form);
        form.appendChild(name);
        form.appendChild(price);
        form.appendChild(quantity);
        form.appendChild(color);
        form.appendChild(material);
        form.appendChild(brand);
        form.appendChild(category);
        form.appendChild(description);
        form.appendChild(resetForm);
        form.appendChild(updateForm);
        liste.appendChild(blockBack);
        return liste;
    }

    async function product(recherche) {
        const formData = new FormData();
        formData.append('searching', 'products');

        const requestOptions = {
            method: "POST",
            Header: "Content-Type: multipart/form-data",
            body: formData
        }
        const reponse = await fetch('../controller/php/botController.php', requestOptions);
        const products = await reponse.json();
        if (recherche != "") {
            const liste = document.createElement('div');
            for (var i = 0; i < products.length; i++) {
                if (products[i]["name"].toLowerCase().includes(recherche) == true) {
                    showProduct(products, i, liste);
                }
            }
            $("#contentBack").html(liste);
            $(".blockBody").hide();
            openClose();
        } else {
            const liste = document.createElement('div');
            for (var i = 0; i < products.length; i++) {
                showProduct(products, i, liste);
            }
            $("#contentBack").html(liste);
            $(".blockBody").hide();
            openClose();
        }
    }
    async function customer(recherche) {
        const formData = new FormData();
        formData.append('searching', 'customer');

        const requestOptions = {
            method: "POST",
            Header: "Content-Type: multipart/form-data",
            body: formData
        }
        const reponse = await fetch('../controller/php/botController.php', requestOptions);
        const customer = await reponse.json();
        if (recherche != "") {
            const liste = document.createElement('div');
            for (var i = 0; i < customer.length; i++) {
                if (customer[i]["first_name"].toLowerCase().includes(recherche) == true || customer[i]["last_name"].toLowerCase().includes(recherche) == true) {
                    showCustomer(customer, i, liste);
                }
            }
            $("#contentBack").html(liste);
            $(".blockBody").hide();
            openClose();
        } else {
            const liste = document.createElement('div');
            for (var i = 0; i < customer.length; i++) {
                showCustomer(customer, i, liste);
            }
            $("#contentBack").html(liste);
            $(".blockBody").hide();
            openClose();
        }
    }

    $('#rechercheBack').on('keyup', function () {
            let recherche = $(this).val();
            switch (localStorage['mode']) {
                case 'bCustomer':
                    customer(recherche);
                    break;
                case 'bProduct':
                    product(recherche);
                    break;
                case '#bRate':
                    break;
                case 'bReview':
                    break;
                case 'bOrder':
                    break;
                case 'bCategory':
                    break;
                default:
                    break;
            }
        })

    $('#bCustomer, #bProduct, #bRate, #bReview, #bOrder, #bCategory').on('click', function () {
        localStorage['mode'] = $(this).attr('id');
        switch (localStorage['mode']) {
            case 'bCustomer':
                customer('');
                $('#bCustomer, #bProduct, #bRate, #bReview, #bOrder, #bCategory').removeClass('activeBack');
                $('#bCustomer').addClass('activeBack');
                break;
            case 'bProduct':
                product('');
                $('#bCustomer, #bProduct, #bRate, #bReview, #bOrder, #bCategory').removeClass('activeBack');
                $('#bProduct').addClass('activeBack');
                break;
            case '#bRate':
                $('#bCustomer, #bProduct, #bRate, #bReview, #bOrder, #bCategory').removeClass('activeBack');
                $('#bRate').addClass('activeBack');
                break;
            case 'bReview':
                $('#bCustomer, #bProduct, #bRate, #bReview, #bOrder, #bCategory').removeClass('activeBack');
                $('#bReview').addClass('activeBack');
                break;
            case 'bOrder':
                $('#bCustomer, #bProduct, #bRate, #bReview, #bOrder, #bCategory').removeClass('activeBack');
                $('#bOrder').addClass('activeBack');
                break;
            case 'bCategory':
                $('#bCustomer, #bProduct, #bRate, #bReview, #bOrder, #bCategory').removeClass('activeBack');
                $('#bCategory').addClass('activeBack');
                break;
            default:
                break;
        }
    })
})