<?php 
$pricemode = "none";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['mode']) && !empty($_POST['mode'])){
        $pricemode = $_POST['mode'];
        if($pricemode == "OutPrice"){
            echo "OutPrice";
        } 
        if($pricemode == "sub"){
            echo "sub";
        } 
        if($pricemode == "outsub"){
            echo "outsub";
        } 
    }
}
?>