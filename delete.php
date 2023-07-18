<?php
session_start();
if(isset($_SESSION['name'])){
    
require_once('./init.php');

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['emp_id'])){
        delete_with_id('employees',$_GET['emp_id']);
    }
}


}else{
    header('location:signin.php');
  }