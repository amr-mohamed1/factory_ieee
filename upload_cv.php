<?php 
session_start();
$page_title = "Upload CV";
$css_file = 'style.css';

if(isset($_SESSION['name'])){

require_once("./init.php");


if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST"){


    $personal_image_name = $_FILES["personal_image"]["name"];
    $personal_image_size = $_FILES["personal_image"]["size"];
    $personal_image_tmp_name = $_FILES["personal_image"]["tmp_name"];
    $personal_image_type = $_FILES["personal_image"]["type"];


    $cv_name = $_FILES["cv"]["name"];
    $cv_size = $_FILES["cv"]["size"];
    $cv_tmp_name = $_FILES["cv"]["tmp_name"];
    $cv_type = $_FILES["cv"]["type"];
    $cv_extentions_allowed = array('pdf','docx','pptx');
    @$uploaded_cv_extention = strtolower(end(explode(".",$cv_name)));


    $extention_allowed = array("png","jpg","jpeg","webp");   
    @$personal_image_extention             = strtolower(end(explode(".",$personal_image_name)));
    if(in_array($personal_image_extention,$extention_allowed)){
        $final_personal_image_name = $_SESSION['name'] . "_" . rand(0,1000) . "." . $personal_image_extention;
        $personal_image_destination = "img/personal_images/" . $final_personal_image_name;

        if(in_array($uploaded_cv_extention,$cv_extentions_allowed)){

            $final_cv_name = $_SESSION['name']. '_cv' . "_" . rand(0,1000) . "." . $uploaded_cv_extention;
            $cv_destination = 'img/CVs/'.$final_cv_name;

            upload_cv($_SESSION['id'],$personal_image_destination,$cv_destination);

            move_uploaded_file($personal_image_tmp_name,$personal_image_destination);
            move_uploaded_file($cv_tmp_name,$cv_destination);

            
        }else{
            echo "
            <script>
                toastr.error('الملف غير مسموح')
            </script>";
        }       


    }else{
        echo "
            <script>
                toastr.error('الملف غير مسموح')
            </script>";
    }




    
  }

?>


<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
<div class="container mt-5">

  <div class="mb-3">
    <label class="form-label">Personal Image</label>
    <input type="file" name="personal_image" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">CV</label>
    <input type="file" name="cv" class="form-control">
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