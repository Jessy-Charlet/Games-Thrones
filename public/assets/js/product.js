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

/*
jQuery(document).ready(function () {
  jQuery("product_basketButton").click(function () {
    // Get product SKU (replace "product_sku_selector" with your actual way to get SKU)
    var productSku = jQuery("#your_product_sku_selector").val() || "";

    // Get product quantity from input
    var quantity = parseInt(jQuery("#product_quantity").val()) || 1;

    // Prepare data for fetch request
    var data = {
      sku: productSku,
      quantity: quantity,
    };

    // Fetch request options
    var options = {
      method: "POST",
      body: JSON.stringify(data),
      headers: {
        "Content-Type": "application/json",
      },
    };

    // Send fetch request
    fetch("/addProductToBasketController.php", options)
      .then((response) => response.json()) // Parse JSON response (if applicable)
      .then((data) => {
        // Handle successful response from the server (optional)
        console.log("Success:", data);
        // You can update UI elements here based on the response data
      })
      .catch((error) => {
        console.error("Error:", error);
        // Handle errors during the request (optional)
        // You can display an error message to the user here
      });
  });
});
*/

jQuery(document).ready(function () {
  jQuery("#product_basketButton").click(function (event) {
    event.preventDefault(); // Prevent default form submission if applicable

    const productId = jQuery("#product_ref").text();
    const quantity = jQuery("#product_quantity").val();

    fetch(
      `/addProductToBasketAjaxController?id=${productId}&quantity=${quantity}`
    )
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
