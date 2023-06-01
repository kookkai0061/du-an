<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/><br/>

    <?php 
       if(isset($_SESSION['add'])){
         echo $_SESSION['add']; //display the session
         unset($_SESSION['add']);//remove session manage
       }
    ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" placeholder="Username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="In Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
//process the values
//check whether the submit button is clicked or not ตรวจสอบว่าคลิกปุ่มส่งหรือไม่
   if(isset($_POST['submit']))
   {
    //button clicked
    //echo "Button Clicked";
    //get the data from form // รับข้อมูลจากฟอร์ม
      $full_name = $_POST['full_name'];
      $username = $_POST['username'];
      $password = $_POST['password'];

      //sql
      $sql = "INSERT INTO tbl_admin SET
      full_name = '$full_name',
      username = '$username',
      password = '$password'
      ";
      //Execute query and save data in database // ดำเนินการค้นหาและบันทึกข้อมูลในฐานข้อมูล
      $res = mysqli_query($conn, $sql) or die(mysqli_connect_error());
      if($res == TRUE){
        //echo "Data Inserted";
        //create session
        $_SESSION['add'] =  "Admin added successfully"; 
        //page to manage admin
        header('location:' .SITEURL.'admin/manage-admin.php');
      }else{
        //echo "fails to insert data";
        $_SESSION['add'] =  "Admin added successfully";
        //page to add admin
        header('location:' .SITEURL.'admin/manage-admin.php');
      }
   }
   


?>