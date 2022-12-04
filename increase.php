<?php
include "projectlog.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $inc = $_POST['increase'];
    $customer = $_POST['customer'];
    $product = $_POST['product'];
    $user = new User;
    $increase = $user->updatePricePayment($customer,$product,$inc);
}