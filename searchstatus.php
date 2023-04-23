<?php 
include_once "projectlog.php";
$user = new User;
if($_GET['data'] == "Failed"){
    if($_GET['user'] == "superadmin"){
        $land = $user->searchFailedTransactions($_GET['data'],$_GET['user'],$_GET['unique']);
    }
    
    if($_GET['user'] == "subadmin"){
        $land = $user->searchFailedTransactions($_GET['data'],$_GET['user'],$_GET['unique']);
    }

      
    if($_GET['user'] == "agent" || $_GET['user'] == "normaluser"){
        $land = $user->searchFailedTransactions2($_GET['data'],$_GET['user'],$_GET['unique']);
    }
}

if($_GET['data'] == "Success"){
    if($_GET['user'] == "superadmin"){
        $land = $user->searchSuccessfulTransactions($_GET['data'],$_GET['user'],$_GET['unique']);
    }
    
    if($_GET['user'] == "subadmin"){
        $land = $user->searchSuccessfulTransactions($_GET['data'],$_GET['user'],$_GET['unique']);
    }

    if($_GET['user'] == "agent" || $_GET['user'] == "normaluser"){
        $land = $user->searchSuccessfulTransactions2($_GET['data'],$_GET['user'],$_GET['unique']);
    }
}

if($_GET['data'] == "Deleted"){
    if($_GET['user'] == "superadmin"){
        $land = $user->searchDeletedTransactions($_GET['data'],$_GET['user'],$_GET['unique']);
    }
    
    if($_GET['user'] == "subadmin"){
        $land = $user->searchDeletedTransactions($_GET['data'],$_GET['user'],$_GET['unique']);
    }

    if($_GET['user'] == "agent" || $_GET['user'] == "normaluser"){
        $land = $user->searchDeletedTransactions2($_GET['data'],$_GET['user'],$_GET['unique']);
    }
}