<?php
include "projectlog.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $inc = $_POST['increase'];
    $customer = $_POST['customer'];
    $product = $_POST['product'];
    $newpayid = $_POST['newpayid'];
    $increasedate = $_POST['increasedate'];
    $user = new User;
    $increase = $user->updatePricePayment2($customer,$product,$inc,$newpayid,$increasedate);
}