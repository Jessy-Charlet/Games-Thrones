<?php
include 'connBDD.php';

$mail = $_POST['email'];
$password = $_POST['password'];

$sql = $conn->prepare("SELECT * FROM customer WHERE email = :mail");
$sql->execute(
    array(
        'mail' => $mail
    )
);
$result = $sql->fetch(PDO::FETCH_ASSOC);
if ($result){
    session_start();
    $id = $result['id'];
    $_SESSION['user'] = $id;
    header('Location: '.$router->generate('acceuil'));
} else {
    echo "Email or password incorrect";
}
?>