<?php
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
        $target_path = $destination_path . '../landimage/'. basename($newfilename);
        //$destination = $folder.$newfilename;
        move_uploaded_file($filetmp, $target_path);
    }