<?php
include 'classes/Database.class.php';
include 'classes/CrudUser.class.php';

<<<<<<< Updated upstream

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
=======
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $mail = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $adresse = $_POST['adress'];
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $postalCode = $_POST['postalCode'];
    $city = $_POST['city'];
    $id = $_POST['id'];
    
>>>>>>> Stashed changes
    $user = new CrudUser();

    $testInsert = $user->testUpdateUser($id, $mail, $phone, $password);

    if($testInsert == 'mailAlreadyUsed'){
        echo json_encode(
            array(
                'status' => 'error',
                'error' => 'mailAlreadyUsed'
            )
        );
    }elseif($testInsert == 'wrongPassword'){
        echo json_encode(
            array(
                'status' => 'error',
                'error' => 'wrongPassword'
            )
        );
    }elseif($testInsert == 'phoneAlreadyUsed'){
        echo json_encode(
            array(
                'status' => 'error',
                'error' => 'phoneAlreadyUsed'
            )
        );
    }else{
        $user->updateUser($id, $mail, $phone, $password, $adresse, $name, $firstname, $postalCode, $city);

        session_start();
        $_SESSION['userFirstName'] = $user->getFirstname();
        echo json_encode(
            array(
                'status' => 'success',
                'error' => 'none'
            )
        );
    }

}