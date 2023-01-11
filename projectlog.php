<?php 

/**
 * Author : Teibo Gideon Tamaraduobra
 * Program : Yurland Website
 * Date : Nov 5,2022
 */

include "signconstant.php";

 class User{
    var $username;
    var $useremail;
    var $dbcon;

    function __construct(){
        $this->dbcon = new MySqli(DB_SERVERNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
        if($this->dbcon->connect_error){
            die("Connection Failed: ".$this->dbcon->connect_error);
        } else{
           //echo "Connected Successfully";
        }
     }

     function createAgent($agentname,$agent_password,$referralid,$earningpercent,$email,$groupid){
        $uniqueid = rand();
        $pwd = password_hash($agent_password,PASSWORD_DEFAULT);
        $agentdate = date("M-d-Y");
          $sql = "INSERT INTO agent_table(uniqueagent_id,agent_name, agent_email,agent_password,referral_id,earning_percentage,agent_date,group_id) VALUES('{$uniqueid}','{$agentname}','{$email}','{$pwd}','{$referralid}','{$earningpercent}','{$agentdate}','{$groupid}')";
          $result = $this->dbcon->query($sql);
          if($this->dbcon->affected_rows == 1){
             echo "success";
          } else {
             echo $this->dbcon->error;
          }
     }
     

     function createExecutive($execname,$exec_password,$role,$earningpercent, $email){
        $uniqueid = rand();
        $pwd = password_hash($exec_password,PASSWORD_DEFAULT);
          $sql = "INSERT INTO executive(unique_id,full_name,executive_email,executive_password,earning,exec_role) VALUES('{$uniqueid}','{$execname}','{$email}','{$pwd}','{$earningpercent}','{$role}')";
          $result = $this->dbcon->query($sql);
          if($this->dbcon->affected_rows == 1){
             echo "success";
          } else {
             echo $this->dbcon->error;
          }
     }


     function createSuperAdmin($adminname,$adminpassword,$adminemail){
        $pwd = password_hash($adminpassword,PASSWORD_DEFAULT);
        $uniqueid = rand();
          $sql = "INSERT INTO super_admin(unique_id,super_adminname,super_adminpassword,super_adminemail) VALUES('{$uniqueid}','{$adminname}','{$pwd}','{$adminemail}')";
          $result = $this->dbcon->query($sql);
          if($this->dbcon->affected_rows == 1){
            session_start();
            session_unset();
            $_SESSION['uniquesupadmin_id'] = $uniqueid;
             echo "success";
          } else {
             echo $this->dbcon->error;
          }
     }


     function createSubAdmin($subadminname,$subadminpassword, $subadminemail, $subadminnum){
        $pwd = password_hash($subadminpassword,PASSWORD_DEFAULT);
        $uniqueid = rand();
          $sql = "INSERT INTO sub_admin(unique_id,subadmin_name,subadmin_password,subadmin_email,subadmin_num) VALUES('{$uniqueid}','{$subadminname}','{$pwd}','{$subadminemail}','{$subadminnum}')";
          $result = $this->dbcon->query($sql);
          if($this->dbcon->affected_rows == 1){
            session_start();
            session_unset();
            $_SESSION['uniquesubadmin_id'] = $uniqueid;
             echo "success";
          } else {
             echo $this->dbcon->error;
          }
     }

     
     function createUser($firstname, $lastname, $email, $phonenum,$password,$referral,$inforeferral){
        $pwd = password_hash($password,PASSWORD_DEFAULT);
        $uniqueid = rand();
        $userdate = date("M-d-Y");
        $sql = "INSERT INTO user(unique_id,first_name,last_name,email,phone_number,user_password,personal_ref, referral_id,user_date) VALUES('{$uniqueid}','{$firstname}', '{$lastname}', '{$email}', '{$phonenum}', '{$pwd}','{$referral}','{$inforeferral}','{$userdate}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
            session_start();
            session_unset();
            $_SESSION['unique_id'] = $uniqueid;
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
     }

      
     function createUser2($firstname, $lastname, $email, $phonenum,$password,$referral,$inforeferral){
        $pwd = password_hash($password,PASSWORD_DEFAULT);
        $uniqueid = rand();
        $userdate = date("M-d-Y");
        $sql = "INSERT INTO user(unique_id,first_name,last_name,email,phone_number,user_password,personal_ref, referral_id,user_date) VALUES('{$uniqueid}','{$firstname}', '{$lastname}', '{$email}', '{$phonenum}', '{$pwd}','{$referral}','{$inforeferral}','{$userdate}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
     }



     function updateUser($email,$password,$referralid,$uniqueid){
        $pwd = password_hash($password,PASSWORD_DEFAULT);
        $sql = "UPDATE user SET unique_id='{$uniqueid}',user_password='{$pwd}' WHERE email='{$email}' AND referral_id='{$referralid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
            session_start();
            session_unset();
            $_SESSION['unique_id'] = $uniqueid;
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
     }

     function updateUserInfo($firstname,$lastname,$email,$unique,$phonenum,$nin,$dob,$nfirstname,$nlastname,$nemail,$naddress,$nphone,$nrelation,$earning,$address){
        if(isset($_FILES['image'])){
            $filename = $_FILES['image']['name'];
            $filesize = $_FILES['image']['size'];
            $filetype = $_FILES['image']['type'];
            $file_error = $_FILES['image']['error'];
            $filetmp = $_FILES['image']['tmp_name'];
          // validate image
         
        
          
        
            $extensions = array("gif", "png", "jpeg", "svg", "jpg");
            $file_ext = explode(".",$filename);
            $file_ext = end($file_ext);

            $userphoto = "SELECT * FROM user WHERE unique_id = '{$unique}'";
            $result2 = $this->dbcon->query($userphoto);
            $row = $result2->fetch_assoc();
        
           
          
            if(!empty($filename)){
                  //upload document
            //$folder = "userdocuments/";
            $newfilename = time().rand().".".$file_ext;
            $destination_path = getcwd().DIRECTORY_SEPARATOR;
            $target_path = $destination_path . '../profileimage/'. basename($newfilename);
            //$destination = $folder.$newfilename;

                move_uploaded_file($filetmp, $target_path);
                $sql = "UPDATE user SET photo='{$newfilename}',first_name='{$firstname}', last_name='{$lastname}', email='{$email}',phone_number='{$phonenum}', home_address='{$address}', nin='{$nin}',dateofbirth='{$dob}', nextofkin_firstname='{$nfirstname}',nextofkin_lastname='{$nlastname}', nextofkin_email='{$nemail}',nextofkin_address='{$naddress}',nextofkin_phone='{$nphone}',nextofkin_relation='{$nrelation}',earning_percentage='{$earning}' WHERE unique_id='{$unique}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
            } else {
                 //upload document
            //$folder = "userdocuments/";
            $newfilename = $row['photo'];
            $destination_path = getcwd().DIRECTORY_SEPARATOR;
            $target_path = $destination_path . '../profileimage/'. basename($newfilename);
            //$destination = $folder.$newfilename;

                move_uploaded_file($filetmp, $target_path);
                $sql = "UPDATE user SET photo='{$newfilename}',first_name='{$firstname}', last_name='{$lastname}', email='{$email}',phone_number='{$phonenum}', home_address='{$address}', nin='{$nin}',dateofbirth='{$dob}', nextofkin_firstname='{$nfirstname}',nextofkin_lastname='{$nlastname}', nextofkin_email='{$nemail}',nextofkin_address='{$naddress}',nextofkin_phone='{$nphone}',nextofkin_relation='{$nrelation}',earning_percentage='{$earning}' WHERE unique_id='{$unique}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
                 
            }
            
        }

   
     }



     function createGroup($groupname,$grouphead,$grouplocation){
    if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $filetmp = $_FILES['image']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }
    
        if($filesize > 2097152){
            $error = "Your file should be less than 2mb";
            return $error;
        }
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../profileimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
            $uniqueid = rand();
    $sql = "INSERT INTO group_table(uniquegroup_id,group_name,group_head,group_location,group_img) VALUES('{$uniqueid}','{$groupname}','{$grouphead}','{$grouplocation}','{$newfilename}')";
    $result = $this->dbcon->query($sql);
    if($this->dbcon->affected_rows == 1){
       echo "success";
    } else {
       echo $this->dbcon->error;
    }
}
    }
}

