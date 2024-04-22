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
        autocompltetion("#searchBar", "autocompleteResults");
    },
    focusin: function () {
        $("#navSearch").slideDown("fast");
        $("#navShop").slideUp("fast");
        $("#navInfos").slideUp("fast");
        $("#searchBarClose").show();

    }
})













var availableTags = [];
fetch('recherche.php')
  .then(response => response.json())
  .then(data => {
    data.forEach(product => {
      availableTags.push(product.name);
    });
  })
  .catch(error => console.error('Erreur lors de la récupération des utilisateurs:', error));




$(function () {
  $("#searchBar").autocomplete({
    source: availableTags
  });
});








/*


// Fonction pour obtenir les données de l'API TMDB
async function fetchProduit(recherche, cible, nombre) {
    try {
        const response = await fetch(recherche);
        const data = await response.json();
        var x = 0;

        // Afficher les films dans la liste avec les images
        data.results.forEach(movie => {
            if (x != nombre) {
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
            } else {
                return;
            }

        });
    } catch (error) {
        console.error('Erreur lors de la récupération des données:', error.message);
    }
}


// Appeler la fonction pour récupérer les films
fetchMovies(filmPopulaire, "movieList");
*/

/*** Barre de recherche */
/*
// function autocompletion
function autocompltetion(menu, cible) {
    var filmRecherche = `https://api.themoviedb.org/3/search/${sessionStorage.getItem('mode')}`;
    var query = $(menu).val();

    if (query.length > 0) {
        var filmR = filmRecherche + '?api_key=' + apiKey + '&query=' + query;

        fetchMovies(filmR, cible, 20);
    } else {
        cible.innerHTML = 'Aucun résultat...';
    }
}
// menu PC*/
