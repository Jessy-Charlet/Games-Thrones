<?php

require('./classes/Database.class.php');
$conn = Database::connect();
$selec = [];
if(isset($_GET['option'])){
    global $selec;
    global $conn;
    switch ($_GET['option']){
        case 'allCustomers':
            $selec = Database::getAllCustomer();
            break;
            case 'allOrders':
            //    $selec = Database::getAllorder();
                break;
            default:
            $selec = 'erreur test';
            break;
        }
    }
$conn = null;
header('Content-Type: application/json');
echo json_encode($selec);