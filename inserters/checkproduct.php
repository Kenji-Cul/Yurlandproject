<?php
include_once "../projectlog.php";
 session_start();
 

 if($_SERVER['REQUEST_METHOD'] == "POST"){
$product_id=$_POST['productid'];
$quantity = $_POST['quantity'];
$quantity++;

if(!empty($product_id)){

	// if(empty($_SESSION['cart'])){
	// 	$_SESSION['cart']=[];
	// }

	// if(empty($_SESSION['cart'][$product_id]))
	// {
	// 	$_SESSION['cart'][$product_id]=1;
	// }else{
	// 	$_SESSION['cart'][$product_id]++;
	// }


       
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] = $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id]++;
                $uniqueid = $_POST['productid'];
                $userid = $_POST['user'];
                if(!empty($uniqueid) || !empty($userid)){
                $user = new User;
                $insertuser = $user->addToCart($userid,$uniqueid);
                }
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
            $uniqueid = $_POST['productid'];
                $userid = $_POST['user'];
                if(!empty($uniqueid) || !empty($userid)){
                $user = new User;
                $insertuser = $user->addToCart($userid,$uniqueid);
                }
        }
    
       
    
// die("I got here");
	//header("Location: index.php");
    if(isset($_SESSION['cart'])){
        foreach ($_SESSION['cart'] as $key => $value) {
            
           };
           echo count($_SESSION['cart']);
        // echo $_SESSION['unique_id'];
        }

	//echo "<pre>".print_r($_SESSION['cart'],1)."</pre>";
}

 }


//  if($_SERVER['REQUEST_METHOD'] == 'POST'){
//     if(isset($_SESSION['cart'])){
//         foreach ($_SESSION['cart'] as $key => $value) {
          
//            };
          
//         // echo $_SESSION['unique_id'];
//         }


// }






if(isset($errormsg)){
echo $errormsg;
}



?>










// function check_input($data){
// $data = trim($data);
// $data = strip_tags($data);
// $data = stripslashes($data);
// $data = htmlspecialchars($data);
// return $data;
// }
// ?>