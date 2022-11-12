<?php
    // Retrieve the request's body and parse it as JSON
    $input = @file_get_contents("php://input");
    $event = json_decode($input);
    // Do something with $event
    $event = json_decode($input);
    $status = $event->data->status;
    $customer_code = $event->data->customer->customer_code;
    $plan = $event->data->plan->plan_code;
    $firstname = $event->data->customer->first_name;
    $lastname = $event->data->customer->last_name;
    $fullname = $firstname. ' '.$lastname;
    $createdat = $event->data->created_at;
    $email = $event->data->customer->email;
    $check = $event->event;

    if($check == "subscription.create"){

    }
?>