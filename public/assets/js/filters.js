$(document).ready(function () {

    function afficherProduits(products) {
        const liste = document.createElement('div');
        liste.classList.add("productsGrid");
        if((0 < products.length)){
        for (var i = 0; i < products.length; i++) {
            // Container
            const listItem = document.createElement('div');
            listItem.classList.add("product");
            // Nom du produit
            const titleElement = document.createElement('div');
            titleElement.classList.add("productName");
            titleElement.textContent = products[i]["name"];
            // Lien du produit
            const urlElement = document.createElement('a');
            urlElement.href = `/produit?id=${products[i]["product_id"]}`;
            // Image du produit
            const imageElement = document.createElement('img');
            const productImages = JSON.parse(products[i]["images"]);
            const imageUrl = productImages["main_image"];
            imageElement.src = imageUrl;
            imageElement.alt = products[i]["name"];
            // Prix du produit
            const divElement = document.createElement('div');
            divElement.classList.add("productDiv");
            const priceElement = document.createElement('div');
            priceElement.classList.add("productPrice");
            priceElement.textContent = products[i]["price"] + " €";
            // Note du produit
            const ratingElement = document.createElement('div');
            ratingElement.classList.add("productRate");
            ratingElement.innerHTML = parseFloat(products[i]["average_rating"]).toFixed(1) + "<img src='./assets/img/star.png'/>";

            // Ajouter les éléments à la liste
            listItem.appendChild(urlElement);
            urlElement.appendChild(imageElement);
            urlElement.appendChild(titleElement);
            urlElement.appendChild(divElement);
            divElement.appendChild(priceElement);
            divElement.appendChild(ratingElement);
            liste.appendChild(listItem);
        };
        $("#filtersProducts").html(liste);
    } else {
        $("#filtersProducts").html("<div class='oups'>Oups... Aucun produit ne correspond à cette recherche :(</div>")
    }
    }

    async function rechercheBase() {
        const reponse = await fetch("../controller/php/recherche.php");
        const products = await reponse.json();
        afficherProduits(products);
    }

    async function recherche(filter, value) {
        const reponse = await fetch("../controller/php/recherche.php?filter=" + filter + "&value=" + value);
        const products = await reponse.json();
        afficherProduits(products);
    }

    rechercheBase();

   $("#noir").on("click", function(){
    recherche("color", "Noir")
   });
   $("#blanc").on("click", function(){
    recherche("color", "Blanc")
   });
   $("#rouge").on("click", function(){
    recherche("color", "Rouge")
   });
   $("#jaune").on("click", function(){
    recherche("color", "Jaune")
   });
   $("#vert").on("click", function(){
    recherche("color", "Vert")
   });
   $("#bleu").on("click", function(){
    recherche("color", "Bleu")
   });
   $("#violet").on("click", function(){
    recherche("color", "Violet")
   });
   $("#gris").on("click", function(){
    recherche("color", "Gris")
   });



})