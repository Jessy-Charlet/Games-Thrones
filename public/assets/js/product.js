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

jQuery(document).ready(function () {
  jQuery("#product_basketButton").click(function () {
    var quantity = parseInt(jQuery("#product_quantity").val());
    var currentTotalBottom =
      parseInt(jQuery("#header_totalProductsQuantityBottom").text()) || 0;
    var currentTotalTop =
      parseInt(jQuery("#header_totalProductsQuantity").text()) || 0;

    var newTotalBottom = currentTotalBottom + quantity;
    var newTotalTop = currentTotalTop + quantity;

    jQuery("#header_totalProductsQuantityBottom").text(newTotalBottom);
    jQuery("#header_totalProductsQuantity").text(newTotalTop);
  });
});


jQuery(document).ready(function () {
  jQuery("#product_basketButton").click(function (event) {
    event.preventDefault(); // Prevent default form submission if applicable

    var url = window.location.href;
    var params = new URLSearchParams(url.split("?")[1]);
    var id = params.get("id");
    const quantity = jQuery("#product_quantity").val();

    fetch(`/addProductToBasketAjaxController?id=${id}&quantity=${quantity}`)
      .then((response) => response.json()) // Parse the response as JSON (optional)
      .then((data) => {
        console.log("Product added to cart:", data); // Optional for debugging
        // Page refresh after successful request (not recommended)
        window.location.reload();
      })
      .catch((error) => {
        console.error("Error adding product to cart:", error);
        // Handle any errors during the request (optional)
      });
  });
});
