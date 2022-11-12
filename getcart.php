<?php 
include "projectlog.php";
session_start();
if(isset($_SESSION['unique_id'])){
    $user = new User;
    $cart = $user->selectCart($_SESSION['unique_id']);
    foreach ($cart as $key => $value) {
        echo $value;
        };
}
// if(isset($_SESSION['cart'])){
// foreach ($_SESSION['cart'] as $key => $value) {
    
//    };
//    echo count($_SESSION['cart']);
// // echo $_SESSION['unique_id'];
// } 
// if(!isset($_SESSION['cart']))
// {
    
// }

?>