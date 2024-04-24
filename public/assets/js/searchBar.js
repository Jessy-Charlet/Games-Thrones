$(document).ready(function () {

    const mediaQueryList = window.matchMedia("(orientation: landscape)");
    $("#fleche").css('cursor', 'pointer');
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
        $("#searchBarClose, #fleche").on("click", function () {
            $("#searchBarClose").hide();
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
    $("#fleche").on("click", function(){
        searchClose();
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
        const arrow = document.createElement('a');
        arrow.id = "fleche"
        arrow.textContent = "▲ ▲ ▲";
        arrow.href="#navContainer";
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
                    titleElement.classList.add("productName");
                    titleElement.textContent = products[i]["name"];
                    // Lien du produit
                    const urlElement = document.createElement('a');
                    urlElement.href = `/produit?id=${products[i]["product_id"]}`;
                    // Image du produit
                    console.log(urlElement.href);
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
            };
            $("#navSearch").html(liste);
            $("#navSearch").append(arrow);
            $("#fleche").css('cursor', 'pointer');
            searchClose()
        } else {
            $("#navSearch").html("Aucun résultat...");
            $("#navSearch").append(arrow);
            $("#fleche").css('cursor', 'pointer');
            searchClose()
        }
    }


})