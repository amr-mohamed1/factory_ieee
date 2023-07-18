<?php 
session_start();
$page_title = 'All Employee';
$css_file = 'style.css';

if(isset($_SESSION['name'])){

require_once("./init.php");
$employees = get_all_data('employees');

?>

<h1>Hello <?php echo $_SESSION['name'] ?></h1>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Department</th>
      <th scope="col">Update</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>

  <?php foreach($employees as $employee){ ?>
    <tr>
      <td><?php echo $employee['id']?></td>
      <td><?php echo $employee['name']?></td>
      <td><?php echo $employee['email']?></td>
      <td><?php echo $employee['phone']?></td>
      <td><?php echo $employee['dep']?></td>
      <td><a class="btn btn-success" href="edit.php?emp_id=<?php echo $employee['id']?>">Update</a></td>
      <td><a class="btn btn-danger" href="delete.php?emp_id=<?php echo $employee['id']?>">Delete</a></td>
    </tr>
    <?php } ?>

  </tbody>
</table>


<a href="add_employee.php">Add Employee</a>
<a href="logout.php">logout</a>


<?php 
include_once('./includes/template/footer.php');

}else{
  header('location:signin.php');
}
?>