<?php 
  //Author-access control
  //check whether the user logged or not
  if(isset($_SESSION['user'])){
   $_SESSION['no-login-message'] = "<div class='error' text-center >Please login to access Admin panel</div>";
   header('location:'.SITEURL.'admin/login.php');
  }
?>
 