function checkGroupName($name){
    $sql = "SELECT * FROM group_table WHERE group_name = '{$name}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
}

     function disableAgent($agentid){
        $sql = "UPDATE agent_table SET agent_status = 'Disabled' WHERE uniqueagent_id='{$agentid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
     }

     function enableAgent($agentid){
        $sql = "UPDATE agent_table SET agent_status = 'Enabled' WHERE uniqueagent_id='{$agentid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
     }


     function updateAgentInfo($agentname,$agentnum,$email,$unique,$address,$earning,$groupid,$bankname,$accountnum,$accountname){
        if(isset($_FILES['image'])){
            $filename = $_FILES['image']['name'];
            $filesize = $_FILES['image']['size'];
            $filetype = $_FILES['image']['type'];
            $file_error = $_FILES['image']['error'];
            $filetmp = $_FILES['image']['tmp_name'];
          // validate image
         
        
            $extensions = array("gif", "png", "jpeg", "svg", "jpg");
            $file_ext = explode(".",$filename);
            $file_ext = end($file_ext);
        
            $userphoto = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$unique}'";
            $result2 = $this->dbcon->query($userphoto);
            $row = $result2->fetch_assoc();
        
           
          
            if(!empty($filename)){
        
            //upload document
            //$folder = "userdocuments/";
            $newfilename = time().rand().".".$file_ext;
            $destination_path = getcwd().DIRECTORY_SEPARATOR;
            $target_path = $destination_path . '../profileimage/'. basename($newfilename);
            //$destination = $folder.$newfilename;
            move_uploaded_file($filetmp, $target_path);

            $sql = "UPDATE agent_table SET agent_img='{$newfilename}',agent_name='{$agentname}', agent_num='{$agentnum}', agent_email='{$email}', home_address='{$address}',earning_percentage='{$earning}', group_id='{$groupid}',bank_name = '{$bankname}', account_number = '{$accountnum}', reg_account_name = '{$accountname}' WHERE uniqueagent_id='{$unique}'";
            $result = $this->dbcon->query($sql);
            if($this->dbcon->affected_rows == 1){
               echo "success";
            } else {
               echo $this->dbcon->error;
            }
        } else {

            //upload document
            //$folder = "userdocuments/";
            $newfilename = $row['agent_img'];
            $destination_path = getcwd().DIRECTORY_SEPARATOR;
            $target_path = $destination_path . '../profileimage/'. basename($newfilename);
            //$destination = $folder.$newfilename;
            move_uploaded_file($filetmp, $target_path);

            $sql = "UPDATE agent_table SET agent_img='{$newfilename}',agent_name='{$agentname}', agent_num='{$agentnum}', agent_email='{$email}', home_address='{$address}',earning_percentage='{$earning}', group_id='{$groupid}',bank_name = '{$bankname}', account_number = '{$accountnum}', reg_account_name = '{$accountname}' WHERE uniqueagent_id='{$unique}'";
            $result = $this->dbcon->query($sql);
            if($this->dbcon->affected_rows == 1){
               echo "success";
            } else {
               echo $this->dbcon->error;
            }

        }
        
  
    }
   
     }

     function updateLandInfo($productname,$purpose,$location,$unit,$unitprice,$unique){
        $sql = "UPDATE land_product SET product_name='{$productname}', purpose='{$purpose}', product_location='{$location}',product_unit='{$unit}', unit_price='{$unitprice}' WHERE unique_id='{$unique}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
     }

     function updateUserForReferral($firstname, $lastname, $email, $phonenum,$password,$referralid,$personalref){
        $pwd = password_hash($password,PASSWORD_DEFAULT);
        $uniqueid = rand();
        $userdate = date("M-d-Y");
        $sql = "INSERT INTO user(first_name,last_name,phone_number,unique_id,user_password,email,referral_id, personal_ref,user_date) VALUES('{$firstname}','{$lastname}','{$phonenum}','{$uniqueid}','{$pwd}','{$email}','{$referralid}','{$personalref}','{$userdate}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
            session_start();
            session_unset();
            $_SESSION['unique_id'] = $uniqueid;
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
     }


     function createReferralUser($referral, $email,$firstname,$lastname,$phone_num,$personalref){
        $unique = rand();
        $sql = "INSERT INTO user(referral_id,email,first_name,last_name,phone_number,unique_id,personal_ref) VALUES('{$referral}','{$email}','{$firstname}','{$lastname}','{$phone_num}','{$unique}','{$personalref}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
     }

     function checkReferral($referral, $email){
        $sql = "SELECT * FROM user WHERE email = '{$email}' AND referral_id = '{$referral}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
     }


   

     


     function checkEmailAddress($email){
        $sql = "SELECT * FROM user WHERE email ='{$email}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
      }

      function checkAgentEmailAddress($email){
        $sql = "SELECT * FROM agent_table WHERE agent_email ='{$email}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
      }


      function checkExecutiveEmailAddress($email){
        $sql = "SELECT * FROM executive WHERE executive_email ='{$email}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
      }


      function checkSubadminEmailAddress($email){
        $sql = "SELECT * FROM sub_admin WHERE subadmin_email ='{$email}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
      }

      function checkSuperadminEmailAddress($email){
        $sql = "SELECT * FROM super_admin WHERE super_adminemail ='{$email}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
      }




      function selectUser($uniqueid){
        $sql = "SELECT * FROM user WHERE unique_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

   

    function selectPurchasedLands(){
        $sql = "SELECT COUNT(unique_id) FROM land_product WHERE product_unit= 0";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectGroup($uniqueid){
        $sql = "SELECT * FROM group_table WHERE uniquegroup_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectAgentGroup($uniqueid){
        $sql = "SELECT * FROM agent_table WHERE group_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $rows = array();
            if($this->dbcon->affected_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return $rows;
            }
    }


    function selectEmail($uniqueid){
        $sql = "SELECT * FROM user WHERE email = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectUserEmail($uniqueid){
        $sql = "SELECT * FROM user WHERE unique_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectAgentEmail($uniqueid){
        $sql = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectReferralUser($referralid){
        $sql = "SELECT * FROM user WHERE personal_ref = '{$referralid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    

    function selectReferralAgent($referralid){
        $sql = "SELECT * FROM agent_table WHERE referral_id = '{$referralid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }


    function selectAgent($uniqueid){
        $sql = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    

    function selectAgentRef($uniqueid){
        $sql = "SELECT * FROM agent_table WHERE referral_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectUserRef($uniqueid){
        $sql = "SELECT * FROM user WHERE personal_ref = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }


    function selectExecutive($uniqueid){
        $sql = "SELECT * FROM executive WHERE unique_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectAgentCustomer($uniqueid){
        $sql = "SELECT * FROM user WHERE referral_id = '{$uniqueid}' ORDER BY user_id DESC";
        $result = $this->dbcon->query($sql);
        $rows = array();
            if($this->dbcon->affected_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return $rows;
            }
    }

    
    

    


    function selectSubadmin($uniqueid){
        $sql = "SELECT * FROM sub_admin WHERE unique_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectSupadmin($uniqueid){
        $sql = "SELECT * FROM super_admin WHERE unique_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }


    function login($email){
        $sql = "SELECT * FROM user WHERE email= '{$email}'";
        $result = $this->dbcon->query($sql);
      $row = $result->fetch_assoc();
      if($result->num_rows == 1){
          return $row;
      }else{
          return $row;
      }
    }

    function agentLogin($email){
        $sql = "SELECT * FROM agent_table WHERE agent_email= '{$email}'";
        $result = $this->dbcon->query($sql);
      $row = $result->fetch_assoc();
      if($result->num_rows == 1){
          return $row;
      }else{
          return $row;
      }
    }

    function executiveLogin($email){
        $sql = "SELECT * FROM executive WHERE executive_email= '{$email}'";
        $result = $this->dbcon->query($sql);
      $row = $result->fetch_assoc();
      if($result->num_rows == 1){
          return $row;
      }else{
          return $row;
      }
    }

    function subAdminLogin($name){
        $sql = "SELECT * FROM sub_admin WHERE subadmin_email= '{$name}'";
        $result = $this->dbcon->query($sql);
      $row = $result->fetch_assoc();
      if($result->num_rows == 1){
          return $row;
      }else{
          return $row;
      }
    }

    function superAdminLogin($name){
        $sql = "SELECT * FROM super_admin WHERE super_adminemail= '{$name}'";
        $result = $this->dbcon->query($sql);
      $row = $result->fetch_assoc();
      if($result->num_rows == 1){
          return $row;
      }else{
          return $row;
      }
    }


    function insertNextOfKin($nextofkinfirstname,$nextofkinlastname, $nextofkinemail, $nexofkinaddress, $nextofkinphone,$nextofkinrelation, $uniqueid){
         $sql = "UPDATE user SET nextofkin_firstname='{$nextofkinfirstname}', nextofkin_lastname='{$nextofkinlastname}', nextofkin_email='{$nextofkinemail}' , nextofkin_address='{$nexofkinaddress}', nextofkin_phone='{$nextofkinphone}', nextofkin_relation='{$nextofkinrelation}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }

    function insertUserAddress($homeaddress,$uniqueid){
        $sql = "UPDATE user SET home_address = '{$homeaddress}' WHERE unique_id='{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }

    function updatePhoneNum($phonenum,$uniqueid){
        $sql = "UPDATE user SET phone_number = '{$phonenum}' WHERE unique_id='{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }


   
      

    function insertDocuments($uniqueid,$nin){
        if(isset($_FILES['passport'])){
        $filename = $_FILES['passport']['name'];
        $filesize = $_FILES['passport']['size'];
        $filetype = $_FILES['passport']['type'];
        $file_error = $_FILES['passport']['error'];
        $filetmp = $_FILES['passport']['tmp_name'];
      // validate image
        
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
        

        $userphoto = "SELECT * FROM user WHERE unique_id = '{$uniqueid}'";
        $result2 = $this->dbcon->query($userphoto);
        $row = $result2->fetch_assoc();
       
    
        if(!empty($filename)){

        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../userdocuments/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        move_uploaded_file($filetmp, $target_path);

        $sql = "UPDATE user SET passport='{$newfilename}', nin='{$nin}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
            if(isset($error)){
                echo $error;
            }
              }
            } else {
                 //upload document
        //$folder = "userdocuments/";
        $newfilename = $row['passport'];
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../userdocuments/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        move_uploaded_file($filetmp, $target_path);

        $sql = "UPDATE user SET passport='{$newfilename}', nin='{$nin}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
            if(isset($error)){
                echo $error;
            }
              }
            }
    }
         
    
    }


    function insertLicense($uniqueid){
        if(isset($_FILES['passport'])){
        $filename = $_FILES['passport']['name'];
        $filesize = $_FILES['passport']['size'];
        $filetype = $_FILES['passport']['type'];
        $file_error = $_FILES['passport']['error'];
        $filetmp = $_FILES['passport']['tmp_name'];
      // validate image
       
    
        $extensions = array("pdf");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);

        $userphoto = "SELECT * FROM user WHERE unique_id = '{$uniqueid}'";
        $result2 = $this->dbcon->query($userphoto);
        $row = $result2->fetch_assoc();

        if(!empty($filename)){
           
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../documents/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        move_uploaded_file($filetmp, $target_path);

        $sql = "UPDATE user SET driver_license='{$newfilename}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
        } else {
               //upload document
        //$folder = "userdocuments/";
        $newfilename = $row['driver_license'];
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../documents/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        move_uploaded_file($filetmp, $target_path);

        $sql = "UPDATE user SET driver_license='{$newfilename}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
        }
    
    }
         
   
    }


    function updateUserDetails($uniqueid, $gender, $occupation, $date){
        if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $filetmp = $_FILES['image']['tmp_name'];
      // validate image
       
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        
        $userphoto = "SELECT * FROM user WHERE unique_id = '{$uniqueid}'";
        $result2 = $this->dbcon->query($userphoto);
        $row = $result2->fetch_assoc();
      
    
        if(!empty($filename)){
            //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../profileimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        move_uploaded_file($filetmp, $target_path);
        $sql = "UPDATE user SET photo='{$newfilename}', gender='{$gender}', occupation='{$occupation}', dateofbirth='{$date}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
        } else {
             //upload document
        //$folder = "userdocuments/";
        $newfilename = $row['photo'];
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../profileimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        move_uploaded_file($filetmp, $target_path);
        $sql = "UPDATE user SET photo='{$newfilename}', gender='{$gender}', occupation='{$occupation}', dateofbirth='{$date}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
        }
       
    }
         
    
    }



    function updateAgentDetails($uniqueid, $address, $num,$bankname,$accountnum,$accountname){
        if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $filetmp = $_FILES['image']['tmp_name'];
      // validate image
      
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        $userphoto = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$uniqueid}'";
            $result2 = $this->dbcon->query($userphoto);
            $row = $result2->fetch_assoc();
        
    
            if(!empty($filename)){
                    //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../profileimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        move_uploaded_file($filetmp, $target_path);
    
         $sql = "UPDATE agent_table SET agent_img='{$newfilename}', home_address='{$address}', agent_num='{$num}', bank_name = '{$bankname}', account_number = '{$accountnum}', reg_account_name = '{$accountname}' WHERE uniqueagent_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
            } else {
                $newfilename = $row['agent_img'];
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../profileimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        move_uploaded_file($filetmp, $target_path);
    
        $sql = "UPDATE agent_table SET agent_img='{$newfilename}', home_address='{$address}', agent_num='{$num}', bank_name = '{$bankname}', account_number = '{$accountnum}', reg_account_name = '{$accountname}' WHERE uniqueagent_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
            }
       
            }
   
    }


    function updateExecutiveDetails($uniqueid){
        if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $filetmp = $_FILES['image']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }
    
        if($filesize > 2097152){
            $error = "Your file should be less than 2mb";
            return $error;
        }
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../profileimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
         $sql = "UPDATE executive SET executive_img='{$newfilename}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
     } 
    }
    }



    function updateSubadminDetails($uniqueid,$num){
        if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $filetmp = $_FILES['image']['tmp_name'];
      // validate image
       
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);

        $subphoto = "SELECT * FROM sub_admin WHERE unique_id = '{$uniqueid}'";
        $result6 = $this->dbcon->query($subphoto);
        $row = $result6->fetch_assoc();
    
        if(!empty($filename)){
              //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../profileimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        move_uploaded_file($filetmp, $target_path);

        $sql = "UPDATE sub_admin SET subadmin_image ='{$newfilename}', subadmin_num='{$num}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
        } else {
              //upload document
        //$folder = "userdocuments/";
        $newfilename = $row['subadmin_image'];
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../profileimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        move_uploaded_file($filetmp, $target_path);

        $sql = "UPDATE sub_admin SET subadmin_image ='{$newfilename}', subadmin_num='{$num}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
        }
       
    }
         
   
    }



    function updateSupadminDetails($uniqueid){
        if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $filetmp = $_FILES['image']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }
    
        if($filesize > 2097152){
            $error = "Your file should be less than 2mb";
            return $error;
        }
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../profileimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
         $sql = "UPDATE super_admin SET admin_image ='{$newfilename}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
     } 
    }
    }


    function selectReferredUsers($referral){
        $sql = "SELECT COUNT(referral_id) FROM user WHERE referral_id='{$referral}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectReferredCustomer($referral){
        $sql = "SELECT COUNT(referral_id) FROM user WHERE referral_id='{$referral}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    
    function selectReferredCustomer2($referral){
        $sql = "SELECT * FROM user WHERE referral_id='{$referral}'";
        $result = $this->dbcon->query($sql);
        $rows = array();
            if($this->dbcon->affected_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return $rows;
            }
    }


  
    function uploadProduct($productname,$outrightprice,$productdesc,$estatefeature,$productsize,$productlocation,$onemonth,$uniqueid,$purpose,$unitnumber,$budget,$allocationfee){
        $onemonthperiod = 30;
        $threemonthperiod = 90;
        $sixmonthperiod = 180;
        $twelvemonthperiod = 360;
        $eighteenmonthperiod = 540;
        if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $filetmp = $_FILES['image']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }
    
        if($filesize > 4194304){
            $error = "Your file should be less than 4mb";
            return $error;
        }
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../landimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
         $sql = "INSERT INTO land_product(unique_id,product_name,outright_price,product_image,product_description,estate_feature,product_size,product_location,onemonth_price,purpose,product_unit,product_budget,onemonth_period,threemonth_period,sixmonth_period,twelvemonth_period,eighteen_period,allocation_fee) VALUES('{$uniqueid}','{$productname}','{$outrightprice}','{$newfilename}','{$productdesc}','{$estatefeature}','{$productsize}','{$productlocation}','{$onemonth}','{$purpose}','{$unitnumber}','{$budget}','{$onemonthperiod}','{$threemonthperiod}','{$sixmonthperiod}','{$twelvemonthperiod}','{$eighteenmonthperiod}','{$allocationfee}')";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
     } 
    }
    }


    function uploadOutrightProduct($productname,$outrightprice,$productdesc,$estatefeature,$productsize,$productlocation,$uniqueid,$purpose,$unitnumber,$budget,$allocationfee){
        if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $filetmp = $_FILES['image']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }
    
        if($filesize > 4194304){
            $error = "Your file should be less than 4mb";
            return $error;
        }
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../landimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
         $sql = "INSERT INTO land_product(unique_id,product_name,outright_price,product_image,product_description,estate_feature,product_size,product_location,purpose,product_unit,product_budget,allocation_fee) VALUES('{$uniqueid}','{$productname}','{$outrightprice}','{$newfilename}','{$productdesc}','{$estatefeature}','{$productsize}','{$productlocation}','{$purpose}','{$unitnumber}','{$budget}','{$allocationfee}')";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
     } 
    }
    }


    function uploadSubProduct($productname,$productdesc,$estatefeature,$productsize,$productlocation,$onemonth,$uniqueid,$purpose,$unitnumber,$budget,$allocationfee){
        $onemonthperiod = 30;
        $threemonthperiod = 90;
        $sixmonthperiod = 180;
        $twelvemonthperiod = 360;
        $eighteenmonthperiod = 540;
        if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filesize = $_FILES['image']['size'];
        $filetype = $_FILES['image']['type'];
        $file_error = $_FILES['image']['error'];
        $filetmp = $_FILES['image']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }
    
        if($filesize > 4194304){
            $error = "Your file should be less than 4mb";
            return $error;
        }
    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../landimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
         $sql = "INSERT INTO land_product(unique_id,product_name,product_image,product_description,estate_feature,product_size,product_location,onemonth_price,purpose,product_unit,product_budget,onemonth_period,threemonth_period,sixmonth_period,twelvemonth_period,eighteen_period,allocation_fee) VALUES('{$uniqueid}','{$productname}','{$newfilename}','{$productdesc}','{$estatefeature}','{$productsize}','{$productlocation}','{$onemonth}','{$purpose}','{$unitnumber}','{$budget}','{$onemonthperiod}','{$threemonthperiod}','{$sixmonthperiod}','{$twelvemonthperiod}','{$eighteenmonthperiod}','{$allocationfee}')";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
     } 
    }
    }



    function uploadOtherOptions($uniqueid){
        if(isset($_FILES['firstimage'])){
        $filename = $_FILES['firstimage']['name'];
        $filesize = $_FILES['firstimage']['size'];
        $filetype = $_FILES['firstimage']['type'];
        $file_error = $_FILES['firstimage']['error'];
        $filetmp = $_FILES['firstimage']['tmp_name'];
      // validate image
        if($file_error > 0){
            $error = "You have not selected a file";
            return $error;
        }

       
    
        if($filesize > 4194304){
            $error = "Your file should be less than 4mb";
            return $error;
        }

    
        $extensions = array("gif", "png", "jpeg", "svg", "jpg");
        $file_ext = explode(".",$filename);
        $file_ext = end($file_ext);
    
        if(!in_array(strtolower($file_ext), $extensions)){
            $error = $file_ext."File format not supported";
            return $error;
        }
    
        //upload document
        //$folder = "userdocuments/";
        $newfilename = time().rand().".".$file_ext;
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../landimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        if(move_uploaded_file($filetmp, $target_path)){
         $sql = "UPDATE land_product SET image_one ='{$newfilename}' WHERE unique_id='{$uniqueid}'";
         $result = $this->dbcon->query($sql);
      
              //check if the connection runs successfully
              if($this->dbcon->affected_rows==1){
                //   echo "<h3 align='center'>Photo added successfully</h3>";
                echo "success";
              }else{
            echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
              }
     } 
    }
    }

    function selectLand(){
        $sql = "SELECT * FROM land_product ORDER BY product_id DESC";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    
   

    function selectAllUsers(){
        $sql = "SELECT * FROM user ORDER BY user_id DESC";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectAllGroups(){
        $sql = "SELECT * FROM group_table ORDER BY group_id DESC";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectAllRefUsers(){
        $sql = "SELECT COUNT(unique_id) FROM user WHERE referral_id !='Yurland'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectAllYurlandUsers(){
        $sql = "SELECT COUNT(unique_id) FROM user WHERE referral_id ='Yurland'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    
    function selectAllRefs(){
        $sql = "SELECT * FROM user WHERE referral_id !='Yurland'";
        $result = $this->dbcon->query($sql);
        $rows = array();
            if($this->dbcon->affected_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return $rows;
            }
    }


    function selectAllAgents(){
        $sql = "SELECT * FROM agent_table ORDER BY agent_id DESC";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectAllAgents2(){
        $sql = "SELECT * FROM agent_table FULL JOIN land_history WHERE uniqueagent_id = land_history.agent_id ORDER BY payment_id DESC";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectAgentTotalEarnings($unique){
        $sql = "SELECT SUM(product_price) FROM land_history WHERE agent_id = '{$unique}' ORDER BY payment_id DESC";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectAllUsers2(){
        $sql = "SELECT * FROM user FULL JOIN land_history WHERE unique_id = land_history.agent_id ORDER BY payment_id DESC";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectAllExecutives(){
        $sql = "SELECT * FROM executive";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectLandPrime(){
        $sql = "SELECT * FROM land_product  ORDER BY rand() LIMIT 5";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectLandImage($unique){
        $sql = "SELECT * FROM land_product WHERE unique_id='{$unique}'";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

   
    function selectSubProduct($uniqueid){
        $sql = "SELECT * FROM land_product WHERE unique_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    

    function selectSixMonthPrice(){
        $sql = "SELECT MAX(sixmonth_price) FROM land_product";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectMinPrice(){
        $sql = "SELECT MIN(sixmonth_price) FROM land_product WHERE sixmonth_price > 0";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectOneMonthPrice(){
        $sql = "SELECT MAX(onemonth_price) FROM land_product";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }


    function selectMinOneMonthPrice(){
        $sql = "SELECT MIN(onemonth_price) FROM land_product WHERE onemonth_price > 0";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }


    function selectLowestPrice(){
        $sql = "SELECT MIN(outright_price) FROM land_product WHERE outright_price > 0";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectHighestPrice(){
        $sql = "SELECT MAX(outright_price) FROM land_product";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }


    function searchForLand($price,$location,$purpose){
        $sql = "SELECT * FROM land_product WHERE product_budget = '{$price}' AND product_location = '{$location}' AND purpose = '{$purpose}'";
        $result = $this->dbcon->query($sql);
        $rows = array();
            if($this->dbcon->affected_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return $rows;
            }
    }


    function insertPeriod($onemonth,$threemonth,$sixmonth,$twelvemonth,$eighteenmonth,$eighteenpercentage,$twelvepercentage,$sixpercentage,$threepercentage,$onepercentage){
        $sql = "UPDATE land_product SET onemonth_period='{$onemonth}', threemonth_period='{$threemonth}', sixmonth_period='{$sixmonth}', twelvemonth_period='{$twelvemonth}', eighteen_period='{$eighteenmonth}',onemonth_percent='{$onepercentage}',threemonth_percent='{$threepercentage}', sixmonth_percent='{$sixpercentage}',twelvemonth_percent='{$twelvepercentage}',eighteen_percent='{$eighteenpercentage}' WHERE onemonth_price != 0";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows > 0){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    function selectPeriod(){
        $sql = "SELECT * FROM land_product WHERE onemonth_price !=0 ORDER BY product_id LIMIT 1";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectUnit($unique){
        $sql = "SELECT * FROM land_product WHERE unique_id='{$unique}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
          if($row['onemonth_price'] != 0){
            echo $row['onemonth_price'];
          } else {
            echo $row['outright_price'];
          }
        }else{
            return $row;
        }
    }

    function updateUnit($productunit,$unique,$boughtunit){
        $sql = "UPDATE land_product SET product_unit ='{$productunit}', bought_units='{$boughtunit}' WHERE unique_id='{$unique}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }

    function insertPayment($customerid,$productid,$productname,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$paymentdate,$chosenplan,$intervalinput,$subprice,$payee,$agentid,$allocationfee,$subperiod,$totalprice){
        $uniquename = rand();
        $filename = "offerletter".$uniquename.".doc";
        $sql = "INSERT INTO payment(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method,payment_date,product_plan,sub_period,sub_price,payee,agent_id,allocation_fee,offer_letter,period_num) VALUES('{$customerid}','{$productid}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$method}','{$paymentdate}','{$chosenplan}','{$intervalinput}','{$subprice}','{$payee}','{$agentid}','{$allocationfee}','{$filename}','{$subperiod}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
            $userphoto = "SELECT * FROM user WHERE unique_id = '{$customerid}'";
            $result2 = $this->dbcon->query($userphoto);
            $row2 = $result2->fetch_assoc();
         
    $newbalance = $totalprice;
    if($newbalance > 999 || $newbalance > 9999 || $balance > 99999 || $balance > 999999){
        $newbalance2 = number_format($newbalance);
      } else {
          $newbalance2 =  $newbalance;
      }
      if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
        $allocationfee2 = number_format($allocationfee);
      } else {
        $allocationfee2 =  round($allocationfee);
      }

      if($subprice > 999 || $subprice > 9999 || $subprice > 99999 || $subprice > 999999){
        $subprice2 = number_format($subprice);
      } else {
        $subprice2 =  round($subprice);
      }
    $myfile = fopen("".$filename."", "w");
$txt = '<html xmlns:v="urn:schemas-microsoft-com:vml" '
.'xmlns:o="urn:schemas-microsoft-com:office:office" '
.'xmlns:w="urn:schemas-microsoft-com:office:word" '
.'xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"= '
.'xmlns="http://www.w3.org/TR/REC-html40">'
.'<head><meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">'
.'<title></title>'
.'<!--[if gte mso 9]>'
.'<xml>'
.'<w:WordDocument>'
.'<w:View>Print'
.'<w:Zoom>100'
.'<w:DoNotOptimizeForBrowser/>'
.'</w:WordDocument>'
.'</xml>'
.'<![endif]-->'
.'<style>
@page
{
    font-family: Arial;
    size:215.9mm 279.4mm;  /* A4 */
    margin:14.2mm 17.5mm 14.2mm 16mm; /* Margins: 2.5 cm on each side */
}
h1 { font-family: Arial; font-size: 18px; text-align:center; }
h4 { font-family: Arial; font-size: 18px; text-align:left; }
h5 { font-family: Arial;  text-align:left; }
p.para {font-family: Arial; font-size: 13.5px; text-align: justify;}
.heading{font-weigth: 600; font-size: 20px;}
th,td{width: 180px;}
</style>'
.'</head>'
.'<body>'
.'<h1>yurLAND</h1><br/>'
.'<h4>Dear '.$row2['first_name'].' '.$row2['last_name'].'</h4><br/>'
.'<h1>ACKNOWLEDGEMENT LETTER AND TERMS OF CONDITION</h1><br/>'
.'<p class="para">'
.'Thank you for your interest in YURLAND. We write to affirm that we received your purchase request.
Do see below details of purchase and the terms and conditions attached.
.'
.'</p>' 
.'<h5>ESTATE NAME: '.$productname.'</h5><br/>'
.'<h5>LOCATION: '.$productlocation.'</h5><br/>'
.'<h5>DOCUMENTS ATTACHED: '.$filename.'</h5><br/>'
.'<h5>TOTAL COST:&nbsp;&#8358;'.$newbalance2.'</h5><br/>'
.'<h5>ALLOCATION FEE:&nbsp;&#8358;'.$allocationfee2.'</h5><br/>'
.'<h5>UNITS BOUGHT: '.$addedunit.'</h5><br/>'
.'<h5>DAILY PAYMENT:&nbsp;&#8358;'.$subprice2.'</h5><br/>'
.'<h5>PERIOD OF PAYMENT: '.$subperiod.'</h5><br/>'
.'<h5>START DATE: '.$paymentdate.'</h5><br/>'
.'<h1 class="heading">YurLAND TERMS AND CONDITIONS</h1><br/>'
.'<p class="para">'
.'These terms and conditions will serve as a basis of your customer relationship with us, yurLAND .By choosing to buy a LAND with us, you agree to the terms and conditions contained herein.You also confirm that you have provided us with the accurate and complete information required to create your account and that you have supplied all documentation,photographs and information that allow us to comply with our regulatory obligations.
If you do not agree to these terms and conditions, please do not proceed and exit the application immediately.Also,please be informed that we can terminate your relationship with us if we believe that you have violated any of these terms.
.'
.'</p>' 
.'<h4>ABOUT US</h4><br/>'
.'<p class="para">'
.'YurLAND, a Real Estate Product developed by Ilu-Oba International Limited “Real Estate company in Nigeria”, in partnership with Arklips Limited a tech base company into the development of tech related software to aid access into Logistics, Investments and Properties.
.'
.'</p>' 
.'<h4>Objectives Of Relationship</h4><br/>'
.'<p class="para">'
.'The objective of coming into a relationship with yurLAND is to partake from the real estate offers provided by Ilu-Oba Intl Ltd and Arklips Ltd for their customers.
As a customer, you have access to all offers provided by the two firms via the RealTech product yurLAND through the use of an internet enabled pc or smartphone.
.'
.'</p>' 
.'<h4>When are these terms applicable</h4><br/>'
.'<p class="para">'
.'These terms are applicable when you choose to buy a land on yurLAND and yurLAND prepares a customer database for you.

We may, at any time, modify the terms and conditions of our relationship but we will not do this without first informing you of such modification. All updates will be detailed on our website and our web app. You will be able to access the latest version of our terms at any given time.
.'
.'</p>'
.'<h1>Scope of Relationship Between yurLAND and her customers.</h1><br/>'
.'<h4>Making a purchase</h4><br/>'
.'<p class="para">'
.'You can make a purchase on our platform as long as you are a verified user with accurate database and proper documentation, own or have access to internet or be willing to work closely with any of our field sales agents who can help create and manage your account. We do not intentionally engage with users who do not meet these requirements
Our lands are sold in units, a unit is therefore equivalent to half a plot of land (250 - 300spm)
.'
.'</p>' 
.'<h4>Special Offer</h4><br/>'
.'<p class="para">'
.'Users who purchase up to 4 units at a single purchase transaction, gets one free unit. This offer is valid for all our estates locations.
.'
.'</p>' 
.'<h4>Identity Verification</h4><br/>'
.'<p class="para">'
.'As much as we have developed an easy path to owning a LAND, with flexible payment plan, we are obligated by regulatory bodies to carry out proper KYC on all users. At the very least, there needs to be an active phone number, email, picture, BVN or any other means of identification.
.'
.'</p>' 
.'<h4>Notification</h4><br/>'
.'<p class="para">'
.'By starting a relationship with us, you consent to receiving text (SMS), email and push notifications from us. These notifications are meant for your consumption only and we will not be held liable if you suffer any loss, or damage as a result of unauthorized access to the information sent.
If you decide to opt out of receiving notifications from us, we would grant you such request. You agree to indemnify yurLAND and its owners against all losses, damages, claims, demands and expenses whatsoever which may be incurred, imposed or suffered by the firm as well as against all actions, proceedings or claims (including attorney"s fees) whether civil or criminal, which may be brought against yurLAND by reason of such notifications.'
.'</p>' 
.'<h4>Purchase Duration</h4><br/>'
.'<p class="para">'
.'With yurLAND, you would be able to buy a LAND and pay over a minimum period of 1 month to a maximum period of 18 months or outright.
Users who do not pay up after the maximum period would be charged with a 10% on Location price as a contract breaking fee and continue payment for their location of choice at the NEW SELLING PRICE, should the location prices be increased.
.'
.'</p>' 
.'<h4>AVAILABLE PLANS AND DURATION</h4><br/>'
.'<table>
<thead>
    <tr>
        <th>S/N</th>
        <th>PLAN TITLE</th>
        <th>DURATION</th>
        <th>PRICE INCREASE(%)</th>
    </tr>
</thead>
<tbody>
 <tr>
   <td>1</td>
   <td>Outright Purchase</td>
   <td>Instant</td>
   <td>0</td>
 </tr>
 <tr>
   <td>2</td>
    <td>1 month plan</td>
   <td>1 month</td>
   <td>0</td>
</tr>
<tr>
<td>3</td>
<td>3 months plan</td>
<td>3 months</td>
<td>0</td>
</tr>
<tr>
<td>4</td>
<td>6 months plan</td>
<td>6 months</td>
<td>0</td>
</tr>
<tr>
<td>5</td>
<td>12 months plan</td>
<td>12 months</td>
<td>20</td>
</tr>
<tr>
<td>6</td>
<td>18 months plan</td>
<td>18 months</td>
<td>30</td>
</tr>
</tbody>
</table>
'
.'<h4>Default</h4><br/>'
.'<p class="para">'
.'Users who do not complete their payments before deadline of their plans, would be charged a contract breaking for every extra month(s) spent on the plan.
.'
.'</p>' 
.'<h4>Means of Payment</h4><br/>'
.'<p class="para">'
.'Payments on yurLAND are processed electronically on the web app either by manual operations daily, weekly or monthly or by automation using our auto debit feature enabled by our partners PAYSTACK to help process either daily, weekly or monthly payments without a need to visit the platform regularly.
Users can also make payments offline, directly to the provided company’s account only. Users who decides to make such payments are expected to contact their attached agents or our customer supports within a maximum period of 30 minutes to help confirm payments and update on the platform as supposed. Failure to do this may result in loss of fund and/or lag on updating payment.
.'
.'</p>' 
.'<h4>Land Inspection</h4><br/>'
.'<p class="para">'
.'Lands are available for inspection under the following conditions;
.'
.'</p>' 

.'<p>a</p>'
.'<p class="para">'
.'<h4>On Schedule</h4> - <p class="para">We organize regular visitation to our estate locations using our prepared calendar and send out an invite to all customers. Interested customers are then expected to pay the sum of #5,000 (Five thousand naira) only, to participate in this inspection. The amount paid covers for two persons, on exception please contact our support lines</p>.
.'
.'</p>' 
.'<p>b</p>'
.'<p class="para">'
.'<h4>On Request</h4> - <p class="para">Users are also allowed to request for an inspection either while paying for their lands or before starting their payment. This inspection comes with an inspection fee of #10,000 (Ten Thousand Naira) only. The amount paid covers for two persons, on exception please contact our support lines</p>.
.'
.'</p>' 
.'<p>c</p>'
.'<p class="para">'
.'<h4>Feed your eye</h4> -  <p class="para"> This inspection is 100% free and happens quarterly. We send out a public notice inviting both existing, new and prospective customers to join us as we visit any of our Estate locations. Users who intend to benefit from this offer are expected to prepare to cover all their personal expenses (feeding, transportation etc.). There is no maximum number of persons that can visit</p>.
.'
.'</p>' 
.'<h4>Change Of Location</h4><br/>'
.'<p class="para">'
.'A user is allowed to change their location of choice just once under the following conditions;
.'
.'</p>' 

.'<p>a</p>'
.'<p class="para">'
.'<h4>On Schedule</h4> - <p class="para">a.A user who wants to change his current land location from a cheaper location to a more expensive location. This comes with no charges and can be treated within 24-72hours of notification, after a proper verification of request.</p>.
.'
.'</p>' 
.'<p>b</p>'
.'<p class="para">'
.'<h4>Upgrade</h4> - <p class="para">Users are also allowed to request for an inspection either while paying for their lands or before starting their payment. This inspection comes with an inspection fee of #10,000 (Ten Thousand Naira) only. The amount paid covers for two persons, on exception please contact our support lines</p>.
.'
.'</p>'
.'<p class="para">'
.'<h4>Downgrade</h4> - <p class="para"> A user who wants to change his current location from a more expensive location to a cheaper location. This comes with a 10% charge on the new location price and can be treated within 24-72hours of notification, after a proper verification of request</p>.
.'
.'</p>' 
.'<h4>All change or location requests, should be sent via mail to support@yurland.com.ng with a follow up request via phone call to +2349124259139</h4><br/>'
.'<h4>Transfer of ownership</h4><br/>'
.'<p class="para">'
.'Users are allowed to transfer the ownership of their land location to a new owner by simply using the “REQUEST CHANGE OWNERSHIP” button on their dashboard or send a request via mail to the email provided above with a follow up call, only after completion of payment.
The transfer of ownership comes with a 10% charge on the current location price, can be treated within 24-120hours of notification, after a proper verification of request and ownership can only be transferred ONCE. Should you and the existing user fail to meet our user verification for change of ownership request, this request would be rejected and can only be treated again after 30 days of consistent payment. This verification is done to prevent theft..
.'
.'</p>' 
.'<h4>Allocation of LAND</h4><br/>'
.'<p class="para">'
.'Currently, all lands allocation are designed to take place after successful completion of payment within 7-14 working days. Although we are working to make this happen before completion, we would communicate if that is to be initiated.
Note: Allocation of land comes with a fee, an amount already stated on this document and on the product review page.
.'
.'</p>' 
.'<h4>Land Documentation</h4><br/>'
.'<p class="para">'
.'All our estates comes with different documents, ranging from registered survey, Individual C of O to a Global C of O or both. We advise that you read and confirm the documents attached to your location of choice before commencing payment.
Also, documentation takes place immediately after allocation of land..
.'
.'</p>' 
.'<h4>Proof Of Payment</h4><br/>'
.'<p class="para">'
.'Our payments processing partners are responsible and promises to provide you with regular payment receipts of every payments processed on our platform. You can also view and download your transaction history from your dashboard.
On occasions where there seems to be a delay or cases where alerts are not sent , please reach out to our support lines directly for assistance..
.'
.'</p>'
.'<h4>Cancellation and refund request</h4><br/>'
.'<p class="para">'
.'We operate a strict cancellation and refund policy. “See below” to read about our cancellation and refund policy. .
.'
.'</p>'
.'<h4>REFUND POLICY</h4><br/>'
.'<p class="para">'
.'A subscriber can completely cancel, upgrade or downgrade a payment plan without any penalty or fine if the cancellation is done within 24hrs after the payment or activation of the plan.
.'
.'</p>' 
.'<p class="para">'
.'A subscriber is eligible for a full refund IF ONLY the refund is requested for within 24hrs after payment.
.'
.'</p>'
.'<p class="para">'
.'In a case of an emergency refund, a subscriber must inform YURLAND management and provide concrete evidences before refunds can be processed. Processing of refund may take 30-60 working days and attracts a penalty of 30% of the subscribed plan
.'
.'</p>'
.'<h1>GENERAL RULES</h1>'
.'<p class="para">'
.'Refunds must be requested in writing and given to the agent/IOC you purchased the land through or sent through email to the official email address of YURLAND. This request must be signed by the person who made the original payment.
.'
.'</p>' 
.'<p class="para">'
.'Refunds will be made by the same method used for payment and will be paid to the entity that made the original payment.
.'
.'</p>'
.'<p class="para">'
.'All requests for refunds will be processed on an individual basis, taking into account the impact on units purchased.
.'
.'</p>'
.'<h4>For your perusal, below are important communication channels you should keep</h4>'
.'<p>a</p>'
.'<p class="para">Your assigned agents (details available on your dashboard)</p>.
.'
.'<p>b</p>'
.'<p class="para">Support mail : support@yurland.com.ng</p>.
.'
.'<p>c</p>'
.'<p class="para">Call center : +234 912 425 9139, +234 902 609 4011</p>.
.'
.'<p>d</p>'
.'<p class="para">On escalation : put in copy of your mail hello@yurland.com.ng</p>.
.'
.'<h4>Our physical office address: 1 Abiola Adeyemi Street, Jidsam Filling Station Plaza, Igando-Ikotun Road, LAGOS State.</h4>'
.'<h4>Partners Website;</h4>'
.'<h4>Ilu-Oba International Limited: https://Iluobainternationallimited.com</h4>'
.'<h4>Arklips Limited : https://arklips.com</h4>'
.'<p class="para">Once again, thank you for your purchase.</p>.
.'
.'<p class="para">Kind Regards. </p>.
.'
.'<h4>Ahunanya, Ifeanyi Richard</h4>'
.'<h4>Founder/Chief Technology Office Arklips</h4>'
.'<h4>For: yurLAND</h4>'
.'</body>' 
.'</html>'; 


fwrite($myfile, $txt);
rename("".$filename."","userdocuments/".$filename."");
fclose($myfile);
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }

    function insertPayHistory($customerid,$productid,$productname,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$paymentdate,$chosenplan,$intervalinput,$subprice,$payee,$agentid,$allocationfee,$subperiod){
        $sql = "INSERT INTO land_history(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method,payment_date,product_plan,sub_period,sub_price,payee,agent_id,allocation_fee,period_num) VALUES('{$customerid}','{$productid}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$method}','{$paymentdate}','{$chosenplan}','{$intervalinput}','{$subprice}','{$payee}','{$agentid}','{$allocationfee}','{$subperiod}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }


    function insertOutPayment($customerid,$productid,$productname,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$paymentdate,$payee,$agentid,$allocationfee){
        $balance = 0;
        $uniquename = rand();
        $filename = "allocation".$uniquename.".doc";
        $sql = "INSERT INTO payment(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method,payment_date,payee,agent_id,balance,allocation_fee,allocation_letter) VALUES('{$customerid}','{$productid}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$method}','{$paymentdate}','{$payee}','{$agentid}','{$balance}','{$allocationfee}','{$filename}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
            $userphoto = "SELECT * FROM user WHERE unique_id = '{$customerid}'";
            $result2 = $this->dbcon->query($userphoto);
            $row2 = $result2->fetch_assoc();

            if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
                $allocationfee2 = number_format($allocationfee);
              } else {
                $allocationfee2 =  round($allocationfee);
              }
         
    
    $myfile = fopen("".$filename."", "w");
$txt = '<html xmlns:v="urn:schemas-microsoft-com:vml" '
.'xmlns:o="urn:schemas-microsoft-com:office:office" '
.'xmlns:w="urn:schemas-microsoft-com:office:word" '
.'xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"= '
.'xmlns="http://www.w3.org/TR/REC-html40">'
.'<head><meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">'
.'<title></title>'
.'<!--[if gte mso 9]>'
.'<xml>'
.'<w:WordDocument>'
.'<w:View>Print'
.'<w:Zoom>100'
.'<w:DoNotOptimizeForBrowser/>'
.'</w:WordDocument>'
.'</xml>'
.'<![endif]-->'
.'<style>
@page
{
    font-family: Arial;
    size:215.9mm 279.4mm;  /* A4 */
    margin:14.2mm 17.5mm 14.2mm 16mm; /* Margins: 2.5 cm on each side */
}
h1 { font-family: Arial; font-size: 18px; text-align:center; }
h4 { font-family: Arial; font-size: 18px; text-align:left; }
h5 { font-family: Arial;  text-align:left; }
p.para {font-family: Arial; font-size: 13.5px; text-align: justify;}
.heading{font-weigth: 600; font-size: 20px;}
th,td{width: 180px;}
</style>'
.'</head>'
.'<body>'
.'<h1>yurLAND</h1><br/>'
.'<h4>Dear '.$row2['first_name'].' '.$row2['last_name'].'</h4><br/>'
.'<h5>ESTATE NAME: '.$productname.'</h5><br/>'
.'<h5>LOCATION: '.$productlocation.'</h5><br/>'
.'<h1 class="heading">INVITE FOR ALLOCATION</h1><br/>'
.'<p class="para">'
.'Once again, we appreciate your interest in yurLAND and are sending you this document to formerly affirm that you have made and we have received the complete payment for our estate project which you subscribed to.
In accordance to our terms and promise for instant allocation, we are setting the ground by inviting you to the next phase of your purchase which is the allocation of the estate you subscribed to and have completed payment for.
Details of allocation would be communicated to you via mail and a follow up text via SMS, so we advise that you reconfirm your submitted email and phone number.
Also, as stated in our product description, you are to pay in the sum of <span style="color: red;">&#8358;'.$allocationfee2.'</span> either by cash or direct bank transfer to the account number provided below and send proof of payment to our support staff via Whatsapp. You can also walk into our office, having this document as a proof to make your allocation fee payment.
We expect that you respond to this document within 14days of receipt, to allow us properly plan for your allocation, ensuring that all your documents attached are prepared and ready to be handed over to you on the day of allocation.
Thank you for trusting us, we are glad we could be part of making your dream to own a LAND come true.
.'
.'</p>' 

.'<p class="para">Regards.</p>.
.'
.'<h4>Ahunanya, Ifeanyi Richard</h4>'
.'<h4>Founder/ CTO Arklips Limited</h4>'
.'<h4>For: yurLAND</h4>'
.'</body>' 
.'</html>'; 


fwrite($myfile, $txt);
rename("".$filename."","userdocuments/".$filename."");
fclose($myfile);
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    function insertOutPayHistory($customerid,$productid,$productname,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$paymentdate,$payee,$agentid,$allocationfee){
        $balance = 0;
        $sql = "INSERT INTO land_history(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method,payment_date,payee,agent_id,balance,allocation_fee) VALUES('{$customerid}','{$productid}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$method}','{$paymentdate}','{$payee}','{$agentid}','{$balance}','{$allocationfee}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    function insertNewPayment($customerid,$productid,$productname,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$balance,$period,$subperiod,$newpay,$paymentdate,$chosenplan,$subprice,$payee,$agentid,$allocationfee){
        $uniquename = rand();
        $filename = "offerletter".$uniquename.".doc";
        $sql = "INSERT INTO payment(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method,balance,sub_period,period_num,sub_payment,payment_date,product_plan,sub_price,payee,agent_id,allocation_fee,offer_letter) VALUES('{$customerid}','{$productid}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$method}','{$balance}','{$period}','{$subperiod}','{$newpay}','{$paymentdate}','{$chosenplan}','{$subprice}','{$payee}','{$agentid}','{$allocationfee}','{$filename}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){

            $userphoto = "SELECT * FROM user WHERE unique_id = '{$customerid}'";
            $result2 = $this->dbcon->query($userphoto);
            $row2 = $result2->fetch_assoc();
         
    $newbalance = $newpay + $balance;
    if($newbalance > 999 || $newbalance > 9999 || $balance > 99999 || $balance > 999999){
        $newbalance2 = number_format($newbalance);
      } else {
          $newbalance2 =  $newbalance;
      }
      if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
        $allocationfee2 = number_format($allocationfee);
      } else {
        $allocationfee2 =  round($allocationfee);
      }

      if($subprice > 999 || $subprice > 9999 || $subprice > 99999 || $subprice > 999999){
        $subprice2 = number_format($subprice);
      } else {
        $subprice2 =  round($subprice);
      }
    $myfile = fopen("".$filename."", "w");
$txt = '<html xmlns:v="urn:schemas-microsoft-com:vml" '
.'xmlns:o="urn:schemas-microsoft-com:office:office" '
.'xmlns:w="urn:schemas-microsoft-com:office:word" '
.'xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"= '
.'xmlns="http://www.w3.org/TR/REC-html40">'
.'<head><meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">'
.'<title></title>'
.'<!--[if gte mso 9]>'
.'<xml>'
.'<w:WordDocument>'
.'<w:View>Print'
.'<w:Zoom>100'
.'<w:DoNotOptimizeForBrowser/>'
.'</w:WordDocument>'
.'</xml>'
.'<![endif]-->'
.'<style>
@page
{
    font-family: Arial;
    size:215.9mm 279.4mm;  /* A4 */
    margin:14.2mm 17.5mm 14.2mm 16mm; /* Margins: 2.5 cm on each side */
}
h1 { font-family: Arial; font-size: 18px; text-align:center; }
h4 { font-family: Arial; font-size: 18px; text-align:left; }
h5 { font-family: Arial;  text-align:left; }
p.para {font-family: Arial; font-size: 13.5px; text-align: justify;}
.heading{font-weigth: 600; font-size: 20px;}
th,td{width: 180px;}
</style>'
.'</head>'
.'<body>'
.'<h1>yurLAND</h1><br/>'
.'<h4>Dear '.$row2['first_name'].' '.$row2['last_name'].'</h4><br/>'
.'<h1>ACKNOWLEDGEMENT LETTER AND TERMS OF CONDITION</h1><br/>'
.'<p class="para">'
.'Thank you for your interest in YURLAND. We write to affirm that we received your purchase request.
Do see below details of purchase and the terms and conditions attached.
.'
.'</p>' 
.'<h5>ESTATE NAME: '.$productname.'</h5><br/>'
.'<h5>LOCATION: '.$productlocation.'</h5><br/>'
.'<h5>DOCUMENTS ATTACHED: '.$filename.'</h5><br/>'
.'<h5>TOTAL COST:&nbsp;&#8358;'.$newbalance2.'</h5><br/>'
.'<h5>ALLOCATION FEE:&nbsp;&#8358;'.$allocationfee2.'</h5><br/>'
.'<h5>UNITS BOUGHT: '.$addedunit.'</h5><br/>'
.'<h5>DAILY PAYMENT:&nbsp;&#8358;'.$subprice2.'</h5><br/>'
.'<h5>PERIOD OF PAYMENT: '.$subperiod.'</h5><br/>'
.'<h5>START DATE: '.$paymentdate.'</h5><br/>'
.'<h5>END DATE: '.$period.'</h5><br/>'
.'<h1 class="heading">YurLAND TERMS AND CONDITIONS</h1><br/>'
.'<p class="para">'
.'These terms and conditions will serve as a basis of your customer relationship with us, yurLAND .By choosing to buy a LAND with us, you agree to the terms and conditions contained herein.You also confirm that you have provided us with the accurate and complete information required to create your account and that you have supplied all documentation,photographs and information that allow us to comply with our regulatory obligations.
If you do not agree to these terms and conditions, please do not proceed and exit the application immediately.Also,please be informed that we can terminate your relationship with us if we believe that you have violated any of these terms.
.'
.'</p>' 
.'<h4>ABOUT US</h4><br/>'
.'<p class="para">'
.'YurLAND, a Real Estate Product developed by Ilu-Oba International Limited “Real Estate company in Nigeria”, in partnership with Arklips Limited a tech base company into the development of tech related software to aid access into Logistics, Investments and Properties.
.'
.'</p>' 
.'<h4>Objectives Of Relationship</h4><br/>'
.'<p class="para">'
.'The objective of coming into a relationship with yurLAND is to partake from the real estate offers provided by Ilu-Oba Intl Ltd and Arklips Ltd for their customers.
As a customer, you have access to all offers provided by the two firms via the RealTech product yurLAND through the use of an internet enabled pc or smartphone.
.'
.'</p>' 
.'<h4>When are these terms applicable</h4><br/>'
.'<p class="para">'
.'These terms are applicable when you choose to buy a land on yurLAND and yurLAND prepares a customer database for you.

We may, at any time, modify the terms and conditions of our relationship but we will not do this without first informing you of such modification. All updates will be detailed on our website and our web app. You will be able to access the latest version of our terms at any given time.
.'
.'</p>'
.'<h1>Scope of Relationship Between yurLAND and her customers.</h1><br/>'
.'<h4>Making a purchase</h4><br/>'
.'<p class="para">'
.'You can make a purchase on our platform as long as you are a verified user with accurate database and proper documentation, own or have access to internet or be willing to work closely with any of our field sales agents who can help create and manage your account. We do not intentionally engage with users who do not meet these requirements
Our lands are sold in units, a unit is therefore equivalent to half a plot of land (250 - 300spm)
.'
.'</p>' 
.'<h4>Special Offer</h4><br/>'
.'<p class="para">'
.'Users who purchase up to 4 units at a single purchase transaction, gets one free unit. This offer is valid for all our estates locations.
.'
.'</p>' 
.'<h4>Identity Verification</h4><br/>'
.'<p class="para">'
.'As much as we have developed an easy path to owning a LAND, with flexible payment plan, we are obligated by regulatory bodies to carry out proper KYC on all users. At the very least, there needs to be an active phone number, email, picture, BVN or any other means of identification.
.'
.'</p>' 
.'<h4>Notification</h4><br/>'
.'<p class="para">'
.'By starting a relationship with us, you consent to receiving text (SMS), email and push notifications from us. These notifications are meant for your consumption only and we will not be held liable if you suffer any loss, or damage as a result of unauthorized access to the information sent.
If you decide to opt out of receiving notifications from us, we would grant you such request. You agree to indemnify yurLAND and its owners against all losses, damages, claims, demands and expenses whatsoever which may be incurred, imposed or suffered by the firm as well as against all actions, proceedings or claims (including attorney"s fees) whether civil or criminal, which may be brought against yurLAND by reason of such notifications.'
.'</p>' 
.'<h4>Purchase Duration</h4><br/>'
.'<p class="para">'
.'With yurLAND, you would be able to buy a LAND and pay over a minimum period of 1 month to a maximum period of 18 months or outright.
Users who do not pay up after the maximum period would be charged with a 10% on Location price as a contract breaking fee and continue payment for their location of choice at the NEW SELLING PRICE, should the location prices be increased.
.'
.'</p>' 
.'<h4>AVAILABLE PLANS AND DURATION</h4><br/>'
.'<table>
<thead>
    <tr>
        <th>S/N</th>
        <th>PLAN TITLE</th>
        <th>DURATION</th>
        <th>PRICE INCREASE(%)</th>
    </tr>
</thead>
<tbody>
 <tr>
   <td>1</td>
   <td>Outright Purchase</td>
   <td>Instant</td>
   <td>0</td>
 </tr>
 <tr>
   <td>2</td>
    <td>1 month plan</td>
   <td>1 month</td>
   <td>0</td>
</tr>
<tr>
<td>3</td>
<td>3 months plan</td>
<td>3 months</td>
<td>0</td>
</tr>
<tr>
<td>4</td>
<td>6 months plan</td>
<td>6 months</td>
<td>0</td>
</tr>
<tr>
<td>5</td>
<td>12 months plan</td>
<td>12 months</td>
<td>20</td>
</tr>
<tr>
<td>6</td>
<td>18 months plan</td>
<td>18 months</td>
<td>30</td>
</tr>
</tbody>
</table>
'
.'<h4>Default</h4><br/>'
.'<p class="para">'
.'Users who do not complete their payments before deadline of their plans, would be charged a contract breaking for every extra month(s) spent on the plan.
.'
.'</p>' 
.'<h4>Means of Payment</h4><br/>'
.'<p class="para">'
.'Payments on yurLAND are processed electronically on the web app either by manual operations daily, weekly or monthly or by automation using our auto debit feature enabled by our partners PAYSTACK to help process either daily, weekly or monthly payments without a need to visit the platform regularly.
Users can also make payments offline, directly to the provided company’s account only. Users who decides to make such payments are expected to contact their attached agents or our customer supports within a maximum period of 30 minutes to help confirm payments and update on the platform as supposed. Failure to do this may result in loss of fund and/or lag on updating payment.
.'
.'</p>' 
.'<h4>Land Inspection</h4><br/>'
.'<p class="para">'
.'Lands are available for inspection under the following conditions;
.'
.'</p>' 

.'<p>a</p>'
.'<p class="para">'
.'<h4>On Schedule</h4> - <p class="para">We organize regular visitation to our estate locations using our prepared calendar and send out an invite to all customers. Interested customers are then expected to pay the sum of #5,000 (Five thousand naira) only, to participate in this inspection. The amount paid covers for two persons, on exception please contact our support lines</p>.
.'
.'</p>' 
.'<p>b</p>'
.'<p class="para">'
.'<h4>On Request</h4> - <p class="para">Users are also allowed to request for an inspection either while paying for their lands or before starting their payment. This inspection comes with an inspection fee of #10,000 (Ten Thousand Naira) only. The amount paid covers for two persons, on exception please contact our support lines</p>.
.'
.'</p>' 
.'<p>c</p>'
.'<p class="para">'
.'<h4>Feed your eye</h4> -  <p class="para"> This inspection is 100% free and happens quarterly. We send out a public notice inviting both existing, new and prospective customers to join us as we visit any of our Estate locations. Users who intend to benefit from this offer are expected to prepare to cover all their personal expenses (feeding, transportation etc.). There is no maximum number of persons that can visit</p>.
.'
.'</p>' 
.'<h4>Change Of Location</h4><br/>'
.'<p class="para">'
.'A user is allowed to change their location of choice just once under the following conditions;
.'
.'</p>' 

.'<p>a</p>'
.'<p class="para">'
.'<h4>On Schedule</h4> - <p class="para">a.A user who wants to change his current land location from a cheaper location to a more expensive location. This comes with no charges and can be treated within 24-72hours of notification, after a proper verification of request.</p>.
.'
.'</p>' 
.'<p>b</p>'
.'<p class="para">'
.'<h4>Upgrade</h4> - <p class="para">Users are also allowed to request for an inspection either while paying for their lands or before starting their payment. This inspection comes with an inspection fee of #10,000 (Ten Thousand Naira) only. The amount paid covers for two persons, on exception please contact our support lines</p>.
.'
.'</p>'
.'<p class="para">'
.'<h4>Downgrade</h4> - <p class="para"> A user who wants to change his current location from a more expensive location to a cheaper location. This comes with a 10% charge on the new location price and can be treated within 24-72hours of notification, after a proper verification of request</p>.
.'
.'</p>' 
.'<h4>All change or location requests, should be sent via mail to support@yurland.com.ng with a follow up request via phone call to +2349124259139</h4><br/>'
.'<h4>Transfer of ownership</h4><br/>'
.'<p class="para">'
.'Users are allowed to transfer the ownership of their land location to a new owner by simply using the “REQUEST CHANGE OWNERSHIP” button on their dashboard or send a request via mail to the email provided above with a follow up call, only after completion of payment.
The transfer of ownership comes with a 10% charge on the current location price, can be treated within 24-120hours of notification, after a proper verification of request and ownership can only be transferred ONCE. Should you and the existing user fail to meet our user verification for change of ownership request, this request would be rejected and can only be treated again after 30 days of consistent payment. This verification is done to prevent theft..
.'
.'</p>' 
.'<h4>Allocation of LAND</h4><br/>'
.'<p class="para">'
.'Currently, all lands allocation are designed to take place after successful completion of payment within 7-14 working days. Although we are working to make this happen before completion, we would communicate if that is to be initiated.
Note: Allocation of land comes with a fee, an amount already stated on this document and on the product review page.
.'
.'</p>' 
.'<h4>Land Documentation</h4><br/>'
.'<p class="para">'
.'All our estates comes with different documents, ranging from registered survey, Individual C of O to a Global C of O or both. We advise that you read and confirm the documents attached to your location of choice before commencing payment.
Also, documentation takes place immediately after allocation of land..
.'
.'</p>' 
.'<h4>Proof Of Payment</h4><br/>'
.'<p class="para">'
.'Our payments processing partners are responsible and promises to provide you with regular payment receipts of every payments processed on our platform. You can also view and download your transaction history from your dashboard.
On occasions where there seems to be a delay or cases where alerts are not sent , please reach out to our support lines directly for assistance..
.'
.'</p>'
.'<h4>Cancellation and refund request</h4><br/>'
.'<p class="para">'
.'We operate a strict cancellation and refund policy. “See below” to read about our cancellation and refund policy. .
.'
.'</p>'
.'<h4>REFUND POLICY</h4><br/>'
.'<p class="para">'
.'A subscriber can completely cancel, upgrade or downgrade a payment plan without any penalty or fine if the cancellation is done within 24hrs after the payment or activation of the plan.
.'
.'</p>' 
.'<p class="para">'
.'A subscriber is eligible for a full refund IF ONLY the refund is requested for within 24hrs after payment.
.'
.'</p>'
.'<p class="para">'
.'In a case of an emergency refund, a subscriber must inform YURLAND management and provide concrete evidences before refunds can be processed. Processing of refund may take 30-60 working days and attracts a penalty of 30% of the subscribed plan
.'
.'</p>'
.'<h1>GENERAL RULES</h1>'
.'<p class="para">'
.'Refunds must be requested in writing and given to the agent/IOC you purchased the land through or sent through email to the official email address of YURLAND. This request must be signed by the person who made the original payment.
.'
.'</p>' 
.'<p class="para">'
.'Refunds will be made by the same method used for payment and will be paid to the entity that made the original payment.
.'
.'</p>'
.'<p class="para">'
.'All requests for refunds will be processed on an individual basis, taking into account the impact on units purchased.
.'
.'</p>'
.'<h4>For your perusal, below are important communication channels you should keep</h4>'
.'<p>a</p>'
.'<p class="para">Your assigned agents (details available on your dashboard)</p>.
.'
.'<p>b</p>'
.'<p class="para">Support mail : support@yurland.com.ng</p>.
.'
.'<p>c</p>'
.'<p class="para">Call center : +234 912 425 9139, +234 902 609 4011</p>.
.'
.'<p>d</p>'
.'<p class="para">On escalation : put in copy of your mail hello@yurland.com.ng</p>.
.'
.'<h4>Our physical office address: 1 Abiola Adeyemi Street, Jidsam Filling Station Plaza, Igando-Ikotun Road, LAGOS State.</h4>'
.'<h4>Partners Website;</h4>'
.'<h4>Ilu-Oba International Limited: https://Iluobainternationallimited.com</h4>'
.'<h4>Arklips Limited : https://arklips.com</h4>'
.'<p class="para">Once again, thank you for your purchase.</p>.
.'
.'<p class="para">Kind Regards. </p>.
.'
.'<h4>Ahunanya, Ifeanyi Richard</h4>'
.'<h4>Founder/Chief Technology Office Arklips</h4>'
.'<h4>For: yurLAND</h4>'
.'</body>' 
.'</html>'; 


fwrite($myfile, $txt);
rename("".$filename."","userdocuments/".$filename."");
fclose($myfile);

           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    function insertNewPayHistory($customerid,$productid,$productname,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$balance,$period,$subperiod,$newpay,$paymentdate,$chosenplan,$subprice,$payee,$agentid,$allocationfee){
        $sql = "INSERT INTO land_history(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method,balance,sub_period,period_num,sub_payment,payment_date,product_plan,sub_price,payee,agent_id,allocation_fee) VALUES('{$customerid}','{$productid}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$method}','{$balance}','{$period}','{$subperiod}','{$newpay}','{$paymentdate}','{$chosenplan}','{$subprice}','{$payee}','{$agentid}','{$allocationfee}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    function updateNewPayment($customerid,$productid,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$paymentdate,$balance,$period,$subperiod,$payee,$agentid,$allocationfee){
        $uniquename = rand();
        $filename = "allocation".$uniquename.".doc";
        if($balance < 1){
            $sql = "UPDATE payment SET payment_month='{$paymentmonth}',payment_day='{$paymentday}',payment_year='{$paymentyear}',payment_time='{$paymenttime}',product_location='{$productlocation}',product_price='{$price}',product_image='{$image}',product_unit='{$addedunit}',payment_method='{$method}',payment_date='{$paymentdate}', balance='{$balance}',sub_period='{$period}',period_num='{$subperiod}', payee='{$payee}', agent_id='{$agentid}', allocation_fee = '{$allocationfee}', allocation_letter = '{$filename}' WHERE product_id='{$productid}' AND payment_status='Payed' AND customer_id='{$customerid}'";
        } else {
            $sql = "UPDATE payment SET payment_month='{$paymentmonth}',payment_day='{$paymentday}',payment_year='{$paymentyear}',payment_time='{$paymenttime}',product_location='{$productlocation}',product_price='{$price}',product_image='{$image}',product_unit='{$addedunit}',payment_method='{$method}',payment_date='{$paymentdate}', balance='{$balance}',sub_period='{$period}',period_num='{$subperiod}', payee='{$payee}', agent_id='{$agentid}', allocation_fee = '{$allocationfee}' WHERE product_id='{$productid}' AND payment_status='Payed' AND customer_id='{$customerid}'";
        }
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
            if($balance < 1){
                $userphoto = "SELECT * FROM user WHERE unique_id = '{$customerid}'";
                $result2 = $this->dbcon->query($userphoto);
                $row2 = $result2->fetch_assoc();

                $landinfo = "SELECT * FROM land_product WHERE unique_id='{$productid}'";
                $result3 = $this->dbcon->query($landinfo);
                $row3 = $result3->fetch_assoc();
    
                if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
                    $allocationfee2 = number_format($allocationfee);
                  } else {
                    $allocationfee2 =  round($allocationfee);
                  }
             
        
        $myfile = fopen("".$filename."", "w");
    $txt = '<html xmlns:v="urn:schemas-microsoft-com:vml" '
    .'xmlns:o="urn:schemas-microsoft-com:office:office" '
    .'xmlns:w="urn:schemas-microsoft-com:office:word" '
    .'xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"= '
    .'xmlns="http://www.w3.org/TR/REC-html40">'
    .'<head><meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">'
    .'<title></title>'
    .'<!--[if gte mso 9]>'
    .'<xml>'
    .'<w:WordDocument>'
    .'<w:View>Print'
    .'<w:Zoom>100'
    .'<w:DoNotOptimizeForBrowser/>'
    .'</w:WordDocument>'
    .'</xml>'
    .'<![endif]-->'
    .'<style>
    @page
    {
        font-family: Arial;
        size:215.9mm 279.4mm;  /* A4 */
        margin:14.2mm 17.5mm 14.2mm 16mm; /* Margins: 2.5 cm on each side */
    }
    h1 { font-family: Arial; font-size: 18px; text-align:center; }
    h4 { font-family: Arial; font-size: 18px; text-align:left; }
    h5 { font-family: Arial;  text-align:left; }
    p.para {font-family: Arial; font-size: 13.5px; text-align: justify;}
    .heading{font-weigth: 600; font-size: 20px;}
    th,td{width: 180px;}
    </style>'
    .'</head>'
    .'<body>'
    .'<h1>yurLAND</h1><br/>'
    .'<h4>Dear '.$row2['first_name'].' '.$row2['last_name'].'</h4><br/>'
    .'<h5>ESTATE NAME: '.$row3['product_name'].'</h5><br/>'
    .'<h5>LOCATION: '.$productlocation.'</h5><br/>'
    .'<h1 class="heading">INVITE FOR ALLOCATION</h1><br/>'
    .'<p class="para">'
    .'Once again, we appreciate your interest in yurLAND and are sending you this document to formerly affirm that you have made and we have received the complete payment for our estate project which you subscribed to.
    In accordance to our terms and promise for instant allocation, we are setting the ground by inviting you to the next phase of your purchase which is the allocation of the estate you subscribed to and have completed payment for.
    Details of allocation would be communicated to you via mail and a follow up text via SMS, so we advise that you reconfirm your submitted email and phone number.
    Also, as stated in our product description, you are to pay in the sum of <span style="color: red;">&#8358;'.$allocationfee2.'</span>either by cash or direct bank transfer to the account number provided below and send proof of payment to our support staff via Whatsapp. You can also walk into our office, having this document as a proof to make your allocation fee payment.
    We expect that you respond to this document within 14days of receipt, to allow us properly plan for your allocation, ensuring that all your documents attached are prepared and ready to be handed over to you on the day of allocation.
    Thank you for trusting us, we are glad we could be part of making your dream to own a LAND come true.
    .'
    .'</p>' 
    
    .'<p class="para">Regards.</p>.
    .'
    .'<h4>Ahunanya, Ifeanyi Richard</h4>'
    .'<h4>Founder/ CTO Arklips Limited</h4>'
    .'<h4>For: yurLAND</h4>'
    .'</body>' 
    .'</html>'; 
    
    
    fwrite($myfile, $txt);
    rename("".$filename."","userdocuments/".$filename."");
    fclose($myfile);
            }
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    function insertUpdateHistory($customerid,$productid,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$paymentdate,$balance,$period,$subperiod,$productname,$payee,$agentid,$allocationfee){
        $sql = "INSERT INTO land_history(payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,balance,sub_period,period_num,payment_method,product_id,payment_status,customer_id,product_name,payee,agent_id,payment_date,allocation_fee) VALUES('{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$balance}','{$period}','{$subperiod}','{$method}','{$productid}','Payed','{$customerid}','{$productname}','{$payee}','{$agentid}','{$paymentdate}','{$allocationfee}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    function updatePricePayment($customerid,$productid,$priceincrease){
        $sql = "UPDATE payment SET sub_payment='{$priceincrease}' WHERE product_id='{$productid}' AND payment_status='Payed' AND customer_id='{$customerid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    

    
    function insertPayment2($customerid,$productid,$price,$allocationfee){
        $uniquename = rand();
        $filename = "allocation".$uniquename.".doc";
        if($balance < 1){
            $sql = "UPDATE payment SET product_price = '{$price}' ,allocation_letter = '{$filename}', allocation_fee = '{$allocationfee}' WHERE product_id='{$productid}' AND customer_id = '{$customerid}' AND payment_status = 'Subscription'";
        } else {
            $sql = "UPDATE payment SET product_price = '{$price}' ,allocation_fee = '{$allocationfee}'WHERE product_id='{$productid}' AND customer_id = '{$customerid}' AND payment_status = 'Subscription'";
        }
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
            if($balance < 1){
                $userphoto = "SELECT * FROM user WHERE unique_id = '{$customerid}'";
                $result2 = $this->dbcon->query($userphoto);
                $row2 = $result2->fetch_assoc();

                $landinfo = "SELECT * FROM land_product WHERE unique_id='{$productid}'";
                $result3 = $this->dbcon->query($landinfo);
                $row3 = $result3->fetch_assoc();
    
                if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999){
                    $allocationfee2 = number_format($allocationfee);
                  } else {
                    $allocationfee2 =  round($allocationfee);
                  }
             
        
        $myfile = fopen("".$filename."", "w");
    $txt = '<html xmlns:v="urn:schemas-microsoft-com:vml" '
    .'xmlns:o="urn:schemas-microsoft-com:office:office" '
    .'xmlns:w="urn:schemas-microsoft-com:office:word" '
    .'xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"= '
    .'xmlns="http://www.w3.org/TR/REC-html40">'
    .'<head><meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">'
    .'<title></title>'
    .'<!--[if gte mso 9]>'
    .'<xml>'
    .'<w:WordDocument>'
    .'<w:View>Print'
    .'<w:Zoom>100'
    .'<w:DoNotOptimizeForBrowser/>'
    .'</w:WordDocument>'
    .'</xml>'
    .'<![endif]-->'
    .'<style>
    @page
    {
        font-family: Arial;
        size:215.9mm 279.4mm;  /* A4 */
        margin:14.2mm 17.5mm 14.2mm 16mm; /* Margins: 2.5 cm on each side */
    }
    h1 { font-family: Arial; font-size: 18px; text-align:center; }
    h4 { font-family: Arial; font-size: 18px; text-align:left; }
    h5 { font-family: Arial;  text-align:left; }
    p.para {font-family: Arial; font-size: 13.5px; text-align: justify;}
    .heading{font-weigth: 600; font-size: 20px;}
    th,td{width: 180px;}
    </style>'
    .'</head>'
    .'<body>'
    .'<h1>yurLAND</h1><br/>'
    .'<h4>Dear '.$row2['first_name'].' '.$row2['last_name'].'</h4><br/>'
    .'<h5>ESTATE NAME: '.$row3['product_name'].'</h5><br/>'
    .'<h5>LOCATION: '.$row3['product_location'].'</h5><br/>'
    .'<h1 class="heading">INVITE FOR ALLOCATION</h1><br/>'
    .'<p class="para">'
    .'Once again, we appreciate your interest in yurLAND and are sending you this document to formerly affirm that you have made and we have received the complete payment for our estate project which you subscribed to.
    In accordance to our terms and promise for instant allocation, we are setting the ground by inviting you to the next phase of your purchase which is the allocation of the estate you subscribed to and have completed payment for.
    Details of allocation would be communicated to you via mail and a follow up text via SMS, so we advise that you reconfirm your submitted email and phone number.
    Also, as stated in our product description, you are to pay in the sum of <span style="color: red;">&#8358;'.$allocationfee2.'</span>either by cash or direct bank transfer to the account number provided below and send proof of payment to our support staff via Whatsapp. You can also walk into our office, having this document as a proof to make your allocation fee payment.
    We expect that you respond to this document within 14days of receipt, to allow us properly plan for your allocation, ensuring that all your documents attached are prepared and ready to be handed over to you on the day of allocation.
    Thank you for trusting us, we are glad we could be part of making your dream to own a LAND come true.
    .'
    .'</p>' 
    
    .'<p class="para">Regards.</p>.
    .'
    .'<h4>Ahunanya, Ifeanyi Richard</h4>'
    .'<h4>Founder/ CTO Arklips Limited</h4>'
    .'<h4>For: yurLAND</h4>'
    .'</body>' 
    .'</html>'; 
    
    
    fwrite($myfile, $txt);
    rename("".$filename."","userdocuments/".$filename."");
    fclose($myfile);
            }
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }


    function selectPayment($id){
        $sql = "SELECT * FROM payment WHERE customer_id='{$id}' ORDER BY payment_id DESC";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

  

    function selectProductPayment($id,$idtwo){
        $sql = "SELECT * FROM payment WHERE product_id='{$id}' AND customer_id='{$idtwo}' LIMIT 1";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectProductNewPayment($id,$idtwo){
        $sql = "SELECT * FROM payment WHERE product_id='{$id}' AND customer_id='{$idtwo}' AND payment_status='Payed'LIMIT 1";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }


    function selectProductOldPayment($id,$idtwo){
        $sql = "SELECT * FROM payment WHERE product_id='{$id}' AND customer_id='{$idtwo}' AND payment_status='Payed'LIMIT 1";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
                foreach($rows as $key => $value){
                    return $value;
                  }
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectLastPayment($idtwo){
        $sql = "SELECT * FROM payment WHERE customer_id='{$idtwo}' AND payment_status='Payed' ORDER BY payment_id";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
                foreach($rows as $key => $value){
                  return $value;
                }
			}
		}else{
			return $rows;
		}
    }

    function selectLastPay($idtwo,$id){
        $sql = "SELECT * FROM payment WHERE customer_id='{$idtwo}' AND product_id='{$id}' AND payment_method='NewPayment' ORDER BY payment_id DESC LIMIT 1";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
                foreach($rows as $key => $value){
                  return $value;
                }
			}
		}else{
			return $rows;
		}
    }

    function selectSubPay($idtwo){
        $sql = "SELECT * FROM payment WHERE customer_id='{$idtwo}' AND product_plan != '' ORDER BY payment_id DESC LIMIT 1";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
                foreach($rows as $key => $value){
                  return $value;
                }
			}
		}else{
			return $rows;
		}
    }

   

    function selectLastSub($idtwo,$id){
        $sql = "SELECT * FROM payment WHERE customer_id='{$idtwo}' AND product_id='{$id}' AND payment_method='Subscription' ORDER BY payment_id DESC LIMIT 1";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
                foreach($rows as $key => $value){
                  return $value;
                }
			}
		}else{
			return $rows;
		}
    }


    function selectBalPayment($idtwo,$id){
        $sql = "SELECT SUM(product_price) FROM payment WHERE customer_id='{$idtwo}' AND product_id='{$id}' AND payment_status='Payed'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
            
        }else{
            return $row;
        }
    }

    function selectSumPayment($idtwo,$id){
        $sql = "SELECT SUM(balance) FROM payment WHERE customer_id='{$idtwo}' AND product_id='{$id}' AND payment_status='Payed' ORDER BY payment_id DESC LIMIT 2";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
            
        }else{
            return $row;
        }
    }

    function selectFirstPayment($idtwo){
        $sql = "SELECT * FROM payment WHERE customer_id='{$idtwo}' AND payment_status='Payed' ORDER BY payment_id ASC LIMIT 1";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
                foreach($rows as $key => $value){
                  return $value;
                }
			}
		}else{
			return $rows;
		}
    }

    function secureFeature($idtwo,$id){
        $sql = "SELECT * FROM payment WHERE customer_id='{$idtwo}'AND product_id='{$id}' AND payment_status='Payed' ORDER BY payment_id";
        $result = $this->dbcon->query($sql);
        $rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }


    function selectAllPayment(){
        $sql = "SELECT * FROM payment";
        $result = $this->dbcon->query($sql);
	    $rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectAllPayment2(){
        $sql = "SELECT * FROM payment";
        $result = $this->dbcon->query($sql);
	    $rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
                foreach($rows as $key => $value){
                    return $value;
                }
			}
		}else{
			return $rows;
		}
    }


   

    function selectCurrentPayment($id){
        $sql = "SELECT * FROM payment WHERE customer_id='{$id}' ORDER BY payment_id DESC LIMIT 5";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }


    
    function selectCurrentPayHistory($id){
        $sql = "SELECT * FROM land_history WHERE customer_id='{$id}' ORDER BY payment_id DESC LIMIT 5";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectAgentCurrentHistory($id){
        $sql = "SELECT * FROM land_history WHERE agent_id='{$id}' ORDER BY payment_id DESC LIMIT 5";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectPayHistory($id){
        $sql = "SELECT * FROM land_history WHERE customer_id='{$id}' ORDER BY payment_id DESC";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectOfferLetter($id){
        $null = "";
        $sql = "SELECT * FROM payment WHERE customer_id='{$id}' AND offer_letter != '{$null}' ORDER BY payment_id DESC";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectAllocationLetter($id){
        $null = "";
        $sql = "SELECT * FROM payment WHERE customer_id='{$id}' AND allocation_letter != '{$null}' ORDER BY payment_id DESC";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectAgentHistory($id){
        $sql = "SELECT * FROM land_history WHERE agent_id='{$id}' ORDER BY payment_id DESC";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectAgentHistory2($id){
        $sql = "SELECT * FROM land_history WHERE agent_id='{$id}' ORDER BY payment_id DESC LIMIT 6";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }


    function selectAllHistory(){
        $sql = "SELECT * FROM land_history  ORDER BY payment_id DESC";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

  

    function selectAgentHistorySum($id){
        $sql = "SELECT * FROM land_history WHERE agent_id='{$id}' ORDER BY payment_id DESC";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectSubPayment($id){
        $sql = "SELECT * FROM payment WHERE customer_id='{$id}' AND payment_method='Subscription'";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectTotal($id){
        $sql = "SELECT SUM(product_price) FROM land_history WHERE customer_id='{$id}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    



    function selectTotalPayment($id){
        $sql = "SELECT SUM(product_price) FROM payment WHERE product_id='{$id}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectNums($user){
        $sql = "SELECT COUNT(product_price) FROM land_history WHERE customer_id='{$user}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectTotalCustomers($id){
        $sql = "SELECT customer_id FROM land_history WHERE customer_id='{$id}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    

    function selectAllocatedCustomers($id){
        $sql = "SELECT customer_id FROM payment WHERE customer_id='{$id}' AND balance < 1";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectLastPayedCustomers($id){
        $sql = "SELECT * FROM payment WHERE customer_id = '{$id}'";
        $result = $this->dbcon->query($sql);
        $rows = array();
            if($this->dbcon->affected_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }else{
                return $rows;
            }
    }

   
    function selectAllUsersNum(){
        $sql = "SELECT COUNT(unique_id) FROM user";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }





    

   

    function selectBuyers(){
        $sql = "SELECT COUNT(product_id) FROM payment";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectSum($id){
        $sql = "SELECT SUM(product_price) FROM payment WHERE product_id='{$id}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectSubscribers($productid){
        $sql = "SELECT COUNT(product_id) FROM payment WHERE payment_method='Subscription' AND product_id='{$productid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectSubNum($user){
        $sql = "SELECT COUNT(product_price) FROM payment WHERE customer_id='{$user}' AND payment_method='Subscription'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            foreach ($row as $key => $value) {
                return $value;
               }
        }else{
            return $row;
        }
    }

    
    function selectNewPaymentNum($user){
        $sql = "SELECT COUNT(product_price) FROM payment WHERE customer_id='{$user}' AND payment_method='NewPayment'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            foreach ($row as $key => $value) {
                return $value;
               }
        }else{
            return $row;
        }
    }

    
    function selectTotalUsersPayment(){
        $sql = "SELECT SUM(product_price) FROM land_history";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            foreach ($row as $key => $value) {
                return $value;
               }
        }else{
            return $row;
        }
    }



    function addToCart($userid,$productid){
        $sql = "INSERT INTO cart(user_id,product_id) VALUES('{$userid}','{$productid}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }

    function addAgentCart($userid,$productid){
        $sql = "INSERT INTO cart(agent_id,product_id) VALUES('{$userid}','{$productid}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }

    function selectCart($user){
        $sql = "SELECT COUNT(product_id) FROM cart WHERE user_id='{$user}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectAgentCart($user){
        $sql = "SELECT COUNT(product_id) FROM cart WHERE agent_id='{$user}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectCartId($userid){
        $sql = "SELECT product_id FROM cart WHERE user_id='{$userid}'";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function checkCartId($userid,$prodid){
        $sql = "SELECT * FROM cart WHERE user_id='{$userid}' AND product_id='{$prodid}'";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function selectCartId2($userid){
        $sql = "SELECT product_id FROM cart WHERE agent_id='{$userid}'";
        $result = $this->dbcon->query($sql);
	$rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}else{
			return $rows;
		}
    }

    function DeleteCartId($userid,$user){
        $sql = "DELETE  FROM cart WHERE product_id='{$userid}' AND user_id='{$user}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    
    function DeleteProduct($userid,$user,$pay,$payid){
        $sql = "UPDATE payment SET payment_status='Deleted' WHERE product_id='{$userid}' AND customer_id='{$user}' AND payment_method='{$pay}' AND payment_id='{$payid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        // echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function updatePayment($userid,$user){
        $sql = "UPDATE payment SET payment_status='Payed' WHERE product_id='{$userid}' AND customer_id='{$user}' AND balance !=0";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
        //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function updateLandUnit($prodid,$soldunit,$boughtunits){
        $sql = "UPDATE land_product SET product_unit='{$soldunit}', bought_units='{$boughtunits}' WHERE unique_id='{$prodid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
        //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function DeleteProductP($userid,$user,$pay,$payid){
        $sql = "DELETE  FROM payment WHERE product_id='{$userid}' AND customer_id='{$user}' AND payment_method='{$pay}' AND payment_id='{$payid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function updateProductStat($userid,$user,$pay,$payid){
        $sql = "UPDATE payment SET payment_status='Restored' WHERE product_id='{$userid}' AND customer_id='{$user}' AND payment_method='{$pay}' AND payment_id='{$payid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function closeProduct($userid){
        $sql = "UPDATE land_product SET land_status='Closed' WHERE unique_id='{$userid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function openProduct($userid){
        $sql = "UPDATE land_product SET land_status='Opened' WHERE unique_id='{$userid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }


    function DeleteAgentCartId($userid,$user){
        $sql = "DELETE  FROM cart WHERE product_id='{$userid}' AND agent_id='{$user}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function DeleteCartId2($userid,$user){
        $sql = "DELETE  FROM cart WHERE product_id='{$userid}' AND user_id='{$user}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
           //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function DeleteCartId3($userid,$user){
        $sql = "DELETE  FROM cart WHERE product_id='{$userid}' AND agent_id='{$user}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
           //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }


    function updatePassword($unique,$password){
        $sql2 = "SELECT * FROM user WHERE token='{$unique}'";
        $result = $this->dbcon->query($sql2);
        $rows = $result->fetch_assoc();
        if($result->num_rows == 1){
                       $pwd = password_hash($password,PASSWORD_DEFAULT);
                        $sql = "UPDATE user SET user_password='{$pwd}' WHERE token='{$unique}'";
                        $result = $this->dbcon->query($sql);
                        if($this->dbcon->affected_rows == 1){
                            echo "success";
                        }else{
                            echo "Could not update password try again later";
                        }
           
        }else{
              echo "Invalid User";
        }
               
    }

    
    function updateAgentPassword($unique,$password){
        $sql2 = "SELECT * FROM agent_table WHERE token='{$unique}'";
        $result = $this->dbcon->query($sql2);
        $rows = $result->fetch_assoc();
        if($result->num_rows == 1){
                       $pwd = password_hash($password,PASSWORD_DEFAULT);
                        $sql = "UPDATE agent_table SET agent_password='{$pwd}' WHERE token='{$unique}'";
                        $result = $this->dbcon->query($sql);
                        if($this->dbcon->affected_rows == 1){
                            echo "success";
                        }else{
                            echo "Could not update password try again later";
                        }
           
        }else{
              echo "Invalid User";
        }
               
    }


    function updateExecutivePassword($unique,$password){
        $sql2 = "SELECT * FROM executive WHERE token='{$unique}'";
        $result = $this->dbcon->query($sql2);
        $rows = $result->fetch_assoc();
        if($result->num_rows == 1){
                       $pwd = password_hash($password,PASSWORD_DEFAULT);
                        $sql = "UPDATE executive SET executive_password='{$pwd}' WHERE token='{$unique}'";
                        $result = $this->dbcon->query($sql);
                        if($this->dbcon->affected_rows == 1){
                            echo "success";
                        }else{
                            echo "Could not update password try again later";
                        }
           
        }else{
              echo "Invalid User";
        }
               
    }

    function updateSubPassword($unique,$password){
        $sql2 = "SELECT * FROM sub_admin WHERE token='{$unique}'";
        $result = $this->dbcon->query($sql2);
        $rows = $result->fetch_assoc();
        if($result->num_rows == 1){
                       $pwd = password_hash($password,PASSWORD_DEFAULT);
                        $sql = "UPDATE sub_admin SET subadmin_password='{$pwd}' WHERE token='{$unique}'";
                        $result = $this->dbcon->query($sql);
                        if($this->dbcon->affected_rows == 1){
                            echo "success";
                        }else{
                            echo "Could not update password try again later";
                        }
           
        }else{
              echo "Invalid User";
        }
               
    }

    function updateSuperPassword($unique,$password){
        $sql2 = "SELECT * FROM super_admin WHERE token='{$unique}'";
        $result = $this->dbcon->query($sql2);
        $rows = $result->fetch_assoc();
        if($result->num_rows == 1){
                       $pwd = password_hash($password,PASSWORD_DEFAULT);
                        $sql = "UPDATE super_admin SET super_adminpassword='{$pwd}' WHERE token='{$unique}'";
                        $result = $this->dbcon->query($sql);
                        if($this->dbcon->affected_rows == 1){
                            echo "success";
                        }else{
                            echo "Could not update password try again later";
                        }
           
        }else{
              echo "Invalid User";
        }
               
    }

    function searchProduct($name,$uniquestaff){
        $sql = "SELECT * FROM land_product WHERE product_name = '{$name}'";
        $result = $this->dbcon->query($sql);
        $output = "";
        if($result->num_rows > 0){
          while($data = $result->fetch_assoc()){
    
 if($data['product_unit'] == 0){
   
    $output1 ='
<img src="landimage/'.$data['product_image']
                   .'" alt="'.$data['product_name'].'" />'; 


                   $output3 ='</div>';

$output4 ='<div class="updated-details">
<div class="detail-one">
<div class="unit-detail">
    <div class="detail-btn">
        <p>Limited Units Available</p>
    </div>
    <div class="detail-btn" style="background: #9B51E0;">
        <p>Half plot per Unit</p>
    </div>
</div>
</div>
<div class="detail-two">
<div class="unit-detail2">
    <div class="detail-name">
        <p>'.$data['product_name'].'</p>
</div>
<div class="detail-location">
    <p style="color: #808080;">'.$data['product_location'].'</p>
</div>
</div>
</div>
';



$output5 = '<p>Sold Out</p>';






$output11 ='</div>
</div>
</div>
</div>';


$output .= '<div class="updated-land">
    <div class="updated-img">'.$output1.''.$output3.''.$output4.''.$output5.''.$output11.'';

        }



        if($data['product_unit'] != 0){
        if($uniquestaff != ""){
          
        $output1 ='<a
            href="estateinfo.php?id='.$data['unique_id'].'&key=9298783&unique='.$uniquestaff.'&REF=019299383&keyref=091234549">
<img src="landimage/'.$data['product_image']
                    .'" alt="estate image" />
</a>';
} else {
$output1 ='<a
    href="estateinfo.php?id='.$data['unique_id'].'&key=9298783623&REF=0192993838383&keyref=09123454954848kdksuuejwej">
    <img src="landimage/'.$data['product_image']
                    .'" alt="estate image" />
</a>';
}

$output3 ='</div>';

if($uniquestaff != ""){
    $output4 ='<div class="updated-details">
    <div class="detail-one">
        <div class="unit-detail">
            <div class="detail-btn">
                <p>Limited Units Available</p>
            </div>
            <div class="detail-btn" style="background: #9B51E0;">
                <p>Half plot per Unit</p>
            </div>
        </div>
    </div>
    <div class="detail-two">
        <div class="unit-detail2">
            <div class="detail-name">
                <p>'.$data['product_name'].'</p>
            </div>
            <div class="detail-location">
                <p style="color: #808080;">'.$data['product_location'].'</p>
                <p><a
                        href="estateinfo.php?id='.$data['unique_id'].'&key=9298783623k&unique='.$uniquestaff.'&REF=019299383838383&keyref=09123454954848kdksuuejwej">click
                        here to view</a></p>
            </div>
        </div>
    </div>
    ';

}  else {
    $output4 ='<div class="updated-details">
    <div class="detail-one">
        <div class="unit-detail">
            <div class="detail-btn">
                <p>Limited Units Available</p>
            </div>
            <div class="detail-btn" style="background: #9B51E0;">
                <p>Half plot per Unit</p>
            </div>
        </div>
    </div>
    <div class="detail-two">
        <div class="unit-detail2">
            <div class="detail-name">
                <p>'.$data['product_name'].'</p>
            </div>
            <div class="detail-location">
                <p style="color: #808080;">'.$data['product_location'].'</p>
                <p><a
                        href="estateinfo.php?id='.$data['unique_id'].'&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej">click
                        here to view</a></p>
            </div>
        </div>
    </div>
    ';
}



    $output11 ='
</div>
</div>
</div>
</div>';

if($data['outright_price'] != 0){
$outprice = $data['outright_price'];
$onemonthprice = $data['onemonth_price'];
$allocationfee = $data['allocation_fee'];
if($outprice > 999 || $outprice > 9999 || $outprice > 99999 || $outprice > 999999){
$output6 = number_format($outprice);

}


if($data['outright_price'] != 0 && $data['onemonth_price'] == 0){
   if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999 || $allocationfee > 9999999){
  $allocationfee2 = number_format($allocationfee);
} else {
   $allocationfee2 = round($allocationfee);
}

$output5 = '
<div class="detail-four" style="gap: 1em;">
    <p style="color: #808080; padding-top: 1em;"><span>Outright
            Price:&nbsp;&nbsp;</span>&#8358;'.$output6.'</p>
            <p><span>Allocation Fee:&nbsp;&nbsp;</span>&#8358;'.$allocationfee2.'</p>
            ';

} else {
    $output5 = '
<div class="detail-four" style="gap: 1em;">
    <p style="color: #808080; padding-top: 1em;"><span>Outright
            Price:&nbsp;&nbsp;</span>&#8358;'.$output6.'</p>';
}


    } else {
    $output5 = '<p style="color: #ff6600;  padding-top: 1em;">Subscription Only</p>';
    }


    if($data['onemonth_price'] != 0){
        $overallprice = $data['eighteen_percent'] / 100 * $data['onemonth_price'];
    $totprice = $overallprice + $data['onemonth_price'];
    $totalprice = number_format($totprice);
    $onemonthprice = $totprice / 540;
    $allocationfee = $data['allocation_fee'];

   
        if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999 || $allocationfee > 9999999){
       $allocationfee2 = number_format($allocationfee);
     } else {
        $allocationfee2 = round($allocationfee);
     }

    

    if($onemonthprice > 999 || $onemonthprice > 9999 || $onemonthprice > 99999 || $onemonthprice > 999999){
    $outinprice = number_format($onemonthprice);
    
    } else {
        $outinprice = round($onemonthprice);
    }
    $output7 = '<p style="color: #808080;"><span>Daily Price:&nbsp;&nbsp;</span>&#8358;'.$outinprice.'
    </p>
    <p><span>Allocation Fee:&nbsp;&nbsp;</span>&#8358;'.$allocationfee2.'</p>
</div>';

$output8 = '<p style="color: #808080;"><span>Subscription Price(18 Months):&nbsp;&nbsp;</span>&#8358;'.$totalprice.'</p>';

$output .= '<div class="updated-land">
    <div class="updated-img">'.$output1.''.$output3.''.$output4.''.$output5.''.$output8.''.$output7.''.$output11.'';

} else {
$output7 = '
<p style="color: #ff6600;">Outright Only</p>
</div>';

$output .= '<div class="updated-land">
    <div class="updated-img">'.$output1.''.$output3.''.$output4.''.$output5.''.$output7.''.$output11.'';
}


        }


        }
        }else{
        $output .= "<div class='success'>
            <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
            <p>We are sorry but this land</p>
            <p>is unavailable at the moment!</p>
        </div>";


        }
        echo $output;



        }

        function searchLand($name){
            $sql = "SELECT * FROM land_product WHERE product_name = '{$name}'";
            $result = $this->dbcon->query($sql);
            $output = "";
            if($result->num_rows > 0){
              while($data = $result->fetch_assoc()){
            //       $outputs .= '<a href="chatpage.php?user_id='.$data['unique_id'].'"><div class="chat-friend">
            //       <div class="chatimg">
            //         <img src="profile/'.$data['profileimg'].'" alt="">
            //      </div>
            //         <a href="chatpage.php?user_id='.$data['unique_id'].'">
            //         <div>
            //         <h3 style="color:black;">'.$data['username'].'</h3>
            //         <p style="color:black; left:10px;"></p></div></a>
            //      <a href="chatpage.php?user_id='.$data['unique_id'].'"><div class="status-dot '.$offline.'" style=""><i class="fas fa-circle" style="font-size:15px;"></i></div></a>
            //    </div></a>';
    
              
               
    
               
     if($data['product_unit'] == 0){
       
        $output1 ='
    <img src="landimage/'.$data['product_image']
                       .'" alt="'.$data['product_name'].'" />'; 
    
    
                       $output3 ='</div>';
    
    $output4 ='<div class="updated-details">
    <div class="detail-one">
    <div class="unit-detail">
        <div class="detail-btn">
            <p>Limited Units Available</p>
        </div>
        <div class="detail-btn" style="background: #9B51E0;">
            <p>Half plot per Unit</p>
        </div>
    </div>
    </div>
    <div class="detail-two">
    <div class="unit-detail2">
        <div class="detail-name">
            <p>'.$data['product_name'].'</p>
    </div>
    <div class="detail-location">
        <p style="color: #808080;">'.$data['product_location'].'</p>
    </div>
    </div>
    </div>
    ';
    
    
    
    $output5 = '<p>Sold Out</p>';
    
    
    
    
    
    
    $output11 ='</div>
    </div>
    </div>
    </div>';
    
    
    $output .= '<div class="updated-land">
        <div class="updated-img">'.$output1.''.$output3.''.$output4.''.$output5.''.$output11.'';
    
            }
    
    
    
            if($data['product_unit'] != 0){
          
         
  
    $output1 ='
        <img src="landimage/'.$data['product_image']
                        .'" alt="estate image" />
    ';
    
    
    $output3 ='</div>';
    

    
 
        $output4 ='<div class="updated-details">
        <div class="detail-one">
            <div class="unit-detail">
                <div class="detail-btn">
                    <p>Limited Units Available</p>
                </div>
                <div class="detail-btn" style="background: #9B51E0;">
                    <p>Half plot per Unit</p>
                </div>
            </div>
        </div>
        <div class="detail-two">
            <div class="unit-detail2">
                <div class="detail-name">
                    <p>'.$data['product_name'].'</p>
                </div>
            </div>
        </div>
        ';
    
    
    
        $output11 ='
    </div>
    </div>
    </div>
    </div>';
    
    if($data['outright_price'] != 0){
    $outprice = $data['outright_price'];
    $onemonthprice = $data['onemonth_price'];
    $allocationfee = $data['allocation_fee'];
    if($outprice > 999 || $outprice > 9999 || $outprice > 99999 || $outprice > 999999){
    $output6 = number_format($outprice);
    
    }

    if($data['outright_price'] != 0 && $data['onemonth_price'] == 0){
        if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999 || $allocationfee > 9999999){
       $allocationfee2 = number_format($allocationfee);
     } else {
        $allocationfee2 = round($allocationfee);
     }

     $output5 = '
     <div class="detail-four" style="gap: 1em;">
         <p style="color: #808080; padding-top: 1em;"><span>Outright
                 Price:&nbsp;&nbsp;</span>&#8358;'.$output6.'</p>
                 <p><span>Allocation Fee:&nbsp;&nbsp;</span>&#8358;'.$allocationfee2.'</p>
                 ';
    } else {
        $output5 = '
        <div class="detail-four" style="gap: 1em;">
            <p style="color: #808080;  padding-top: 1em;"><span>Outright
                    Price:&nbsp;&nbsp;</span>&#8358;'.$output6.'</p>';
    }
    
  
    
    
        } else {
        $output5 = '<p style="color: #ff6600;  padding-top: 1em;">Subscription Only</p>';
        }
    
    
        if($data['onemonth_price'] != 0){
            $overallprice = $data['eighteen_percent'] / 100 * $data['onemonth_price'];
        $totprice = $overallprice + $data['onemonth_price'];
        $totalprice = number_format($totprice);
        $onemonthprice = $totprice / 540;
        $allocationfee = $data['allocation_fee'];

   
        if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999 || $allocationfee > 9999999){
       $allocationfee2 = number_format($allocationfee);
     } else {
        $allocationfee2 = round($allocationfee);
     }
        if($onemonthprice > 999 || $onemonthprice > 9999 || $onemonthprice > 99999 || $onemonthprice > 999999){
        $outinprice = number_format($onemonthprice);
        
        } else {
            $outinprice = round($onemonthprice);
        }
        $output7 = '<p style="color: #808080;"><span>Daily Price:&nbsp;&nbsp;</span>&#8358;'.$outinprice.'
        </p>
        <p><span>Allocation Fee:&nbsp;&nbsp;</span>&#8358;'.$allocationfee2.'</p>
    </div>';
    
    $output8 = '<p style="color: #808080;
    "><span>Subscription Price(18 Months):&nbsp;&nbsp;</span>&#8358;'.$totalprice.'</p>';
    
    $output .= '<div class="updated-land">
        <div class="updated-img">'.$output1.''.$output3.''.$output4.''.$output5.''.$output8.''.$output7.''.$output11.'';
    
    } else {
    $output7 = '
    <p style="color: #ff6600;">Outright Only</p>
    </div>';
    
    $output .= '<div class="updated-land">
        <div class="updated-img">'.$output1.''.$output3.''.$output4.''.$output5.''.$output7.''.$output11.'';
    }
    
    
            }
    
    
            }
            }else{
            $output .= "<div class='success'>
                <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
                <p>We are sorry but this land</p>
                <p>is unavailable at the moment!</p>
            </div>";
    
    
            }
            echo $output;
    
    
    
            }
    


function searchForCustomer($name,$ref){
    $sql = "SELECT * FROM user WHERE email = '{$name}'  AND referral_id = '{$ref}'";
    $result = $this->dbcon->query($sql);
    $output = "";
    
    if($result->num_rows > 0){
      while($data = $result->fetch_assoc()){
        $output1 = '<div class="account-detail2">
                    <div class="radius"> ';
                         if(!empty($data['photo'])){
$output2 = '<img src="profileimage/'.$data['photo'].'" alt="profile image" /></div>';
 }
if(empty($data['photo'])){
 $output2 = '<div class="empty-img">
    <i class="ri-user-fill"></i>
</div> 
</div> ';
}
$output3 ='
        <div class="flex">
    <p style="text-transform: capitalize;">
        <span>'.$data['first_name'].'</span>&nbsp;<span>'.$data['last_name'].'</span>
</p>
<span>'.$data['email'].'</span>
</div>
<a href="customerinfo.php?unique='.$data['unique_id'].'&real=91838JDFOJOEI939" style="color: #808080;"><i
        class="ri-arrow-right-s-line"></i></a>
</div> ';
$output .= ''.$output1.''.$output2.''.$output3.'';
}
} else {
$output .= "
  <div class='success'>
   <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
  <p>This customer does not exist </p>
  </div>
";
}

echo $output;
}


function searchCustomer($name){
    $sql = "SELECT * FROM user WHERE email = '{$name}'";
    $result = $this->dbcon->query($sql);
    $output = "";
    
    if($result->num_rows > 0){
      while($data = $result->fetch_assoc()){
        $output1 = '<div class="account-detail2">
                    <div class="radius"> ';
                         if(!empty($data['photo'])){
$output2 = '<img src="profileimage/'.$data['photo'].'" alt="profile image" /></div>';
 }
if(empty($data['photo'])){
 $output2 = '<div class="empty-img">
    <i class="ri-user-fill"></i>
</div> 
</div> ';
}
$output3 ='
        <div class="flex">
    <p style="text-transform: capitalize;">
        <span>'.$data['first_name'].'</span>&nbsp;<span>'.$data['last_name'].'</span>
</p>
<span class="email-span">'.$data['email'].'</span>
</div>
<a href="customerinfo.php?unique='.$data['unique_id'].'&real=91838JDFOJOEI939" style="color: #808080;"><i
        class="ri-arrow-right-s-line"></i></a>
</div> ';
$output .= ''.$output1.''.$output2.''.$output3.'';
}
} else {
$output .= "
  <div class='success'>
   <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
  <p>This customer does not exist </p>
  </div>
";
}

echo $output;
}


function searchAgent($name){
    $sql = "SELECT * FROM agent_table WHERE agent_email = '{$name}'";
    $result = $this->dbcon->query($sql);
    $output = "";
    
    if($result->num_rows > 0){
      while($data = $result->fetch_assoc()){
        $output1 = '<div class="account-detail2">
                    <div class="radius"> ';
                         if(!empty($data['agent_img'])){
$output2 = '<img src="profileimage/'.$data['agent_img'].'" alt="profile image" /></div>';
 }
if(empty($data['agent_img'])){
 $output2 = '<div class="empty-img">
    <i class="ri-user-fill"></i>
</div> 
</div> ';
}
$output3 ='
        <div class="flex">
    <p style="text-transform: capitalize;">
        <span>'.$data['agent_name'].'</span>
</p>
<span class="email-span">'.$data['agent_email'].'</span>
</div>

<a href="agentinfo.php?unique='.$data['uniqueagent_id'].'&real=91838JDFOJOEI939" style="color: #808080;"><i
        class="ri-arrow-right-s-line"></i></a>
</div> ';
$output .= ''.$output1.''.$output2.''.$output3.'';
}
} else {
$output .= "
  <div class='success'>
   <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
  <p>This agent does not exist </p>
  </div>
";
}

echo $output;
}

function searchAgentEarning($name){
    $sql = "SELECT * FROM agent_table WHERE agent_email = '{$name}'";
    $result = $this->dbcon->query($sql);
    $output = "";
    
    if($result->num_rows > 0){
      while($data = $result->fetch_assoc()){
        $totalpayment = "SELECT SUM(product_price) FROM land_history WHERE agent_id = '{$data['uniqueagent_id']}' ORDER BY payment_id DESC";
        $result2 = $this->dbcon->query($totalpayment);
        $row = $result2->fetch_assoc();
        // if($result->num_rows == 1){
        //     return $row;
        // }else{
        //     return $row;
        // }

        $output1 = '
        <a href="agenthistory.php?unique='.$data['uniqueagent_id'].'">
        <div class="account-detail2">
                    <div class="radius"> ';
                         if(!empty($data['agent_img'])){
$output2 = '<img src="profileimage/'.$data['agent_img'].'" alt="profile image" /></div>';
 }
if(empty($data['agent_img'])){
 $output2 = '<div class="empty-img">
    <i class="ri-user-fill"></i>
</div> 
</div> ';
}

foreach($row as $key => $value){
   
     
    $percent = $data['earning_percentage'];
    $earnedprice = $percent / 100 * $value;
    $unitprice = $earnedprice;
    
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
        $price =  number_format(round($unitprice));
      } else {
          $price =  round($unitprice);
      }

$output3 ='
        <div class="flex">
    <p style="text-transform: capitalize;">
        <span>'.$data['agent_name'].'</span>
</p>
<span class="email-span">Total Earnings: &#8358;'.$price.''; 
}


       
        

$output4 = '</span>
</div>
</div> 
</a>';
$output .= ''.$output1.''.$output2.''.$output3.''.$output4.'';
}
} else {
$output .= "
  <div class='success'>
   <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
  <p>This agent does not exist </p>
  </div>
";
}

echo $output;
}


function searchAgentEarningByMonth($month,$year){
    $sql = "SELECT * FROM land_history WHERE payment_month='{$month}' AND payment_year = '{$year}' ORDER BY payment_id DESC";
    $result = $this->dbcon->query($sql);
    $output = "";
    $agentid = [];
    if($result->num_rows > 0){
      while($data = $result->fetch_assoc()){
         array_push($agentid,$data['agent_id']);
}

$agentid2 = array_unique($agentid);
for ($i=0; $i < count($agentid2); $i++) { 
$totalpayment = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$agentid2[$i]}'";
        $result2 = $this->dbcon->query($totalpayment);
        $row = $result2->fetch_assoc();
        // if($result->num_rows == 1){
        //     return $row;
        // }else{
        //     return $row;
        // }
        foreach($row as $key => $value){

            $totalearning = "SELECT SUM(product_price) FROM land_history WHERE agent_id = '{$row['uniqueagent_id']}' ORDER BY payment_id DESC";
            $result3 = $this->dbcon->query($totalearning);
            $row2 = $result3->fetch_assoc();

        $output1 = '
        <a href="agenthistory.php?unique='.$row['uniqueagent_id'].'">
        <div class="account-detail2">
                    <div class="radius"> ';
                         if(!empty($row['agent_img'])){
$output2 = '<img src="profileimage/'.$row['agent_img'].'" alt="profile image" /></div>';
 }
if(empty($row['agent_img'])){
 $output2 = '<div class="empty-img">
    <i class="ri-user-fill" style="color: #000;"></i>
</div> 
</div> ';
}


   
     foreach ($row2 as $key => $value2) {
      
     
    $percent = $row['earning_percentage'];
    $earnedprice = $percent / 100 * $value2;
    $unitprice = $earnedprice;
    
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
        $price =  number_format(round($unitprice));
      } else {
          $price =  round($unitprice);
      }
    

$output3 ='
        <div class="flex">
    <p style="text-transform: capitalize;">
        <span>'.$row['agent_name'].'</span>
</p>
<span class="email-span">Total Earnings: &#8358;'.$price.''; 
    }




       
        

$output4 = '</span>
</div>
</div> 
</a>';


        }
        $output .= ''.$output1.''.$output2.''.$output3.''.$output4.'';
    }
    
} else {
$output .= "
  <div class='success'>
   <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
  <p>No agent has earned on this month</p>
  </div>
";
}

echo $output;
}

function downloadAgentEarning($month,$year){
    $sql = "SELECT * FROM land_history WHERE payment_month='{$month}' AND payment_year = '{$year}' ORDER BY payment_id DESC";
    $result = $this->dbcon->query($sql);
    $alldata = "";
    $agentid = [];
   
    if($result->num_rows > 0){
      while($data = $result->fetch_assoc()){
         array_push($agentid,$data['agent_id']);
}

$agentid2 = array_unique($agentid);
for ($i=0; $i < count($agentid2); $i++) { 
$totalpayment = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$agentid2[$i]}'";
        $result2 = $this->dbcon->query($totalpayment);
        $row = $result2->fetch_assoc();
        // if($result->num_rows == 1){
        //     return $row;
        // }else{
        //     return $row;
        // }
        foreach($row as $key => $value){

            $totalearning = "SELECT SUM(product_price) FROM land_history WHERE agent_id = '{$row['uniqueagent_id']}' ORDER BY payment_id DESC";
            $result3 = $this->dbcon->query($totalearning);
            $row2 = $result3->fetch_assoc();

       
            if(!empty($row['group_id'])){
                $group = "SELECT * FROM group_table WHERE uniquegroup_id = '{$row['group_id']}'";
                $result5 = $this->dbcon->query($group);
                $row5 = $result5->fetch_assoc();
                $groupname = $row5['group_name'];
              }  else {
                $groupname = "None";
              }

   
     foreach ($row2 as $key => $value2) {
      
     
    $percent = $row['earning_percentage'];
    $earnedprice = $percent / 100 * $value2;
    $unitprice = $earnedprice;
    
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
        $price =  number_format(round($unitprice));
      } else {
          $price =  round($unitprice);
      }

     
    }


    $output2 = '
    <tr>
      <td>'.$row['agent_id'].'</td>
      <td>'.$month.'</td>
      <td>'.$year.'</td>
      <td>'.$row['agent_name'].'</td>
      <td>Agent</td>
      <td>'.$groupname.'</td>
      <td>'.$row['bank_name'].'</td>
      <td>'.$row['account_number'].'</td>
      <td>'.$row['reg_account_name'].'</td>
      <td>'.$price.'</td>
    </tr>
  '; 

  
        }
    $alldata .=  ''.$output2.'';
           
    }
    
} else {
  $alldata .= "No Data";

}

echo $alldata;
}


function searchGroup($name){
    $sql = "SELECT * FROM group_table WHERE group_name = '{$name}'";
    $result = $this->dbcon->query($sql);
    $output = "";
    
    if($result->num_rows > 0){
      while($data = $result->fetch_assoc()){
$output1 = '
<a href="groupmembers.php?unique='.$data['uniquegroup_id'].'">
    <div class="account-detail2">
        <div class="radius"> ';
            if(!empty($data['group_img'])){
            $output2 = '<img src="profileimage/'.$data['group_img'].'" alt="profile image" /></div>';
        }
        if(empty($data['group_img'])){
        $output2 = '<div class="empty-img">
            <i class="ri-user-fill"></i>
        </div>
    </div> ';
    }
    $output3 ='
    <div class="flex">
        <p style="text-transform: capitalize;">
            <span>Group Head:&nbsp;&nbsp;&nbsp;'.$data['group_head'].'</span>
        </p>
        <p style="text-transform: capitalize;">
            <span>Group Name:&nbsp;&nbsp;&nbsp;'.$data['group_name'].'</span>
        </p>
        <p style="text-transform: capitalize;">
            <span>Group Location:&nbsp;&nbsp;&nbsp;'.$data['group_location'].'</span>
        </p>

    </div>
    </div>
</a>';
$output .= ''.$output1.''.$output2.''.$output3.'';
}
} else {
$output .= "
<div class='success'>
    <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
    <p>This group does not exist </p>
</div>
";
}

echo $output;
}




function selectEarningbyname($name){
    $sql = "SELECT * FROM agent_table FULL JOIN land_history WHERE uniqueagent_id = land_history.agent_id AND agent_name = '{$name}' ORDER BY payment_id DESC";
    $result = $this->dbcon->query($sql);
    $output = "";
    
if($result->num_rows > 0){
      while($data = $result->fetch_assoc()){

    if($data['agent_date'] <= $data['payment_date']){
        if($data['earning_percentage'] != ""){  
            $percent = $data['earning_percentage'];
            $earnedprice = $percent / 100 * $data['product_price'];
            $unitprice = $earnedprice;
            if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                              $unit = number_format(round($unitprice));
                            } else {
                                $unit = round($unitprice);
                            }
                        
                            if($data['payee'] == $data['agent_name']){
                                $customer =   $data['agent_name']." Paid:";
                            } 
                            
                            else {
                                $customer =  "Customer Paid:";   
                            }
    
                            $unitprice2 = $data['product_price'];
    
                            if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
                            $unit2 = number_format(round($unitprice2));
                            } else {
                                $unit2 = round($unitprice2);
                            }
    $output.= '<a href="agenthistory.php?unique='.$data['uniqueagent_id'].'">
  <div class="account-detail2" style="height: 3em; display: flex; justify-content: space-between; align-items:center;">
    <div class="flex">
        <p style="text-transform: uppercase;">
            <span style="color: #000000!important; font-size: 16px;">'.$data['agent_name'].'
                earned  &#8358;'.$unit.'</span>
        </p>
                <div class="payee">
                    <p class="payee-tag" style="color: #808080;">'.$customer.'</p>&nbsp;
                    <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                        &#8358;'.$unit2.' for '.$data['product_name'].'</p>
                        </div>
                        <div class="inner-detail">
                            <div class="date">
                                <span style="font-size: 13px;">'.$data['payment_month'].'</span>&nbsp;<span
                            style="font-size: 13px;">'.$data['payment_day'].'</span>&nbsp;<span
                            style="font-size: 13px;">'.$data['payment_year'].'
                          </div>
                       </div>
                </div>
    </div>

                        </a> ';               

}}}
} else {
    $output .= "
    <div class='success'>
        <img src='images/asset_success.svg' alt='' style='width: 15em; height: 15em;' />
        <p>This agent does not exist</p>
    </div>
    ";
}

echo $output;
}

function selectUserEarningbyname($name){
    $sql = "SELECT * FROM user FULL JOIN land_history WHERE unique_id = land_history.agent_id AND first_name = '{$name}' ORDER BY payment_id DESC";
    $result = $this->dbcon->query($sql);
    $output = "";
    
if($result->num_rows > 0){
      while($data = $result->fetch_assoc()){

    if($data['user_date'] <= $data['payment_date']){
        if($data['earning_percentage'] != ""){  
            $percent = $data['earning_percentage'];
            $earnedprice = $percent / 100 * $data['product_price'];
            $unitprice = $earnedprice;
            if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                              $unit = number_format(round($unitprice));
                            } else {
                                $unit = round($unitprice);
                            }
                        
                            if($data['payee'] == $data['first_name']." ".$data['last_name'] ){ 
                                $customer = "".$data['first_name']." ".$data['last_name']." Paid:"; 
                            }   
                            else {
                                $customer =  "Customer Paid:"; }
    
                            $unitprice2 = $data['product_price'];
    
                            if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
                            $unit2 = number_format(round($unitprice2));
                            } else {
                                $unit2 = round($unitprice2);
                            }
    $output.= '
  <div class="account-detail2" style="height: 3em; display: flex; justify-content: space-between; align-items:center;">
    <div class="flex">
        <p style="text-transform: uppercase;">
            <span style="color: #000000!important; font-size: 16px;">'.$data['first_name']." ".$data['last_name'].'
                earned  &#8358;'.$unit.'</span>
        </p>
                <div class="payee">
                    <p class="payee-tag" style="color: #808080;">'.$customer.'</p>&nbsp;
                    <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                        &#8358;'.$unit2.' for '.$data['product_name'].'</p>
                        </div>
                        <div class="inner-detail">
                            <div class="date">
                                <span style="font-size: 13px;">'.$data['payment_month'].'</span>&nbsp;<span
                            style="font-size: 13px;">'.$data['payment_day'].'</span>&nbsp;<span
                            style="font-size: 13px;">'.$data['payment_year'].'
                          </div>
                       </div>
                </div>
    </div>

                         ';               

}}}
} else {
    $output .= "
    <div class='success'>
        <img src='images/asset_success.svg' alt='' style='width: 15em; height: 15em;' />
        <p>This customer does not exist</p>
    </div>
    ";
}

echo $output;
}


function selectUserEarningbyDate($name){
    $sql = "SELECT * FROM user FULL JOIN land_history WHERE unique_id = land_history.agent_id AND payment_date = '{$name}' ORDER BY payment_id DESC";
    $result = $this->dbcon->query($sql);
    $output = "";
    
if($result->num_rows > 0){
      while($data = $result->fetch_assoc()){

    if($data['user_date'] <= $data['payment_date']){
        if($data['earning_percentage'] != ""){  
            $percent = $data['earning_percentage'];
            $earnedprice = $percent / 100 * $data['product_price'];
            $unitprice = $earnedprice;
            if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                              $unit = number_format(round($unitprice));
                            } else {
                                $unit = round($unitprice);
                            }
                        
                            if($data['payee'] == $data['first_name']." ".$data['last_name'] ){ 
                                $customer = "".$data['first_name']." ".$data['last_name']." Paid:"; 
                            }   
                            else {
                                $customer =  "Customer Paid:"; }
    
                            $unitprice2 = $data['product_price'];
    
                            if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
                            $unit2 = number_format(round($unitprice2));
                            } else {
                                $unit2 = round($unitprice2);
                            }
    $output.= '
  <div class="account-detail2" style="height: 3em; display: flex; justify-content: space-between; align-items:center;">
    <div class="flex">
        <p style="text-transform: uppercase;">
            <span style="color: #000000!important; font-size: 16px;">'.$data['first_name']." ".$data['last_name'].'
                earned  &#8358;'.$unit.'</span>
        </p>
                <div class="payee">
                    <p class="payee-tag" style="color: #808080;">'.$customer.'</p>&nbsp;
                    <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                        &#8358;'.$unit2.' for '.$data['product_name'].'</p>
                        </div>
                        <div class="inner-detail">
                            <div class="date">
                                <span style="font-size: 13px;">'.$data['payment_month'].'</span>&nbsp;<span
                            style="font-size: 13px;">'.$data['payment_day'].'</span>&nbsp;<span
                            style="font-size: 13px;">'.$data['payment_year'].'
                          </div>
                       </div>
                </div>
    </div>

                         ';               

}}}
} else {
    $output .= "
    <div class='success'>
        <img src='images/asset_success.svg' alt='' style='width: 15em; height: 15em;' />
        <p>No customer has earned on this date</p>
    </div>
    ";
}

echo $output;
}




function selectEarningbyDate($name){
    $sql = "SELECT * FROM agent_table FULL JOIN land_history WHERE uniqueagent_id = land_history.agent_id AND payment_date = '{$name}' ORDER BY payment_id DESC";
    $result = $this->dbcon->query($sql);
    $output = "";
    
if($result->num_rows > 0){
      while($data = $result->fetch_assoc()){

    if($data['agent_date'] <= $data['payment_date']){
        if($data['earning_percentage'] != ""){  
            $percent = $data['earning_percentage'];
            $earnedprice = $percent / 100 * $data['product_price'];
            $unitprice = $earnedprice;
            if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                              $unit = number_format(round($unitprice));
                            } else {
                                $unit = round($unitprice);
                            }
                        
                            if($data['payee'] == $data['agent_name']){
                                $customer =   $data['agent_name']." Paid:";
                            } 
                            
                            else {
                                $customer =  "Customer Paid:";   
                            }
    
                            $unitprice2 = $data['product_price'];
    
                            if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
                            $unit2 = number_format(round($unitprice2));
                            } else {
                                $unit2 = round($unitprice2);
                            }
    $output.= '<a href="agenthistory.php?unique='.$data['uniqueagent_id'].'">
  <div class="account-detail2" style="height: 3em; display: flex; justify-content: space-between; align-items:center;">
    <div class="flex">
        <p style="text-transform: uppercase;">
            <span style="color: #000000!important; font-size: 16px;">'.$data['agent_name'].'
                earned  &#8358;'.$unit.'</span>
        </p>
                <div class="payee">
                    <p class="payee-tag" style="color: #808080;">'.$customer.'</p>&nbsp;
                    <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                        &#8358;'.$unit2.' for '.$data['product_name'].'</p>
                        </div>
                        <div class="inner-detail">
                            <div class="date">
                                <span style="font-size: 13px;">'.$data['payment_month'].'</span>&nbsp;<span
                            style="font-size: 13px;">'.$data['payment_day'].'</span>&nbsp;<span
                            style="font-size: 13px;">'.$data['payment_year'].'
                          </div>
                       </div>
                </div>
    </div>

                        </a> ';               

}}}
} else {
    $output .= "
    <div class='success'>
        <img src='images/asset_success.svg' alt='' style='width: 15em; height: 15em;' />
        <p>No agent has earned on this date</p>
    </div>
    ";
}

echo $output;
}




}

?>