$(document).ready(function () {

    $("#searchBarContainer").hide();


    $("#searchBarOpen").on("click", function(){
        $("#searchBarContainer").show();
        $("#searchBarClose").show();
        $(this).hide();
        $("#logo").addClass("logoMove");
        $(".navContainer").addClass("navContainerOpen")
    })

    $("#searchBarClose").on("click", function(){
        $(this).hide();
        $("#searchBarContainer").hide();
        $("#searchBarOpen").show();
        $(".navContainer").removeClass("navContainerOpen")
        $("#logo").removeClass("logoMove");
    })



})