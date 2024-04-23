<?php
session_start();
include 'classes/CrudUser.class.php';
include 'classes/Database.class.php';

<<<<<<< Updated upstream
$conn = Database::connect();

$sql = $conn->prepare("SELECT * FROM customer WHERE email = :mail");
$sql->execute(
    array(
        'mail' => $mail
    )
);
$result = $sql->fetch(PDO::FETCH_ASSOC);
if ($result){
    $id = $result['customer_id'];
    $firstName = $result['customer_first-name'];
    $_SESSION['user'] = $id;
    $_SESSION['userFirstName'] = $firstName;
    header('Location: '.$router->generate('accueil'));
} else {
    echo "Email or password incorrect";
=======

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['email'])){
        $isEmailChanged = $_POST['email'];
    }
    if(isset($_POST['password'])){
        $isPasswordChanged = $_POST['password'];
    }

    $user = new CrudUser();
    $user->connectionUser($isEmailChanged, $isPasswordChanged);
>>>>>>> Stashed changes
}
?>