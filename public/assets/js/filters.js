$(document).ready(function () {
  $("#filtersSup").hide();
  sessionStorage.clear('color');
  function afficherProduits(products) {
    const liste = document.createElement('div');
    liste.classList.add("productsGrid");
    if ((0 < products.length)) {
      for (var i = 0; i < products.length; i++) {
        // Container
        const listItem = document.createElement('div');
        listItem.classList.add("product");
        // Nom du produit
        const titleElement = document.createElement('div');
        titleElement.classList.add("productName");
        titleElement.textContent = products[i]["name"];
        // Lien du produit
        const urlElement = document.createElement('a');
        urlElement.href = `/produit?id=${products[i]["id"]}`;
        // Image du produit
        const imageElement = document.createElement('img');
        const imageUrl = "./assets/img/products/" + products[i]["img"];
        imageElement.src = imageUrl;
        imageElement.alt = products[i]["name"];
        // Prix du produit
        const divElement = document.createElement('div');
        divElement.classList.add("productDiv");
        const priceElement = document.createElement('div');
        priceElement.classList.add("productPrice");
        priceElement.textContent = products[i]["price"] + " €";
        // Note du produit
        const ratingElement = document.createElement('div');
        ratingElement.classList.add("productRate");
        ratingElement.innerHTML = parseFloat(products[i]["rate"]).toFixed(1) + "<img src='./assets/img/star.png'/>";
        // Ajouter les éléments à la liste
        listItem.appendChild(urlElement);
        urlElement.appendChild(imageElement);
        urlElement.appendChild(titleElement);
        urlElement.appendChild(divElement);
        divElement.appendChild(priceElement);
        divElement.appendChild(ratingElement);
        liste.appendChild(listItem);
      };
      $("#filtersProducts").html(liste);
    } else {
      $("#filtersProducts").html("<div class='oups'>Oups... Aucun produit ne correspond à cette recherche :(</div>")
    }
  }
  async function recherche(mini = 1, maxi = 1000, color = "all") {
    const reponse = await fetch("../controller/php/recherche.php?color=" + color + "&mini=" + mini + "&maxi=" + maxi);
    const products = await reponse.json();
    afficherProduits(products);
  }
  $("#noir, #blanc, #rouge, #jaune, #vert, #bleu, #violet, #gris").on("click", function () {
    sessionStorage.setItem('color', this.id);
    recherche($("#slider-range").slider("values", 0), $("#slider-range").slider("values", 1), sessionStorage.getItem('color'));
    $("#filtersSup").html("❌ Supprimer le filtre <span class='bold'>" + this.id + "<span>");
    $("#filtersSup").slideDown();
  });
  $(function () {
    $("#slider-range").slider({
      range: true,
      min: 1,
      max: 1000,
      values: [1, 1000],
      slide: function (event, ui) {
        $("#amount").val(ui.values[0] + " € - " + ui.values[1] + " €");
        if(sessionStorage.getItem('color')){
          recherche($("#slider-range").slider("values", 0), $("#slider-range").slider("values", 1), sessionStorage.getItem('color'));
        } else {
          recherche($("#slider-range").slider("values", 0), $("#slider-range").slider("values", 1));
        }
      }
    });
    $("#amount").val($("#slider-range").slider("values", 0) +
    " € - " + $("#slider-range").slider("values", 1) + " €");
  });    
  $(function () {
    if (sessionStorage.getItem('color')) {
      $("#filtersSup").slideDown();
    }
    $("#filtersSup").on("click", function () {
      sessionStorage.clear('color');
      recherche($("#slider-range").slider("values", 0), $("#slider-range").slider("values", 1));
      $(this).slideUp();
    });
 
  })
  recherche();
})
