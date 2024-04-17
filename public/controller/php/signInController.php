<?php
$mail = $_POST['email'];
$password = $_POST['password'];

$conn = Database::connect();

$sql = $conn->prepare("SELECT * FROM customer WHERE email = :mail");
$sql->execute(
    array(
        'mail' => $mail
    )
);
$result = $sql->fetch(PDO::FETCH_ASSOC);
if ($result){
    $id = $result['customer_id'];
    $_SESSION['user'] = $id;
    header('Location: '.$router->generate('accueil'));
} else {
    echo "Email or password incorrect";
}
?>