<?php
include_once "projectlog.php";
include_once "xlsx.php";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
$excel = SimpleXLSX::parse($_FILES['image']['tmp_name']);

//print_r($excel->rows());
$i = 0;

       
        $earneridarray = [];
         $paidearningsarray = [];
         $balanceearningsarray = [];
         $amountearnedarray = [];
print_r($excel->sheetName(1));
foreach ($excel->rows() as $key => $row) {
  //print_r($row);
  $q = "";
  
  if($i == 0){

  } else {

         array_push($earneridarray,$row[2]);
            array_push($paidearningsarray,$row[7]);
          array_push($balanceearningsarray,$row[8]);
          array_push($amountearnedarray,$row[6]);
   
 
  }

  $i++;
} 





   array_map(function($data2, $data3, $data4, $data6) {
              
    
    $int1 = intval($data6);
    $int2 = intval($data4);
    $int3 = intval($data3);

    if($int1 == $int2 + $int3){
$user = new User;
$uploadexcel = $user->uploadExcel($data2,$data3,$data4,$data6);
    } else {
      echo "BadUpdate";
    }
            }, $earneridarray,$paidearningsarray,$balanceearningsarray,$amountearnedarray);
          
                  
}