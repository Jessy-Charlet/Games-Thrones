<?php
require 'classes/Database.class.php';
require 'classes/CrudUser.class.php';
?>

<form method="post">
    <input type="email" id="email" name="email">
    <input type="password" id="password" name="password">
    <input type="submit">
</form>


<?php


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = $_POST['email'];
    $password = $_POST['password'];

    $user = new CrudUser();
    $user->connectionUser($mail, $password);

    session_start();
    $_SESSION['user'] = $user->getCustomer_id();
    $_SESSION['userFirstName'] = $user->getFirstname();

    echo json_encode(
        array(
            'status' => 'success',
            'sessionUser' => $user->getCustomer_id(),
            'sessionUserFirstName' => $user->getFirstname()
        )
    );
}
?>