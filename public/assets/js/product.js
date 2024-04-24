$(document).ready(function () {
  $(".slider ul").slick({
    dots: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    vertical: true,
    verticalSwiping: true,
    prevArrow: false,
    nextArrow: '<button type="button" class="slick-next"></button>',

    responsive: [
      {
        breakpoint: 1200,
        settings: {
          dots: false,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 3,
          vertical: false,
          dots: false,
        },
      },
    ],
  });

  $(".sliderPhoto").click(function () {
    var imgSrc = $(this).attr("src");
    $(".imageMain").attr("src", imgSrc);
  });
});

$(document).ready(function () {
  $("#toggleButton").click(function () {
    $("#svg1").toggle();
    $("#svg2").toggle();
    $(this).text($(this).text() === "Voir plus" ? "Voir moins" : "Voir plus");
    toggleReviewsItem();
  });
  function toggleReviewsItem() {
    $(".toggleReviewsItem").toggleClass("hideElement");
  }
});
