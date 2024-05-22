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

/*************** add to the cart *******************/

jQuery(document).ready(function () {
  jQuery("#product_basketButton").click(function (event) {
    event.preventDefault();

    var url = window.location.href;
    var params = new URLSearchParams(url.split("?")[1]);
    var id = params.get("id");
    const quantity = jQuery("#product_quantity").val();

    fetch(`/addProductToBasketAjaxController?id=${id}&quantity=${quantity}`)
      .then((response) => response.json()) 
      .then((data) => {
        console.log("Product added to cart:", data); 
        window.location.reload();
      })
      .catch((error) => {
        console.error("Error adding product to cart:", error);
  
      });
  });
});

/*************** "Voir plus" Button  *******************/ 
jQuery(document).ready(function () {
  var currentPage = 2;

  function fetchReviews() {
    fetch(
      `/getReviewAjaxController?product_id=${productId}&page=${currentPage}`
    )
      .then((response) => response.text())
      .then((data) => {
        jQuery(".reviews").append(data);
        console.log(data.length);
        if (data.length < 3) {
          jQuery("#toggleButton").hide();
        }
      })
      .catch((error) => console.error("Error fetching reviews", error));
    currentPage++;
  }

  jQuery("#toggleButton").click(fetchReviews);
});

/*************** form to send a post request  *******************/

jQuery(document).ready(function () {
  jQuery(".reviewForm").submit(function (event) {
    event.preventDefault(); 

    const rating = jQuery('input[name="rating"]:checked').val();
    const text = jQuery('textarea[name="text"]').val();

    if (!rating || !text) {
      alert("Merci de remplir tous les champs.");
      return;
    }

    const formData = new FormData();
    formData.append("rating", rating);
    formData.append("text", text);
    formData.append("product_id", productId);

    fetch("/sendReviewFormAjaxController", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json()) 
      .then((data) => {
        if (data.success) {
          alert("Votre avis a été soumis avec succès!");
          jQuery(".reviewForm").trigger("reset");
        } else {
          alert(data.error); 
        }
      })
      .catch((error) => {
        console.error("Error submitting form:", error);
        alert("Une erreur est survenue. Veuillez réessayer plus tard.");
      });
  });
});
