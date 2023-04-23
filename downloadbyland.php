<?php 
include_once "projectlog.php";
$user = new User;


if($_GET['mode'] == "downloadland"){
    $land = $user->downloadByLand($_POST['searchproduct2'],$_GET['mode']);
   
}

if($_GET['mode'] == "downloaddate"){
    $land = $user->downloadByMode($_GET['data'],$_GET['mode']);
   
}

if($_GET['mode'] == "downloadpayer"){
    $land = $user->downloadByMode($_POST['searchproduct'],$_GET['mode']);
   
}

if($_GET['mode'] == "downloadfailed"){
    $_GET['data'] = "Failed";
    $land = $user->downloadByMode($_GET['data'],$_GET['mode']);
   
}

if($_GET['mode'] == "downloadsuccess"){
    $_GET['data'] = "Success";
    $land = $user->downloadByMode($_GET['data'],$_GET['mode']);
   
}

if($_GET['mode'] == "downloaddeleted"){
    $_GET['data'] = "Deleted";
    $land = $user->downloadByMode($_GET['data'],$_GET['mode']);
   
}


    if($_GET['mode'] == "downloadearnname"){
        $land = $user->downloadByEarnMode($_POST['searchproduct'],$_GET['mode'],$_GET['user']);
       
    }
    
    if($_GET['mode'] == "downloadearndate"){
        $land = $user->downloadByEarnMode($_GET['data'],$_GET['mode'],$_GET['user']);
       
    }
    
    if($_GET['mode'] == "downloadearnrange"){
        $lastdays = date('M-d-Y', strtotime('today - '.$_GET['data'].' days'));
        $mode = "downloadearndate";
        $land = $user->downloadByEarnMode($lastdays,$mode,$_GET['user']);
       
    }