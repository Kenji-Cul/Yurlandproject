<?php 
$plan = "none";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['payment']) && !empty($_POST['payment'])){
        $plan = $_POST['payment'];
        if($plan == "outright payment"){
            echo "outright payment";
        } 
        if($plan == "subscription payment"){
            echo "subscription payment";
        } 
    }
}
?>