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
     $product = substr($name, 0, 12);
    $firstname = $event->data->customer->first_name;
    $lastname = $event->data->customer->last_name;
    $fullname = $firstname. ' '.$lastname;
    $createdat = $event->data->created_at;
    $month = date("m",strtotime($createdat));
    $year = date('Y', strtotime($createdat));
    $day = date('d', strtotime($createdat));
    $time=date('h:i a',strtotime($createdat));
    $email = $event->data->customer->email;
    $check = $event->event;

    if($check == "subscription.create"){
        $user = new User;
        $land = $user->selectEmail($email);
        $landview = $user->selectLandImage($land['uniqueid']);
        if(!empty($landview)){
            foreach($landview as $key => $value){ 
        $sub = $user->insertPayment2($land['unique_id'],$name,$productname,$month,$day,$year,$time,$value['product_location'],$value['product_price'],$value['product_price'],$value['payment_method']); 
    
    }}
    }
?>