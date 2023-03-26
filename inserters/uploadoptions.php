<?php 
include_once "../projectlog.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $filename = $_FILES['firstimage']['name'];
    $unique = $_POST['unique'];
   
if(empty($filename)){
    $errormsg = "Please select your File";
}  

else {
     $superadmin = new User;
        $insertland = $superadmin->uploadOtherOptions($unique);
       
     
    

}

if(isset($errormsg)){
    echo $errormsg;
}
}

function check_input($data){
    $data = trim($data);
    $data = strip_tags($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>