<?php

/*
===============================================
================= save Operation ==============
===============================================
*/
function save_operation($table_name,$operation){
    global $con;
    $stmt2 = $con->prepare("INSERT INTO actions(operation,table_name) VALUE(?,?)");
    $stmt2->execute(array($operation,$table_name));
}

/*
===============================================
================= add employee ================
===============================================
*/
function add_employee($name,$email,$phone,$dep){
    global $con;
    $stmt = $con->prepare("INSERT INTO employees(name,email,phone,dep) value(?,?,?,?)");
    $stmt->execute(array($name,$email,$phone,$dep));

    save_operation('employees','ADD');

    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة الصلاحيه بنجاح')
    </script>";
    header("Refresh:3;url=index.php"); 
}

/*
===============================================
================= update employee ================
===============================================
*/
function edit_employee($name,$email,$phone,$dep,$id){
    global $con;
    $stmt = $con->prepare('UPDATE employees SET name=?,email=?,phone=?,dep=? WHERE id=?');
    $stmt->execute(array($name,$email,$phone,$dep,$_GET['emp_id']));

    save_operation('employees','Edit');
    
    echo "
    <script>
        toastr.success('تم بنجاح :- تم تعديل البيانات بنجاح')
    </script>";
    header('Refresh:3;url=index.php');
}


/*
===============================================
================= get employees ================
===============================================
*/
function get_all_data($table){
    global $con;
    $stmt = $con->prepare("SELECT * FROM $table");
    $stmt->execute();
    $employees = $stmt->fetchAll();
    return $employees;
}


/*
===============================================
============= get employee with id ============
===============================================
*/
function get_emp_with_id($table,$id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM $table WHERE id=?");
    $stmt->execute(array($id));

    save_operation($table,'Ask For Information');

    $emp_data = $stmt->fetch();
    return $emp_data;
}


/*
===============================================
============= delete employee with id ========
===============================================
*/
function delete_with_id($table,$id){
    global $con;
    $stmt = $con->prepare("DELETE FROM $table WHERE id=?");
    $stmt->execute(array($id));

    save_operation($table,'Delete');

    header('location:index.php');
}



/*
===============================================
================= register ================
===============================================
*/
function register($name,$email,$passwrd){
    global $con;
    $stmt = $con->prepare("INSERT INTO users(name,email,password) value(?,?,?)");
    $stmt->execute(array($name,$email,$passwrd));

    save_operation('users','ADD');

    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة المستخدم بنجاح')
    </script>";
    header("Refresh:3;url=signin.php"); 
}



/*
===============================================
================= login ================
===============================================
*/
function login($email,$passwrd){
    global $con;
    $stmt = $con->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute(array($email));
    $user_data = $stmt->fetch();
    $row_count = $stmt->rowCount();
    if($row_count > 0){
        // if(sha1($passwrd) == $user_data['password']){
        if(password_verify($passwrd,$user_data['password'])){
            @session_start();
            $_SESSION['id']    = $user_data['id'];
            $_SESSION['name']  = $user_data['name'];
            $_SESSION['email']  = $user_data['email'];
            echo "
            <script>
                toastr.success('تم بنجاح :- تم تسجيل الدخول')
            </script>";
            header("Refresh:3;url=index.php");
        }else{
            echo "
            <script>
                toastr.error('كلمة السر ')
            </script>";
        }
    }else{
        echo "
            <script>
                toastr.error('البريد الالكتروني غير صحيح')
            </script>";
    }

    save_operation('users','Login');

}