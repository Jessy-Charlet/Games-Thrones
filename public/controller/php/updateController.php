<?php

if(isset($_GET['changeEmail'])){
    $isEmailChanged = $_GET['changeEmail'];
}
if(isset($_GET['changePhone'])){
    $isPhoneChanged = $_GET['changePhone'];
}
if(isset($_GET['changePassword'])){
    $isPasswordChanged = $_GET['changePassword'];
}
if(isset($_GET['changeAdresse'])){
    $isAddressChanged = $_GET['changeAdresse'];
}
if(isset($_GET['changeName'])){
    $isNameChanged = $_GET['changeName'];
}
if(isset($_GET['changeFirstname'])){
    $isFirstnameChanged = $_GET['changeFirstname'];
}
if(isset($_GET['changePostalCode'])){
    $isPostalCodeChanged = $_GET['changePostalCode'];
}
if(isset($_GET['changeCity'])){
    $isCityChanged = $_GET['changeCity'];
}



$id = $_SESSION['user'];
$user = new CrudUser();
$user->updateUser($id, $isEmailChanged, $isPhoneChanged, $isPasswordChanged, $isAddressChanged, $isNameChanged, $isFirstnameChanged, $isPostalCodeChanged, $isCityChanged);
header('Location: '.$router->generate('profil'));


?>