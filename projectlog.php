<?php 

/**
 * Author : Teibo Gideon Tamaraduobra
 * Program : Yurland Webapp
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

     function createAgent($agentname,$agent_password,$referralid,$earningpercent,$email,$groupid,$creatorid){
        $uniqueid = rand();
        $pwd = password_hash($agent_password,PASSWORD_DEFAULT);
        $agentdate = date("M-d-Y");
          $sql = "INSERT INTO agent_table(uniqueagent_id,agent_name, agent_email,agent_password,referral_id,earning_percentage,agent_date,group_id,creator_id) VALUES('{$uniqueid}','{$agentname}','{$email}','{$pwd}','{$referralid}','{$earningpercent}','{$agentdate}','{$groupid}','{$creatorid}')";
          $result = $this->dbcon->query($sql);
          if($this->dbcon->affected_rows == 1){
             echo "success";
          } else {
             echo $this->dbcon->error;
          }
     }
     

     function createExecutive($execname,$exec_password,$role,$earningpercent,$email,$phonenum,$bankname,$accountnum){
        $uniqueid = rand();
        $execdate = date("M-d-Y");
        $pwd = password_hash($exec_password,PASSWORD_DEFAULT);
          $sql = "INSERT INTO executive(unique_id,full_name,executive_email,executive_password,earning,exec_role,executive_num,executive_date,bank_name,account_number) VALUES('{$uniqueid}','{$execname}','{$email}','{$pwd}','{$earningpercent}','{$role}','{$phonenum}','{$execdate}','{$bankname}','{$accountnum}')";
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
     
     function selectSuperAdminCount(){
        $sql = "SELECT COUNT(unique_id) FROM super_admin";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }


     function createSubAdmin($subadminname,$subadminpassword, $subadminemail, $subadminnum){
        $pwd = password_hash($subadminpassword,PASSWORD_DEFAULT);
        $uniqueid = rand();
          $sql = "INSERT INTO sub_admin(unique_id,subadmin_name,subadmin_password,subadmin_email,subadmin_num) VALUES('{$uniqueid}','{$subadminname}','{$pwd}','{$subadminemail}','{$subadminnum}')";
          $result = $this->dbcon->query($sql);
          if($this->dbcon->affected_rows == 1){
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

      
     function createUser2($firstname, $lastname, $email, $phonenum,$password,$referral,$inforeferral,$creatorid){
        $pwd = password_hash($password,PASSWORD_DEFAULT);
        $uniqueid = rand();
        $userdate = date("M-d-Y");
        $sql = "INSERT INTO user(unique_id,first_name,last_name,email,phone_number,user_password,personal_ref, referral_id,user_date,creator_id) VALUES('{$uniqueid}','{$firstname}', '{$lastname}', '{$email}', '{$phonenum}', '{$pwd}','{$referral}','{$inforeferral}','{$userdate}','{$creatorid}')";
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

     function disableSubadmin($subadminid){
        $sql = "UPDATE sub_admin SET subadmin_status = 'Disabled' WHERE unique_id='{$subadminid}'";
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

     function enableSubadmin($subadminid){
        $sql = "UPDATE sub_admin SET subadmin_status = 'Enabled' WHERE unique_id='{$subadminid}'";
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


     function updateSubadminInfo($agentname,$agentnum,$email,$unique){
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
        
            $userphoto = "SELECT * FROM sub_admin WHERE unique_id = '{$unique}'";
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

            $sql = "UPDATE sub_admin SET subadmin_image='{$newfilename}',subadmin_name='{$agentname}', subadmin_num='{$agentnum}', subadmin_email='{$email}' WHERE unique_id='{$unique}'";
            $result = $this->dbcon->query($sql);
            if($this->dbcon->affected_rows == 1){
               echo "success";
            } else {
               echo $this->dbcon->error;
            }
        } else {

            //upload document
            //$folder = "userdocuments/";
            $newfilename = $row['subadmin_image'];
            $destination_path = getcwd().DIRECTORY_SEPARATOR;
            $target_path = $destination_path . '../profileimage/'. basename($newfilename);
            //$destination = $folder.$newfilename;
            move_uploaded_file($filetmp, $target_path);

            $sql = "UPDATE sub_admin SET subadmin_image='{$newfilename}',subadmin_name='{$agentname}', subadmin_num='{$agentnum}', subadmin_email='{$email}' WHERE unique_id='{$unique}'";
            $result = $this->dbcon->query($sql);
            if($this->dbcon->affected_rows == 1){
               echo "success";
            } else {
               echo $this->dbcon->error;
            }

        }
        
  
    }
   
     }


     function updateExecInfo($agentname,$email,$unique,$num,$earning,$bankname,$accountnum){
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
        
            $userphoto = "SELECT * FROM executive WHERE unique_id = '{$unique}'";
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

            $sql = "UPDATE executive SET executive_img='{$newfilename}',full_name='{$agentname}',executive_email='{$email}',executive_num = '{$num}',earning = '{$earning}',bank_name = '{$bankname}', account_number = '{$accountnum}' WHERE unique_id='{$unique}'";
            $result = $this->dbcon->query($sql);
            if($this->dbcon->affected_rows == 1){
               echo "success";
            } else {
               echo $this->dbcon->error;
            }
        } else {

            //upload document
            //$folder = "userdocuments/";
            $newfilename = $row['executive_img'];
            $destination_path = getcwd().DIRECTORY_SEPARATOR;
            $target_path = $destination_path . '../profileimage/'. basename($newfilename);
            //$destination = $folder.$newfilename;
            move_uploaded_file($filetmp, $target_path);

            $sql = "UPDATE executive SET executive_img='{$newfilename}',full_name='{$agentname}',executive_email='{$email}',executive_num = '{$num}',earning = '{$earning}' ,bank_name = '{$bankname}', account_number = '{$accountnum}' WHERE unique_id='{$unique}'";
            $result = $this->dbcon->query($sql);
            if($this->dbcon->affected_rows == 1){
               echo "success";
            } else {
               echo $this->dbcon->error;
            }

        }
        
  
    }
   
     }




     function updateGroupInfo($groupname,$grouphead,$grouplocation,$unique){
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
        
            $userphoto = "SELECT * FROM group_table WHERE uniquegroup_id = '{$unique}'";
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

            $sql = "UPDATE group_table SET group_img='{$newfilename}',group_name='{$groupname}',group_head='{$grouphead}',group_location='{$grouplocation}' WHERE uniquegroup_id='{$unique}'";
            $result = $this->dbcon->query($sql);
            if($this->dbcon->affected_rows == 1){
               echo "success";
            } else {
               echo $this->dbcon->error;
            }
        } else {

            //upload document
            //$folder = "userdocuments/";
            $newfilename = $row['group_img'];
            $destination_path = getcwd().DIRECTORY_SEPARATOR;
            $target_path = $destination_path . '../profileimage/'. basename($newfilename);
            //$destination = $folder.$newfilename;
            move_uploaded_file($filetmp, $target_path);

            $sql = "UPDATE group_table SET group_img='{$newfilename}',group_name='{$groupname}',group_head='{$grouphead}',group_location='{$grouplocation}' WHERE uniquegroup_id='{$unique}'";
            $result = $this->dbcon->query($sql);
            if($this->dbcon->affected_rows == 1){
               echo "success";
            } else {
               echo $this->dbcon->error;
            }

        }
        
  
    }
   
     }



     function updateLandInfo1($landname,$description,$budget,$state,$size,$feature,$allocationfee,$subscriptionprice,$purpose,$unitnum,$uniqueland){
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
        
            
            $landdetails = "SELECT * FROM land_product WHERE unique_id='{$uniqueland}'";
            $result2 = $this->dbcon->query($landdetails);
            $row = $result2->fetch_assoc();
          
        
            if(!empty($filename)){
                //upload document
            //$folder = "userdocuments/";
            $newfilename = time().rand().".".$file_ext;
            $destination_path = getcwd().DIRECTORY_SEPARATOR;
            $target_path = $destination_path . '../landimage/'. basename($newfilename);
            //$destination = $folder.$newfilename;
            move_uploaded_file($filetmp, $target_path);
                $sql = "UPDATE land_product SET product_name='{$landname}',purpose='{$purpose}',product_description='{$description}',product_budget='{$budget}',product_location='{$state}',onemonth_price='{$subscriptionprice}',product_unit='{$unitnum}', estate_feature='{$feature}', allocation_fee='{$allocationfee}',product_image='{$newfilename}'WHERE unique_id='{$uniqueland}'";
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
            $newfilename = $row['product_image'];
            $destination_path = getcwd().DIRECTORY_SEPARATOR;
            $target_path = $destination_path . '../landimage/'. basename($newfilename);
            //$destination = $folder.$newfilename;
            move_uploaded_file($filetmp, $target_path);
            $sql = "UPDATE land_product SET product_name='{$landname}',purpose='{$purpose}',product_description='{$description}',product_budget='{$budget}',product_location='{$state}',onemonth_price='{$subscriptionprice}',product_unit='{$unitnum}', estate_feature='{$feature}', allocation_fee='{$allocationfee}',product_image='{$newfilename}'WHERE unique_id='{$uniqueland}'";
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

     function updateLandInfo2($landname,$description,$budget,$state,$size,$feature,$allocationfee,$outrightprice,$purpose,$unitnum,$uniqueland){
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
        
            
            $landdetails = "SELECT * FROM land_product WHERE unique_id='{$uniqueland}'";
            $result2 = $this->dbcon->query($landdetails);
            $row = $result2->fetch_assoc();
          
        
            if(!empty($filename)){
                //upload document
            //$folder = "userdocuments/";
            $newfilename = time().rand().".".$file_ext;
            $destination_path = getcwd().DIRECTORY_SEPARATOR;
            $target_path = $destination_path . '../landimage/'. basename($newfilename);
            //$destination = $folder.$newfilename;
            move_uploaded_file($filetmp, $target_path);
                $sql = "UPDATE land_product SET product_name='{$landname}',purpose='{$purpose}',product_description='{$description}',product_budget='{$budget}',product_location='{$state}',outright_price='{$outrightprice}',product_unit='{$unitnum}', estate_feature='{$feature}', allocation_fee='{$allocationfee}',product_image='{$newfilename}'WHERE unique_id='{$uniqueland}'";
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
            $newfilename = $row['product_image'];
            $destination_path = getcwd().DIRECTORY_SEPARATOR;
            $target_path = $destination_path . '../landimage/'. basename($newfilename);
            //$destination = $folder.$newfilename;
            move_uploaded_file($filetmp, $target_path);
            $sql = "UPDATE land_product SET product_name='{$landname}',purpose='{$purpose}',product_description='{$description}',product_budget='{$budget}',product_location='{$state}',outright_price='{$outrightprice}',product_unit='{$unitnum}', estate_feature='{$feature}', allocation_fee='{$allocationfee}',product_image='{$newfilename}'WHERE unique_id='{$uniqueland}'";
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

     function updateLandInfo3($landname,$description,$budget,$state,$size,$feature,$allocationfee,$outrightprice,$subscriptionprice,$purpose,$unitnum,$uniqueland){
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
        
            
            $landdetails = "SELECT * FROM land_product WHERE unique_id='{$uniqueland}'";
            $result2 = $this->dbcon->query($landdetails);
            $row = $result2->fetch_assoc();
          
        
            if(!empty($filename)){
                //upload document
            //$folder = "userdocuments/";
            $newfilename = time().rand().".".$file_ext;
            $destination_path = getcwd().DIRECTORY_SEPARATOR;
            $target_path = $destination_path . '../landimage/'. basename($newfilename);
            //$destination = $folder.$newfilename;
            move_uploaded_file($filetmp, $target_path);
                $sql = "UPDATE land_product SET product_name='{$landname}',purpose='{$purpose}',product_description='{$description}',product_budget='{$budget}',product_location='{$state}',outright_price='{$outrightprice}',onemonth_price='{$subscriptionprice}',product_unit='{$unitnum}', estate_feature='{$feature}', allocation_fee='{$allocationfee}',product_image='{$newfilename}'WHERE unique_id='{$uniqueland}'";
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
            $newfilename = $row['product_image'];
            $destination_path = getcwd().DIRECTORY_SEPARATOR;
            $target_path = $destination_path . '../landimage/'. basename($newfilename);
            //$destination = $folder.$newfilename;
            move_uploaded_file($filetmp, $target_path);
            $sql = "UPDATE land_product SET product_name='{$landname}',purpose='{$purpose}',product_description='{$description}',product_budget='{$budget}',product_location='{$state}',outright_price='{$outrightprice}',onemonth_price='{$subscriptionprice}',product_unit='{$unitnum}', estate_feature='{$feature}', allocation_fee='{$allocationfee}',product_image='{$newfilename}' WHERE unique_id='{$uniqueland}'";
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
        $userdate = date("M-d-Y");
        $sql = "INSERT INTO user(referral_id,email,first_name,last_name,phone_number,unique_id,personal_ref,user_date) VALUES('{$referral}','{$email}','{$firstname}','{$lastname}','{$phone_num}','{$unique}','{$personalref}','{$userdate}')";
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

    function selectGroupName($groupname){
        $sql = "SELECT * FROM group_table WHERE group_name = '{$groupname}'";
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

    function selectGroupCount($uniqueid){
            $sql = "SELECT COUNT(uniqueagent_id) FROM agent_table WHERE group_id='{$uniqueid}'";
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

    function selectSubadminEmail($uniqueid){
        $sql = "SELECT * FROM sub_admin WHERE unique_id = '{$uniqueid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectExecutiveEmail($uniqueid){
        $sql = "SELECT * FROM executive WHERE unique_id = '{$uniqueid}'";
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

    function insertUserAccount($bankname,$accountnum,$uniqueid){
        $sql = "UPDATE user SET bank_name = '{$bankname}', account_number = '{$accountnum}' WHERE unique_id='{$uniqueid}'";
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


    function updateExecutiveDetails($uniqueid,$phonenum,$bankname,$accountnum){
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

       

        $subphoto = "SELECT * FROM executive WHERE unique_id = '{$uniqueid}'";
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

        $sql = "UPDATE executive SET executive_img='{$newfilename}', executive_num = '{$phonenum}', bank_name = '{$bankname}', account_number = '{$accountnum}' WHERE unique_id='{$uniqueid}'";
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
        $newfilename = $row['executive_img'];
        $destination_path = getcwd().DIRECTORY_SEPARATOR;
        $target_path = $destination_path . '../profileimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        move_uploaded_file($filetmp, $target_path);

        $sql = "UPDATE executive SET executive_img='{$newfilename}', executive_num = '{$phonenum}', bank_name = '{$bankname}', account_number = '{$accountnum}' WHERE unique_id='{$uniqueid}'";
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
        $onepercentage = 0;
        $threemonthperiod = 90;
        $threepercentage = 0;
        $sixmonthperiod = 180;
        $sixpercentage = 10;
        $twelvemonthperiod = 360;
        $twelvepercentage = 20;
        $eighteenmonthperiod = 540;
        $eighteenpercentage = 30;
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
         $sql = "INSERT INTO land_product(unique_id,product_name,outright_price,product_image,product_description,estate_feature,product_size,product_location,onemonth_price,purpose,product_unit,product_budget,onemonth_period,threemonth_period,sixmonth_period,twelvemonth_period,eighteen_period,allocation_fee,onemonth_percent,threemonth_percent,sixmonth_percent,twelvemonth_percent,eighteen_percent) VALUES('{$uniqueid}','{$productname}','{$outrightprice}','{$newfilename}','{$productdesc}','{$estatefeature}','{$productsize}','{$productlocation}','{$onemonth}','{$purpose}','{$unitnumber}','{$budget}','{$onemonthperiod}','{$threemonthperiod}','{$sixmonthperiod}','{$twelvemonthperiod}','{$eighteenmonthperiod}','{$allocationfee}','{$onepercentage}','{$threepercentage}','{$sixpercentage}','{$twelvepercentage}','{$eighteenpercentage}')";
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
        $onepercentage = 0;
        $threemonthperiod = 90;
        $threepercentage = 0;
        $sixmonthperiod = 180;
        $sixpercentage = 10;
        $twelvemonthperiod = 360;
        $twelvepercentage = 20;
        $eighteenmonthperiod = 540;
        $eighteenpercentage = 30;
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
         $sql = "INSERT INTO land_product(unique_id,product_name,product_image,product_description,estate_feature,product_size,product_location,onemonth_price,purpose,product_unit,product_budget,onemonth_period,threemonth_period,sixmonth_period,twelvemonth_period,eighteen_period,allocation_fee,onemonth_percent,threemonth_percent,sixmonth_percent,twelvemonth_percent,eighteen_percent) VALUES('{$uniqueid}','{$productname}','{$newfilename}','{$productdesc}','{$estatefeature}','{$productsize}','{$productlocation}','{$onemonth}','{$purpose}','{$unitnumber}','{$budget}','{$onemonthperiod}','{$threemonthperiod}','{$sixmonthperiod}','{$twelvemonthperiod}','{$eighteenmonthperiod}','{$allocationfee}','{$onepercentage}','{$threepercentage}','{$sixpercentage}','{$twelvepercentage}','{$eighteenpercentage}')";
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

    function selectAllYurlandUsers2(){
        $sql = "SELECT * FROM user WHERE referral_id ='Yurland'";
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


    function selectAllSubadmins(){
        $sql = "SELECT * FROM sub_admin ORDER BY subadmin_id DESC";
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

    function selectAllExecutive(){
        $sql = "SELECT * FROM executive ORDER BY executive_id DESC";
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
        $sql = "SELECT SUM(earned_amount) FROM earning_history WHERE earner_id = '{$unique}' ORDER BY earning_id DESC";
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

    function selectAgentTotalPayment($unique){
        $sql = "SELECT SUM(product_price) FROM earning_history WHERE earner_id = '{$unique}' ORDER BY earning_id DESC";
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

    function selectExecutiveTotalEarnings($unique){
        $sql = "SELECT SUM(earned_amount) FROM earning_history WHERE earner_id = '{$unique}' ORDER BY earning_id DESC";
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


    function insertPeriod($onemonth,$threemonth,$sixmonth,$twelvemonth,$eighteenmonth,$eighteenpercentage,$twelvepercentage,$sixpercentage,$threepercentage,$onepercentage,$eighteenupdate,$twelveupdate,$sixupdate,$threeupdate,$oneupdate){
        $sql = "UPDATE land_product SET onemonth_period='{$onemonth}', threemonth_period='{$threemonth}', sixmonth_period='{$sixmonth}', twelvemonth_period='{$twelvemonth}', eighteen_period='{$eighteenmonth}',onemonth_percent='{$onepercentage}',threemonth_percent='{$threepercentage}', sixmonth_percent='{$sixpercentage}',twelvemonth_percent='{$twelvepercentage}',eighteen_percent='{$eighteenpercentage}',eighteen_increaserate = '{$eighteenupdate}' , twelvemonth_increaserate = '{$twelveupdate}', sixmonth_increaserate = '{$sixupdate}' , threemonth_increaserate = '{$threeupdate}', onemonth_increaserate = '{$oneupdate}' WHERE onemonth_price != 0";
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

    function selectOneUser(){
        $sql = "SELECT * FROM user WHERE unique_id  != '' ORDER BY user_id LIMIT 1";
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

    function editUserPercentage($percent){
        $sql = "UPDATE user SET earning_percentage ='{$percent}' WHERE unique_id != ''";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows > 0){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }

    function editYurlandPercentage($percent){
        $sql = "UPDATE user SET yurland_percentage ='{$percent}' WHERE unique_id != ''";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows > 0){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }

    function insertPayment($customerid,$productid,$productname,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$paymentdate,$chosenplan,$intervalinput,$subprice,$payee,$agentid,$allocationfee,$subperiod,$totalprice,$filename,$totprice,$newpayid,$balance,$subpayment,$firstdate,$increaserate){
        $sql = "INSERT INTO payment(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method,payment_date,product_plan,sub_period,sub_price,payee,agent_id,allocation_fee,offer_letter,period_num,total_price,newpay_id,balance,sub_payment,increase_date,increase_rate) VALUES('{$customerid}','{$productid}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$method}','{$paymentdate}','{$chosenplan}','{$intervalinput}','{$subprice}','{$payee}','{$agentid}','{$allocationfee}','{$filename}','{$subperiod}','{$totprice}','{$newpayid}','{$balance}','{$subpayment}','{$firstdate}','{$increaserate}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
            $userphoto = "SELECT * FROM user WHERE unique_id = '{$customerid}'";
            $result2 = $this->dbcon->query($userphoto);
            $row2 = $result2->fetch_assoc();
         
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }

    function updateFailedPayment($newpayid,$uniqueperson,$unique,$failedcharge,$balance,$prodprice){
        $sql = "UPDATE payment SET failed_charges = '{$failedcharge}', balance = '{$balance}', product_price = '{$prodprice}'  WHERE newpay_id='{$newpayid}' AND customer_id = '{$uniqueperson}' AND product_id = '{$unique}' AND payment_method = 'Subscription'";
      
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }

    function insertPayHistory($customerid,$productid,$productname,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$paymentdate,$chosenplan,$intervalinput,$subprice,$payee,$agentid,$allocationfee,$subperiod,$balance,$newpayid,$substatus){
        $sql = "INSERT INTO land_history(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method,payment_date,product_plan,sub_period,sub_price,payee,agent_id,allocation_fee,period_num,balance,newpay_id,sub_status) VALUES('{$customerid}','{$productid}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$method}','{$paymentdate}','{$chosenplan}','{$intervalinput}','{$subprice}','{$payee}','{$agentid}','{$allocationfee}','{$subperiod}','{$balance}','{$newpayid}','{$substatus}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    function insertPayHistory3($customerid,$productid,$productname,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$paymentdate,$chosenplan,$intervalinput,$subprice,$payee,$agentid,$allocationfee,$subperiod,$filename,$balance,$newpayid){
        $sql = "INSERT INTO land_history(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method,payment_date,product_plan,sub_period,sub_price,payee,agent_id,allocation_fee,period_num,allocation_letter,balance,newpay_id) VALUES('{$customerid}','{$productid}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$method}','{$paymentdate}','{$chosenplan}','{$intervalinput}','{$subprice}','{$payee}','{$agentid}','{$allocationfee}','{$subperiod}','{$filename}','{$balance}','{$newpayid}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    function insertPayHistory2($customerid,$productid,$productname,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$paymentdate,$chosenplan,$intervalinput,$subprice,$payee,$agentid,$allocationfee,$subperiod,$filename,$newpayid,$balance,$subpayment){
        $sql = "INSERT INTO land_history(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method,payment_date,product_plan,sub_period,sub_price,payee,agent_id,allocation_fee,period_num,offer_letter,newpay_id,balance,sub_payment) VALUES('{$customerid}','{$productid}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$method}','{$paymentdate}','{$chosenplan}','{$intervalinput}','{$subprice}','{$payee}','{$agentid}','{$allocationfee}','{$subperiod}','{$filename}','{$newpayid}','{$balance}','{$subpayment}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }


    function insertOutPayment($customerid,$productid,$productname,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$paymentdate,$payee,$agentid,$allocationfee,$filename,$newpayid){
        
        $sql = "INSERT INTO payment(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method,payment_date,payee,agent_id,balance,allocation_fee,allocation_letter,total_price,newpay_id) VALUES('{$customerid}','{$productid}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$method}','{$paymentdate}','{$payee}','{$agentid}','{$balance}','{$allocationfee}','{$filename}','{$price}','{$newpayid}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    function insertOutPayHistory($customerid,$productid,$productname,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$paymentdate,$payee,$agentid,$allocationfee,$filename,$newpayid){
        $balance = 0;
        $sql = "INSERT INTO land_history(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method,payment_date,payee,agent_id,balance,allocation_fee,allocation_letter,total_price,newpay_id) VALUES('{$customerid}','{$productid}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$method}','{$paymentdate}','{$payee}','{$agentid}','{$balance}','{$allocationfee}','{$filename}','{$price}','{$newpayid}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }


    function insertFailedHistory($uniqueperson,$unique,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$image,$boughtunit,$paymentmethod,$paymentdate,$productname,$payee,$agentid,$allocationfee,$newpayid,$price,$filename,$balance){
        $sql = "INSERT INTO land_history(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method,payment_date,payee,agent_id,allocation_fee,allocation_letter,total_price,newpay_id,balance) VALUES('{$uniqueperson}','{$unique}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$boughtunit}','{$paymentmethod}','{$paymentdate}','{$payee}','{$agentid}','{$allocationfee}','{$filename}','{$price}','{$newpayid}','{$balance}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }


    function insertFailedHistory2($uniqueperson,$unique,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$image,$boughtunit,$paymentmethod,$paymentdate,$productname,$payee,$agentid,$allocationfee,$newpayid,$price,$balance){
        $sql = "INSERT INTO land_history(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method,payment_date,payee,agent_id,allocation_fee,total_price,newpay_id,balance) VALUES('{$uniqueperson}','{$unique}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$boughtunit}','{$paymentmethod}','{$paymentdate}','{$payee}','{$agentid}','{$allocationfee}','{$price}','{$newpayid}','{$balance}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }
    }

    function insertEarningHistory($customerid,$agentid,$earnerid,$paymentdate,$paymentmonth,$paymentyear,$paymenttime,$paymentday,$productprice,$payee,$earnedamount,$earnee,$name,$product_name,$newpayid){
        $sql = "INSERT INTO earning_history(customer_id,agent_id,earner_id,payment_date,payment_month,payment_year,payment_time,payment_day,product_price,payee,earned_amount,earnee,customer_name,product_name,newpay_id) VALUES('{$customerid}','{$agentid}','{$earnerid}','{$paymentdate}','{$paymentmonth}','{$paymentyear}','{$paymenttime}','{$paymentday}','{$productprice}','{$payee}','{$earnedamount}','{$earnee}','{$name}','{$product_name}','{$newpayid}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }


    function insertautodebit($check,$name,$amount,$product,$email){
        $sql = "INSERT INTO autodebit(chargename,name,amount,sub_name,email) VALUES('{$check}','{$name}','{$amount}','{$product}','{$email}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    function insertNewPayment($customerid,$productid,$productname,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$balance,$period,$subperiod,$newpay,$paymentdate,$chosenplan,$subprice,$payee,$agentid,$allocationfee,$filename,$totalprice,$newpayid,$firstdate,$increaserate){
       
        $sql = "INSERT INTO payment(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method,balance,sub_period,period_num,sub_payment,payment_date,product_plan,sub_price,payee,agent_id,allocation_fee,offer_letter,total_price,newpay_id,increase_date,increase_rate) VALUES('{$customerid}','{$productid}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$method}','{$balance}','{$period}','{$subperiod}','{$newpay}','{$paymentdate}','{$chosenplan}','{$subprice}','{$payee}','{$agentid}','{$allocationfee}','{$filename}','{$totalprice}','{$newpayid}','{$firstdate}','{$increaserate}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){

           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    function insertNewPayHistory($customerid,$productid,$productname,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$balance,$period,$subperiod,$newpay,$paymentdate,$chosenplan,$subprice,$payee,$agentid,$allocationfee,$filename,$newpayid){
        $sql = "INSERT INTO land_history(customer_id,product_id,product_name,payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,payment_method,balance,sub_period,period_num,sub_payment,payment_date,product_plan,sub_price,payee,agent_id,allocation_fee,offer_letter,newpay_id) VALUES('{$customerid}','{$productid}','{$productname}','{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$method}','{$balance}','{$period}','{$subperiod}','{$newpay}','{$paymentdate}','{$chosenplan}','{$subprice}','{$payee}','{$agentid}','{$allocationfee}','{$filename}','{$newpayid}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    function updateNewPayment($customerid,$productid,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$paymentdate,$balance,$period,$subperiod,$payee,$agentid,$allocationfee,$newpayid,$firstdate,$increaserate){
        
            $sql = "UPDATE payment SET payment_month='{$paymentmonth}',payment_day='{$paymentday}',payment_year='{$paymentyear}',payment_time='{$paymenttime}',product_location='{$productlocation}',product_price='{$price}',product_image='{$image}',product_unit='{$addedunit}',payment_method='{$method}',payment_date='{$paymentdate}', balance='{$balance}',sub_period='{$period}',period_num='{$subperiod}', payee='{$payee}', agent_id='{$agentid}', allocation_fee = '{$allocationfee}' , increase_date = '{$firstdate}', increase_rate = '{$increaserate}' WHERE product_id='{$productid}' AND payment_status='Payed' AND customer_id='{$customerid}' AND newpay_id = '{$newpayid}'";
        
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }


    function updateNewPayment2($customerid,$productid,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$paymentdate,$balance,$period,$subperiod,$payee,$agentid,$allocationfee,$filename,$newpayid){
        
        $sql = "UPDATE payment SET payment_month='{$paymentmonth}',payment_day='{$paymentday}',payment_year='{$paymentyear}',payment_time='{$paymenttime}',product_location='{$productlocation}',product_price='{$price}',product_image='{$image}',product_unit='{$addedunit}',payment_method='{$method}',payment_date='{$paymentdate}', balance='{$balance}',sub_period='{$period}',period_num='{$subperiod}', payee='{$payee}', agent_id='{$agentid}', allocation_fee = '{$allocationfee}', allocation_letter = '{$filename}' WHERE product_id='{$productid}' AND payment_status='Payed' AND customer_id='{$customerid}' AND newpay_id = '{$newpayid}'";
    $result = $this->dbcon->query($sql);
    if($this->dbcon->affected_rows == 1){
       //echo "success";
    } else {
       echo $this->dbcon->error;
    }

}


    function insertUpdateHistory($customerid,$productid,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$paymentdate,$balance,$period,$subperiod,$productname,$payee,$agentid,$allocationfee,$newpayid){
        $sql = "INSERT INTO land_history(payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,balance,sub_period,period_num,payment_method,product_id,payment_status,customer_id,product_name,payee,agent_id,payment_date,allocation_fee,newpay_id) VALUES('{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$balance}','{$period}','{$subperiod}','{$method}','{$productid}','Payed','{$customerid}','{$productname}','{$payee}','{$agentid}','{$paymentdate}','{$allocationfee}','{$newpayid}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    
    function insertUpdateHistory2($customerid,$productid,$paymentmonth,$paymentday,$paymentyear,$paymenttime,$productlocation,$price,$image,$addedunit,$method,$paymentdate,$balance,$period,$subperiod,$productname,$payee,$agentid,$allocationfee,$filename,$newpayid){
        $sql = "INSERT INTO land_history(payment_month,payment_day,payment_year,payment_time,product_location,product_price,product_image,product_unit,balance,sub_period,period_num,payment_method,product_id,payment_status,customer_id,product_name,payee,agent_id,payment_date,allocation_fee,allocation_letter,newpay_id) VALUES('{$paymentmonth}','{$paymentday}','{$paymentyear}','{$paymenttime}','{$productlocation}','{$price}','{$image}','{$addedunit}','{$balance}','{$period}','{$subperiod}','{$method}','{$productid}','Payed','{$customerid}','{$productname}','{$payee}','{$agentid}','{$paymentdate}','{$allocationfee}','{$filename}','{$newpayid}')";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    function updatePricePayment($customerid,$productid,$priceincrease,$newpayid,$newsubprice,$increasedate){
        $sql = "UPDATE payment SET balance='{$priceincrease}' , sub_price = '{$newsubprice}', increase_date = '{$increasedate}' WHERE product_id='{$productid}'  AND customer_id='{$customerid}' AND newpay_id = '{$newpayid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }


    function updatePricePayment2($customerid,$productid,$priceincrease,$newpayid,$increasedate){
        $sql = "UPDATE payment SET failed_charges ='{$priceincrease}', increase_date = '{$increasedate}' WHERE product_id='{$productid}'  AND customer_id='{$customerid}' AND newpay_id = '{$newpayid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    

    
    function insertPayment2($customerid,$productid,$price,$prodprice,$allocationfee,$amount2,$periodnum){
        $prodprice2 = $prodprice + $amount2;
            $sql = "UPDATE payment SET product_price = '{$prodprice2}' , balance = '{$price}' , allocation_fee = '{$allocationfee}' , period_num = '{$periodnum}' WHERE newpay_id='{$productid}' AND customer_id = '{$customerid}' AND payment_method = 'Subscription'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }

    function insertPayment4($customerid,$productid,$price,$prodprice,$allocationfee,$amount2,$periodnum,$failedcharge){
            $sql = "UPDATE payment SET product_price = '{$prodprice}' , balance = '{$price}' , allocation_fee = '{$allocationfee}' , period_num = '{$periodnum}' , failed_charges = '{$failedcharge}' WHERE newpay_id='{$productid}' AND customer_id = '{$customerid}' AND payment_method = 'Subscription'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
           //echo "success";
        } else {
           echo $this->dbcon->error;
        }

    }


    function insertPayment3($customerid,$productid,$price,$prodprice,$allocationfee,$filename){
            $sql = "UPDATE payment SET product_price = '{$prodprice}' , balance = '{$price}' ,allocation_letter = '{$filename}', allocation_fee = '{$allocationfee}' WHERE newpay_id='{$productid}' AND customer_id = '{$customerid}' AND payment_method = 'Subscription'";
      
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows == 1){
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

  

    function selectProductPayment($idthree,$id,$idtwo){
        $sql = "SELECT * FROM payment WHERE customer_id='{$id}' AND newpay_id = '{$idtwo}' AND product_id = '{$idthree}'LIMIT 1";
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

    function selectProductPayment2($id,$idtwo){
        $sql = "SELECT * FROM payment WHERE customer_id='{$id}' AND newpay_id = '{$idtwo}'LIMIT 1";
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

    function selectProductNewPayment($id,$idtwo,$idthree){
        $sql = "SELECT * FROM payment WHERE product_id='{$id}' AND customer_id='{$idtwo}' AND payment_status='Payed' AND newpay_id = '{$idthree}' LIMIT 1";
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


    function selectProductOldPayment($id,$idtwo,$idthree){
        $sql = "SELECT * FROM payment WHERE product_id='{$id}' AND customer_id='{$idtwo}' AND payment_status='Payed' AND newpay_id = '{$idthree}' LIMIT 1";
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

    function selectProductOldPayment2($id,$idtwo,$idthree){
        $sql = "SELECT * FROM payment WHERE product_id='{$id}' AND customer_id='{$idtwo}' AND newpay_id = '{$idthree}' LIMIT 1";
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

    function selectLastPay($idtwo,$id,$idthree){
        $sql = "SELECT * FROM payment WHERE customer_id='{$idtwo}' AND product_id='{$id}' AND payment_method='NewPayment' AND newpay_id = '{$idthree}' ORDER BY payment_id DESC LIMIT 1";
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

    function selectLatestPay($idtwo,$id){
        $sql = "SELECT * FROM payment WHERE customer_id='{$idtwo}' AND product_id='{$id}' AND product_plan != '' ORDER BY payment_id DESC LIMIT 1";
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


   

    function selectLastSub($idtwo,$id,$idthree){
        $sql = "SELECT * FROM payment WHERE customer_id='{$idtwo}' AND product_id='{$id}' AND newpay_id = '{$idthree}' AND payment_method='Subscription' ORDER BY payment_id DESC LIMIT 1";
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
        $sql = "SELECT * FROM land_history WHERE customer_id='{$id}' AND offer_letter != '{$null}' ORDER BY payment_id DESC";
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
        $sql = "SELECT * FROM land_history WHERE customer_id='{$id}' AND allocation_letter != '{$null}' ORDER BY payment_id DESC";
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
        $sql = "SELECT * FROM earning_history WHERE earner_id='{$id}' ORDER BY earning_id DESC";
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

    function selectUserHistory($id){
        $sql = "SELECT * FROM land_history WHERE customer_id ='{$id}' ORDER BY payment_id DESC";
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
        $sql = "SELECT * FROM earning_history WHERE earner_id='{$id}' ORDER BY earning_id DESC LIMIT 6";
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

    function selectSumUnits($id){
        $sql = "SELECT SUM(product_unit) FROM payment WHERE customer_id='{$id}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectSumUnits2($id){
        $sql = "SELECT SUM(product_unit) FROM payment WHERE agent_id='{$id}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectTotal($id2){
        $sql = "SELECT SUM(earned_amount) FROM earning_history WHERE earner_id = '{$id2}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectTotal2($id){
        $sql = "SELECT SUM(product_price) FROM land_history WHERE agent_id='{$id}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectTotal3($id){
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

    function selectAllEarningAgents($id){
        $sql = "SELECT * FROM earning_history WHERE earner_id = '{$id}'";
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

    function selectNumsCount(){
        $sql = "SELECT COUNT(product_price) FROM land_history";
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

    function selectUsersReg($creatorid){
        $sql = "SELECT COUNT(unique_id) FROM user WHERE creator_id = '{$creatorid}'";
        $result = $this->dbcon->query($sql);
        $row = $result->fetch_assoc();
        if($result->num_rows == 1){
            return $row;
        }else{
            return $row;
        }
    }

    function selectAgentsReg($creatorid){
        $sql = "SELECT COUNT(uniqueagent_id) FROM agent_table WHERE creator_id = '{$creatorid}'";
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

    function selectLandCount($user){
        $sql = "SELECT COUNT(product_price) FROM payment WHERE customer_id='{$user}'";
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

    function selectTotalEarnings(){
        $sql = "SELECT SUM(earned_amount) FROM earning_history";
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

    function selectYurlandEarnings(){
        $sql = "SELECT SUM(earned_amount) FROM earning_history WHERE earner_id = 'Yurland'";
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
        $sql = "UPDATE payment SET delete_status='Deleted' WHERE product_id='{$userid}' AND customer_id='{$user}' AND payment_method='{$pay}' AND payment_id='{$payid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        // echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function updatePayment($userid,$user,$newpayid){
        $sql = "UPDATE payment SET payment_status='Payed' WHERE product_id='{$userid}' AND customer_id='{$user}'AND newpay_id = '{$newpayid}' AND balance !=0";
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
        $sql = "DELETE  FROM payment WHERE product_id='{$userid}' AND customer_id='{$user}' AND payment_method='{$pay}' AND newpay_id='{$payid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function updateLandHistory($userid,$user,$pay,$payid){
        $sql = "UPDATE land_history SET delete_status = 'Deleted' WHERE product_id='{$userid}' AND customer_id='{$user}' AND payment_method='{$pay}' AND newpay_id='{$payid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }


    function updateEarningHistory($payid){
        $sql = "DELETE FROM earning_history WHERE newpay_id='{$payid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function DeleteProductP2($userid,$user,$pay,$payid,$newpayid){
        $sql = "DELETE FROM payment WHERE product_id='{$userid}' AND customer_id='{$user}' AND payment_method='{$pay}' AND payment_id='{$payid}' AND newpay_id='{$newpayid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function updateLandHistory2($userid,$user,$pay,$newpayid){
        $sql = "UPDATE land_history SET delete_status = 'Deleted' WHERE product_id='{$userid}' AND customer_id='{$user}' AND payment_method='{$pay}' AND newpay_id='{$newpayid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function updateLandHistory3($userid,$user,$pay,$newpayid){
        $sql = "UPDATE land_history SET delete_status = 'Deleted' WHERE product_id='{$userid}' AND payment_id='{$user}' AND payment_method='{$pay}' AND newpay_id='{$newpayid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function updateLandHistory4($userid,$user,$pay,$newpayid){
        $sql = "UPDATE land_history SET delete_status = 'Restored' WHERE product_id='{$userid}' AND payment_id='{$user}' AND payment_method='{$pay}' AND newpay_id='{$newpayid}'";
        $result = $this->dbcon->query($sql);
        if($this->dbcon->affected_rows==1){
            //   echo "<h3 align='center'>Photo added successfully</h3>";
            //echo "success";
          }else{
        //echo  $this->dbcon->error;//"<h3 align='center'>There is an error with your file</h3>";
          }
    }

    function updateProductStat($userid,$user,$pay,$payid){
        $sql = "UPDATE payment SET delete_status='Restored' WHERE product_id='{$userid}' AND customer_id='{$user}' AND payment_method='{$pay}' AND newpay_id='{$payid}'";
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
    if($data['land_status'] != "Closed"){
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
    <p style="color: #808080; padding-top: 1em; font-size: 12px;"><span>Outright
            Price:&nbsp;&nbsp;</span>&#8358;'.$output6.'</p>
            <p><span>Allocation Fee:&nbsp;&nbsp;</span>&#8358;'.$allocationfee2.'</p>
            ';

} else {
    $output5 = '
<div class="detail-four" style="gap: 1em;">
    <p style="color: #808080; padding-top: 1em; font-size: 12px;"><span>Outright
            Price:&nbsp;&nbsp;</span>&#8358;'.$output6.'</p>';
}


    } else {
    $output5 = '<p style="color: #ff6600;  padding-top: 1em; font-size: 12px;">Subscription Only</p>';
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
    $output7 = '<p style="color: #808080; font-size: 12px;"><span>Daily Price:&nbsp;&nbsp;</span>&#8358;'.$outinprice.'
    </p>
    <p style="font-size: 12px;"><span>Allocation Fee:&nbsp;&nbsp;</span>&#8358;'.$allocationfee2.'</p>
</div>';

$output8 = '<p style="color: #808080; font-size: 12px;"><span>Subscription Price(18 Months):&nbsp;&nbsp;</span>&#8358;'.$totalprice.'</p>';

$output .= '<div class="updated-land">
    <div class="updated-img">'.$output1.''.$output3.''.$output4.''.$output5.''.$output8.''.$output7.''.$output11.'';

} else {
$output7 = '
<p style="color: #ff6600; font-size: 12px;">Outright Only</p>
</div>';

$output .= '<div class="updated-land">
    <div class="updated-img">'.$output1.''.$output3.''.$output4.''.$output5.''.$output7.''.$output11.'';
}




        } } else {
            
                $output .= "<div class='success'>
                <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
                <p>This land has been closed</p>
            </div>";
            
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
        if($data['land_status'] != "Closed"){
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
            } } else {
                $output .= "<div class='success'>
                <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
                <p>This land has been closed</p>
            </div>";
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

    
            function searchLand2($name){
                $sql = "SELECT * FROM land_product WHERE product_name = '{$name}'";
                $result = $this->dbcon->query($sql);
                $output = "";
                if($result->num_rows > 0){
                  while($data = $result->fetch_assoc()){  
         if($data['product_unit'] == 0){
           
            $output1 ='
            <a
            href="superadmininfo.php?id='.$data['unique_id'].'&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej">
<img src="landimage/'.$data['product_image']
                           .'" alt="'.$data['product_name'].'" /></a>';


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

    $output11 ='
</div>
</div>
</div>
</div>';

$output .= '<div class="updated-land">
    <div class="updated-img">'.$output1.''.$output3.''.$output4.''.$output5.''.$output11.'';

        }

        if($data['product_unit'] != 0){

        $output1 ='
        <a
        href="superadmininfo.php?id='.$data['unique_id'].'&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej">
        <img src="landimage/'.$data['product_image']
                            .'" alt="estate image" /></a>
        ';

        $output3 ='
    </div>';

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

        if($data['land_status'] == "Closed"){ 
            $output12 = '<div class="detail-four">
                <div class="detail"
                    style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-left: 1em;">
                    <p style="font-size: 14px; color: #fff;">Closed</p>
                </div>
            </div>';
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
if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999 || $allocationfee
> 9999999){
$allocationfee2 = number_format($allocationfee);
} else {
$allocationfee2 = round($allocationfee);
}

$output5 = '
<div class="detail-four" style="gap: 1em;">
    <p style="color: #808080; padding-top: 1em; font-size: 12px;"><span>Outright
            Price:&nbsp;&nbsp;</span>&#8358;'.$output6.'</p>
    <p style="font-size: 12px;"><span>Allocation Fee:&nbsp;&nbsp;</span>&#8358;'.$allocationfee2.'</p>
    ';
    } else {
    $output5 = '
    <div class="detail-four" style="gap: 1em;">
        <p style="color: #808080;  padding-top: 1em; font-size: 12px;"><span>Outright
                Price:&nbsp;&nbsp;</span>&#8358;'.$output6.'</p>';
        }

        } else {
        $output5 = '<p style="color: #ff6600;  padding-top: 1em; font-size: 12px;">Subscription Only</p>';
        }
        if($data['onemonth_price'] != 0){
        $overallprice = $data['eighteen_percent'] / 100 * $data['onemonth_price'];
        $totprice = $overallprice + $data['onemonth_price'];
        $totalprice = number_format($totprice);
        $onemonthprice = $totprice / 540;
        $allocationfee = $data['allocation_fee'];


        if($allocationfee > 999 || $allocationfee > 9999 || $allocationfee > 99999 || $allocationfee > 999999 ||
        $allocationfee > 9999999){
        $allocationfee2 = number_format($allocationfee);
        } else {
        $allocationfee2 = round($allocationfee);
        }
        if($onemonthprice > 999 || $onemonthprice > 9999 || $onemonthprice > 99999 || $onemonthprice > 999999){
        $outinprice = number_format($onemonthprice);

        } else {
        $outinprice = round($onemonthprice);
        }
        $output7 = '<p style="color: #808080; font-size: 12px;"><span>Daily Price:&nbsp;&nbsp;</span>&#8358;'.$outinprice.'
        </p>
        <p style="font-size: 12px;"><span>Allocation Fee:&nbsp;&nbsp;</span>&#8358;'.$allocationfee2.'</p>
    </div>
    ';

   


    $output8 = '<p style="color: #808080;
    font-size: 12px;"><span>Subscription Price(18 Months):&nbsp;&nbsp;</span>&#8358;'.$totalprice.'</p>';

    if($data['land_status'] == "Closed"){
    $output .= '<div class="updated-land">
        <div class="updated-img">'.$output1.''.$output3.''.$output4.''.$output5.''.$output8.''.$output7.''.$output12.''.$output11.'';
    } else {
        $output .= '<div class="updated-land">
        <div class="updated-img">'.$output1.''.$output3.''.$output4.''.$output5.''.$output8.''.$output7.''.$output11.'';
    }

            } else {
            $output7 = '
            <p style="color: #ff6600;">Outright Only</p>
        </div>';
        if($data['land_status'] == "Closed"){
        $output .= '<div class="updated-land">
            <div class="updated-img">'.$output1.''.$output3.''.$output4.''.$output5.''.$output7.''.$output12.''.$output11.'';
        } else {
            $output .= '<div class="updated-land">
            <div class="updated-img">'.$output1.''.$output3.''.$output4.''.$output5.''.$output7.''.$output11.'';
        }
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
                $sql = "SELECT * FROM user WHERE email = '{$name}' AND referral_id = '{$ref}'";
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
                <a href="customerinfo.php?unique='.$data['unique_id'].'&real=91838JDFOJOEI939"
                    style="color: #808080;"><i class="ri-arrow-right-s-line"></i></a>
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
                $output1 = '
                <div class="transaction-details2">
                    <div class="details" style="text-transform: capitalize;">
                        <p class="pname email-span">
                            <span>'.$data['first_name'].'</span>&nbsp;<span>'.$data['last_name'].'</span>
                        </p>
                    </div>

                    <div class="details hide flexdetail" style="text-transform: lowercase;">
                        <p class="pname email-span"> '.$data['email'].'</p>
</div> ';

$unique = $data['unique_id'];
$sql1 = "SELECT SUM(product_unit) FROM payment WHERE customer_id='{$unique}'";
$result1 = $this->dbcon->query($sql1);
$row1 = $result1->fetch_assoc();
foreach ($row1 as $key => $value1) {
    if(is_null($value1)){
      $data1 =  "0";
    } else{
      $data1 =  $value1;
    }
  }

$sql2 = "SELECT COUNT(product_price) FROM payment WHERE customer_id='{$unique}'";
$result2 = $this->dbcon->query($sql2);
$row2 = $result2->fetch_assoc();
foreach ($row2 as $key => $value) {
$data2 =  $value;
}

$sql3 = "SELECT SUM(product_price) FROM land_history WHERE customer_id='{$unique}'";
$result3 = $this->dbcon->query($sql3);
$row3 = $result3->fetch_assoc();
$date = $data['user_date'];
                
                 foreach ($row3 as $key => $value3) {
                    if(is_null($value3)){
                      $data3 =  "0";
                    } else{
                     
                      if($value3 > 999 || $value3 > 9999 || $value3 > 99999 || $value3 > 999999){
                        $data3 = number_format($value3);
                      } else {
                         $data3 = $value3;
                      }
                    }
                  }


$output2 = '
<div class="details" style="text-transform: capitalize;">
    <p class="pname">'.$data1.'</p>
</div> 

<div class="details" style="text-transform: capitalize;">
    <p class="pname">&#8358;'.$data3.'</p>
</div> 

<div class="details hide flexdetail" style="text-transform: capitalize;">
    <p class="pname">'.$data2.'</p>
</div>

<div class="details hide flexdetail" style="text-transform: capitalize;">
    <p class="pname">'.$date.'</p>
</div>

<div class="details" style="text-transform: capitalize;">
    <div class="detail" style="">
        <a href="customerprofileinfo.php?unique='.$data['unique_id'].'&real=91838JDFOJOEI939">
<p style="font-size: 14px; color: #fff;">View</p>
</a>
</div>
</div>
';


$output .= ''.$output1.''.$output2.'';
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
    $output1 = '
    <div class="transaction-details2">
        <div class="details" style="text-transform: capitalize;">
            <p class="pname email-span">
                <span>'.$data['agent_name'].'</span>
            </p>
        </div>

        <div class="details hide flexdetail" style="text-transform: lowercase;">
            <p class="pname email-span"> '.$data['agent_email'].'</p>
</div> ';

    $output5 = '<div class="details" style="text-transform: capitalize;">
    <p class="pname">&#8358;'; 
    $agentid = $data['uniqueagent_id'];
    $refid = $data['referral_id'];
    $percentage = $data['earning_percentage'];
    $agentdate = $data['agent_date'];
    $sql = "SELECT SUM(earned_amount) FROM earning_history WHERE earner_id = '{$agentid}' ORDER BY earning_id DESC";
    $result = $this->dbcon->query($sql);
    $row = $result->fetch_assoc();
            if($result->num_rows == 1){
                foreach ($row as $key => $value) {
                    $unitprice2 = $value;
                   }
            }else{
                $unitprice2 = $row;
            }
            
            if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
                $data3 =  number_format(round($unitprice2));
              } else {
                  $data3 =  round($unitprice2);
              }
        
        $output6 = $data3.'</p>
    </div> ';


    $output7 = '<div class="details" style="text-transform: capitalize;">
    <p class="pname">&#8358;'; 
    $agentid = $data['uniqueagent_id'];
    $refid = $data['referral_id'];
    $agentdate = $data['agent_date'];
    $sql2 = "SELECT SUM(product_price) FROM earning_history WHERE earner_id = '{$agentid}' ORDER BY earning_id DESC";
    $result2 = $this->dbcon->query($sql2);
    $row2 = $result2->fetch_assoc();
    if($result2->num_rows == 1){
        foreach ($row2 as $key => $value) {
            $unitprice3 = $value;
           }
    }else{
        $unitprice3 = $row2;
    }
            
            if($unitprice3 > 999 || $unitprice3 > 9999 || $unitprice3 > 99999 || $unitprice3 > 999999){
                $data3 =  number_format(round($unitprice3));
              } else {
                  $data3 =  round($unitprice3);
              }
           
        $output8 = $data3.'</p>
    </div> ';


$sql5 = "SELECT * FROM user WHERE referral_id = '{$refid}' ORDER BY user_id DESC";
$result5 = $this->dbcon->query($sql5);
$row5 = array();
while($row = $result5->fetch_assoc()){
    $row5[] = $row;
}

$customer = $row5;

    $output3 = '<div class="details hide flexdetail" style="text-transform: capitalize;">
    <p class="pname">';

        if(!empty($customer)){
            $percent = $percentage / 100;
            $agenttotalunits = [];
            foreach($customer as $key => $value2){
                $unique = $value2['unique_id'];
                $sql1 = "SELECT SUM(product_unit) FROM payment WHERE customer_id='{$unique}'";
                $result1 = $this->dbcon->query($sql1);
                $total1 = $result1->fetch_assoc();
            foreach($total1 as $key => $value3){
              if(is_null($value3)){
                //echo "0";
              } else {
                array_push($agenttotalunits,$value3);
              }  } 
       
            }
            $sumunits = array_sum($agenttotalunits);
            $data1 =  $sumunits;
         } else {
                $data1 =  "0";
            }
        $output4 = $data1.'</p>
    </div> ';

    $referral = $data['referral_id'];
$sql4 = "SELECT COUNT(referral_id) FROM user WHERE referral_id='{$referral}'";
$result4 = $this->dbcon->query($sql4);
$row4 = $result4->fetch_assoc();

foreach ($row4 as $key => $value4) {
    $data4 = $value4;
};

$output2 = '
<div class="details" style="text-transform: capitalize;">
<p class="pname">'.$data4.'</p>
</div> 

';

  

$output9 = ' <div class="details" style="text-transform: capitalize;">
<div class="detail" style="">
    <a href="agentinfo.php?unique='.$agentid.'&real=91838JDFOJOEI939">
        <p style="font-size: 14px; color: #fff;">View</p>
    </a>
</div>
</div>';


$output .= ''.$output1.''.$output5.''.$output6.''.$output7.''.$output8.''.$output3.''.$output4.''.$output2.''.$output9.'';
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


function searchByLand($name,$user,$unique){
    $sql = "SELECT * FROM land_product WHERE product_name = '{$name}'";
    $result = $this->dbcon->query($sql);
    $output = "";
    if($result->num_rows > 0){
        $data = $result->fetch_assoc();
        $sql2 = "SELECT * FROM land_history WHERE product_id = '{$data['unique_id']}' ORDER BY payment_id DESC";
        $result2 = $this->dbcon->query($sql2);
        $rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row2 = $result2->fetch_assoc()){
				$rows[] = $row2;
			}
            if(!empty($rows)){
			foreach ($rows as $key => $value) {
if($value['sub_status'] == "Failed"){ 
$output1 = ' <div class="transaction-details" style="border: 2px solid red;">
<div class="radius">
<img src="landimage/'.$value['product_image'].'" alt="">
</div>
<div class="details">
<p class="pname">'.$value['product_name'].'</p>
<div class="inner-detail">
<div class="date" style="font-size: 14px;">
<span>'.$value['payment_month'].'</span>&nbsp;<span>'.$value['payment_day'].'</span>,<span>'.$value['payment_year'].'</span>,<span>'.$value['payment_time'].'</span>
</div>
</div>
</div> ';

if($value['product_unit'] == "1"){
$unit = $value['product_unit']." Unit";
} else {
$unit = $value['product_unit']." Units";
}
$output2 = '
<div class="price-detail detail3">
'.$unit.'
    </div>
<div class="price-detail detail3">
    '.$value['payment_method'].'</div> ';


if($value['delete_status'] == "Deleted"){

$name = $value['product_id'].$value['payment_id'];

$output3 = '<form action="" class="restore-form" method="POST">
    <input class="price" type="submit" value="Restore" name="restorel'.$name.'"
        style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
</form>
</div>
</div>';

$output4 = "";
$output5 = "";
if(isset($_POST["restorel".$name])){
$insertupdate =
$user->updateLandHistory4($value['product_id'],$value['payment_id'],$value['payment_method'],$value['newpay_id']);

$deletedp = "restorel";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");


}
} else {

$unitprice = $value['product_price'];
if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$amount = number_format($unitprice);
} else {
$amount = round($unitprice);
}


if($user == "subadmin"){
$sql3 = "SELECT * FROM sub_admin WHERE unique_id = '{$unique}'";
$result3 = $this->dbcon->query($sql3);
$row3 = $result3->fetch_assoc();
if($value['payee'] == $row3['subadmin_name']){
$payeename = "You";
} else {
$payeename = $value['payee'];
}
}

if($user == "superadmin"){
$sql3 = "SELECT * FROM super_admin WHERE unique_id = '{$unique}'";
$result3 = $this->dbcon->query($sql3);
$row3 = $result3->fetch_assoc();
if($value['payee'] == $row3['super_adminname']){
$payeename = "You";
} else {
$payeename = $value['payee'];
}
}

$output3 = "";
$output4 = '<div class="price-detail" style="color: red;">&#8358;'.$amount.'
    <span style="font-size: 12px;">(Failed)</span>
    <div class="payee">
        <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
        <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
            '.$payeename.'
        </p>
    </div> ';



    $name = $value['product_id'].$value['payment_id'];

    $output5 = '<form action="" class="deletep-form" method="POST">
        <input class="price" type="submit" value="Delete" name="deletel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div> </div>';
if(isset($_POST["deletel".$name])){
$insertupdate =
$user->updateLandHistory3($value['product_id'],$value['payment_id'],$value['payment_method'],$value['newpay_id']);

$deletedp = "deletedl";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
}
}
$output .= "$output1$output2$output3$output4$output5";
} else {
$output1 = ' <div class="transaction-details">
    <div class="radius">
        <img src="landimage/'.$value['product_image'].'" alt="">
    </div>
    <div class="details">
        <p class="pname">'.$value['product_name'].'</p>
        <div class="inner-detail">
            <div class="date" style="font-size: 14px;">
                <span>'.$value['payment_month'].'</span>&nbsp;<span>'.$value['payment_day'].'</span>,<span>'.$value['payment_year'].'</span>,<span>'.$value['payment_time'].'</span>
            </div>
        </div>
    </div> ';

    if($value['product_unit'] == "1"){
    $unit = $value['product_unit']." Unit";
    } else {
    $unit = $value['product_unit']." Units";
    }

    $output2 = '
    <div class="price-detail detail3">
        '.$unit.'
    </div>
    <div class="price-detail detail3">'.$value['payment_method'].'</div> ';


    if($value['delete_status'] == "Deleted"){

    $name = $value['product_id'].$value['payment_id'];

    $output3 = '<form action="" class="restore-form" method="POST">
        <input class="price" type="submit" value="Restore" name="restorel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div>
<div>';

    $output4 = "";
    $output5 = "";


    if(isset($_POST["restorel".$name])){
    $insertupdate =
    $user->updateLandHistory4($value['product_id'],$value['payment_id'],$value['payment_method'],$value['newpay_id']);

    $deletedp = "restorel";
    header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
    }
    } else {

    $unitprice = $value['product_price'];
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
    $amount = number_format($unitprice);
    } else {
    $amount = round($unitprice);
    }


    if($user == "subadmin"){
    $sql3 = "SELECT * FROM sub_admin WHERE unique_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($value['payee'] == $row3['subadmin_name']){
    $payeename = "You";
    } else {
    $payeename = $value['payee'];
    }
    }

    if($user == "superadmin"){
    $sql3 = "SELECT * FROM super_admin WHERE unique_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($value['payee'] == $row3['super_adminname']){
    $payeename = "You";
    } else {
    $payeename = $value['payee'];
    }
    }

    $output3 = "";

    $output4 = '<div class="price-detail">&#8358;'.$amount.'
        <div class="payee">
            <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
            <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                '.$payeename.'
            </p>
        </div>';



        $name = $value['product_id'].$value['payment_id'];

        $output5 = '<form action="" class="deletep-form" method="POST">
            <input class="price" type="submit" value="Delete" name="deletel'.$name.'"
                style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
        </form>
    </div>
</div>
';

if(isset($_POST["deletel".$name])){
$insertupdate =
$user->updateLandHistory3($value['product_id'],$value['payment_id'],$value['payment_method'],$value['newpay_id']);

$deletedp = "deletedl";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
}
}
$output .= "$output1$output2$output3$output4$output5";
}
}
} else {
$output .= "<div class='success'>
    <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
    <p>We can't find this transaction</p>
</div>";
}
}
} else {
$output .= "<div class='success'>
    <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
    <p>We can't find this transaction</p>
</div>";
}

echo $output;
}


function downloadByLand($name,$mode){
   if($mode == "downloadland"){
    $sql = "SELECT * FROM land_product WHERE product_name = '{$name}'";
   }
    $result = $this->dbcon->query($sql);
    $output = "";
    if($result->num_rows > 0){
        $data = $result->fetch_assoc();
        $sql2 = "SELECT * FROM land_history WHERE product_id = '{$data['unique_id']}' ORDER BY payment_id DESC";
        $result2 = $this->dbcon->query($sql2);
        $rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row2 = $result2->fetch_assoc()){
				$rows[] = $row2;
			}
            if(!empty($rows)){
			foreach ($rows as $key => $value) {
if($value['sub_status'] == "Failed"){ 
    $unitprice = $value['product_price'];
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                      $amount = number_format($unitprice);
                    } else {
                       $amount = round($unitprice);
                    }
                    $uniqueid = $value['customer_id'];
                    $sql2 = "SELECT * FROM user WHERE unique_id = '{$uniqueid}'";
                    $result2 = $this->dbcon->query($sql2);
                    $row2 = $result2->fetch_assoc();
 $output.= '
                 <tr>
                     <td>'.$value['payment_id'].'</td>
                     <td> <span>'.$row2['first_name'].'</span>&nbsp;<span>'.$row2['last_name'].'</span>
</td>
<td>&#8358;'.$amount.'</td>
<td>'.$value['product_name'].'</td>
<td>'.$value['payee'].'</td>
<td>'.$value['payment_date'].'</td>
<td>'.$value['payment_time'].'</td>
</tr>
';
} else {
    $unitprice = $value['product_price'];
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                      $amount = number_format($unitprice);
                    } else {
                       $amount = round($unitprice);
                    }
                    $uniqueid = $value['customer_id'];
                    $sql2 = "SELECT * FROM user WHERE unique_id = '{$uniqueid}'";
                    $result2 = $this->dbcon->query($sql2);
                    $row2 = $result2->fetch_assoc();
    $output.= '
                 <tr>
                     <td>'.$value['payment_id'].'</td>
                     <td> <span>'.$row2['first_name'].'</span>&nbsp;<span>'.$row2['last_name'].'</span>
</td>
<td>&#8358;'.$amount.'</td>
<td>'.$value['product_name'].'</td>
<td>'.$value['payee'].'</td>
<td>'.$value['payment_date'].'</td>
<td>'.$value['payment_time'].'</td>
</tr>
';
}
}
} else {
$output .= "";
}
}
} else {
$output .= "";
}

echo $output;
}



function searchByDate($name,$user,$unique){
$sql = "SELECT * FROM land_history WHERE payment_date = '{$name}' ORDER BY payment_id DESC";
$result = $this->dbcon->query($sql);
$output = "";
if($result->num_rows > 0){
while($data = $result->fetch_assoc()){
if($data['sub_status'] == "Failed"){
$output1 = ' <div class="transaction-details" style="border: 2px solid red;">
    <div class="radius">
        <img src="landimage/'.$data['product_image'].'" alt="">
    </div>
    <div class="details">
        <p class="pname">'.$data['product_name'].'</p>
        <div class="inner-detail">
            <div class="date" style="font-size: 14px;">
                <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
            </div>
        </div>
    </div> ';

    if($data['product_unit'] == "1"){
    $unit = $data['product_unit']." Unit";
    } else {
    $unit = $data['product_unit']." Units";
    }
    $output2 = '
    <div class="price-detail detail3">
        '.$unit.'
    </div>
    <div class="price-detail detail3">
        '.$data['payment_method'].'</div> ';


    if($data['delete_status'] == "Deleted"){

    $name = $data['product_id'].$data['payment_id'];

    $output3 = '<form action="" class="restore-form" method="POST">
        <input class="price" type="submit" value="Restore" name="restorel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div>
</div>';

$output4 = "";
$output5 = "";
if(isset($_POST["restorel".$name])){
$insertupdate =
$user->updateLandHistory4($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

$deletedp = "restorel";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");


}
} else {

$unitprice = $data['product_price'];
if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$amount = number_format($unitprice);
} else {
$amount = round($unitprice);
}


if($user == "subadmin"){
$sql3 = "SELECT * FROM sub_admin WHERE unique_id = '{$unique}'";
$result3 = $this->dbcon->query($sql3);
$row3 = $result3->fetch_assoc();
if($data['payee'] == $row3['subadmin_name']){
$payeename = "You";
} else {
$payeename = $data['payee'];
}
}

if($user == "superadmin"){
$sql3 = "SELECT * FROM super_admin WHERE unique_id = '{$unique}'";
$result3 = $this->dbcon->query($sql3);
$row3 = $result3->fetch_assoc();
if($data['payee'] == $row3['super_adminname']){
$payeename = "You";
} else {
$payeename = $data['payee'];
}
}

$output3 = "";
$output4 = '<div class="price-detail" style="color: red;">&#8358;'.$amount.'
    <span style="font-size: 12px;">(Failed)</span>
    <div class="payee">
        <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
        <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
            '.$payeename.'
        </p>
    </div> ';



    $name = $data['product_id'].$data['payment_id'];

    $output5 = '<form action="" class="deletep-form" method="POST">
        <input class="price" type="submit" value="Delete" name="deletel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div>
</div>';
if(isset($_POST["deletel".$name])){
$insertupdate =
$user->updateLandHistory3($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

$deletedp = "deletedl";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
}
}
$output .= "$output1$output2$output3$output4$output5";
} else {
$output1 = ' <div class="transaction-details">
    <div class="radius">
        <img src="landimage/'.$data['product_image'].'" alt="">
    </div>
    <div class="details">
        <p class="pname">'.$data['product_name'].'</p>
        <div class="inner-detail">
            <div class="date" style="font-size: 14px;">
                <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
            </div>
        </div>
    </div> ';

    if($data['product_unit'] == "1"){
    $unit = $data['product_unit']." Unit";
    } else {
    $unit = $data['product_unit']." Units";
    }

    $output2 = '
    <div class="price-detail detail3">
        '.$unit.'
    </div>
    <div class="price-detail detail3">'.$data['payment_method'].'</div> ';


    if($data['delete_status'] == "Deleted"){

    $name = $data['product_id'].$data['payment_id'];

    $output3 = '<form action="" class="restore-form" method="POST">
        <input class="price" type="submit" value="Restore" name="restorel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div>
<div>';

    $output4 = "";
    $output5 = "";


    if(isset($_POST["restorel".$name])){
    $insertupdate =
    $user->updateLandHistory4($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

    $deletedp = "restorel";
    header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
    }
    } else {

    $unitprice = $data['product_price'];
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
    $amount = number_format($unitprice);
    } else {
    $amount = round($unitprice);
    }


    if($user == "subadmin"){
    $sql3 = "SELECT * FROM sub_admin WHERE unique_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($data['payee'] == $row3['subadmin_name']){
    $payeename = "You";
    } else {
    $payeename = $data['payee'];
    }
    }

    if($user == "superadmin"){
    $sql3 = "SELECT * FROM super_admin WHERE unique_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($data['payee'] == $row3['super_adminname']){
    $payeename = "You";
    } else {
    $payeename = $data['payee'];
    }
    }

    $output3 = "";

    $output4 = '<div class="price-detail">&#8358;'.$amount.'
        <div class="payee">
            <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
            <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                '.$payeename.'
            </p>
        </div>';



        $name = $data['product_id'].$data['payment_id'];

        $output5 = '<form action="" class="deletep-form" method="POST">
            <input class="price" type="submit" value="Delete" name="deletel'.$name.'"
                style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
        </form>
    </div>
</div>
';

if(isset($_POST["deletel".$name])){
$insertupdate =
$user->updateLandHistory3($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

$deletedp = "deletedl";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
}
}
$output .= "$output1$output2$output3$output4$output5";
}
}
} else {
$output .= "<div class='success'>
    <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
    <p>We can't find this transaction</p>
</div>";
}

echo $output;
}


function searchAgentDate($name,$user,$unique){
    if($user == "agent"){
        $sql = "SELECT * FROM land_history WHERE payment_date = '{$name}' AND agent_id = '{$unique}'ORDER BY payment_id DESC";
    }

    if($user == "normaluser"){
        $sql = "SELECT * FROM land_history WHERE payment_date = '{$name}' AND customer_id = '{$unique}'ORDER BY payment_id DESC";
    }
    $result = $this->dbcon->query($sql);
    $output = "";
    if($result->num_rows > 0){
    while($data = $result->fetch_assoc()){
    if($data['sub_status'] == "Failed"){
        $output1 = ' <div class="transaction-details" style="border: 2px solid red;">
        <div class="radius">
            <img src="landimage/'.$data['product_image'].'" alt="">
        </div>
        <div class="details">
            <p class="pname">'.$data['product_name'].'</p>
            <div class="inner-detail">
                <div class="date" style="font-size: 14px;">
                    <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
                </div>
            </div>
        </div> ';
    
        if($data['product_unit'] == "1"){
        $unit = $data['product_unit']." Unit";
        } else {
        $unit = $data['product_unit']." Units";
        }
        $output2 = '
        <div class="price-detail detail3">
            '.$unit.'
        </div>
        <div class="price-detail detail3">
            '.$data['payment_method'].'</div> ';
    
    
        if($data['delete_status'] == "Deleted"){
    
        $output3 = ' <div class="detail-four">
        <div class="detail"
            style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
            <p style="font-size: 14px; color: #fff;">Deleted</p>
        </div>
    </div>
    </div>
    </div>';
    
    $output4 = "";
    $output5 = "";
    
    } else {
    
    $unitprice = $data['product_price'];
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
    $amount = number_format($unitprice);
    } else {
    $amount = round($unitprice);
    }
    
    
    if($user == "agent"){
    $sql3 = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($data['payee'] == $row3['agent_name']){
    $payeename = "You";
    } else {
    $payeename = $data['payee'];
    }
    }

    if($user == "normaluser"){
        $sql3 = "SELECT * FROM user WHERE unique_id = '{$unique}'";
        $result3 = $this->dbcon->query($sql3);
        $row3 = $result3->fetch_assoc();
        if($data['payee'] == $row3['first_name']." ".$row3['last_name']){
        $payeename = "You";
        } else {
        $payeename = $data['payee'];
        }
        }
    
    $output3 = "";
    $output4 = '<div class="price-detail" style="color: red;">&#8358;'.$amount.'
        <span style="font-size: 12px;">(Failed)</span>
        <div class="payee">
            <p class="payee-tag" stylvaluelor: #808080;">Paid By:</p>&nbsp;
            <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                '.$payeename.'
            </p>
        </div></div></div>';
    
        $name = $data['product_id'].$data['payment_id'];
    
    }
    $output .= "$output1$output2$output3$output4";
        } else {
            $output1 = ' <div class="transaction-details">
            <div class="radius">
                <img src="landimage/'.$data['product_image'].'" alt="">
            </div>
            <div class="details">
                <p class="pname">'.$data['product_name'].'</p>
                <div class="inner-detail">
                    <div class="date" style="font-size: 14px;">
                        <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
                    </div>
                </div>
            </div> ';
        
            if($data['product_unit'] == "1"){
            $unit = $data['product_unit']." Unit";
            } else {
            $unit = $data['product_unit']." Units";
            }
        
            $output2 = '
            <div class="price-detail detail3">
                '.$unit.'
            </div>
            <div class="price-detail detail3">'.$data['payment_method'].'</div> ';
        
        
            if($data['delete_status'] == "Deleted"){
        
            $name = $data['product_id'].$data['payment_id'];
        
            $output3 = ' <div class="detail-four">
            <div class="detail"
                style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                <p style="font-size: 14px; color: #fff;">Deleted</p>
            </div>
        </div>
        </div>
        </div>';
        
            $output4 = "";
            } else {
        
            $unitprice = $data['product_price'];
            if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
            $amount = number_format($unitprice);
            } else {
            $amount = round($unitprice);
            }
        
            if($user == "agent"){
                $sql3 = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$unique}'";
                $result3 = $this->dbcon->query($sql3);
                $row3 = $result3->fetch_assoc();
                if($data['payee'] == $row3['agent_name']){
                $payeename = "You";
                } else {
                $payeename = $data['payee'];
                }
            }

            if($user == "normaluser"){
                $sql3 = "SELECT * FROM user WHERE unique_id = '{$unique}'";
                $result3 = $this->dbcon->query($sql3);
                $row3 = $result3->fetch_assoc();
                if($data['payee'] == $row3['first_name']." ".$row3['last_name']){
                $payeename = "You";
                } else {
                $payeename = $data['payee'];
                }
                }
        
            $output3 = "";
        
            $output4 = '<div class="price-detail">&#8358;'.$amount.'
                <div class="payee">
                    <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
                    <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                        '.$payeename.'
                    </p>
                </div></div></div>';
        
        }
        $output .= "$output1$output2$output3$output4";
        
    }
    }
    } else {
    $output .= "<div class='success'>
        <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
        <p>We can't find this transaction</p>
    </div>";
    }
    
    echo $output;
    }


function downloadByMode($name,$mode){
    if($mode == "downloaddate"){
        $sql = "SELECT * FROM land_history WHERE payment_date = '{$name}' ORDER BY payment_id DESC";
       }

       if($mode == "downloadpayer"){
        $sql = "SELECT * FROM land_history WHERE payee = '{$name}' ORDER BY payment_id DESC";
       }

       if($mode == "downloadfailed"){
        $sql = "SELECT * FROM land_history WHERE sub_status = '{$name}' ORDER BY payment_id DESC";
       }

       if($mode == "downloadsuccess"){
        $sql = "SELECT * FROM land_history WHERE sub_status != 'Failed' ORDER BY payment_id DESC";
       }

       if($mode == "downloaddeleted"){
        $sql = "SELECT * FROM land_history WHERE delete_status = '{$name}' ORDER BY payment_id DESC";
       }
    $result = $this->dbcon->query($sql);
    $output = "";
    if($result->num_rows > 0){
    while($data = $result->fetch_assoc()){
    if($data['sub_status'] == "Failed"){
        $unitprice = $data['product_price'];
        if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                          $amount = number_format($unitprice);
                        } else {
                           $amount = round($unitprice);
                        }
                        $uniqueid = $data['customer_id'];
                        $sql2 = "SELECT * FROM user WHERE unique_id = '{$uniqueid}'";
                        $result2 = $this->dbcon->query($sql2);
                        $row2 = $result2->fetch_assoc();
     $output.= '
                     <tr>
                         <td>'.$data['payment_id'].'</td>
                         <td> <span>'.$row2['first_name'].'</span>&nbsp;<span>'.$row2['last_name'].'</span>
    </td>
    <td>&#8358;'.$amount.'</td>
    <td>'.$data['product_name'].'</td>
    <td>'.$data['payee'].'</td>
    <td>'.$data['payment_date'].'</td>
    <td>'.$data['payment_time'].'</td>
    </tr>
    ';
    } else {
        $unitprice = $data['product_price'];
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                      $amount = number_format($unitprice);
                    } else {
                       $amount = round($unitprice);
                    }
                    $uniqueid = $data['customer_id'];
                    $sql2 = "SELECT * FROM user WHERE unique_id = '{$uniqueid}'";
                    $result2 = $this->dbcon->query($sql2);
                    $row2 = $result2->fetch_assoc();
 $output.= '
                 <tr>
                     <td>'.$data['payment_id'].'</td>
                     <td> <span>'.$row2['first_name'].'</span>&nbsp;<span>'.$row2['last_name'].'</span>
</td>
<td>&#8358;'.$amount.'</td>
<td>'.$data['product_name'].'</td>
<td>'.$data['payee'].'</td>
<td>'.$data['payment_date'].'</td>
<td>'.$data['payment_time'].'</td>
</tr>
';
    }
    }
    } else {
    $output .= "";
    }
    
    echo $output;
    }


function searchByPayer($name,$user,$unique){
$sql = "SELECT * FROM land_history WHERE payee = '{$name}' ORDER BY payment_id DESC";
$result = $this->dbcon->query($sql);
$output = "";
if($result->num_rows > 0){
while($data = $result->fetch_assoc()){
if($data['sub_status'] == "Failed"){
$output1 = ' <div class="transaction-details" style="border: 2px solid red;">
    <div class="radius">
        <img src="landimage/'.$data['product_image'].'" alt="">
    </div>
    <div class="details">
        <p class="pname">'.$data['product_name'].'</p>
        <div class="inner-detail">
            <div class="date" style="font-size: 14px;">
                <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
            </div>
        </div>
    </div> ';

    if($data['product_unit'] == "1"){
    $unit = $data['product_unit']." Unit";
    } else {
    $unit = $data['product_unit']." Units";
    }
    $output2 = '
    <div class="price-detail detail3">
        '.$unit.'
    </div>
    <div class="price-detail detail3">
        '.$data['payment_method'].'</div> ';


    if($data['delete_status'] == "Deleted"){

    $name = $data['product_id'].$data['payment_id'];

    $output3 = '<form action="" class="restore-form" method="POST">
        <input class="price" type="submit" value="Restore" name="restorel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div>
</div>';

$output4 = "";
$output5 = "";
if(isset($_POST["restorel".$name])){
$insertupdate =
$user->updateLandHistory4($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

$deletedp = "restorel";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");


}
} else {

$unitprice = $data['product_price'];
if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$amount = number_format($unitprice);
} else {
$amount = round($unitprice);
}


if($user == "subadmin"){
$sql3 = "SELECT * FROM sub_admin WHERE unique_id = '{$unique}'";
$result3 = $this->dbcon->query($sql3);
$row3 = $result3->fetch_assoc();
if($data['payee'] == $row3['subadmin_name']){
$payeename = "You";
} else {
$payeename = $data['payee'];
}
}

if($user == "superadmin"){
$sql3 = "SELECT * FROM super_admin WHERE unique_id = '{$unique}'";
$result3 = $this->dbcon->query($sql3);
$row3 = $result3->fetch_assoc();
if($data['payee'] == $row3['super_adminname']){
$payeename = "You";
} else {
$payeename = $data['payee'];
}
}

$output3 = "";
$output4 = '<div class="price-detail" style="color: red;">&#8358;'.$amount.'
    <span style="font-size: 12px;">(Failed)</span>
    <div class="payee">
        <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
        <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
            '.$payeename.'
        </p>
    </div> ';



    $name = $data['product_id'].$data['payment_id'];

    $output5 = '<form action="" class="deletep-form" method="POST">
        <input class="price" type="submit" value="Delete" name="deletel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div>
</div>';
if(isset($_POST["deletel".$name])){
$insertupdate =
$user->updateLandHistory3($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

$deletedp = "deletedl";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
}
}
$output .= "$output1$output2$output3$output4$output5";
} else {
$output1 = ' <div class="transaction-details">
    <div class="radius">
        <img src="landimage/'.$data['product_image'].'" alt="">
    </div>
    <div class="details">
        <p class="pname">'.$data['product_name'].'</p>
        <div class="inner-detail">
            <div class="date" style="font-size: 14px;">
                <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
            </div>
        </div>
    </div> ';

    if($data['product_unit'] == "1"){
    $unit = $data['product_unit']." Unit";
    } else {
    $unit = $data['product_unit']." Units";
    }

    $output2 = '
    <div class="price-detail detail3">
        '.$unit.'
    </div>
    <div class="price-detail detail3">'.$data['payment_method'].'</div> ';


    if($data['delete_status'] == "Deleted"){

    $name = $data['product_id'].$data['payment_id'];

    $output3 = '<form action="" class="restore-form" method="POST">
        <input class="price" type="submit" value="Restore" name="restorel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div>
<div>';

    $output4 = "";
    $output5 = "";


    if(isset($_POST["restorel".$name])){
    $insertupdate =
    $user->updateLandHistory4($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

    $deletedp = "restorel";
    header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
    }
    } else {

    $unitprice = $data['product_price'];
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
    $amount = number_format($unitprice);
    } else {
    $amount = round($unitprice);
    }


    if($user == "subadmin"){
    $sql3 = "SELECT * FROM sub_admin WHERE unique_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($data['payee'] == $row3['subadmin_name']){
    $payeename = "You";
    } else {
    $payeename = $data['payee'];
    }
    }

    if($user == "superadmin"){
    $sql3 = "SELECT * FROM super_admin WHERE unique_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($data['payee'] == $row3['super_adminname']){
    $payeename = "You";
    } else {
    $payeename = $data['payee'];
    }
    }

    $output3 = "";

    $output4 = '<div class="price-detail">&#8358;'.$amount.'
        <div class="payee">
            <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
            <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                '.$payeename.'
            </p>
        </div>';



        $name = $data['product_id'].$data['payment_id'];

        $output5 = '<form action="" class="deletep-form" method="POST">
            <input class="price" type="submit" value="Delete" name="deletel'.$name.'"
                style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
        </form>
    </div>
</div>
';

if(isset($_POST["deletel".$name])){
$insertupdate =
$user->updateLandHistory3($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

$deletedp = "deletedl";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
}
}
$output .= "$output1$output2$output3$output4$output5";
}
}
} else {
$output .= "<div class='success'>
    <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
    <p>We can't find this transaction</p>
</div>";
}

echo $output;
}


function searchAgentPayer($name,$user,$unique){
$sql = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$unique}'";
$result = $this->dbcon->query($sql);
$output = "";
if($result->num_rows > 0){
$data = $result->fetch_assoc();
    $refid = $data['referral_id'];
    $sql2 = "SELECT * FROM user WHERE email = '{$name}' AND referral_id = '{$refid}'";
    $result2 = $this->dbcon->query($sql2);
    $userrow = $result2->fetch_assoc();
    if(!empty($userrow)){
$username = $userrow['first_name']." ".$userrow['last_name'];
$userid = $userrow['unique_id'];
$sql3 = "SELECT * FROM land_history WHERE payee = '{$username}' AND customer_id = '{$userid}'";
$result3 = $this->dbcon->query($sql3);
$rows = array();
if($this->dbcon->affected_rows > 0){
    while($row2 = $result3->fetch_assoc()){
        $rows[] = $row2;
    }
    if(!empty($rows)){
    foreach ($rows as $key => $value) {
if($value['sub_status'] == "Failed"){
$output1 = ' <div class="transaction-details" style="border: 2px solid red;">
    <div class="radius">
        <img src="landimage/'.$value['product_image'].'" alt="">
    </div>
    <div class="details">
        <p class="pname">'.$value['product_name'].'</p>
        <div class="inner-detail">
            <div class="date" style="font-size: 14px;">
                <span>'.$value['payment_month'].'</span>&nbsp;<span>'.$value['payment_day'].'</span>,<span>'.$value['payment_year'].'</span>,<span>'.$value['payment_time'].'</span>
            </div>
        </div>
    </div> ';

    if($value['product_unit'] == "1"){
    $unit = $value['product_unit']." Unit";
    } else {
    $unit = $value['product_unit']." Units";
    }
    $output2 = '
    <div class="price-detail detail3">
        '.$unit.'
    </div>
    <div class="price-detail detail3">
        '.$value['payment_method'].'</div> ';


    if($value['delete_status'] == "Deleted"){

    $output3 = ' <div class="detail-four">
    <div class="detail"
        style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
        <p style="font-size: 14px; color: #fff;">Deleted</p>
    </div>
</div>
</div>
</div>';

$output4 = "";
$output5 = "";

} else {

$unitprice = $value['product_price'];
if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$amount = number_format($unitprice);
} else {
$amount = round($unitprice);
}


if($user == "agent"){
$sql3 = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$unique}'";
$result3 = $this->dbcon->query($sql3);
$row3 = $result3->fetch_assoc();
if($value['payee'] == $row3['agent_name']){
$payeename = "You";
} else {
$payeename = $value['payee'];
}
}

$output3 = "";
$output4 = '<div class="price-detail" style="color: red;">&#8358;'.$amount.'
    <span style="font-size: 12px;">(Failed)</span>
    <div class="payee">
        <p class="payee-tag" stylvaluelor: #808080;">Paid By:</p>&nbsp;
        <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
            '.$payeename.'
        </p>
    </div></div></div>';

    $name = $value['product_id'].$value['payment_id'];

}
$output .= "$output1$output2$output3$output4";
} else {
$output1 = ' <div class="transaction-details">
    <div class="radius">
        <img src="landimage/'.$value['product_image'].'" alt="">
    </div>
    <div class="details">
        <p class="pname">'.$value['product_name'].'</p>
        <div class="inner-detail">
            <div class="date" style="font-size: 14px;">
                <span>'.$value['payment_month'].'</span>&nbsp;<span>'.$value['payment_day'].'</span>,<span>'.$value['payment_year'].'</span>,<span>'.$value['payment_time'].'</span>
            </div>
        </div>
    </div> ';

    if($value['product_unit'] == "1"){
    $unit = $value['product_unit']." Unit";
    } else {
    $unit = $value['product_unit']." Units";
    }

    $output2 = '
    <div class="price-detail detail3">
        '.$unit.'
    </div>
    <div class="price-detail detail3">'.$value['payment_method'].'</div> ';


    if($value['delete_status'] == "Deleted"){

    $name = $value['product_id'].$value['payment_id'];

    $output3 = ' <div class="detail-four">
    <div class="detail"
        style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
        <p style="font-size: 14px; color: #fff;">Deleted</p>
    </div>
</div>
</div>
</div>';

    $output4 = "";
    } else {

    $unitprice = $value['product_price'];
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
    $amount = number_format($unitprice);
    } else {
    $amount = round($unitprice);
    }

    if($user == "agent"){
        $sql3 = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$unique}'";
        $result3 = $this->dbcon->query($sql3);
        $row3 = $result3->fetch_assoc();
        if($value['payee'] == $row3['agent_name']){
        $payeename = "You";
        } else {
        $payeename = $value['payee'];
        }
    }

    $output3 = "";

    $output4 = '<div class="price-detail">&#8358;'.$amount.'
        <div class="payee">
            <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
            <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                '.$payeename.'
            </p>
        </div></div></div>';

}
$output .= "$output1$output2$output3$output4";
}
    }} else {
        $output .= "<div class='success'>
    <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
    <p>We can't find this transaction</p>
</div>";
    }} 
} else {
    $output .= "<div class='success'>
    <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
    <p>We can't find this user on your customer list</p>
</div>";
}
} else {
$output .= "<div class='success'>
    <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
    <p>We can't find this transaction</p>
</div>";
}

echo $output;
}


function searchAgentLand($name,$user,$unique){
    $sql = "SELECT * FROM land_product WHERE product_name = '{$name}'";
    $result = $this->dbcon->query($sql);
    $output = "";
    if($result->num_rows > 0){
        $data = $result->fetch_assoc();
        if($user == "normaluser"){
            $sql2 = "SELECT * FROM land_history WHERE product_id = '{$data['unique_id']}' AND customer_id = '{$unique}' ORDER BY payment_id DESC";
        }
        
        if($user == "agent"){
            $sql2 = "SELECT * FROM land_history WHERE product_id = '{$data['unique_id']}' AND agent_id = '{$unique}' ORDER BY payment_id DESC";
        }
        $result2 = $this->dbcon->query($sql2);
        $rows = array();
		if($this->dbcon->affected_rows > 0){
			while($row2 = $result2->fetch_assoc()){
				$rows[] = $row2;
			}
            if(!empty($rows)){
			foreach ($rows as $key => $value) {
if($value['sub_status'] == "Failed"){ 
    $output1 = ' <div class="transaction-details" style="border: 2px solid red;">
    <div class="radius">
        <img src="landimage/'.$value['product_image'].'" alt="">
    </div>
    <div class="details">
        <p class="pname">'.$value['product_name'].'</p>
        <div class="inner-detail">
            <div class="date" style="font-size: 14px;">
                <span>'.$value['payment_month'].'</span>&nbsp;<span>'.$value['payment_day'].'</span>,<span>'.$value['payment_year'].'</span>,<span>'.$value['payment_time'].'</span>
            </div>
        </div>
    </div> ';

    if($value['product_unit'] == "1"){
    $unit = $value['product_unit']." Unit";
    } else {
    $unit = $value['product_unit']." Units";
    }
    $output2 = '
    <div class="price-detail detail3">
        '.$unit.'
    </div>
    <div class="price-detail detail3">
        '.$value['payment_method'].'</div> ';


    if($value['delete_status'] == "Deleted"){

    $output3 = ' <div class="detail-four">
    <div class="detail"
        style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
        <p style="font-size: 14px; color: #fff;">Deleted</p>
    </div>
</div>
</div>
</div>';

$output4 = "";
$output5 = "";

} else {

$unitprice = $value['product_price'];
if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$amount = number_format($unitprice);
} else {
$amount = round($unitprice);
}


if($user == "agent"){
$sql3 = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$unique}'";
$result3 = $this->dbcon->query($sql3);
$row3 = $result3->fetch_assoc();
if($value['payee'] == $row3['agent_name']){
$payeename = "You";
} else {
$payeename = $value['payee'];
}
}

if($user == "normaluser"){
    $sql3 = "SELECT * FROM user WHERE unique_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($value['payee'] == $row3['first_name']." ".$row3['last_name']){
    $payeename = "You";
    } else {
    $payeename = $value['payee'];
    }
    }

$output3 = "";
$output4 = '<div class="price-detail" style="color: red;">&#8358;'.$amount.'
    <span style="font-size: 12px;">(Failed)</span>
    <div class="payee">
        <p class="payee-tag" stylvaluelor: #808080;">Paid By:</p>&nbsp;
        <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
            '.$payeename.'
        </p>
    </div></div></div>';

    $name = $value['product_id'].$value['payment_id'];

}
$output .= "$output1$output2$output3$output4";
} else {
    $output1 = ' <div class="transaction-details">
    <div class="radius">
        <img src="landimage/'.$value['product_image'].'" alt="">
    </div>
    <div class="details">
        <p class="pname">'.$value['product_name'].'</p>
        <div class="inner-detail">
            <div class="date" style="font-size: 14px;">
                <span>'.$value['payment_month'].'</span>&nbsp;<span>'.$value['payment_day'].'</span>,<span>'.$value['payment_year'].'</span>,<span>'.$value['payment_time'].'</span>
            </div>
        </div>
    </div> ';

    if($value['product_unit'] == "1"){
    $unit = $value['product_unit']." Unit";
    } else {
    $unit = $value['product_unit']." Units";
    }

    $output2 = '
    <div class="price-detail detail3">
        '.$unit.'
    </div>
    <div class="price-detail detail3">'.$value['payment_method'].'</div> ';


    if($value['delete_status'] == "Deleted"){

    $name = $value['product_id'].$value['payment_id'];

    $output3 = ' <div class="detail-four">
    <div class="detail"
        style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
        <p style="font-size: 14px; color: #fff;">Deleted</p>
    </div>
</div>
</div>
</div>';

    $output4 = "";
    } else {

    $unitprice = $value['product_price'];
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
    $amount = number_format($unitprice);
    } else {
    $amount = round($unitprice);
    }

    if($user == "agent"){
        $sql3 = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$unique}'";
        $result3 = $this->dbcon->query($sql3);
        $row3 = $result3->fetch_assoc();
        if($value['payee'] == $row3['agent_name']){
        $payeename = "You";
        } else {
        $payeename = $value['payee'];
        }
    }

    if($user == "normaluser"){
        $sql3 = "SELECT * FROM user WHERE unique_id = '{$unique}'";
        $result3 = $this->dbcon->query($sql3);
        $row3 = $result3->fetch_assoc();
        if($value['payee'] == $row3['first_name']." ".$row3['last_name']){
        $payeename = "You";
        } else {
        $payeename = $value['payee'];
        }
        }

    $output3 = "";

    $output4 = '<div class="price-detail">&#8358;'.$amount.'
        <div class="payee">
            <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
            <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                '.$payeename.'
            </p>
        </div></div></div>';

}
$output .= "$output1$output2$output3$output4";

}
}
} else {
$output .= "<div class='success'>
    <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
    <p>We can't find this transaction</p>
</div>";
}
}
} else {
$output .= "<div class='success'>
    <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
    <p>We can't find this transaction</p>
</div>";
}

echo $output;
    }


function searchFailedTransactions($name,$user,$unique){
$sql = "SELECT * FROM land_history WHERE sub_status = '{$name}' ORDER BY payment_id DESC";
$result = $this->dbcon->query($sql);
$output = "";
if($result->num_rows > 0){
while($data = $result->fetch_assoc()){
if($data['sub_status'] == "Failed"){
$output1 = ' <div class="transaction-details" style="border: 2px solid red;">
    <div class="radius">
        <img src="landimage/'.$data['product_image'].'" alt="">
    </div>
    <div class="details">
        <p class="pname">'.$data['product_name'].'</p>
        <div class="inner-detail">
            <div class="date" style="font-size: 14px;">
                <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
            </div>
        </div>
    </div> ';

    if($data['product_unit'] == "1"){
    $unit = $data['product_unit']." Unit";
    } else {
    $unit = $data['product_unit']." Units";
    }
    $output2 = '
    <div class="price-detail detail3">
        '.$unit.'
    </div>
    <div class="price-detail detail3">
        '.$data['payment_method'].'</div> ';


    if($data['delete_status'] == "Deleted"){

    $name = $data['product_id'].$data['payment_id'];

    $output3 = '<form action="" class="restore-form" method="POST">
        <input class="price" type="submit" value="Restore" name="restorel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div>
</div>';

$output4 = "";
$output5 = "";
if(isset($_POST["restorel".$name])){
$insertupdate =
$user->updateLandHistory4($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

$deletedp = "restorel";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");


}
} else {

$unitprice = $data['product_price'];
if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$amount = number_format($unitprice);
} else {
$amount = round($unitprice);
}


if($user == "subadmin"){
$sql3 = "SELECT * FROM sub_admin WHERE unique_id = '{$unique}'";
$result3 = $this->dbcon->query($sql3);
$row3 = $result3->fetch_assoc();
if($data['payee'] == $row3['subadmin_name']){
$payeename = "You";
} else {
$payeename = $data['payee'];
}
}

if($user == "superadmin"){
$sql3 = "SELECT * FROM super_admin WHERE unique_id = '{$unique}'";
$result3 = $this->dbcon->query($sql3);
$row3 = $result3->fetch_assoc();
if($data['payee'] == $row3['super_adminname']){
$payeename = "You";
} else {
$payeename = $data['payee'];
}
}

$output3 = "";
$output4 = '<div class="price-detail" style="color: red;">&#8358;'.$amount.'
    <span style="font-size: 12px;">(Failed)</span>
    <div class="payee">
        <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
        <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
            '.$payeename.'
        </p>
    </div> ';



    $name = $data['product_id'].$data['payment_id'];

    $output5 = '<form action="" class="deletep-form" method="POST">
        <input class="price" type="submit" value="Delete" name="deletel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div>
</div>';
if(isset($_POST["deletel".$name])){
$insertupdate =
$user->updateLandHistory3($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

$deletedp = "deletedl";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
}
}
$output .= "$output1$output2$output3$output4$output5";
} else {
$output1 = ' <div class="transaction-details">
    <div class="radius">
        <img src="landimage/'.$data['product_image'].'" alt="">
    </div>
    <div class="details">
        <p class="pname">'.$data['product_name'].'</p>
        <div class="inner-detail">
            <div class="date" style="font-size: 14px;">
                <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
            </div>
        </div>
    </div> ';

    if($data['product_unit'] == "1"){
    $unit = $data['product_unit']." Unit";
    } else {
    $unit = $data['product_unit']." Units";
    }

    $output2 = '
    <div class="price-detail detail3">
        '.$unit.'
    </div>
    <div class="price-detail detail3">'.$data['payment_method'].'</div> ';


    if($data['delete_status'] == "Deleted"){

    $name = $data['product_id'].$data['payment_id'];

    $output3 = '<form action="" class="restore-form" method="POST">
        <input class="price" type="submit" value="Restore" name="restorel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div>
<div>';

    $output4 = "";
    $output5 = "";


    if(isset($_POST["restorel".$name])){
    $insertupdate =
    $user->updateLandHistory4($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

    $deletedp = "restorel";
    header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
    }
    } else {

    $unitprice = $data['product_price'];
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
    $amount = number_format($unitprice);
    } else {
    $amount = round($unitprice);
    }


    if($user == "subadmin"){
    $sql3 = "SELECT * FROM sub_admin WHERE unique_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($data['payee'] == $row3['subadmin_name']){
    $payeename = "You";
    } else {
    $payeename = $data['payee'];
    }
    }

    if($user == "superadmin"){
    $sql3 = "SELECT * FROM super_admin WHERE unique_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($data['payee'] == $row3['super_adminname']){
    $payeename = "You";
    } else {
    $payeename = $data['payee'];
    }
    }

    $output3 = "";

    $output4 = '<div class="price-detail">&#8358;'.$amount.'
        <div class="payee">
            <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
            <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                '.$payeename.'
            </p>
        </div>';



        $name = $data['product_id'].$data['payment_id'];

        $output5 = '<form action="" class="deletep-form" method="POST">
            <input class="price" type="submit" value="Delete" name="deletel'.$name.'"
                style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
        </form>
    </div>
</div>
';

if(isset($_POST["deletel".$name])){
$insertupdate =
$user->updateLandHistory3($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

$deletedp = "deletedl";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
}
}
$output .= "$output1$output2$output3$output4$output5";
}
}
} else {
$output .= "<div class='success'>
    <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
    <p>We can't find this transaction</p>
</div>";
}

echo $output;
}



function searchFailedTransactions2($name,$user,$unique){
    if($user == "agent"){
        $sql = "SELECT * FROM land_history WHERE sub_status = '{$name}' AND agent_id = '{$unique}' ORDER BY payment_id DESC";
    }

    if($user == "normaluser"){
        $sql = "SELECT * FROM land_history WHERE sub_status = '{$name}' AND customer_id = '{$unique}' ORDER BY payment_id DESC";
    }
    $result = $this->dbcon->query($sql);
    $output = "";
    if($result->num_rows > 0){
    while($data = $result->fetch_assoc()){
    if($data['sub_status'] == "Failed"){
        $output1 = ' <div class="transaction-details" style="border: 2px solid red;">
        <div class="radius">
            <img src="landimage/'.$data['product_image'].'" alt="">
        </div>
        <div class="details">
            <p class="pname">'.$data['product_name'].'</p>
            <div class="inner-detail">
                <div class="date" style="font-size: 14px;">
                    <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
                </div>
            </div>
        </div> ';
    
        if($data['product_unit'] == "1"){
        $unit = $data['product_unit']." Unit";
        } else {
        $unit = $data['product_unit']." Units";
        }
        $output2 = '
        <div class="price-detail detail3">
            '.$unit.'
        </div>
        <div class="price-detail detail3">
            '.$data['payment_method'].'</div> ';
    
    
        if($data['delete_status'] == "Deleted"){
    
        $output3 = ' <div class="detail-four">
        <div class="detail"
            style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
            <p style="font-size: 14px; color: #fff;">Deleted</p>
        </div>
    </div>
    </div>
    </div>';
    
    $output4 = "";
    $output5 = "";
    
    } else {
    
    $unitprice = $data['product_price'];
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
    $amount = number_format($unitprice);
    } else {
    $amount = round($unitprice);
    }
    
    
    if($user == "agent"){
    $sql3 = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($data['payee'] == $row3['agent_name']){
    $payeename = "You";
    } else {
    $payeename = $data['payee'];
    }
    }

    if($user == "normaluser"){
        $sql3 = "SELECT * FROM user WHERE unique_id = '{$unique}'";
        $result3 = $this->dbcon->query($sql3);
        $row3 = $result3->fetch_assoc();
        if($data['payee'] == $row3['first_name']." ".$row3['last_name']){
        $payeename = "You";
        } else {
        $payeename = $data['payee'];
        }
        }
    
    $output3 = "";
    $output4 = '<div class="price-detail" style="color: red;">&#8358;'.$amount.'
        <span style="font-size: 12px;">(Failed)</span>
        <div class="payee">
            <p class="payee-tag" stylvaluelor: #808080;">Paid By:</p>&nbsp;
            <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                '.$payeename.'
            </p>
        </div></div></div>';
    
        $name = $data['product_id'].$data['payment_id'];
    
    }
    $output .= "$output1$output2$output3$output4";    
} else {
    $output1 = ' <div class="transaction-details">
    <div class="radius">
        <img src="landimage/'.$data['product_image'].'" alt="">
    </div>
    <div class="details">
        <p class="pname">'.$data['product_name'].'</p>
        <div class="inner-detail">
            <div class="date" style="font-size: 14px;">
                <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
            </div>
        </div>
    </div> ';

    if($data['product_unit'] == "1"){
    $unit = $data['product_unit']." Unit";
    } else {
    $unit = $data['product_unit']." Units";
    }

    $output2 = '
    <div class="price-detail detail3">
        '.$unit.'
    </div>
    <div class="price-detail detail3">'.$data['payment_method'].'</div> ';


    if($data['delete_status'] == "Deleted"){

    $name = $data['product_id'].$data['payment_id'];

    $output3 = ' <div class="detail-four">
    <div class="detail"
        style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
        <p style="font-size: 14px; color: #fff;">Deleted</p>
    </div>
</div>
</div>
</div>';

    $output4 = "";
    } else {

    $unitprice = $data['product_price'];
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
    $amount = number_format($unitprice);
    } else {
    $amount = round($unitprice);
    }

    if($user == "agent"){
        $sql3 = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$unique}'";
        $result3 = $this->dbcon->query($sql3);
        $row3 = $result3->fetch_assoc();
        if($data['payee'] == $row3['agent_name']){
        $payeename = "You";
        } else {
        $payeename = $data['payee'];
        }
    }

    if($user == "normaluser"){
        $sql3 = "SELECT * FROM user WHERE unique_id = '{$unique}'";
        $result3 = $this->dbcon->query($sql3);
        $row3 = $result3->fetch_assoc();
        if($data['payee'] == $row3['first_name']." ".$row3['last_name']){
        $payeename = "You";
        } else {
        $payeename = $data['payee'];
        }
        }

    $output3 = "";

    $output4 = '<div class="price-detail">&#8358;'.$amount.'
        <div class="payee">
            <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
            <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                '.$payeename.'
            </p>
        </div></div></div>';

}
$output .= "$output1$output2$output3$output4";

    }
    }
    } else {
    $output .= "<div class='success'>
        <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
        <p>We can't find this transaction</p>
    </div>";
    }
    
    echo $output;
    }
    



function searchDeletedTransactions($name,$user,$unique){
$sql = "SELECT * FROM land_history WHERE delete_status = '{$name}' ORDER BY payment_id DESC";
$result = $this->dbcon->query($sql);
$output = "";
if($result->num_rows > 0){
while($data = $result->fetch_assoc()){
if($data['sub_status'] == "Failed"){
$output1 = ' <div class="transaction-details" style="border: 2px solid red;">
    <div class="radius">
        <img src="landimage/'.$data['product_image'].'" alt="">
    </div>
    <div class="details">
        <p class="pname">'.$data['product_name'].'</p>
        <div class="inner-detail">
            <div class="date" style="font-size: 14px;">
                <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
            </div>
        </div>
    </div> ';

    if($data['product_unit'] == "1"){
    $unit = $data['product_unit']." Unit";
    } else {
    $unit = $data['product_unit']." Units";
    }
    $output2 = '
    <div class="price-detail detail3">
        '.$unit.'
    </div>
    <div class="price-detail detail3">
        '.$data['payment_method'].'</div> ';


    if($data['delete_status'] == "Deleted"){

    $name = $data['product_id'].$data['payment_id'];

    $output3 = '<form action="" class="restore-form" method="POST">
        <input class="price" type="submit" value="Restore" name="restorel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div>
</div>';

$output4 = "";
$output5 = "";
if(isset($_POST["restorel".$name])){
$insertupdate =
$user->updateLandHistory4($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

$deletedp = "restorel";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");


}
} else {

$unitprice = $data['product_price'];
if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$amount = number_format($unitprice);
} else {
$amount = round($unitprice);
}


if($user == "subadmin"){
$sql3 = "SELECT * FROM sub_admin WHERE unique_id = '{$unique}'";
$result3 = $this->dbcon->query($sql3);
$row3 = $result3->fetch_assoc();
if($data['payee'] == $row3['subadmin_name']){
$payeename = "You";
} else {
$payeename = $data['payee'];
}
}

if($user == "superadmin"){
$sql3 = "SELECT * FROM super_admin WHERE unique_id = '{$unique}'";
$result3 = $this->dbcon->query($sql3);
$row3 = $result3->fetch_assoc();
if($data['payee'] == $row3['super_adminname']){
$payeename = "You";
} else {
$payeename = $data['payee'];
}
}

$output3 = "";
$output4 = '<div class="price-detail" style="color: red;">&#8358;'.$amount.'
    <span style="font-size: 12px;">(Failed)</span>
    <div class="payee">
        <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
        <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
            '.$payeename.'
        </p>
    </div> ';



    $name = $data['product_id'].$data['payment_id'];

    $output5 = '<form action="" class="deletep-form" method="POST">
        <input class="price" type="submit" value="Delete" name="deletel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div>
</div>';
if(isset($_POST["deletel".$name])){
$insertupdate =
$user->updateLandHistory3($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

$deletedp = "deletedl";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
}
}
$output .= "$output1$output2$output3$output4$output5";
} else {
$output1 = ' <div class="transaction-details">
    <div class="radius">
        <img src="landimage/'.$data['product_image'].'" alt="">
    </div>
    <div class="details">
        <p class="pname">'.$data['product_name'].'</p>
        <div class="inner-detail">
            <div class="date" style="font-size: 14px;">
                <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
            </div>
        </div>
    </div> ';

    if($data['product_unit'] == "1"){
    $unit = $data['product_unit']." Unit";
    } else {
    $unit = $data['product_unit']." Units";
    }

    $output2 = '
    <div class="price-detail detail3">
        '.$unit.'
    </div>
    <div class="price-detail detail3">'.$data['payment_method'].'</div> ';


    if($data['delete_status'] == "Deleted"){

    $name = $data['product_id'].$data['payment_id'];

    $output3 = '<form action="" class="restore-form" method="POST">
        <input class="price" type="submit" value="Restore" name="restorel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div>
<div>';

    $output4 = "";
    $output5 = "";


    if(isset($_POST["restorel".$name])){
    $insertupdate =
    $user->updateLandHistory4($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

    $deletedp = "restorel";
    header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
    }
    } else {

    $unitprice = $data['product_price'];
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
    $amount = number_format($unitprice);
    } else {
    $amount = round($unitprice);
    }


    if($user == "subadmin"){
    $sql3 = "SELECT * FROM sub_admin WHERE unique_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($data['payee'] == $row3['subadmin_name']){
    $payeename = "You";
    } else {
    $payeename = $data['payee'];
    }
    }

    if($user == "superadmin"){
    $sql3 = "SELECT * FROM super_admin WHERE unique_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($data['payee'] == $row3['super_adminname']){
    $payeename = "You";
    } else {
    $payeename = $data['payee'];
    }
    }

    $output3 = "";

    $output4 = '<div class="price-detail">&#8358;'.$amount.'
        <div class="payee">
            <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
            <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                '.$payeename.'
            </p>
        </div>';



        $name = $data['product_id'].$data['payment_id'];

        $output5 = '<form action="" class="deletep-form" method="POST">
            <input class="price" type="submit" value="Delete" name="deletel'.$name.'"
                style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
        </form>
    </div>
</div>
';

if(isset($_POST["deletel".$name])){
$insertupdate =
$user->updateLandHistory3($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

$deletedp = "deletedl";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
}
}
$output .= "$output1$output2$output3$output4$output5";
}
}
} else {
$output .= "<div class='success'>
    <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
    <p>We can't find this transaction</p>
</div>";
}

echo $output;
}


function searchDeletedTransactions2($name,$user,$unique){
    if($user == "agent"){
        $sql = "SELECT * FROM land_history WHERE delete_status = '{$name}' AND agent_id = '{$unique}' ORDER BY payment_id DESC";
    }

    if($user == "normaluser"){
        $sql = "SELECT * FROM land_history WHERE delete_status = '{$name}' AND customer_id = '{$unique}' ORDER BY payment_id DESC";
    }
  
    $result = $this->dbcon->query($sql);
    $output = "";
    if($result->num_rows > 0){
    while($data = $result->fetch_assoc()){
    if($data['sub_status'] == "Failed"){
        $output1 = ' <div class="transaction-details" style="border: 2px solid red;">
        <div class="radius">
            <img src="landimage/'.$data['product_image'].'" alt="">
        </div>
        <div class="details">
            <p class="pname">'.$data['product_name'].'</p>
            <div class="inner-detail">
                <div class="date" style="font-size: 14px;">
                    <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
                </div>
            </div>
        </div> ';
    
        if($data['product_unit'] == "1"){
        $unit = $data['product_unit']." Unit";
        } else {
        $unit = $data['product_unit']." Units";
        }
        $output2 = '
        <div class="price-detail detail3">
            '.$unit.'
        </div>
        <div class="price-detail detail3">
            '.$data['payment_method'].'</div> ';
    
    
        if($data['delete_status'] == "Deleted"){
    
        $output3 = ' <div class="detail-four">
        <div class="detail"
            style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
            <p style="font-size: 14px; color: #fff;">Deleted</p>
        </div>
    </div>
    </div>
    </div>';
    
    $output4 = "";
    $output5 = "";
    
    } else {
    
    $unitprice = $data['product_price'];
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
    $amount = number_format($unitprice);
    } else {
    $amount = round($unitprice);
    }
    
    
    if($user == "agent"){
    $sql3 = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($data['payee'] == $row3['agent_name']){
    $payeename = "You";
    } else {
    $payeename = $data['payee'];
    }
    }

    if($user == "normaluser"){
        $sql3 = "SELECT * FROM user WHERE unique_id = '{$unique}'";
        $result3 = $this->dbcon->query($sql3);
        $row3 = $result3->fetch_assoc();
        if($data['payee'] == $row3['first_name']." ".$row3['last_name']){
        $payeename = "You";
        } else {
        $payeename = $data['payee'];
        }
        }
    
    $output3 = "";
    $output4 = '<div class="price-detail" style="color: red;">&#8358;'.$amount.'
        <span style="font-size: 12px;">(Failed)</span>
        <div class="payee">
            <p class="payee-tag" stylvaluelor: #808080;">Paid By:</p>&nbsp;
            <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                '.$payeename.'
            </p>
        </div></div></div>';
    
        $name = $data['product_id'].$data['payment_id'];
    
    }
    $output .= "$output1$output2$output3$output4";
    } else {
        $output1 = ' <div class="transaction-details">
        <div class="radius">
            <img src="landimage/'.$data['product_image'].'" alt="">
        </div>
        <div class="details">
            <p class="pname">'.$data['product_name'].'</p>
            <div class="inner-detail">
                <div class="date" style="font-size: 14px;">
                    <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
                </div>
            </div>
        </div> ';
    
        if($data['product_unit'] == "1"){
        $unit = $data['product_unit']." Unit";
        } else {
        $unit = $data['product_unit']." Units";
        }
    
        $output2 = '
        <div class="price-detail detail3">
            '.$unit.'
        </div>
        <div class="price-detail detail3">'.$data['payment_method'].'</div> ';
    
    
        if($data['delete_status'] == "Deleted"){
    
        $name = $data['product_id'].$data['payment_id'];
    
        $output3 = ' <div class="detail-four">
        <div class="detail"
            style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
            <p style="font-size: 14px; color: #fff;">Deleted</p>
        </div>
    </div>
    </div>
    </div>';
    
        $output4 = "";
        } else {
    
        $unitprice = $data['product_price'];
        if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
        $amount = number_format($unitprice);
        } else {
        $amount = round($unitprice);
        }
    
        if($user == "agent"){
            $sql3 = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$unique}'";
            $result3 = $this->dbcon->query($sql3);
            $row3 = $result3->fetch_assoc();
            if($data['payee'] == $row3['agent_name']){
            $payeename = "You";
            } else {
            $payeename = $data['payee'];
            }
        }


        if($user == "normaluser"){
            $sql3 = "SELECT * FROM user WHERE unique_id = '{$unique}'";
            $result3 = $this->dbcon->query($sql3);
            $row3 = $result3->fetch_assoc();
            if($data['payee'] == $row3['first_name']." ".$row3['last_name']){
            $payeename = "You";
            } else {
            $payeename = $data['payee'];
            }
            }
    
        $output3 = "";
    
        $output4 = '<div class="price-detail">&#8358;'.$amount.'
            <div class="payee">
                <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
                <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                    '.$payeename.'
                </p>
            </div></div></div>';
    
    }
    $output .= "$output1$output2$output3$output4";
    
    }
    }
    } else {
    $output .= "<div class='success'>
        <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
        <p>We can't find this transaction</p>
    </div>";
    }
    
    echo $output;
    }


function searchSuccessfulTransactions($name,$user,$unique){
$sql = "SELECT * FROM land_history WHERE sub_status != 'Failed' ORDER BY payment_id DESC";
$result = $this->dbcon->query($sql);
$output = "";
if($result->num_rows > 0){
while($data = $result->fetch_assoc()){
if($data['sub_status'] == "Failed"){
$output1 = ' <div class="transaction-details" style="border: 2px solid red;">
    <div class="radius">
        <img src="landimage/'.$data['product_image'].'" alt="">
    </div>
    <div class="details">
        <p class="pname">'.$data['product_name'].'</p>
        <div class="inner-detail">
            <div class="date" style="font-size: 14px;">
                <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
            </div>
        </div>
    </div> ';

    if($data['product_unit'] == "1"){
    $unit = $data['product_unit']." Unit";
    } else {
    $unit = $data['product_unit']." Units";
    }
    $output2 = '
    <div class="price-detail detail3">
        '.$unit.'
    </div>
    <div class="price-detail detail3">
        '.$data['payment_method'].'</div> ';


    if($data['delete_status'] == "Deleted"){

    $name = $data['product_id'].$data['payment_id'];

    $output3 = '<form action="" class="restore-form" method="POST">
        <input class="price" type="submit" value="Restore" name="restorel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div>
</div>';

$output4 = "";
$output5 = "";
if(isset($_POST["restorel".$name])){
$insertupdate =
$user->updateLandHistory4($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

$deletedp = "restorel";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");


}
} else {

$unitprice = $data['product_price'];
if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$amount = number_format($unitprice);
} else {
$amount = round($unitprice);
}


if($user == "subadmin"){
$sql3 = "SELECT * FROM sub_admin WHERE unique_id = '{$unique}'";
$result3 = $this->dbcon->query($sql3);
$row3 = $result3->fetch_assoc();
if($data['payee'] == $row3['subadmin_name']){
$payeename = "You";
} else {
$payeename = $data['payee'];
}
}

if($user == "superadmin"){
$sql3 = "SELECT * FROM super_admin WHERE unique_id = '{$unique}'";
$result3 = $this->dbcon->query($sql3);
$row3 = $result3->fetch_assoc();
if($data['payee'] == $row3['super_adminname']){
$payeename = "You";
} else {
$payeename = $data['payee'];
}
}

$output3 = "";
$output4 = '<div class="price-detail" style="color: red;">&#8358;'.$amount.'
    <span style="font-size: 12px;">(Failed)</span>
    <div class="payee">
        <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
        <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
            '.$payeename.'
        </p>
    </div> ';



    $name = $data['product_id'].$data['payment_id'];

    $output5 = '<form action="" class="deletep-form" method="POST">
        <input class="price" type="submit" value="Delete" name="deletel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div>
</div>';
if(isset($_POST["deletel".$name])){
$insertupdate =
$user->updateLandHistory3($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

$deletedp = "deletedl";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
}
}
$output .= "$output1$output2$output3$output4$output5";
} else {
$output1 = ' <div class="transaction-details">
    <div class="radius">
        <img src="landimage/'.$data['product_image'].'" alt="">
    </div>
    <div class="details">
        <p class="pname">'.$data['product_name'].'</p>
        <div class="inner-detail">
            <div class="date" style="font-size: 14px;">
                <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
            </div>
        </div>
    </div> ';

    if($data['product_unit'] == "1"){
    $unit = $data['product_unit']." Unit";
    } else {
    $unit = $data['product_unit']." Units";
    }

    $output2 = '
    <div class="price-detail detail3">
        '.$unit.'
    </div>
    <div class="price-detail detail3">'.$data['payment_method'].'</div> ';


    if($data['delete_status'] == "Deleted"){

    $name = $data['product_id'].$data['payment_id'];

    $output3 = '<form action="" class="restore-form" method="POST">
        <input class="price" type="submit" value="Restore" name="restorel'.$name.'"
            style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
    </form>
</div>
<div>';

    $output4 = "";
    $output5 = "";


    if(isset($_POST["restorel".$name])){
    $insertupdate =
    $user->updateLandHistory4($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

    $deletedp = "restorel";
    header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
    }
    } else {

    $unitprice = $data['product_price'];
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
    $amount = number_format($unitprice);
    } else {
    $amount = round($unitprice);
    }


    if($user == "subadmin"){
    $sql3 = "SELECT * FROM sub_admin WHERE unique_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($data['payee'] == $row3['subadmin_name']){
    $payeename = "You";
    } else {
    $payeename = $data['payee'];
    }
    }

    if($user == "superadmin"){
    $sql3 = "SELECT * FROM super_admin WHERE unique_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($data['payee'] == $row3['super_adminname']){
    $payeename = "You";
    } else {
    $payeename = $data['payee'];
    }
    }

    $output3 = "";

    $output4 = '<div class="price-detail">&#8358;'.$amount.'
        <div class="payee">
            <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
            <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                '.$payeename.'
            </p>
        </div>';



        $name = $data['product_id'].$data['payment_id'];

        $output5 = '<form action="" class="deletep-form" method="POST">
            <input class="price" type="submit" value="Delete" name="deletel'.$name.'"
                style="background-color: #7e252b; color: #fff; height: 19px; padding: 0; width: 100px;" />
        </form>
    </div>
</div>
';

if(isset($_POST["deletel".$name])){
$insertupdate =
$user->updateLandHistory3($data['product_id'],$data['payment_id'],$data['payment_method'],$data['newpay_id']);

$deletedp = "deletedl";
header("Location: successpage/deletesuccess.php?detect=".$deletedp."");
}
}
$output .= "$output1$output2$output3$output4$output5";
}
}
} else {
$output .= "<div class='success'>
    <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
    <p>We can't find this transaction</p>
</div>";
}

echo $output;
}


function searchSuccessfulTransactions2($name,$user,$unique){
    if($user == "agent"){
        $sql = "SELECT * FROM land_history WHERE sub_status != 'Failed' AND agent_id = '{$unique}' AND delete_status = '' ORDER BY payment_id DESC";
    }

    if($user == "normaluser"){
        $sql = "SELECT * FROM land_history WHERE sub_status != 'Failed' AND customer_id = '{$unique}' AND delete_status = '' ORDER BY payment_id DESC";
    }
    $result = $this->dbcon->query($sql);
    $output = "";
    if($result->num_rows > 0){
    while($data = $result->fetch_assoc()){
    if($data['sub_status'] == "Failed"){
        $output1 = ' <div class="transaction-details" style="border: 2px solid red;">
        <div class="radius">
            <img src="landimage/'.$data['product_image'].'" alt="">
        </div>
        <div class="details">
            <p class="pname">'.$data['product_name'].'</p>
            <div class="inner-detail">
                <div class="date" style="font-size: 14px;">
                    <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
                </div>
            </div>
        </div> ';
    
        if($data['product_unit'] == "1"){
        $unit = $data['product_unit']." Unit";
        } else {
        $unit = $data['product_unit']." Units";
        }
        $output2 = '
        <div class="price-detail detail3">
            '.$unit.'
        </div>
        <div class="price-detail detail3">
            '.$data['payment_method'].'</div> ';
    
    
        if($data['delete_status'] == "Deleted"){
    
        $output3 = ' <div class="detail-four">
        <div class="detail"
            style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
            <p style="font-size: 14px; color: #fff;">Deleted</p>
        </div>
    </div>
    </div>
    </div>';
    
    $output4 = "";
    $output5 = "";
    
    } else {
    
    $unitprice = $data['product_price'];
    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
    $amount = number_format($unitprice);
    } else {
    $amount = round($unitprice);
    }
    
    
    if($user == "agent"){
    $sql3 = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$unique}'";
    $result3 = $this->dbcon->query($sql3);
    $row3 = $result3->fetch_assoc();
    if($data['payee'] == $row3['agent_name']){
    $payeename = "You";
    } else {
    $payeename = $data['payee'];
    }
    }

    if($user == "normaluser"){
        $sql3 = "SELECT * FROM user WHERE unique_id = '{$unique}'";
        $result3 = $this->dbcon->query($sql3);
        $row3 = $result3->fetch_assoc();
        if($data['payee'] == $row3['first_name']." ".$row3['last_name']){
        $payeename = "You";
        } else {
        $payeename = $data['payee'];
        }
        }
    
    $output3 = "";
    $output4 = '<div class="price-detail" style="color: red;">&#8358;'.$amount.'
        <span style="font-size: 12px;">(Failed)</span>
        <div class="payee">
            <p class="payee-tag" stylvaluelor: #808080;">Paid By:</p>&nbsp;
            <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                '.$payeename.'
            </p>
        </div></div></div>';
    
        $name = $data['product_id'].$data['payment_id'];
    
    }
    $output .= "$output1$output2$output3$output4"; 
    } else {
        $output1 = ' <div class="transaction-details">
        <div class="radius">
            <img src="landimage/'.$data['product_image'].'" alt="">
        </div>
        <div class="details">
            <p class="pname">'.$data['product_name'].'</p>
            <div class="inner-detail">
                <div class="date" style="font-size: 14px;">
                    <span>'.$data['payment_month'].'</span>&nbsp;<span>'.$data['payment_day'].'</span>,<span>'.$data['payment_year'].'</span>,<span>'.$data['payment_time'].'</span>
                </div>
            </div>
        </div> ';
    
        if($data['product_unit'] == "1"){
        $unit = $data['product_unit']." Unit";
        } else {
        $unit = $data['product_unit']." Units";
        }
    
        $output2 = '
        <div class="price-detail detail3">
            '.$unit.'
        </div>
        <div class="price-detail detail3">'.$data['payment_method'].'</div> ';
    
    
        if($data['delete_status'] == "Deleted"){
    
        $name = $data['product_id'].$data['payment_id'];
    
        $output3 = ' <div class="detail-four">
        <div class="detail"
            style="width: 100px; height: 20px; background-color: #7e252b; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
            <p style="font-size: 14px; color: #fff;">Deleted</p>
        </div>
    </div>
    </div>
    </div>';
    
        $output4 = "";
        } else {
    
        $unitprice = $data['product_price'];
        if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
        $amount = number_format($unitprice);
        } else {
        $amount = round($unitprice);
        }
    
        if($user == "agent"){
            $sql3 = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$unique}'";
            $result3 = $this->dbcon->query($sql3);
            $row3 = $result3->fetch_assoc();
            if($data['payee'] == $row3['agent_name']){
            $payeename = "You";
            } else {
            $payeename = $data['payee'];
            }
        }

        if($user == "normaluser"){
            $sql3 = "SELECT * FROM user WHERE unique_id = '{$unique}'";
            $result3 = $this->dbcon->query($sql3);
            $row3 = $result3->fetch_assoc();
            if($data['payee'] == $row3['first_name']." ".$row3['last_name']){
            $payeename = "You";
            } else {
            $payeename = $data['payee'];
            }
            }
    
        $output3 = "";
    
        $output4 = '<div class="price-detail">&#8358;'.$amount.'
            <div class="payee">
                <p class="payee-tag" style="color: #808080;">Paid By:</p>&nbsp;
                <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                    '.$payeename.'
                </p>
            </div></div></div>';
    
    }
    $output .= "$output1$output2$output3$output4";
    }
    }
    } else {
    $output .= "<div class='success'>
        <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
        <p>We can't find this transaction</p>
    </div>";
    }
    
    echo $output;
    }
    



function searchEarningAgent($name){
$sql = "SELECT * FROM agent_table WHERE agent_email = '{$name}'";
$result = $this->dbcon->query($sql);
$output = "";
if($result->num_rows > 0){
$agentid = [];
while($data = $result->fetch_assoc()){
array_push($agentid,$data['uniqueagent_id']);
}
$agentid2 = array_unique($agentid);
foreach ($agentid2 as $key => $value) {
$sql = "SELECT * FROM earning_history WHERE earner_id = '{$value}'";
$result2 = $this->dbcon->query($sql);
$row = $result2->fetch_assoc();
if(!empty($row)){
$sql = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$value}'";
$result3 = $this->dbcon->query($sql);
$row2 = $result3->fetch_assoc();

$output1 = '<div class="account-detail2">
    <div class="radius"> ';
        if(!empty($row2['agent_img'])){
        $output2 = '<img src="profileimage/'.$row2['agent_img'].'" alt="profile image" /></div>';
    }
    if(empty($row2['agent_img'])){
    $output2 = '<div class="empty-img">
        <i class="ri-user-fill"></i>
    </div>
</div> ';
}
$output3 ='
<div class="flex">
    <p style="text-transform: capitalize;">
        <span>'.$row2['agent_name'].'</span>
    </p>
    <span class="email-span">'.$row2['agent_email'].'</span>
</div>

<a href="agentinfo.php?unique='.$row2['uniqueagent_id'].'&real=91838JDFOJOEI939" style="color: #808080;"><i
        class="ri-arrow-right-s-line"></i></a>
</div> ';
$output .= ''.$output1.''.$output2.''.$output3.'';
}
} }

if(empty($row)){
$output .= "
<div class='success'>
    <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
    <p>This agent has not earned yet</p>
</div>
";
}
echo $output;
}




function searchYurlandReferral($name){
$sql = "SELECT * FROM user WHERE email = '{$name}' AND referral_id = 'Yurland'";
$result = $this->dbcon->query($sql);
$row2 = $result->fetch_assoc();
$output = "";
if($result->num_rows > 0){
$output1 = '<div class="account-detail2">
    <div class="radius"> ';
        if(!empty($row2['photo'])){
        $output2 = '<img src="profileimage/'.$row2['photo'].'" alt="profile image" /></div>';
    }
    if(empty($row2['photo'])){
    $output2 = '<div class="empty-img">
        <i class="ri-user-fill"></i>
    </div>
</div> ';
}
$output3 ='
<div class="flex">
    <p style="text-transform: capitalize;">
        <span>'.$row2['first_name'].'&nbsp;'.$row2['last_name'].'</span>
    </p>
    <span class="email-span">'.$row2['email'].'</span>
</div>

<a href="customerprofileinfo.php?unique='.$row2['unique_id'].'&real=91838JDFOJOEI939" style="color: #808080;"><i
        class="ri-arrow-right-s-line"></i></a>
</div> ';
$output .= ''.$output1.''.$output2.''.$output3.'';


}else {
$output .= "
<div class='success'>
    <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
    <p>This is not a yurland referral</p>
</div>
";
}
echo $output;
}


function searchSubadmin($name){
$sql = "SELECT * FROM sub_admin WHERE subadmin_email = '{$name}'";
$result = $this->dbcon->query($sql);
$output = "";

if($result->num_rows > 0){
while($data = $result->fetch_assoc()){
$output1 = '
<div class="transaction-details2">
    <div class="details" style="text-transform: capitalize;">
        <p class="pname email-span">
            <span>'.$data['subadmin_name'].'</span>
        </p>
    </div>

    <div class="details hide flexdetail" style="text-transform: lowercase;">
        <p class="pname email-span"> '.$data['subadmin_email'].'</p>
    </div>

    <div class="details hide flexdetail" style="text-transform: lowercase;">
        <p class="pname email-span"> '.$data['subadmin_num'].'</p>
    </div>

    ';


    $subadminid = $data['unique_id'];



    $output3 = '<div class="details hide flexdetail" style="text-transform: capitalize;">
        <p class="pname">';
            $unique = $data['unique_id'];
            $sql1 = "SELECT SUM(product_unit) FROM payment WHERE agent_id='{$unique}'";
            $result1 = $this->dbcon->query($sql1);
            $row1 = $result1->fetch_assoc();
            //var_dump($row1);
            foreach($row1 as $key => $value1){
            if(is_null($value1)){
            $data1 = "0";
            } else {
            $data1 = $value1;
            }

            }

            $output4 = $data1.'</p>
    </div> ';

    $output5 = '<div class="details" style="text-transform: capitalize;">
        <p class="pname">&#8358;';
            $unique3 = $data['unique_id'];
            $sql3 = "SELECT SUM(product_price) FROM land_history WHERE agent_id='{$unique3}'";
            $result3 = $this->dbcon->query($sql3);
            $row3 = $result3->fetch_assoc();
            foreach($row3 as $key => $value3){
            if(is_null($value3)){
            $data3 = "0";
            } else {
            $earnedprice = $value3;
            $unitprice = $earnedprice;
            if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
            $data3 = number_format($unitprice);
            } else {
            $data3 = $unitprice;
            } }

            }

            $output6 = $data3.'</p>
    </div> ';

    $creatorid = $data['unique_id'];
    $sql4 = "SELECT COUNT(uniqueagent_id) FROM agent_table WHERE creator_id = '{$creatorid}'";
    $result4 = $this->dbcon->query($sql4);
    $row4 = $result4->fetch_assoc();

    foreach($row4 as $key => $value4){
    if(is_null($value4)){
    $data4 = "0";
    } else {
    $data4 = $value4;
    } }

    $sql5 = "SELECT COUNT(unique_id) FROM user WHERE creator_id = '{$creatorid}'";
    $result5 = $this->dbcon->query($sql5);
    $row5 = $result5->fetch_assoc();

    foreach($row5 as $key => $value5){
    if(is_null($value5)){
    $data5 = "0";
    } else {
    $data5 = $value5;
    } }

    $output7 = ' <div class="details hide flexdetail" style="text-transform: lowercase;">
        <p class="pname email-span"> '.$data4.'</p>
    </div>

    <div class="details hide flexdetail" style="text-transform: lowercase;">
        <p class="pname email-span"> '.$data5.'</p>
    </div>

    ';



    $output9 = ' <div class="details" style="text-transform: capitalize;">
        <div class="detail" style="">
            <a href="subinfo.php?unique='.$subadminid.'&real=91838JDFOJOEI939">
                <p style="font-size: 14px; color: #fff;">View</p>
            </a>
        </div>
    </div>';


    $output .= ''.$output1.''.$output7.''.$output3.''.$output4.''.$output5.''.$output6.''.$output9.'';
    }
    } else {
    $output .= "
    <div class='success'>
        <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
        <p>This subadmin does not exist </p>
    </div>
    ";
    }

    echo $output;
    }


    function searchExecutive($name){
    $sql = "SELECT * FROM executive WHERE executive_email = '{$name}'";
    $result = $this->dbcon->query($sql);
    $output = "";

    if($result->num_rows > 0){
    while($data = $result->fetch_assoc()){
    $output1 = '
    <div class="transaction-details2">
        <div class="details" style="text-transform: capitalize;">
            <p class="pname email-span">
                <span>'.$data['full_name'].'</span>
            </p>
        </div>

        <div class="details hide flexdetail" style="text-transform: lowercase;">
            <p class="pname email-span"> '.$data['executive_email'].'</p>
        </div>
        <div class="details hide flexdetail" style="text-transform: lowercase;">
            <p class="pname email-span"> '.$data['earning'].'%</p>
        </div>
        ';

        $execid = $data['unique_id'];
        $execdate = $data['executive_date'];
        $execearn = $data['earning'];

        $output5 = '<div class="details" style="text-transform: capitalize;">
            <p class="pname">&#8358;';
                $sql3 = "SELECT SUM(earned_amount) FROM earning_history WHERE earner_id = '{$execid}' ORDER BY
                earning_id DESC";
                $result3 = $this->dbcon->query($sql3);

                $row3 = $result3->fetch_assoc();
                if($result3->num_rows == 1){
                foreach ($row3 as $key => $value) {
                $unitprice3 = $value;
                }
                }else{
                $unitprice3 = $row3;
                }

                if($unitprice3 > 999 || $unitprice3 > 9999 || $unitprice3 > 99999 || $unitprice3 > 999999){
                $data3 = number_format(round($unitprice3));
                } else {
                $data3 = round($unitprice3);
                }



                $output6 = $data3.'</p>
        </div> ';


        $output9 = ' <div class="details" style="text-transform: capitalize;">
            <div class="detail" style="">
                <a href="execinfo.php?unique='.$execid.'&real=91838JDFOJOEI939">
                    <p style="font-size: 14px; color: #fff;">View</p>
                </a>
            </div>
        </div>';


        $output .= ''.$output1.''.$output5.''.$output6.''.$output9.'';
        }
        } else {
        $output .= "
        <div class='success'>
            <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
            <p>This executive does not exist </p>
        </div>
        ";
        }

        echo $output;
        }


        function searchProductList($name){
        $sql5 = "SELECT * FROM land_product WHERE product_name = '{$name}'";
        $result5 = $this->dbcon->query($sql5);
        $output = "";

        if($result5->num_rows > 0){
        while($data = $result5->fetch_assoc()){
        $output1 = '<a
            href="superadmininfo.php?id='.$data['unique_id'].'&key=9298783623kfhdJKJhdh&REF=019299383838383837373611009178273535&keyref=09123454954848kdksuuejwej">
            <div class="transaction-details2">
                <div class="details" style="text-transform: uppercase;">
                    <p class="pname">'.$data['product_name'].'</p>
                </div>

                <div class="details hide flexdetail" style="text-transform: uppercase;">
                    <p class="pname">'.$data['product_location'].'</p>
                    <p class="pname">Nigeria</p>
                </div>';

                $unitprice = $data['outright_price'];
                if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                $outprice = number_format($unitprice);
                } else {
                $outprice = $unitprice;
                }

                $output2 = ' <div class="details hide" style="text-transform: uppercase;">
                    <p class="pname">&#8358;'.$outprice.'</p>
                </div>

                <div class="details" style="text-transform: uppercase;">
                    <p class="pname">'.$data['product_unit'].'</p>
                </div>

                <div class="details" style="text-transform: uppercase;">
                    <p class="pname">'.$data['bought_units'].'</p>
                </div>';

                $unique = $data['unique_id'];

                $sql = "SELECT COUNT(product_id) FROM payment WHERE payment_method='Subscription' AND
                product_id='{$unique}'";
                $result = $this->dbcon->query($sql);
                $row = $result->fetch_assoc();



                $sql2 = "SELECT SUM(product_price) FROM payment WHERE product_id='{$unique}'";
                $result2 = $this->dbcon->query($sql2);
                $row2 = $result->fetch_assoc();


                $sql3 = "SELECT SUM(product_price) FROM payment WHERE product_id='{$unique}'";
                $result3 = $this->dbcon->query($sql3);
                $row3 = $result3->fetch_assoc();


                if(!empty($row)){
                foreach($row as $key => $value){
                $data1 = $value;
                } } else {
                $data1 = "0";
                }

                if(!empty($row2)){
                foreach($row2 as $key => $value){
                $unitprice = $value;
                if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                $data2 = number_format($unitprice);
                } else {
                $data2 = $unitprice;
                }
                } } else {
                $data2 = "0";
                }

                foreach($row3 as $key => $value){
                $unitprice = $value;
                if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                $data3 = number_format($unitprice);
                } else {
                $data3 = $unitprice;
                }
                }


                $output3 = ' <div class="details hide" style="text-transform: uppercase;">
                    <p class="pname">'.$data1.'</p>
                </div>

                <div class="details hide" style="text-transform: uppercase;">
                    <p class="pname">&#8358;'.$data2.'</p>
                </div>

                <div class="details" style="text-transform: uppercase;">
                    <p class="pname">&#8358;'.$data3.'</p>
                </div>
            </div>
        </a>
        ';


        }
        $output .= ''.$output1.''.$output2.''.$output3.'';
        } else {
        $output .= "
        <div class='success'>
            <img src='images/asset_success.svg' alt='' style='width: 20em; height:20em;' />
            <p>This land does not exist </p>
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
        $totalpayment = "SELECT SUM(earned_amount) FROM earning_history WHERE earner_id =
        '{$data['uniqueagent_id']}'
        ORDER BY
        earning_id DESC";
        $result2 = $this->dbcon->query($totalpayment);
        $row = $result2->fetch_assoc();
        if($result2->num_rows == 1){
        foreach ($row as $key => $value) {
        $sumearn = $value;
        }
        }else{
        $sumearn = $row;
        }
        // if($result->num_rows == 1){
        // return $row;
        // }else{
        // return $row;
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





            $earnedprice = $sumearn;
            $unitprice = $earnedprice;

            if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
            $price = number_format(round($unitprice));
            } else {
            $price = round($unitprice);
            }

            $output3 ='
            <div class="flex">
                <p style="text-transform: capitalize;">
                    <span>'.$data['agent_name'].'</span>
                </p>
                <span class="email-span">Total Earnings: &#8358;'.$price.'';






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


    function searchExecutiveEarning($name){
    $sql = "SELECT * FROM executive WHERE executive_email = '{$name}'";
    $result = $this->dbcon->query($sql);
    $output = "";

    if($result->num_rows > 0){
    while($data = $result->fetch_assoc()){
    $date = $data['executive_date'];
    $execid = $data['unique_id'];
    $totalpayment = "SELECT SUM(earned_amount) FROM earning_history WHERE earner_id = '{$execid}' ORDER BY
    earning_id
    DESC";
    $result2=$this->dbcon->query($totalpayment);
    $row = $result2->fetch_assoc();
    if($result2->num_rows == 1){
    foreach ($row as $key => $value) {
    $sumearn = $value;
    }
    }else{
    $sumearn = $row;
    }
    // if($result->num_rows == 1){
    // return $row;
    // }else{
    // return $row;
    // }

    $output1 = '
    <a href="executivehistory.php?unique='.$data['unique_id'].'" style="color: #808080;">
        <div class="account-detail2">
            <div class="radius"> ';
                if(!empty($data['executive_img'])){
                $output2 = '<img src="profileimage/'.$data['executive_img'].'" alt="profile image" /></div>';
            }
            if(empty($data['executive_img'])){
            $output2 = '<div class="empty-img">
                <i class="ri-user-fill"></i>
            </div>
        </div> ';
        }

        $earnedprice = $sumearn;
        $unitprice = $earnedprice;

        if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
        $price = number_format(round($unitprice));
        } else {
        $price = round($unitprice);
        }

        $output3 ='
        <div class="flex">
            <p style="text-transform: capitalize;">
                <span>'.$data['full_name'].'</span>
            </p>
            <span class="email-span">Total Earnings: &#8358;'.$price.'';






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
    <p>This executive does not exist </p>
</div>
";
}

echo $output;
}


function searchAgentEarningByMonth($month,$year){
$sql = "SELECT * FROM earning_history WHERE payment_month='{$month}' AND payment_year = '{$year}' ORDER BY
earning_id
DESC";
$result = $this->dbcon->query($sql);
$output = "";
$agentid = [];
if($result->num_rows > 0){
while($data = $result->fetch_assoc()){
array_push($agentid,$data['earner_id']);
}

$agentid2 = array_unique($agentid);
$agentdata = [];
foreach($agentid2 as $key => $value) {

$totalpayment = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$value}'";
$result2 = $this->dbcon->query($totalpayment);
$row = $result2->fetch_assoc();
if($result2->num_rows > 0){
array_push($agentdata,$row['uniqueagent_id']);
}
// else{
// return $row;
// }

}



foreach($agentdata as $key => $value){

$totalagent = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$value}'";
$results = $this->dbcon->query($totalagent);
$row4 = $results->fetch_assoc();
$agentdate = $row4['agent_date'];
$totalearning = "SELECT SUM(earned_amount) FROM earning_history WHERE earner_id = '{$value}' AND payment_month =
'{$month}' AND payment_year = '{$year}' ORDER BY earning_id DESC";

$result3=$this->dbcon->query($totalearning);
$row2 = $result3->fetch_assoc();


$output1 = '
<a href="agenthistory.php?unique='.$row4['uniqueagent_id'].'">
    <div class="account-detail2">
        <div class="radius"> ';
            if(!empty($row4['agent_img'])){
            $output2 = '<img src="profileimage/'.$row4['agent_img'].'" alt="profile image" /></div>';
        }
        if(empty($row4['agent_img'])){
        $output2 = '<div class="empty-img">
            <i class="ri-user-fill" style="color: #000;"></i>
        </div>
    </div> ';
    }

    if($result3->num_rows == 1){
    foreach ($row2 as $key => $value) {
    $unitprice = $value;

    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
    $price = number_format(round($unitprice));
    } else {
    $price = round($unitprice);
    }

    $output3 ='
    <div class="flex">
        <p style="text-transform: capitalize;">
            <span>'.$row4['agent_name'].'</span>
        </p>
        <span class="email-span">Total Earnings: &#8358;'.$price.'';
            }
            }else{
            $sumearn = $row2;
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
    <p>No agent has earned on this month</p>
</div>
";
}

echo $output;
}


function searchExecutiveEarningByMonth($month,$year){
$sql = "SELECT * FROM earning_history WHERE payment_month='{$month}' AND payment_year = '{$year}' ORDER BY
earning_id
DESC";
$result = $this->dbcon->query($sql);
$output = "";

if($result->num_rows > 0){

$agentdata = [];

$totalpayment = "SELECT * FROM executive";
$result2 = $this->dbcon->query($totalpayment);
if($result2->num_rows > 0){
while($row = $result2->fetch_assoc()){
array_push($agentdata,$row['unique_id']);

}
}
// else{
// return $row;
// }

foreach($agentdata as $key => $value){

$totalagent = "SELECT * FROM executive WHERE unique_id = '{$value}'";
$results = $this->dbcon->query($totalagent);
$row4 = $results->fetch_assoc();
$execdate = $row4['executive_date'];
$execid = $row4['unique_id'];
$totalearning = "SELECT SUM(earned_amount) FROM earning_history WHERE earner_id = '{$execid}' AND
payment_month='{$month}' AND payment_year =
'{$year}' ORDER BY earning_id DESC"; $result3=$this->
dbcon->query($totalearning);
$row2 = $result3->fetch_assoc();
if($result3->num_rows == 1){
foreach ($row2 as $key => $value) {
$sumearn = $value;
}
}else{
$sumearn = $row;
}

$output1 = '
<a href="executivehistory.php?unique='.$row4['unique_id'].'">
    <div class="account-detail2">
        <div class="radius"> ';
            if(!empty($row4['executive_img'])){
            $output2 = '<img src="profileimage/'.$row4['executive_img'].'" alt="profile image" /></div>';
        }
        if(empty($row4['executive_img'])){
        $output2 = '<div class="empty-img">
            <i class="ri-user-fill" style="color: #000;"></i>
        </div>
    </div> ';
    }


    if($result3->num_rows == 1){
    foreach ($row2 as $key => $value) {
    $earnedprice = $value;
    $unitprice = $earnedprice;

    if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
    $price = number_format(round($unitprice));
    } else {
    $price = round($unitprice);
    }

    $output3 ='
    <div class="flex">
        <p style="text-transform: capitalize;">
            <span>'.$row4['full_name'].'</span>
        </p>
        <span class="email-span">Total Earnings: &#8358;'.$price.'';

            }
            }else{
            $sumearn = $row;
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
    <p>No executive has earned on this month</p>
</div>
";
}

echo $output;
}

function downloadAgentEarning($month,$year){
$sql = "SELECT * FROM earning_history WHERE payment_month='{$month}' AND payment_year = '{$year}' ORDER BY
earning_id
DESC";
$result = $this->dbcon->query($sql);
$alldata = "";
$agentid = [];

if($result->num_rows > 0){
while($data = $result->fetch_assoc()){
array_push($agentid,$data['earner_id']);
}

$agentid2 = array_unique($agentid);
$agentdata = [];
foreach($agentid2 as $key => $value) {
$totalpayment = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$value}'";
$result2 = $this->dbcon->query($totalpayment);
$row = $result2->fetch_assoc();
if($result2->num_rows > 0){
array_push($agentdata,$row['uniqueagent_id']);
}
// else{
// return $row;
// }
}
foreach($agentdata as $key => $value){

$totalagent = "SELECT * FROM agent_table WHERE uniqueagent_id = '{$value}'";
$results = $this->dbcon->query($totalagent);
$row4 = $results->fetch_assoc();
$agentdate = $row4['agent_date'];
$totalearning = "SELECT SUM(earned_amount) FROM earning_history WHERE earner_id = '{$value}' AND
payment_month='{$month}' AND payment_year = '{$year}' ORDER BY earning_id
DESC"; $result3=$this->dbcon->query($totalearning);
$row2 = $result3->fetch_assoc();


if(!empty($row4['group_id'])){
$group = "SELECT * FROM group_table WHERE uniquegroup_id = '{$row4['group_id']}'";
$result5 = $this->dbcon->query($group);
$row5 = $result5->fetch_assoc();
$groupname = $row5['group_name'];
} else {
$groupname = "None";
}


if($result3->num_rows == 1){
foreach ($row2 as $key => $value) {
$earnedprice = $value;
$unitprice = $earnedprice;

if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$price = number_format(round($unitprice));
} else {
$price = round($unitprice);
}

}
} else {
$sumearn = $row2;
}


$output2 = '
<tr>
    <td>'.$row4['agent_id'].'</td>
    <td>'.$month.'</td>
    <td>'.$year.'</td>
    <td>'.$row4['agent_name'].'</td>
    <td>Agent</td>
    <td>'.$groupname.'</td>
    <td>'.$row4['bank_name'].'</td>
    <td>'.$row4['account_number'].'</td>
    <td>'.$row4['reg_account_name'].'</td>
    <td>&#8358;'.$price.'</td>
</tr>
';



$alldata .= ''.$output2.'';
}



} else {
$alldata .= "No Data";

}

echo $alldata;
}


function downloadExecutiveEarning($month,$year){
$sql = "SELECT * FROM earning_history WHERE payment_month='{$month}' AND payment_year = '{$year}' ORDER BY
earning_id
DESC";
$result = $this->dbcon->query($sql);
$alldata = "";


if($result->num_rows > 0){

$agentdata = [];

$totalpayment = "SELECT * FROM executive";
$result2 = $this->dbcon->query($totalpayment);
if($result2->num_rows > 0){
while($row = $result2->fetch_assoc()){
array_push($agentdata,$row['unique_id']);
}
}
// else{
// return $row;
// }

foreach($agentdata as $key => $value){

$totalagent = "SELECT * FROM executive WHERE unique_id = '{$value}'";
$results = $this->dbcon->query($totalagent);
$row4 = $results->fetch_assoc();
$execdate = $row4['executive_date'];
$execid = $row4['unique_id'];
$totalearning = "SELECT SUM(earned_amount) FROM earning_history WHERE earner_id = '{$execid}' AND
payment_month='{$month}' AND
payment_year = '{$year}' ORDER BY earning_id DESC";
$result3=$this->dbcon->query($totalearning);
$row2 = $result3->fetch_assoc();


if($result3->num_rows == 1){
foreach ($row2 as $key => $value) {
$earnedprice = $value;
$unitprice = $earnedprice;

if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
$price = number_format(round($unitprice));
} else {
$price = round($unitprice);
}

}
} else {
$sumearn = $row2;
}

$output2 = '
<tr>
    <td>'.$row4['executive_id'].'</td>
    <td>'.$month.'</td>
    <td>'.$year.'</td>
    <td>'.$row4['full_name'].'</td>
    <td>Executive</td>
    <td>&#8358;'.$price.'</td>
</tr>
';



$alldata .= ''.$output2.'';
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
<div class="transaction-details2">
    <div class="details" style="text-transform: capitalize;">
        <p class="pname email-span">
            <span>'.$data['group_name'].'</span>
        </p>
    </div>

    <div class="details hide flexdetail" style="text-transform: capitalize;">
        <p class="pname email-span"> '.$data['group_location'].'</p>
    </div>

    <div class="details hide flexdetail" style="text-transform: capitalize;">
        <p class="pname email-span"> '.$data['group_head'].'</p>
    </div>
    ';

    $groupid = $data['uniquegroup_id'];


    $output5 = '<div class="details" style="text-transform: capitalize;">
        <p class="pname">';

            $sql3 = "SELECT COUNT(uniqueagent_id) FROM agent_table WHERE group_id='{$groupid}'";
            $result3 = $this->dbcon->query($sql3);
            $row3 = $result3->fetch_assoc();
            foreach($row3 as $key => $value3){
            if(is_null($value3)){
            $data3 = "0";
            } else {
            $data3 = $value3;
            }

            }
            $output6 = $data3.'</p>
    </div> ';


    $output9 = ' <div class="details" style="text-transform: capitalize;">
        <div class="detail" style="">
            <a href="groupinfo.php?unique='.$groupid.'&real=91838JDFOJOEI939">
                <p style="font-size: 14px; color: #fff;">View</p>
            </a>
        </div>
    </div>';


    $output .= ''.$output1.''.$output5.''.$output6.''.$output9.'';
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
    $sql = "SELECT * FROM agent_table FULL JOIN earning_history WHERE uniqueagent_id =
    earning_history.earner_id AND agent_name =
    '{$name}' ORDER BY earning_id DESC";
    $result = $this->dbcon->query($sql);
    $output = "";

    if($result->num_rows > 0){
    while($data = $result->fetch_assoc()){

    $earnedprice= $data['earned_amount'];
    $unitprice=$earnedprice; if($unitprice> 999 || $unitprice > 9999 || $unitprice > 99999 ||
    $unitprice > 999999){
    $unit = number_format(round($unitprice));
    } else {
    $unit = round($unitprice);
    }

    if($data['payee'] == $data['earnee']){
    $customer = $data['earnee']." Paid:";
    }

    else {
    $customer = "Customer Paid:";
    }

    $unitprice2 = $data['product_price'];

    if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
    $unit2 = number_format(round($unitprice2));
    } else {
    $unit2 = round($unitprice2);
    }
    $output.= '<a href="agenthistory.php?unique='.$data['uniqueagent_id'].'">
        <div class="account-detail2"
            style="height: 3em; display: flex; justify-content: space-between; align-items:center;">
            <div class="flex">
                <p style="text-transform: uppercase;">
                    <span style="color: #000000!important; font-size: 16px;">'.$data['earnee'].'
                        earned &#8358;'.$unit.'</span>
                </p>
                <div class="payee">
                    <p class="payee-tag" style="color: #808080;">'.$customer.'</p>&nbsp;
                    <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                        &#8358;'.$unit2.' for '.$data['product_name'].'</p>
                </div>
                <div class="inner-detail">
                    <div class="date">
                        <span style="font-size: 13px;">'.$data['payment_date'].'</span>
                    </div>
                </div>
            </div>
        </div>

    </a> ';

    }
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
    $sql = "SELECT * FROM user FULL JOIN earning_history WHERE unique_id = earning_history.earner_id AND
    earnee = '{$name}'
    ORDER BY earner_id DESC";
    $result = $this->dbcon->query($sql);
    $output = "";

    if($result->num_rows > 0){
    while($data = $result->fetch_assoc()){
    $earnedprice = $data['earned_amount'];
    $unitprice=$earnedprice; if($unitprice> 999 || $unitprice > 9999 || $unitprice > 99999 ||
    $unitprice > 999999){
    $unit = number_format(round($unitprice));
    } else {
    $unit = round($unitprice);
    }

    if($data['payee'] == $data['earnee'] ){
    $customer = "".$data['earnee']." Paid:";
    }
    else {
    $customer = "Customer Paid:"; }

    $unitprice2 = $data['product_price'];

    if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
    $unit2 = number_format(round($unitprice2));
    } else {
    $unit2 = round($unitprice2);
    }
    $output.= '
    <div class="account-detail2"
        style="height: 3em; display: flex; justify-content: space-between; align-items:center;">
        <div class="flex">
            <p style="text-transform: uppercase;">
                <span style="color: #000000!important; font-size: 16px;">'.$data['earnee'].'
                    earned &#8358;'.$unit.'</span>
            </p>
            <div class="payee">
                <p class="payee-tag" style="color: #808080;">'.$customer.'</p>&nbsp;
                <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                    &#8358;'.$unit2.' for '.$data['product_name'].'</p>
            </div>
            <div class="inner-detail">
                <div class="date">
                    <span style="font-size: 13px;">'.$data['payment_date'].'</span>
                </div>
            </div>
        </div>
    </div>

    ';

    }
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


    function downloadByEarnMode($name,$mode,$user){
        if($user == "customer"){
            if($mode == "downloadearnname"){
                $sql = "SELECT * FROM user FULL JOIN earning_history WHERE unique_id = earning_history.earner_id AND
            earnee = '{$name}'
            ORDER BY earner_id DESC";
             }
    
             if($mode == "downloadearndate"){
                $sql = "SELECT * FROM user FULL JOIN earning_history WHERE unique_id = earning_history.earner_id
                AND payment_date =
                '{$name}' ORDER BY earning_id DESC";
             }
        }

        if($user == "agent"){
            if($mode == "downloadearnname"){
                $sql = "SELECT * FROM agent_table FULL JOIN earning_history WHERE uniqueagent_id =
                earning_history.earner_id AND agent_name =
                '{$name}' ORDER BY earning_id DESC";
             }
    
             if($mode == "downloadearndate"){
                $sql = "SELECT * FROM agent_table FULL JOIN earning_history WHERE uniqueagent_id =
                earning_history.earner_id AND
                payment_date = '{$name}' ORDER BY earning_id DESC";
             }
        }
         
        $result = $this->dbcon->query($sql);
        $output = "";
    
        if($result->num_rows > 0){
        while($data = $result->fetch_assoc()){
        $earnedprice = $data['earned_amount'];
        $unitprice=$earnedprice; if($unitprice> 999 || $unitprice > 9999 || $unitprice > 99999 ||
        $unitprice > 999999){
        $unit = number_format(round($unitprice));
        } else {
        $unit = round($unitprice);
        }
    
        if($data['payee'] == $data['earnee'] ){
        $customer = "".$data['earnee']." Paid:";
        }
        else {
        $customer = "Customer Paid:"; }
    
        $unitprice2 = $data['product_price'];
    
        if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 > 999999){
        $unit2 = number_format(round($unitprice2));
        } else {
        $unit2 = round($unitprice2);
        }

        $uniqueid = $data['earner_id'];
        $sql2 = "SELECT * FROM user WHERE unique_id = '{$uniqueid}'";
        $result2 = $this->dbcon->query($sql2);
        $row2 = $result2->fetch_assoc();

        $unitprice = $data['product_price'];
        if($unitprice > 999 || $unitprice > 9999 || $unitprice > 99999 || $unitprice > 999999){
                            $amount = number_format(round($unitprice));
                        } else {
                            $amount = round($unitprice);
                        }
                         
       

        
          $unitprice3 = $data['product_price'] - $earnedprice;
          if($unitprice3 > 999 || $unitprice3 > 9999 || $unitprice3 > 99999 || $unitprice3 > 999999){
                            $amount3 = number_format(round($unitprice3));
                          } else {
                              $amount3 = round($unitprice3); }   

            if($user == "customer"){
                $usertype = "User";
            }

            if($user == "agent"){
                $usertype = "Agent";
            }
        $output.= '
                        <tr>
                            <td><span>'.$data['earnee'].'</span>
                            </td>
                            <td>'.$usertype.'</td>
                            <td>'.$row2['bank_name'].'</td>
                            <td>'.$row2['account_number'].'</td>
                            <td>&#8358;'.$amount.'</td>
                            <td>&#8358;'.$unit.'</td>
                            <td>&#8358;'.$amount3.'</td>
                            <td>'.$data['payment_date'].'</td> </tr>
';

}
} else {
$output .= " ";
}

echo $output;
}

function selectUserEarningbyDate($name){
$sql = "SELECT * FROM user FULL JOIN earning_history WHERE unique_id = earning_history.earner_id
AND payment_date =
'{$name}' ORDER BY earning_id DESC";
$result = $this->dbcon->query($sql);
$output = "";

if($result->num_rows > 0){
while($data = $result->fetch_assoc()){
$earnedprice = $data['earned_amount']; $unitprice=$earnedprice; if($unitprice> 999 || $unitprice > 9999
|| $unitprice > 99999 || $unitprice >
999999){
$unit = number_format(round($unitprice));
} else {
$unit = round($unitprice);
}

if($data['payee'] == $data['earnee'] ){
$customer = "".$data['earnee']." Paid:";
}
else {
$customer = "Customer Paid:"; }

$unitprice2 = $data['product_price'];

if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 >
999999){
$unit2 = number_format(round($unitprice2));
} else {
$unit2 = round($unitprice2);
}
$output.= '
<div class="account-detail2" style="height: 3em; display: flex; justify-content: space-between; align-items:center;">
    <div class="flex">
        <p style="text-transform: uppercase;">
            <span style="color: #000000!important; font-size: 16px;">'.$data['earnee'].'
                earned &#8358;'.$unit.'</span>
        </p>
        <div class="payee">
            <p class="payee-tag" style="color: #808080;">'.$customer.'</p>&nbsp;
            <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                &#8358;'.$unit2.' for '.$data['product_name'].'</p>
        </div>
        <div class="inner-detail">
            <div class="date">
                <span style="font-size: 13px;">'.$data['payment_date'].'</span>
            </div>
        </div>
    </div>
</div>

';

}
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
$sql = "SELECT * FROM agent_table FULL JOIN earning_history WHERE uniqueagent_id =
earning_history.earner_id AND
payment_date = '{$name}' ORDER BY earning_id DESC";
$result = $this->dbcon->query($sql);
$output = "";

if($result->num_rows > 0){
while($data = $result->fetch_assoc()){

$earnedprice= $data['earned_amount']; $unitprice=$earnedprice; if($unitprice> 999 || $unitprice >
9999 || $unitprice > 99999 || $unitprice >
999999){
$unit = number_format(round($unitprice));
} else {
$unit = round($unitprice);
}

if($data['payee'] == $data['earnee']){
$customer = $data['earnee']." Paid:";
}

else {
$customer = "Customer Paid:";
}

$unitprice2 = $data['product_price'];

if($unitprice2 > 999 || $unitprice2 > 9999 || $unitprice2 > 99999 || $unitprice2 >
999999){
$unit2 = number_format(round($unitprice2));
} else {
$unit2 = round($unitprice2);
}
$output.= '<a href="agenthistory.php?unique='.$data['uniqueagent_id'].'">
    <div class="account-detail2"
        style="height: 3em; display: flex; justify-content: space-between; align-items:center;">
        <div class="flex">
            <p style="text-transform: uppercase;">
                <span style="color: #000000!important; font-size: 16px;">'.$data['earnee'].'
                    earned &#8358;'.$unit.'</span>
            </p>
            <div class="payee">
                <p class="payee-tag" style="color: #808080;">'.$customer.'</p>&nbsp;
                <p class="payee-name" style="text-transform: capitalize; color: #808080; text-overflow: ellipsis;">
                    &#8358;'.$unit2.' for '.$data['product_name'].'</p>
            </div>
            <div class="inner-detail">
                <div class="date">
                    <span style="font-size: 13px;">'.$data['payment_date'].'</span>
                </div>
            </div>
        </div>
    </div>

</a> ';

}
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