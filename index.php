<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

include 'users/usersController.php';
include 'orders/ordersController.php';
include 'cloth/clothController.php';
include 'basket/basketController.php';

$type = $_GET['q'];


// Users
if ($type === 'users/getall') {
    echo json_encode($usersController->getAll());
}

if ($type === 'users/getonebyid') {
    echo json_encode($usersController->getOne($_GET['userid']));
}

if ($type === 'users/getonebylogin') {
    echo json_encode($usersController->getOneByLogin($_GET['userlogin']));
}

if ($type === 'users/addone') {
    $login = $_GET['login'];
    $pass = $_GET['pass'];
    $email = $_GET['email'];

    echo json_encode($usersController->addOne($login, $pass, $email));
}

// orders
if ($type === 'orders/getall') {
    echo json_encode($ordersController->getAll());
}

if ($type === 'orders/getone') {
    echo json_encode($ordersController->getOne($_GET['userid']));
}

// cloth
if ($type === 'cloth/getall') {
    echo json_encode($clothController->getAll());
}

if ($type === 'cloth/getone') {
    echo json_encode($clothController->getOne($_GET['clothid']));
}

// basket
if ($type === 'basket/getall') {
    echo json_encode($basketController->getAll());
}

if ($type === 'basket/getone') {
    echo json_encode($basketController->getOne($_GET['userid']));
}

if ($type === 'basket/addone') {
    $userid = $_GET['userid'];
    $clothid = $_GET['clothid'];

    echo json_encode($basketController->addOne($userid, $clothid, 1));

}

if ($type === 'basket/deleteone') {
    $busketid = $_GET['busketid'];
    $clothid = $_GET['clothid'];
    
    echo json_encode($basketController->deleteOne($busketid, $clothid));
}

// admin panel

if ($type === 'shop/deleteone') {
    $clothid = $_GET['clothid'];
    
    echo json_encode($clothController->deleteOne($clothid));
}

if ($type === 'shop/addcloth') {
    $header = $_GET['header'];
    $cost = $_GET['cost'];
    
    echo json_encode($clothController->addOne($header, $cost, 'static/default.jpg'));
}
?>