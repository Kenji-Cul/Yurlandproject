<?php 
$plan = "none";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['submethod']) && !empty($_POST['submethod'])){
        $plan = $_POST['submethod'];
        if($plan == "autodebit"){
            echo "autodebit";
        } 
        if($plan == "manually"){
            echo "manually";
        } 
    }
}
?>