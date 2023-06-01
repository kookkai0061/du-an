<?php 
 include('../config/constraints.php');
 //1. get the id of admin to be delete
 echo $id = $_GET['id'];
 //2. create sql 
 $sql = "DELETE FROM tbl_admin WHERE id = $id";

 //execute the query
 $res =  mysqli_query($conn, $sql);

 if($res == true){
    $_SESSION['delete'] =  "<div class='success'>Admin deleted successful </div>";
    header('location:' .SITEURL. 'admin/manage-admin.php');
 }else{
    $_SESSION['delete'] = "<div class='error'>Admin to delete admin. Try again later</div>";
    header('location:' .SITEURL. 'admin/manage-admin.php');
 }

 //3. redirect to manage admin(success or error)
 
 ?>