$(document).ready(function () {

    const mediaQueryList = window.matchMedia("(orientation: landscape)");
    $("#navShop").hide();
    $("#navInfos").hide();

    /*** Au chargement de la page */
    if (mediaQueryList.matches){
        $("#searchBarContainer").hide();
        $("#searchBarOpen").show();
        searchOpen();
        searchClose();
    } else {
        $("#searchBarContainer").show();
        $("#searchBarOpen").hide();

    }


    /*** Ouverture de la barre de recherche */
    function searchOpen(){
        $("#searchBarOpen").on("click", function () {
            $("#searchBarContainer").show();
            $("#searchBarClose").show();
            $(this).hide();
            $("#logo").addClass("logoMove");
            $("#navContainer").addClass("navContainerOpen")
        });
    }

    /*** Fermeture de la barre de recherche */
    function searchClose(){
        $("#searchBarClose").on("click", function () {
            $(this).hide();
            $("#searchBarContainer").hide();
            $("#searchBarOpen").show();
            $("#navContainer").removeClass("navContainerOpen")
            $("#logo").removeClass("logoMove");
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

    });
    $("#infos").on("click", function () {
        $("#infos").toggleClass("active");
        $("#navInfos").slideToggle("fast");
        $("#shop").removeClass("active");
        $("#navShop").slideUp("fast");
    });

})