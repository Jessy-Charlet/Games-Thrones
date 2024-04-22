<?php
session_start();
include 'classes/CrudUser.class.php';
include 'classes/Database.class.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $isEmailChanged = $isPhoneChanged = $isPasswordChanged = $isAddressChanged = $isNameChanged = $isFirstnameChanged = $isPostalCodeChanged = $isCityChanged = null;

    if(isset($_POST['changeEmail'])){
        $isEmailChanged = $_POST['changeEmail'];
    }
    if(isset($_POST['changePhone'])){
        $isPhoneChanged = $_POST['changePhone'];
    }
    if(isset($_POST['changePassword'])){
        $isPasswordChanged = $_POST['changePassword'];
    }
    if(isset($_POST['changeAdresse'])){
        $isAddressChanged = $_POST['changeAdresse'];
    }
    if(isset($_POST['changeName'])){
        $isNameChanged = $_POST['changeName'];
    }
    if(isset($_POST['changeFirstname'])){
        $isFirstnameChanged = $_POST['changeFirstname'];
    }
    if(isset($_POST['changePostalCode'])){
        $isPostalCodeChanged = $_POST['changePostalCode'];
    }
    if(isset($_POST['changeCity'])){
        $isCityChanged = $_POST['changeCity'];
    }
    $id = $_SESSION['user'];
    $user = new CrudUser();
    $user->updateUser($id, $isEmailChanged, $isPhoneChanged, $isPasswordChanged, $isAddressChanged, $isNameChanged, $isFirstnameChanged, $isPostalCodeChanged, $isCityChanged);
}
?>