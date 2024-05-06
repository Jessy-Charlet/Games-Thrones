<?php
if(isset($_SESSION['admin'])){
    // PAGE ADMIN
    








}elseif(isset($_SESSION['user'])){
    $id = $_SESSION['user'];

    $user = new CrudUser();

    if($user->checkRole($id) === false){
        header('Location: /');
    }else{
        header('Location: /gt-signIn');
    }
}
