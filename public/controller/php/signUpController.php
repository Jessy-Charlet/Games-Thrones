<?php
session_start();
include 'classes/CrudUser.class.php';
include 'classes/Database.class.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $mail = $_POST['email'];
    $phone = $_POST['phone'];
    $adress = $_POST['adress'];
    $postalCode = $_POST['postalCode'];
    $city = $_POST['city'];
    $password = $_POST['password'];

    $user = new CrudUser();
    $user->createUser($name, $firstname, $mail, $phone, $adress, $postalCode, $city, $password);
}
?>