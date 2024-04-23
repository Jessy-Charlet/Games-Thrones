<?php
$name = $_POST['name'];
$firstname = $_POST['firstname'];
$mail = $_POST['email'];
$phone = $_POST['phone'];
$adress = $_POST['adress'];
$postalCode = $_POST['postalCode'];
$city = $_POST['city'];
$password = $_POST['password'];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new CrudUser();
    $user->createUser($name, $firstname, $mail, $phone, $adress, $postalCode, $city, $password);
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