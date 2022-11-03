<?php 
$interval = "none";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['mode']) && !empty($_POST['mode'])){
        $interval = $_POST['mode'];
        if($interval == "daily"){
            echo "daily";
        } 
        if($interval == "weekly"){
            echo "weekly";
        } 
        if($interval == "monthly"){
            echo "monthly";
        } 
        if($interval == "annually"){
            echo "annually";
        } 
    }
}
?>