<?php
session_start();
include "projectlog.php";
    // Retrieve the request's body and parse it as JSON
    $input = @file_get_contents("php://input");
    $event = json_decode($input);
    // Do something with $event
    $event = json_decode($input);
    $status = $event->data->status;
    $customer_code = $event->data->customer->customer_code;
    $plan = $event->data->plan->plan_code;
    $name = $event->data->plan->name;
    $amount = $event->data->plan->amount;
     $product = substr($name, 0, 12);
    $email = $event->data->customer->email;
    $check = $event->event;
    $paymentmethod = "Subscription";
    $land = $user->selectEmail($email);
     
       
        $landuse = $user->selectProductPayment($product,$land['unique_id']);
    $paymentmonth = date("M");
        $paymentday = date("d");
        $paymentyear = date("Y");
        $paymenttime = date("h:i a");
        $paymentdate = date("M-d-Y");

    if($check == "subscription.create"){
        $user = new User;
        
        foreach($landuse as $key => $value){
            $balance = $value['product_price'] + $amount;
            $sub = $user->insertPayment2($land['unique_id'],$product,$balance,$land['allocation_fee']); 
           
            $inserthistory = $land->insertPayHistory($land['unique_id'],$value['product_id'],$value['product_name'],$paymentmonth,$paymentday,$paymentyear,$paymenttime,$value['product_location'],$value['product_price'],$value['product_image'],$value['product_unit'],$paymentmethod,$paymentdate,$value['product_plan'],$value['sub_period'],$value['product_price'],$value['payee'],$value['agent_id']);
        }
        
    
    
    }
?>