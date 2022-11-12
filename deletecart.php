<?php session_start();

$product_id=$_GET['productid'];

if(!empty($product_id)){

	if(empty($_SESSION['cart'])){
		$_SESSION['cart']=[];
	}

	if(empty($_SESSION['cart'][$product_id]))
	{
		$_SESSION['cart']=[];
	}else{
		$_SESSION['cart']=[$product_id];
	}
// die("I got here");
	header("Location: showcart.php");

	//echo "<pre>".print_r($_SESSION['cart'],1)."</pre>";
}



?>