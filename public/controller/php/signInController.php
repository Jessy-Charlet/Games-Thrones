<?php
$mail = $_POST['email'];
$password = $_POST['password'];



$conn = Database::connect();

$sql = $conn->prepare("SELECT * FROM customer WHERE email = :mail AND password = :password");
$sql->execute(
    array(
        'mail' => $mail,
        'password' => $password
    )
);
$result = $sql->fetch(PDO::FETCH_ASSOC);
if ($result){
    $id = $result['customer_id'];
    $firstName = $result['customer_first-name'];
    $_SESSION['user'] = $id;
    $_SESSION['userFirstName'] = $firstName;
    header('Location: '.$router->generate('accueil'));
} else {
    echo "Email or password incorrect";
}
?>