<?php
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

    if($check == "subscription.create"){
        $user = new User;
        $land = $user->selectEmail($email);
        $landuse = $user->selectProductPayment($product,$land['unique_id']);
        foreach($landuse as $key => $value){
            $balance = $value['product_price'] + $amount;
            $sub = $user->insertPayment2($land['unique_id'],$product,$balance); 
        }
        
    
    
    }
?>