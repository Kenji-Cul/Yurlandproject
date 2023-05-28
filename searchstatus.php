<?php 
include_once "projectlog.php";
$user = new User;
if($_GET['data'] == "Failed"){
    if($_GET['user'] == "superadmin"){
        $land = $user->searchFailedTransactions($_GET['data'],$_GET['user'],$_GET['unique']);
    }

    if($_GET['user'] == "subadmin2" || $_GET['user'] == "supadmin2" || $_GET['user'] == "agent2"){
        $land = $user->searchFailedTransactions3($_GET['data'],$_GET['user'],$_GET['unique'],$_GET['userid']);
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

    if($_GET['user'] == "subadmin2" || $_GET['user'] == "supadmin2" || $_GET['user'] == "agent2"){
        $land = $user->searchSuccessfulTransactions3($_GET['data'],$_GET['user'],$_GET['unique'],$_GET['userid']);
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

    if($_GET['user'] == "subadmin2" || $_GET['user'] == "supadmin2" || $_GET['user'] == "agent2"){
        $land = $user->searchDeletedTransactions3($_GET['data'],$_GET['user'],$_GET['unique'],$_GET['userid']);
    }

    if($_GET['user'] == "agent" || $_GET['user'] == "normaluser"){
        $land = $user->searchDeletedTransactions2($_GET['data'],$_GET['user'],$_GET['unique']);
    }
}

if($_GET['data'] == "Pending" || $_GET['data'] == "Paid"){
    if($_GET['user'] == "customer"){
        $land = $user->selectUserEarningStatus($_GET['data']);
    }

    if($_GET['user'] == "agent"){
        $land = $user->selectUserEarningStatus2($_GET['data']);
    }

    if($_GET['user'] == "executive"){
        $type = "executive";
        $land = $user->selectUserEarningStatus3($_GET['data'],$_GET['execuser'],$type);
    }

    if($_GET['user'] == "customeruser"){
        $type = "customer";
        $land = $user->selectUserEarningStatus3($_GET['data'],$_GET['customeruser'],$type);
    }

    if($_GET['user'] == "yurland"){
        $type = "Yurland";
        $land = $user->selectUserEarningStatus3($_GET['data'],$_GET['yurlanduser'],$type);
    }
}