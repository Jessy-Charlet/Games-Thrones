<?php
session_start();
require 'classes/Database.class.php';
require 'classes/CrudUser.class.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_SESSION['user'];
    $mail = $_POST['email'];
    $password = $_POST['password'];

    $user = new CrudUser();
    $testConn = $user->testConnectionUser($mail, $password);

    if($testConn == "success"){
        if($user->checkRole($id) === true){
            $_SESSION['admin'] = true;
            echo json_encode(
                array(
                    'status' => 'success',
                    'error' => 'none'
                )
            );  
        }else{
            $_SESSION['user'] = $id;
            echo json_encode(
                array(
                    'status' => 'error',
                    'error' => 'notAdmin'
                )
            );
        }

    }elseif($testConn == "wrongPassword"){
        echo json_encode(
            array(
                'status' => 'error',
                'error' => 'wrongPassword'
            )
        );   
    }elseif($testConn == "mailNotFound"){
        echo json_encode(
            array(
                'status' => 'error',
                'error' => 'mailNotFound'
            )
        );
    }
}
?>