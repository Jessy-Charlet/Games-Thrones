$(document).ready(function () {

    const mediaQueryList = window.matchMedia("(orientation: landscape)");
    $("#navShop").hide();
    $("#navInfos").hide();
    $("#navSearch").hide();

    /*** Au chargement de la page */
    if (mediaQueryList.matches) {
        $("#searchBarContainer").hide();
        $("#searchBarOpen").show();
        searchOpen();
        searchClose();
    } else {
        $("#searchBarContainer").show();
        $("#searchBarOpen").hide();
        $("#searchBarClose").hide();
    }


    /*** Ouverture de la barre de recherche */
    function searchOpen() {
        $("#searchBarOpen").on("click", function () {
            $("#searchBarContainer").show();
            $("#searchBarClose").show();
            $(this).hide();
            $("#logo").addClass("logoMove");
            $("#navContainer").addClass("navContainerOpen")
            document.getElementById("searchBar").focus();
        });
    }

    /*** Fermeture de la barre de recherche */
    function searchClose() {
        $("#searchBarClose").on("click", function () {
            $(this).hide();
            $("#navSearch").slideUp("fast");
            if (mediaQueryList.matches) {
                $("#searchBarContainer").hide();
                $("#searchBarOpen").show();
                $("#navContainer").removeClass("navContainerOpen")
                $("#logo").removeClass("logoMove");
            } else {
            }
        });
    }

    /*** Au changement Portrait/landscape */
    function screenTest(e) {
        if (e.matches) {
            $("#navContainer").removeClass("navContainerOpen");
            $("#logo").removeClass("logoMove");
            $("#searchBarContainer").hide();
            $("#searchBarOpen").show();
            searchOpen();
            searchClose();

        } else {
            $("#searchBarContainer").show();
            $("#searchBarOpen").hide();
            $("#searchBarClose").hide();
            $("#navContainer").removeClass("navContainerOpen")
        }
    }

    mediaQueryList.addListener(screenTest);

    /*** Menu de gauche */
    $("#shop").on("click", function () {
        $("#shop").toggleClass("active");
        $("#navShop").slideToggle("fast");
        $("#infos").removeClass("active");
        $("#navInfos").slideUp("fast");
        $("#navSearch").slideUp("fast");

    });
    $("#infos").on("click", function () {
        $("#infos").toggleClass("active");
        $("#navInfos").slideToggle("fast");
        $("#shop").removeClass("active");
        $("#navShop").slideUp("fast");
        $("#navSearch").slideUp("fast");
    });

})

$('#searchBar').on({
    keyup: function () {
        let recherche = $(this).val();
        afficherProduits(recherche);
    },
    focusin: function () {
        $("#navSearch").slideDown("fast");
        $("#navShop").slideUp("fast");
        $("#navInfos").slideUp("fast");
        $("#searchBarClose").show();

    }
})


async function afficherProduits(recherche) {
    if (recherche != "") {

        const reponse = await fetch('../controller/php/recherche.php');
        const products = await reponse.json();
        const liste = document.createElement('div');
        liste.classList.add("productsGrid");
        for (var i = 0; i < products.length; i++) {
            if (products[i]["name"].toLowerCase().includes(recherche) == true) {
                // Container
                const listItem = document.createElement('div');
                listItem.classList.add("product");
                // Nom du produit
                const titleElement = document.createElement('div');
                listItem.classList.add("productName");
                titleElement.textContent = products[i]["name"];
                // Lien du produit
                const urlElement = document.createElement('a');
                urlElement.href = `<?= $router->generate('produit') ?>?id=${products[i]["product_id"]}`;
                // Image du produit
                console.log(urlElement.href);
                const imageElement = document.createElement('img');
                const productImages = JSON.parse(products[i]["images"]);
                const imageUrl = productImages["main_image"];
                imageElement.src = imageUrl;
                imageElement.alt = products[i]["name"];
                // Prix du produit
                const priceElement = document.createElement('div');
                priceElement.classList.add("productPrice");
                priceElement.textContent = products[i]["price"];
                // Note du produit
                const ratingElement = document.createElement('span');
                ratingElement.classList.add("productPrice");
                ratingElement.textContent = parseFloat(products[i]["price"]).toFixed(1);

                // Ajouter les éléments à la liste
                listItem.appendChild(urlElement);
                urlElement.appendChild(imageElement);
                listItem.appendChild(titleElement);
                listItem.appendChild(ratingElement);
                liste.appendChild(listItem);
            };
        };
        $("#navSearch").html(liste);
    } else {
        $("#navSearch").html("Aucun résultat...");
    }
}

