function countNumberProductsAndTotalPrice() {
  jQuery(document).ready(function () {
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
  });
}

function removeItems() {
    jQuery(document).on("click", ".panierItemRemove", function () {
        var panierItemToRemove = jQuery(this).closest(".panierItem");
        
    panierItemToRemove.remove();
    countNumberProductsAndTotalPrice();
  });
}
