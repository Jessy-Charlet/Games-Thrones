<?php
session_start();
include 'classes/CrudUser.class.php';
include 'classes/Database.class.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $isEmailChanged = $isPhoneChanged = $isPasswordChanged = $isAddressChanged = $isNameChanged = $isFirstnameChanged = $isPostalCodeChanged = $isCityChanged = null;

    if(isset($_POST['email'])){
        $isEmailChanged = $_POST['email'];
    }
    if(isset($_POST['phone'])){
        $isPhoneChanged = $_POST['phone'];
    }
    if(isset($_POST['password'])){
        $isPasswordChanged = $_POST['password'];
    }
    if(isset($_POST['adresse'])){
        $isAddressChanged = $_POST['adresse'];
    }
    if(isset($_POST['nameId'])){
        $isNameChanged = $_POST['nameId'];
    }
    if(isset($_POST['firstname'])){
        $isFirstnameChanged = $_POST['firstname'];
    }
    if(isset($_POST['postalCode'])){
        $isPostalCodeChanged = $_POST['postalCode'];
    }
    if(isset($_POST['city'])){
        $isCityChanged = $_POST['city'];
    }
    $id = $_SESSION['user'];
    $user = new CrudUser();
    $user->updateUser($id, $isEmailChanged, $isPhoneChanged, $isPasswordChanged, $isAddressChanged, $isNameChanged, $isFirstnameChanged, $isPostalCodeChanged, $isCityChanged);
}
?>