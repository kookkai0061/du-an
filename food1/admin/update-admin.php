<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br/><br/>
        // query ข้อมูลด้วย mysqli_query() function และเช็คว่า query สำเร็จหรือไม่ ถ้าสำเร็จ 
        <?php 
           $id = $_GET['id']; // ดึงข้อมูลเข้ามาด้วย $_GET['id'] และกำหนดคำสั่ง SQL
           $sql = "SELECT * FROM tbl_admin WHERE id=$id";
           $res=mysqli_query($conn, $sql); //query ข้อมูลด้วย mysqli_query() function 

           if($res == true){
              $count = mysqli_num_rows($res); // จะใช้เพื่อนับจำนวนแถวของผลลัพธ์ที่ได้จาก query และตรวจสอบว่ามีข้อมูล Admin ที่ต้องการหรือไม่ 
              if($count == 1){
                 //echo "Admin Available";
                 $row=mysqli_fetch_assoc($res); //ถ้ามี จะใช้ เพื่อดึงข้อมูลของ Admin นั้นออกมาจากฐานข้อมูล
                 $full_name = $row['full_name'];
                 $username = $row['username'];

              }else{
                header('location:' .SITEURL. 'admin/manage-admin.php');
              }
           }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
            <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name ; ?>"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username ; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value=" <?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>
<?php 

    //Check whether the Submit Button is Clicked or not /Kiểm tra nút gửi có được nhấp hay không
    if(isset($_POST['submit']))
    {
        //echo "Button CLicked";
        //Get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Create a SQL Query to Update Admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id='$id'
        ";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Query Executed and Admin Updated
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to Update Admin
            $_SESSION['update'] = "<div class='error'>Failed to Delete Admin.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>

<?php include('partials/footer.php') ?>