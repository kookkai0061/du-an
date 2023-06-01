<?php include('partials/menu.php'); ?>
    
<link rel="stylesheet" href="css/admin.css">
       <!----Main content section starts ----->
       <div class="main-content">
       <div class="wrapper">
            <h1>Manage Admin</h1>
            <br /><br />
            <?php 
               if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
               }
               if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset ($_SESSION['delete']);
               }
               if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset ($_SESSION['update']);
               }
               if(isset($_SESSION['user-not-found'])){
                echo $_SESSION['user-not-found'];
                unset ($_SESSION['user-not-found']);
               }
               if(isset($_SESSION['pass-not-match'])){
                echo $_SESSION['pass-not-match'];
                unset ($_SESSION['pass-not-match']);
               }
               if(isset($_SESSION['change-password'])){
                echo $_SESSION['change-password'];
                unset ($_SESSION['change-password']);
               }
            ?>
            <br/><br/><br/>
            <!---button to add admin--->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br /><br /><br />
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Full Name</th> 
                    <th>Username</th>
                    <th>Action</th>
                </tr> 
                <?php 
                   $sql= "SELECT * FROM tbl_admin";
                   $res = mysqli_query($conn, $sql); //query ข้อมูลด้วย mysqli_query() function 
                   
                   if($res == TRUE){
                    $rows = mysqli_num_rows($res); //จะใช้ mysqli_num_rows() function เพื่อนับจำนวนแถวของผลลัพธ์ที่ได้จาก query และตรวจสอบว่ามีข้อมูล Admin ที่ต้องการหรือไม่ 

                    $sn = 1; //$sn=1; ซึ่งจะใช้ในการกำหนดลำดับของ du lieu ที่ถูกเพิ่มเข้าไปในฐานข้อมูลโดยเป็นการเพิ่มเลขลำดับที่ต่อจาก
                    if($rows > 0){
                        //we have data in database
                        while($rows = mysqli_fetch_assoc($res)) //ถ้ามี จะใช้ mysqli_fetch_assoc() function เพื่อดึงข้อมูลของ Admin นั้นออกมาจากฐานข้อมูล
                        {
                            //using whlie loop to get all the data from db
                            //add while

                            //get individual
                            $id = $rows['id'];
                            $full_name =$rows['full_name'];
                            $username =$rows['username'];
                            //display the values in our table
                            ?>
                              <tr>
                                  <td><?php echo $sn++; ?></td>
                                  <td><?php echo $full_name; ?></td>
                                  <td><?php echo $username; ?></td>
                                  <td>
                                    <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                  <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary"><i class="bi bi-pencil-square"></i>Update</a>
                                  <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class= "btn-danger"><i class="bi bi-trash3"></i>Delete</a>
                                  </td>
                              </tr>

                            <?php 
                        }
                    }else{
                        //we do not have data
                    }
                   }
                ?>
            </table>
            
        </div>
       </div>
       <!----Main content section ends ----->
<?php include('partials/footer.php'); ?>
