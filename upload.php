<?php
/*
Copyright amir javanmir
Released on: october 25, 2023
*/
if(isset($_FILES["file"])){
    $error = [];
    $pathProject = __DIR__;
    
    if(is_dir($pathProject.'/uploads')){
        $pathProject .= '/uploads';
        extract($_FILES["file"]);    
        $extension = strtolower(pathinfo($name,PATHINFO_EXTENSION));
        if(!move_uploaded_file($tmp_name,$pathProject.'/'.$name)){
            $error[] = "error upload file!";
            echo "error";
        }else{
            echo "true";
        }
    }else{
        mkdir("uploads");
    }
}

?>
