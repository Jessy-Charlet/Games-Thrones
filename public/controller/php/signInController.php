<?php
require 'classes/Database.class.php';
require 'classes/CrudUser.class.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = $_POST['email'];
    $password = $_POST['password'];

    $user = new CrudUser();
    $testConn = $user->testConnectionUser($mail, $password);

    if ($testConn == "success") {
        session_start();
        $_SESSION['user'] = $user->getCustomer_id();
        $_SESSION['userFirstName'] = $user->getFirstname();
        echo json_encode(
            array(
                'status' => 'success',
                'error' => 'none'
            )
        );
    } elseif ($testConn == "wrongPassword") {
        echo json_encode(
            array(
                'status' => 'error',
                'error' => 'wrongPassword'
            )
        );
    } elseif ($testConn == "mailNotFound") {
        echo json_encode(
            array(
                'status' => 'error',
                'error' => 'mailNotFound'
            )
        );
    } elseif ($testConn == "successAdmin") {
        session_start();
        $_SESSION['user'] = $user->getCustomer_id();
        $_SESSION['userFirstName'] = $user->getFirstname();
        $_SESSION['admin'] = true;
        echo json_encode(
            array(
                'status' => 'success',
                'error' => 'none'
            )
        );
    }
}
