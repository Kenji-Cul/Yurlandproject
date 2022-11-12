<?php 
$interval = "none";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['mode']) && !empty($_POST['mode'])){
        $interval = $_POST['mode'];
        if($interval == "onemonth"){
            echo "onemonth";
        } 
        if($interval == "threemonths"){
            echo "threemonths";
        } 
        if($interval == "sixmonths"){
            echo "sixmonths";
        } 
        if($interval == "twelvemonths"){
            echo "twelvemonths";
        } 
        if($interval == "eighteenmonths"){
            echo "eighteenmonths";
        } 
    }
}
?>