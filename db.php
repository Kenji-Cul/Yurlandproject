<?php 

$dbcon = mysqli_connect("localhost","root","","land_estate");
        //check if the connection is okay
        if($dbcon){
           // echo "Connected Successfully";
        }else{
            die("connection failed");
        }

?>