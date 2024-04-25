<?php
include 'classes/Database.class.php';
include 'classes/CrudUser.class.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $mail = $_POST['email'];
    $phone = $_POST['phone'];
    $adresse = $_POST['adress'];
    $postalCode = $_POST['postalCode'];
    $city = $_POST['city'];
    $password = $_POST['password'];
    $id = $_POST['id'];
    
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
        $user->updateUser($id, $name, $firstname, $mail, $phone, $adresse, $postalCode, $city, $password);

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