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
     //   autocompltetion("#searchBar", "autocompleteResults");
    },
    focusin: function () {
        $("#navSearch").slideDown("fast");
        $("#navShop").slideUp("fast");
        $("#navInfos").slideUp("fast");
        $("#searchBarClose").show();

    }
})


async function afficherProduits(recherche) {
    const reponse = await fetch('../controller/php/recherche.php');
    const products = await reponse.json();
    let liste = []
    console.log(recherche);
    for(var i= 0; i < products.length; i++){
        let name = $("#navSearch").html(products[i]["name"]);
        if(name == recherche){




            const listItem = document.createElement('li');

            // Titre du film
            const titleElement = document.createElement('h3');
            titleElement.textContent = movie.title;
    
            // Lien 
            const urlElement = document.createElement('a');
            urlElement.href = `./details.php?id=${movie.id}`;
    
    
            // Image du film
            const imageElement = document.createElement('img');
            const imageUrl = `https://image.tmdb.org/t/p/w500${movie.poster_path}`;
            imageElement.src = imageUrl;
            imageElement.alt = movie.title;
    
    
    
            // Note du film
            const ratingElement = document.createElement('span');
            ratingElement.textContent = parseFloat(movie.vote_average).toFixed(1);
    
            // Ajouter les éléments à la liste
            listItem.appendChild(urlElement);
            urlElement.appendChild(imageElement);
            listItem.appendChild(titleElement);
            listItem.appendChild(ratingElement);
    
            movieList.appendChild(listItem);
            x++;







            
        };
    };
    return products;
}

$("#searchBar").on("keyup", function(){
    let recherche = $(this).val();
    afficherProduits(recherche);
})
