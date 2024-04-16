<?php

$id = $_SESSION['user'];
$user = new Crud();
$user->update($id);
// header('Location: /profil');


?>