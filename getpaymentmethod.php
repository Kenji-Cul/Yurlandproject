<?php 
$plan = "none";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['payment']) && !empty($_POST['payment'])){
        $plan = $_POST['payment'];
        if($plan == "offline payment"){
            echo "offline payment";
        } 
        if($plan == "online payment"){
            echo "online payment";
        } 
    }
}
?>