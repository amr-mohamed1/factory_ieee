<?php
session_start();
if(isset($_SESSION['name'])){
    
require_once('./init.php');

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET'){

    if(isset($_GET['emp_id'])){
        delete_with_id('employees',$_GET['emp_id'],'index.php');
    }

    if(isset($_GET['cv_id'])){
        delete_with_id('hiring',$_GET['cv_id'],'all_cvs.php');
        @unlink($_GET["image_path"]);
        @unlink($_GET["cv_path"]);
    }

}


}else{
    header('location:signin.php');
  }