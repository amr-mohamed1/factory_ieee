<?php 
session_start();
$page_title = 'All CVs';
$css_file = 'style.css';

if(isset($_SESSION['name'])){

require_once("./init.php");
$all_cvs = get_all_cvs();

?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Personal Image</th>
      <th scope="col">CV</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>

  <?php foreach($all_cvs as $CV){ ?>
    <tr>
      <td><?php echo $CV['hiring_id']?></td>
      <td><?php echo $CV['name']?></td>
      <td><?php echo $CV['email']?></td>
      <td>
        <img style="width: 50px;" src="<?php echo $CV['personal_image']?>" alt="<?php echo $CV['user_id']?>">  
     </td>
      <td><a class="btn btn-success" target="_blank" href="<?php echo $CV['cv']?>">Download CV</a></td>
      <td><a class="btn btn-danger" href="delete.php?cv_id=<?php echo $CV['hiring_id']."&image_path=".$CV['personal_image']."&cv_path=".$CV['cv']?>">Delete</a></td>
    </tr>
    <?php } ?>

  </tbody>
</table>


<a href="logout.php">logout</a>


<?php 
include_once('./includes/template/footer.php');

}else{
  header('location:signin.php');
}
?>