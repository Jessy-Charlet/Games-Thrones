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
            const addImageForm = $('.addImageForm');
            if(addImageForm){
                $('.formBack .annulerAddImage').remove();
                $('.formBack .AddImageForm').remove();
                $('.formBack .AddImageLabel').remove();
            }
        });
    }


    // CUSTOMER
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


    // PRODUCT
    function showProduct(products, i, liste) {
        // Container
        const blockBack = document.createElement('div');
        blockBack.classList.add("blockBack");

        // header
        const blockHead = document.createElement('div');
        blockHead.classList.add("blockHead");
        $(blockHead).attr('id', 'headbutton' + i);
        const productIdH = document.createElement('p');
        productIdH.textContent = products[i]["id"]
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

        deleteH.addEventListener("click", (event)=>{
            event.preventDefault();
            if(window.confirm("Voulez-vous vraiment supprimer ce produit ?")){
                const id = products[i]['id'];
                const imageId = products[i]["0"][1];
                let secondaryIds = [];
                for (let j = 3; j < products[i]["0"].length; j += 2) {
                    secondaryIds.push(products[i]["0"][j]);
                }
                deleteProduct(id, imageId, secondaryIds);
            }        
        });


        blockHead.appendChild(productIdH);
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
        nameForm.id = "name";
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
        priceForm.id = "price";
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
        quantityForm.id = "quantity";
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
        colorForm.id = "color";
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
        materialForm.id = "material";
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
        brandForm.id = "brand";
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
        categoryForm.id = "category";
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
        descriptionForm.id = "description";
        description.appendChild(descriptionLabel);
        description.appendChild(descriptionForm);
        // Rate
        const rate = document.createElement('div');
        rate.classList.add('textarea');
        const rateLabel = document.createElement('label');
        rateLabel.for = 'description';
        rateLabel.textContent = 'rate';
        const rateForm = document.createElement('input');
        rateForm.name = 'rate';
        rateForm.value = products[i]["rate"];
        rateForm.id = "rate";
        rateForm.disabled = true;
        rate.appendChild(rateLabel);
        rate.appendChild(rateForm);

        //MAIN IMAGE

        // Main image ID
        const mainImageId = document.createElement('div');
        const mainImageIdLabel = document.createElement('label');
        mainImageIdLabel.for = "mainImageId";
        mainImageIdLabel.textContent = "ID Image principale";
        const mainImageIdForm = document.createElement('input');
        mainImageIdForm.type = 'TEXT';
        mainImageIdForm.name = 'mainImageId';
        mainImageIdForm.value = products[i]["0"][1];
        mainImageIdForm.disabled = true;
        mainImageId.appendChild(mainImageIdLabel);
        mainImageId.appendChild(mainImageIdForm);
        // Main image path
        const mainImagePath = document.createElement('div');
        const mainImagePathLabel = document.createElement('label');
        mainImagePathLabel.setAttribute('for', 'mainImagePath');
        mainImagePathLabel.textContent = 'Chemin Image principale';
        const mainImagePathForm = document.createElement('input');
        mainImagePathForm.type = 'text';
        mainImagePathForm.name = 'mainImagePath';
        mainImagePathForm.value = products[i]["0"][0];
        mainImagePathForm.disabled = true;
        mainImagePath.appendChild(mainImagePathLabel);
        mainImagePath.appendChild(mainImagePathForm);

        // SECONDARY IMAGES

        // Secondary images id
        const secondaryImageId = document.createElement('div');
        const secondaryImageIdLabel = document.createElement('label');
        secondaryImageIdLabel.setAttribute('for', 'secondaryImageId');
        secondaryImageIdLabel.textContent = 'Lien Image secondaire';
        const secondaryImageIdForm = document.createElement('input');
        secondaryImageIdForm.type = 'text';
        secondaryImageIdForm.name = 'secondaryImageId';
        secondaryImageIdForm.disabled = true;
        
        let secondaryIds = [];
        for (let j = 3; j < products[i]["0"].length; j += 2) {
            secondaryIds.push(products[i]["0"][j]);
        }
        secondaryImageIdForm.value = secondaryIds.join(', ');
        
        secondaryImageId.appendChild(secondaryImageIdLabel);
        secondaryImageId.appendChild(secondaryImageIdForm);


        // Secondary image path
        const secondaryImagePath = document.createElement('div');
        const secondaryImagePathLabel = document.createElement('label');
        secondaryImagePathLabel.setAttribute('for', 'secondaryImagePath');
        secondaryImagePathLabel.textContent = 'Lien Image secondaire';
        const secondaryImagePathForm = document.createElement('input');
        secondaryImagePathForm.type = 'text';
        secondaryImagePathForm.name = 'secondaryImagePath';
        secondaryImagePathForm.disabled = true;
        
        // Loop to get secondary image links
        let secondaryLinks = [];
        for (let j = 2; j < products[i]["0"].length; j += 2) {
            secondaryLinks.push(products[i]["0"][j]);
        }
        secondaryImagePathForm.value = secondaryLinks.join(', ');
        
        secondaryImagePath.appendChild(secondaryImagePathLabel);
        secondaryImagePath.appendChild(secondaryImagePathForm);

        // Ajouter une image
        const addImageBtn = document.createElement('submit');
        addImageBtn.setAttribute('type', 'submit');
        addImageBtn.textContent = "Ajouter une image";
        addImageBtn.classList.add('AddImage');

        let imageInputAdd = 0;

        const addImageLabel = document.createElement('label');
        const addImageForm = document.createElement('input');
        const annulerAddImage = document.createElement('submit');

        addImageBtn.addEventListener('click', (event) => {
            event.preventDefault();

            addImageLabel.setAttribute('for', 'addImageForm');
            addImageLabel.classList.add("AddImageLabel");
            addImageLabel.textContent = "Ajouter une image";

            addImageForm.setAttribute('type', 'text');
            addImageForm.setAttribute('name', 'addImageForm');
            addImageForm.setAttribute('id', 'newImages');
            addImageForm.classList.add("AddImageForm");

            annulerAddImage.setAttribute('type', 'submit');
            annulerAddImage.classList.add('annulerAddImage');
            annulerAddImage.textContent = "Annuler l'ajout d'image"
            
            if(imageInputAdd === 0){
                form.removeChild(updateForm);
                form.removeChild(resetForm);
                form.appendChild(addImageLabel);
                form.appendChild(addImageForm);
                form.appendChild(annulerAddImage);
                form.appendChild(resetForm);
                form.appendChild(updateForm);
                imageInputAdd++;
            }

            annulerAddImage.addEventListener('click', (event) => {
                event.preventDefault();

                form.removeChild(addImageLabel);
                form.removeChild(addImageForm);
                form.removeChild(annulerAddImage);

                imageInputAdd = 0;
            })
        });
        
        // annuler valider
        const resetForm = document.createElement('button');
        resetForm.type = 'button';
        resetForm.classList.add("resetForm");
        resetForm.name = 'reset';
        resetForm.id = [i];
        resetForm.textContent = 'Annuler';
        resetForm.addEventListener('click', () => {
            imageInputAdd = 0;
        })

        const updateForm = document.createElement('button');
        updateForm.type = 'submit';
        updateForm.name = 'update';
        updateForm.value = products[i]["id"];
        updateForm.textContent = 'valider';

        updateForm.addEventListener('click', (event) => {
            event.preventDefault();
            const id = products[i]["id"];
            updateProduct(id, nameForm.value, rateForm.value, priceForm.value, quantityForm.value, colorForm.value, materialForm.value, brandForm.value, categoryForm.value, descriptionForm.value, mainImageIdForm.value, mainImagePathForm.value, secondaryImageIdForm.value, secondaryImagePathForm.value, addImageForm.value);
        });

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
        form.appendChild(rate);
        form.appendChild(description);
        form.appendChild(mainImageId);
        form.appendChild(mainImagePath);
        form.appendChild(secondaryImageId);
        form.appendChild(secondaryImagePath);
        form.appendChild(addImageBtn);
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

        // ADD PRODUCT
        const blockCreate = document.createElement('div');
        blockCreate.classList.add('addProductContainer');
        const addProductBtn = document.createElement('button');
        addProductBtn.classList.add('addProductOpen');
        addProductBtn.textContent = "Ajouter un produit";
        blockCreate.appendChild(addProductBtn);
        const addProductForm = document.createElement('form');
        addProductForm.classList.add("addProductForm");
        let addProductFormCheck = 0;
        addProductBtn.addEventListener('click', (event)=>{
            event.preventDefault();

            addProductBtn.style.display = "none";

            if(addProductFormCheck == 0){
                let inputToCreate = [
                    "Name",
                    "Price",
                    "Quantity",
                    "Color",
                    "Material",
                    "Brand",
                    "Category",
                    "Description",
                    "Image",
                    "Secondary Image",
                ];

                for(let inputCount = 0; inputCount < 10; inputCount++){
                    if(inputToCreate[inputCount] == "Description"){                        
                        const addProductInputDiv = document.createElement('div');
                        addProductInputDiv.setAttribute('class', "addProductInputDivDesc");

                        const addProductInput = document.createElement("textarea");
                        addProductInput.setAttribute('name', inputToCreate[inputCount]+"Name");
                        addProductInput.setAttribute('id', 'addProduct'+inputToCreate[inputCount]+"_id");
                        addProductInput.setAttribute('rows', 10);
                        addProductInput.setAttribute('class', "addProductInputDesc");

                        const addProductLabel = document.createElement('label');
                        addProductLabel.setAttribute('for', inputToCreate[inputCount]+"Name");
                        addProductLabel.setAttribute('class', "addProductLabel");
                        addProductLabel.textContent = inputToCreate[inputCount];

                        addProductInputDiv.appendChild(addProductLabel);
                        addProductInputDiv.appendChild(addProductInput);

                        addProductForm.appendChild(addProductInputDiv);
                    }else{
                        const addProductInputDiv = document.createElement('div');
                        const addProductInput = document.createElement("input");
                        addProductInput.setAttribute('type', 'text');
                        addProductInput.setAttribute('name', inputToCreate[inputCount]+"Name");
                        if(inputToCreate[inputCount] == "Name"){
                            addProductInputDiv.setAttribute('class', "addProductInputDivName");
                            addProductInput.setAttribute('class', "addProductInputName");
                        }else{
                            addProductInputDiv.setAttribute('class', "addProductInputDiv");
                            addProductInput.setAttribute('class', "addProductInput");

                        }
                        addProductInput.setAttribute('id', 'addProduct'+inputToCreate[inputCount]+"_id");

                        const addProductLabel = document.createElement('label');
                        addProductLabel.setAttribute('for', inputToCreate[inputCount]+"Name");
                        addProductLabel.setAttribute('class', "addProductLabel");
                        addProductLabel.textContent = inputToCreate[inputCount];

                        addProductInputDiv.appendChild(addProductLabel);
                        addProductInputDiv.appendChild(addProductInput);

                        addProductForm.appendChild(addProductInputDiv);
                    }
                }

                const addProductAnnulerDiv = document.createElement('div');
                addProductAnnulerDiv.setAttribute('class', 'addProductAnnulerDiv');

                const addProductAnnuler = document.createElement('input');
                addProductAnnuler.setAttribute('type', 'button');
                addProductAnnuler.setAttribute('class', "addProductAnnuler");
                addProductAnnuler.setAttribute('value', 'Annuler');

                addProductAnnulerDiv.appendChild(addProductAnnuler);
                addProductForm.appendChild(addProductAnnulerDiv);

                const addProductValiderDiv = document.createElement('div');
                addProductValiderDiv.setAttribute('class', 'addProductValiderDiv');

                const addProductValider = document.createElement("input");
                addProductValider.setAttribute('type', 'submit');
                addProductValider.setAttribute('class', 'addProductValider');
                addProductValider.setAttribute('value', 'Valider');
                
                addProductValiderDiv.appendChild(addProductValider);
                addProductForm.appendChild(addProductValiderDiv);
            
                blockCreate.appendChild(addProductForm);

                if(addProductValider){
                    addProductValider.addEventListener("click", (event)=>{
                        event.preventDefault();

                        const name = document.getElementById('addProductName_id');
                        const price = document.getElementById('addProductPrice_id');
                        const quantity = document.getElementById('addProductQuantity_id');
                        const description = document.getElementById('addProductDescription_id');
                        const color = document.getElementById('addProductColor_id');
                        const material = document.getElementById('addProductMaterial_id');
                        const brand = document.getElementById('addProductBrand_id');
                        const category = document.getElementById('addProductCategory_id');
                        const images = document.getElementById('addProductImage_id');
                        const secondaryImages = document.getElementById('addProductSecondary Image_id');

                        createProduct(name.value, price.value, quantity.value, description.value, color.value, material.value, brand.value, category.value,  images.value, secondaryImages.value)
                    });
                }
                
                if(addProductAnnuler){
                    addProductAnnuler.addEventListener("click", (event)=>{
                        event.preventDefault();

                        addProductBtn.style.display = "grid";

                        for(let inputCount = 0; inputCount < 10; inputCount++){
                            const addProductInput = document.getElementById('addProduct'+inputToCreate[inputCount]+'_id');
                            addProductInput.value = "";
                        }

                        blockCreate.removeChild(addProductForm);
                    });
                }
                addProductFormCheck = 1;
            }else{
                blockCreate.appendChild(addProductForm);
            }
        });


        if (recherche != "") {
            const liste = document.createElement('div');            
            for (var i = 0; i < products.length; i++) {
                if (products[i]["name"].toLowerCase().includes(recherche) == true) {
                    showProduct(products, i, liste);
                }
            }

            $("#contentBack").append(liste);
            $(".blockBody").hide();
            openClose();
        } else {
            const liste = document.createElement('div');            

            for (var i = 0; i < products.length; i++) {
                showProduct(products, i, liste);
            }
            $("#contentBack").append(blockCreate);
            $("#contentBack").append(liste);
            $(".blockBody").hide();
            openClose();
        }





    }
    async function updateProduct(id, name, rate, price, quantity, color, material, brand, category, description, mainImageId, mainImagePath, secondaryImageId, secondaryImagePath, newImage) {
        const formData = new FormData();
        formData.append('id', id);
        formData.append('name', name);
        formData.append('rate', rate);
        formData.append('price', price);
        formData.append('quantity', quantity);
        formData.append('description', description);
        formData.append('color', color);
        formData.append('material', material);
        formData.append('brand', brand);
        formData.append('category_name', category);
        formData.append('image_id', mainImageId)
        formData.append('image_path', mainImagePath);
        formData.append('secondary_image_id', secondaryImageId);
        formData.append('secondary_image_path', secondaryImagePath);
        formData.append('request', "updateProduct");
        if(newImage){
            if(newImage.length > 0){
                formData.append('newImages', 'true');
                formData.append('newImagesPath', newImage);
            }else{
                formData.append('newImages', 'false');
            }           
        }else{
            formData.append('newImages', 'false');
        }
        
        const requestOptions = {
            method: "POST",
            Header: "Content-Type: multipart/form-data",
            body: formData
        }
        
        fetch('http://localhost:8080/controller/php/backOffice/backOfficeController.php', requestOptions)
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert('Success')
                location.reload();
            } else if (data.status === "error") {
                if (data.message === "ProductAlreadyExist") {
                    alert("Product already exists");
                } else if (data.message === "NameAlreadyExist") {
                    alert("Product name already exists");
                } else if (data.message === "ProductNotUpdated") {
                    alert("Unexpected error");
                } else if (data.message === "ImageAlreadyExist") {
                    alert("Image already exists");
                } else if (data.message === "secondaryImageAlreadyExistInDataBase") {
                    alert("Secondary image already exists in the database");
                } else if (data.message === "cannotAddMainImage") {
                    alert("Cannot add main image");
                } else if (data.message === "SecondaryImageAlreadyExist") {
                    alert("Secondary image already exists");
                }
            }                 
        })
        .catch(error =>
            console.log(error)
        )
    }
    async function createProduct(name, price, quantity, description, color, material, brand, category,  mainImagePath, secondaryImagePath){
        const formData = new FormData();

        if(name == ""){
            alert("Name canno't be empty");
            return;
        }else if(price == ""){
            alert("Price canno't be empty");
            return;
        }else if(quantity == ""){
            alert("Quantity canno't be empty");
            return;
        }else if(description == ""){
            alert("Description canno't be empty");
            return;
        }else if(color == ""){
            alert("Color canno't be empty");
            return;
        }else if(material == ""){
            alert("Material canno't be empty");
            return;
        }else if(brand == ""){
            alert("Brand canno't be empty");
            return;
        }else if(category == ""){
            alert("Category canno't be empty");
            return;
        }else if(mainImagePath == ""){
            alert("Main image canno't be empty");
            return;
        }

        let rate = 0;

        formData.append("name", name);
        formData.append("rate", rate);
        formData.append("price", price);
        formData.append("quantity", quantity);
        formData.append("color", color);
        formData.append("material", material);
        formData.append("brand", brand);
        formData.append("category", category);
        formData.append("description", description);
        formData.append("images", mainImagePath);
        if(secondaryImagePath != "none"){
            formData.append("secondaryImages", secondaryImagePath);
        }
        formData.append("request", "addProduct");
        
        const requestOptions = {
            method: "POST",
            Header: "Content-Type: multipart/form-data",
            body: formData
        }

        fetch('http://localhost:8080/controller/php/backOffice/backOfficeController.php', requestOptions)
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert('Success')
                location.reload();
            } else if (data.status === "error") {
                alert(data.message)
            }  
        })
    }
    async function deleteProduct(productId, imageId, secondaryImagesId){
        const formData = new FormData();

        formData.append("productId", productId);
        formData.append("imageId", imageId);
        formData.append("secondaryImageId", secondaryImagesId);
        formData.append("request", "deleteProduct");

        const requestOptions = {
            method: "POST",
            Header: "Content-Type: multipart/form-data",
            body: formData
        }

        fetch('http://localhost:8080/controller/php/backOffice/backOfficeController.php', requestOptions)
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert('Success')
                location.reload();
            } else if (data.status === "error") {
                alert(data.message)
            }  
        })
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