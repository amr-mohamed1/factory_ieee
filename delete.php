<?php
require_once('./connect_db.php');

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['emp_id'])){
        global $con;
        $stmt = $con->prepare('DELETE FROM employees WHERE id=?');
        $stmt->execute(array($_GET['emp_id']));

        header('location:index.php');
    }
}