<?php 

    function uploadFile($fileToUpload, $allowedTypes, $uploadDir = "uploads/profile_photos"){

        if(in_array($fileToUpload['type'], $allowedTypes)){

            $ext_arr = explode(".", $fileToUpload['name']);
            $extension = end($ext_arr);
            $filename = uniqid().".".$extension;
            
            $newFilePath = $uploadDir."/".$filename;

            if(copy($fileToUpload['tmp_name'], $newFilePath)){
                return $newFilePath = "'$newFilePath'";
            }
        }else{
            return false;
        }
    }

?>