<?php
include 'connBDD.php';

$name = $_POST['name'];
$firstname = $_POST['firstname'];
$mail = $_POST['email'];
$phone = $_POST['phone'];
$adress = $_POST['adress'];
$postalCode = $_POST['postalCode'];
$city = $_POST['city'];
$password = $_POST['password'];
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$sql = $conn->prepare("SELECT email FROM customer WHERE email = :email");
$sql->execute(
    array(
        'email' => $mail
    )
);
if($sql->rowCount() > 0){
    header('Location: '.$router->generate('inscription').'?error=mailAlreadyUsed&name='.$name.'&firstname='.$firstname.'&phone='.$phone.'&adress='.$adress.'&postalCode='.$postalCode.'&city='.$city);
    exit();
}
$sql->closeCursor();

$sql = $conn->prepare("SELECT phone FROM customer WHERE phone = :phone");
$sql->execute(
    array(
        'phone' => $phone
    )
);
if($sql->rowCount() > 0){
    header('Location: '.$router->generate('inscription').'?error=phoneAlreadyUsed&name='.$name.'&firstname='.$firstname.'&mail='.$mail.'&adress='.$adress.'&postalCode='.$postalCode.'&city='.$city);
    exit();
}
$sql->closeCursor();

try {
    $conn->beginTransaction();

    // Insertion du client
    $insertCustomer = $conn->prepare("INSERT INTO customer (`customer_last-name`, `customer_first-name`, email, phone, password) VALUES (:customer_last_name, :customer_first_name, :email, :phone, :password)");
    $insertCustomer->execute(
        array(
            'customer_last_name' => $name,
            'customer_first_name' => $firstname,
            'email' => $mail,
            'phone' => $phone,
            'password' => $passwordHash
        )
    );

    // Récupération de l'ID du client inséré
    $customerId = $conn->lastInsertId();

    // Insertion de l'adresse
    $insertAddress = $conn->prepare("INSERT INTO adress (city, postal_code, adress, customer_id, postal_code_id) 
                                    SELECT :city, :postal_code, :adress, :customer_id, postal_code_id 
                                    FROM postal_code WHERE postal_code = :postal_code");
    $insertAddress->execute(
        array(
            'city' => $city,
            'postal_code' => $postalCode,
            'adress' => $adress,
            'customer_id' => $customerId
        )
    );
    session_start();
    $_SESSION['user'] = $customerId;
    header('Location: '.$router->generate('accueil'));
    // Commit des transactions
    $conn->commit();
} catch(PDOException $e) {
    // En cas d'erreur, annulation des transactions
    $conn->rollback();
    throw $e;
}
?>