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

$sql = $conn->prepare("SELECT mail FROM users WHERE mail = :mail");
$sql->execute(
    array(
        'mail' => $mail
    )
);
if($sql->rowCount() > 0){
    header('Location: ../../src/signUp.php?error=mailAlreadyUsed&name='.$name.'&firstname='.$firstname.'&phone='.$phone.'&adress='.$adress.'&postalCode='.$postalCode.'&city='.$city);
    exit();
}
$sql->closeCursor();

$sql = $conn->prepare("SELECT phone FROM users WHERE phone = :phone");
$sql->execute(
    array(
        'phone' => $phone
    )
);
if($sql->rowCount() > 0){
    header('Location: ../../src/signUp.php?error=phoneAlreadyUsed&name='.$name.'&firstname='.$firstname.'&mail='.$mail.'&adress='.$adress.'&postalCode='.$postalCode.'&city='.$city);
    exit();
}
$sql->closeCursor();

$sql = $conn->prepare("INSERT INTO users (name, firstname, mail, phone, adress, password) VALUES (:name, :firstname, :mail, :phone, :adress, :password)");
$sql->execute(
    array(
        'name' => $name,
        'firstname' => $firstname,
        'mail' => $mail,
        'phone' => $phone,
        'adress' => $adress,
        'password' => $passwordHash
    )
);
$sql->closeCursor();
header('Location: ../../src/signIn.php?mail='.$mail);
?>