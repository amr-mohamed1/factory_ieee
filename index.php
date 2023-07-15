<?php 
$page_title = 'All Employee';
$css_file = 'style.css';
include_once('./includes/template/header.php');
require_once('./connect_db.php');

global $con;

$stmt = $con->prepare('SELECT * FROM employees');
$stmt->execute();
$employees = $stmt->fetchAll();

?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Department</th>
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
      <td><a class="btn btn-danger" href="delete.php?emp_id=<?php echo $employee['id']?>">Delete</a></td>
    </tr>
    <?php } ?>

  </tbody>
</table>


<a href="add_employee.php">Add Employee</a>


<?php 
include_once('./includes/template/footer.php');
?>