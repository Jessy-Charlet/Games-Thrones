<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "boutique";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué: " .

            $conn->connect_error);
    }

    $sql = "SELECT * FROM product";

    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
       
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row["product_id"];
            $product_name = $row["name"];    
            $image_data = $row["image"];
            $price = $row["price"];
            $rating = $row["rating"];

            $image_info = json_decode($image_data, true);
            $image_src = isset($image_info['main_image']) ? ".//" . $image_info['main_image'] : "";
          
            echo "<div class='card'>";
            echo "  <div class='cardTop'>";
            echo "    <a href='#'>"; 
            echo "      <img class='cardImg' src='$image_src' alt='$product_name'>";
            echo "    </a>";
            echo "  </div>";
            echo "  <div class='cardBottom'>";
            echo "    <a href='#' class='cardTitle'>$product_name</a>";
            echo "    <div class='priceRating'>";
            echo "      <div class='cardPrice cardPrice--common'>$price<span>€</span></div>";
            echo "      <div class='rating-mini'>";

            // Génère des étoiles de notation en fonction de la valeur récupérée
            for ($i = 0; $i < $rating; $i++) {
                echo "        <span class='active'></span>";
            }
            for ($i = $rating; $i < 5; $i++) {
                echo "        <span></span>"; 
            }
            echo "      </div>";
            echo "    </div>";
            echo "  </div>";
            echo "</div>";
        }
    } else {
        echo "No products found";
    }

    mysqli_close($conn);


    function calculateAverageRating($product_id, $conn)
    {
        $sql = "SELECT AVG(rating) AS average_rating FROM reviews WHERE prod_id = ?";
        $sth = mysqli_prepare($conn, $sql);
        $sth->bind_param('i', $product_id);
        $sth->execute();
        $result = $sth->get_result();
        $row = $result->fetch_assoc();
        return $row['average_rating'];
    }
    mysqli_close($conn);
    ?>
</body>

</html>