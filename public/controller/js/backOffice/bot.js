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
        const reponse = await fetch('../controller/php/recherche.php');
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

    $('#rechercheBack').on('keyup', function () {
            let recherche = $(this).val();
            switch (localStorage['mode']) {
                case 'bCustomer':
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