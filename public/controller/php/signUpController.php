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
<<<<<<< Updated upstream
    $user->createUser($name, $firstname, $mail, $phone, $adress, $postalCode, $city, $password);
=======

    $testInsert = $user->testInsertUser($mail, $phone);

    if($testInsert == 'mailAlreadyUsed'){
        echo json_encode(
            array(
                'status' => 'error',
                'error' => 'mailAlreadyUsed'
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
        $user->createUser($name, $firstname, $mail, $phone, $adress, $postalCode, $city, $password);
        session_start();
        $_SESSION['user'] = $user->getCustomer_id();
        $_SESSION['userFirstName'] = $user->getFirstname();
        echo json_encode(
            array(
                'status' => 'success',
                'error' => 'none'
            )
        );
    }
>>>>>>> Stashed changes
}
?>