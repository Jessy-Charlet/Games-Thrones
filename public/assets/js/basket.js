// Fonction pour effacer les cookies
function clearCookies() {
  document.cookie.split(";").forEach(function(c) {
    document.cookie = c.trim().split("=")[0] + "=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;";
  });
}

// Fonction pour récupérer le panier du session storage
function loadFromSessionStorage() {
  const cart = sessionStorage.getItem('cart');

  if (cart) {
    console.log("Panier récupéré du session storage :", cart);
    const basketContents = JSON.parse(cart);

    // Code pour recréer les éléments du panier à partir de basketContents
    // Par exemple, créer des éléments DOM pour afficher le panier
  } else {
    console.log("Aucun panier trouvé dans le session storage.");
  }
}

// Fonction pour compter le nombre de produits et le prix total
function countNumberProductsAndTotalPrice() {
  var totalPrice = 0;
  var totalProductsQuantity = 0;

  jQuery(".panierItem").each(function (index, element) {
    var priceElement = jQuery(this).find(".panierItemPrix");
    var quantityElement = jQuery(this).find(".panierItemQuantity input");

    if (priceElement.length > 0 && quantityElement.length > 0) {
      var price = parseFloat(priceElement.text());
      var quantity = parseInt(quantityElement.val());

      totalProductsQuantity += quantity;
      var itemTotalPrice = price * quantity;

      totalPrice += itemTotalPrice;
    } else {
      console.log("Item", index + 1, "Price or quantity element not found.");
    }
  });

  jQuery("#basket_total_number").text(totalPrice.toFixed(2));

  jQuery("#header_totalProductsQuantity").text(
    totalProductsQuantity.toFixed(0)
  );
  jQuery("#header_totalProductsQuantityBottom").text(
    totalProductsQuantity.toFixed(0)
  );
}

// Fonction pour sauvegarder le panier dans le session storage
function updateSessionStorage() {
  const basketContents = [];

  jQuery(".panierItem").each(function () {
    const productId = jQuery(this).find('.basket_quantity').data('product-id');
    const quantity = parseInt(jQuery(this).find('.basket_quantity').val());

    basketContents.push({ product_id: productId, quantity: quantity });
  });

  // Stocker le panier dans le session storage
  sessionStorage.setItem('cart', JSON.stringify(basketContents));
  console.log("Panier sauvegardé dans le session storage:", JSON.stringify(basketContents));
}


// Fonction pour activer la suppression d'articles
function activateRemoveItems() {
  jQuery(document).on("click", ".panierItemRemove", function () {
    var panierItemToRemove = jQuery(this).closest(".panierItem");
    panierItemToRemove.remove(); // Suppression de l'article
    updateCart(); // Mise à jour après suppression
  });
}

// Fonction pour activer les boutons d'ajout/réduction de quantité
function activePlusMinusProductsNumber() {
  jQuery(".reduce_basket_quantity, .add_basket_quantity").off("click");

  jQuery(".reduce_basket_quantity").on("click", function () {
    var quantityInput = jQuery(this).parent().find(".basket_quantity");
    var currentQuantity = parseInt(quantityInput.val()) || 1;
    var newQuantity = Math.max(currentQuantity - 1, 1);
    quantityInput.val(newQuantity);

    updateCart(); // Mise à jour après modification
  });

  jQuery(".add_basket_quantity").on("click", function () {
    var quantityInput = jQuery(this).parent().find(".basket_quantity");
    var currentQuantity = parseInt(quantityInput.val()) || 1;
    var newQuantity = currentQuantity + 1;
    quantityInput.val(newQuantity);

    updateCart(); // Mise à jour après modification
  });
}

$(".saveBasketBtn").on("click", function() {
  updateSessionStorage();
  console.log("Panier sauvegardé."); // Vérifiez si ce message s'affiche dans la console
});


// Fonction pour mettre à jour le panier
function updateCart() {
  countNumberProductsAndTotalPrice(); // Recalculer le total du panier
  updateSessionStorage(); // Sauvegarder dans le session storage
}

// Fonction pour initialiser le panier
function initBasket() {
  countNumberProductsAndTotalPrice(); // Recalculer le total
  activateRemoveItems(); // Activer la suppression des articles
  activePlusMinusProductsNumber(); // Activer les boutons d'ajout/réduction de quantité
}

// Appeler initBasket lorsque jQuery est disponible
var waitForJQuery = setInterval(function () {
  if (typeof jQuery !== "undefined") {
    clearInterval(waitForJQuery);
    loadFromSessionStorage(); // Charger le panier
    initBasket(); // Initialisation du panier
  }
}, 100) 

