<?php

/*
## Get cart contents
Usage example: http://localhost:8080/getCartContentsAjaxController

Output sample: 
{
   "products":[
      {
         "product_id":1,
         "name":"Chaise de jeu ergonomique avec repose-pieds",
         "category_id":1,
         "brand":"ProGamer",
         "description":"La chaise gaming  est dot\u00e9e d'un support lombaire amovible, qui peut prot\u00e9ger efficacement la colonne vert\u00e9brale et le cou. L'oreiller lombaire avec fonction de massage produit plus de 20000 vibrations par heure pour soulager efficacement la fatigue pendant un travail ou un gaming. L'oreiller lombaire a un c\u00e2ble USB pour se connecter \u00e0 la prise de courant. L'interrupteur sur le cordon vous permet d'activer et de d\u00e9sactiver la fonction de massagePOSTURE CONFORTABLE - Il s'agit d'une v\u00e9ritable chaise gamer pour les passionn\u00e9s de gamers! Ce chaise gaming massante offre un soutien total de la t\u00eate aux pieds. L'angle du dossier peut \u00eatre facilement ajust\u00e9 de 90\u00b0 \u00e0 135\u00b0. Le repose-pieds, l'appui-t\u00eate et l'oreiller lombaire vous permettent de vous allonger en attendant que votre f\u00eate soit enfin en ligne. Le dossier et les accoudoirs sont enti\u00e8rement rembourr\u00e9s de \u00e9ponge pour fournir un soutien ad\u00e9quat pour la colonne vert\u00e9brale et les coudesREMBOURR\u00c9 - Le dossier et les accoudoirs sont en \u00e9ponge enti\u00e8rement \u00e9lastique et ne se d\u00e9forment pas, vous pouvez donc profiter longtemps de cette siege gaming. La selle est en \u00e9ponge de 8 cm d'\u00e9paisseur qui offre une densit\u00e9 d'assise constante pour les longues sessions. Le cuir PU perfor\u00e9 avec un aspect fibre de carbone assure la respirabilit\u00e9 pour les joueurs \u00e0 long terme. Nos chaise gaming massage avec motif en V de l'appui-t\u00eate au soutien lombaire, symbolisant la victoire",
         "material":"Cuir PU",
         "color":"Rouge",
         "price":"249.99",
         "stock":50,
         "average_rating":"0.0",
         "number_of_ratings":0,
         "vendor_code":"CHS-WD-001",
         "images":"{\r\n  \"main_image\": \"\/assets\/img\/products\/product_1_main_image.jpg\",\r\n  \"other_images\": [\r\n    \"\/assets\/img\/products\/product_1_image_1.jpg\",\r\n    \"\/assets\/img\/products\/product_1_image_2.jpg\"\r\n  ]\r\n}",
         "quantity":7
      },
      {
         "product_id":3,
         "name":"Chaise de jeu racing style avec support lombaire",
         "category_id":1,
         "brand":"SpeedMaster",
         "description":"La chaise gaming  est dot\u00e9e d'un support lombaire amovible, qui peut prot\u00e9ger efficacement la colonne vert\u00e9brale et le cou. L'oreiller lombaire avec fonction de massage produit plus de 20000 vibrations par heure pour soulager efficacement la fatigue pendant un travail ou un gaming. L'oreiller lombaire a un c\u00e2ble USB pour se connecter \u00e0 la prise de courant. L'interrupteur sur le cordon vous permet d'activer et de d\u00e9sactiver la fonction de massagePOSTURE CONFORTABLE - Il s'agit d'une v\u00e9ritable chaise gamer pour les passionn\u00e9s de gamers! Ce chaise gaming massante offre un soutien total de la t\u00eate aux pieds. L'angle du dossier peut \u00eatre facilement ajust\u00e9 de 90\u00b0 \u00e0 135\u00b0. Le repose-pieds, l'appui-t\u00eate et l'oreiller lombaire vous permettent de vous allonger en attendant que votre f\u00eate soit enfin en ligne. Le dossier et les accoudoirs sont enti\u00e8rement rembourr\u00e9s de \u00e9ponge pour fournir un soutien ad\u00e9quat pour la colonne vert\u00e9brale et les coudesREMBOURR\u00c9 - Le dossier et les accoudoirs sont en \u00e9ponge enti\u00e8rement \u00e9lastique et ne se d\u00e9forment pas, vous pouvez donc profiter longtemps de cette siege gaming. La selle est en \u00e9ponge de 8 cm d'\u00e9paisseur qui offre une densit\u00e9 d'assise constante pour les longues sessions. Le cuir PU perfor\u00e9 avec un aspect fibre de carbone assure la respirabilit\u00e9 pour les joueurs \u00e0 long terme. Nos chaise gaming massage avec motif en V de l'appui-t\u00eate au soutien lombaire, symbolisant la victoire",
         "material":"Cuir PU",
         "color":"Noir",
         "price":"179.99",
         "stock":40,
         "average_rating":"0.0",
         "number_of_ratings":0,
         "vendor_code":"CHS-DS-003",
         "images":"{\r\n  \"main_image\": \"\/assets\/img\/products\/product_3_main_image.jpg\",\r\n  \"other_images\": [\r\n    \"\/assets\/img\/products\/product_3_image_1.jpg\",\r\n    \"\/assets\/img\/products\/product_3_image_2.jpg\",\r\n    \"\/assets\/img\/products\/product_3_image_3.jpg\",\r\n    \"\/assets\/img\/products\/product_3_image_4.jpg\"\r\n  ]\r\n}",
         "quantity":16
      }
   ],
   "totalProducts":23
}

*/

require_once $_SERVER['DOCUMENT_ROOT'] . "/controller/php/classes/Database.class.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controller/php/classes/crudProduct.class.php";

// Start a session if it hasn't already been started
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}

// Check if cart exists in session
if (!isset($_SESSION['cart'])) {
   echo json_encode(['cart' => []]);
   exit;
}

$cartId =
   // Get the cart contents from the session
   $cartContents = $_SESSION['cart'];

$cartJson = json_encode(['cart' => $cartContents]);

$conn = Database::connect();

$product = new crudProduct();
$cartContent = $product->getProductsByCartJson($conn, $cartJson);
echo json_encode($cartContent);

// Return the cart contents as JSON
//
exit;
