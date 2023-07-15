<?php 

$page_title = "Add EMployee";
$css_file = 'style.css';
include_once("./includes/template/header.php");
require_once("./connect_db.php");

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $name   = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $email  = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $phone  = filter_var($_POST['phone'],FILTER_SANITIZE_NUMBER_INT);
    $dep    = filter_var($_POST['dep'],FILTER_SANITIZE_STRING);

    global $con;

    $stmt = $con->prepare("INSERT INTO employees(name,email,phone,dep) value(?,?,?,?)");
    $stmt->execute(array($name,$email,$phone,$dep));

    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة الصلاحيه بنجاح')
    </script>";

    header("Refresh:3;url=add_employee.php"); 
}

?>


<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
<div class="container mt-5">
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">email</label>
    <input type="email" name="email" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">phone</label>
    <input type="tel" name="phone" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">department</label>
    <input type="text" name="dep" class="form-control">
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>

<?php include_once("./includes/template/footer.php");
 ?>