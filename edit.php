<?php 
session_start();
$page_title = "Edit Employee";
$css_file = 'style.css';

if(isset($_SESSION['name'])){

require_once("./init.php");

if(isset($_GET['emp_id'])){
    $id=$_GET['emp_id'];
    $emp_data = get_emp_with_id('employees',$id);
}else{
    header('location:index.php');
}

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $name   = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
    $email  = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $phone  = filter_var($_POST['phone'],FILTER_SANITIZE_NUMBER_INT);
    $dep    = filter_var($_POST['dep'],FILTER_SANITIZE_STRING);

    edit_employee($name,$email,$phone,$dep,$id);
  }

?>


<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
<div class="container mt-5">
  <div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" value="<?php echo $emp_data['name'];?>" name="name" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">email</label>
    <input type="email" name="email" value="<?php echo $emp_data['email'];?>" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">phone</label>
    <input type="tel" name="phone" value="<?php echo $emp_data['phone'];?>" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">department</label>
    <input type="text" name="dep" value=" <?php echo $emp_data['dep'];?>" class="form-control">
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>

<?php 
include_once("./includes/template/footer.php");

}else{
  header('location:signin.php');
}
 ?>