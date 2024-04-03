<?php
include 'connBDD.php';

$mail = $_POST['email'];
$password = $_POST['password'];

$sql = $conn->prepare("SELECT * FROM users WHERE mail = :mail");
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
    header('Location: ../../index.php');
} else {
    echo "Email or password incorrect";
}
?>