<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        
        ?>

        <br><br>

        <!-- Add CAtegory Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- Add CAtegory Form Ends -->

        <?php 
        
            //CHeck whether the Submit Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Get the Value from CAtegory Form
                $title = $_POST['title'];

                //For Radio input, we need to check whether the button is selected or not
                /// Đối với đầu vào Radio, chúng ta cần kiểm tra xem nút đã được chọn hay chưa
                if(isset($_POST['featured']))
                {
                    //Get the VAlue from form
                    $featured = $_POST['featured'];
                }
                else
                {
                    //SEt the Default VAlue
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //Check whether the image is selected or not and set the value for image name accoridingly
                //print_r($_FILES['image']);

                //die();//Break the Code Here
                //ช้ isset() function ในการตรวจสอบว่ามีการส่งไฟล์รูปภาพขึ้นมาหรือไม่
                if(isset($_FILES['image']['name']))
                {
                    //Upload the Image // Để tải lên hình ảnh, chúng ta cần tên hình ảnh, đường dẫn nguồn và đường dẫn đích
                    //To upload image we need image name, source path and destination path
                    $image_name = $_FILES['image']['name'];
                    
                    // Upload the Image only if image is selected
                    if($image_name != "")
                    {

                        //Auto Rename our Image
                        // Nhận ext phần mở rộng của hình ảnh của chúng tôi (jpg, png, gif, v.v.)
                        $ext = end(explode('.', $image_name));

                        //Rename the Image
                        // โค้ดนี้เป็นการกำหนดชื่อไฟล์รูปภาพที่ต้องการอัพโหลดใหม่ โดยได้ใช้ฟังก์ชัน rand() เพื่อสุ่มตัวเลข 3 หลักและเชื่อมต่อกับคำว่า "Food_Category_" 
                        //พร้อมนามสกุลของไฟล์รูปภาพที่อยู่ในตัวแปร $ext ซึ่งจะเป็นส่วนขยายของไฟล์เดิมที่ได้มาจาก explode() function โดยใช้จุด (.) 

                        $image_name = "Food_Category_".rand(000, 999).'.'.$ext; // e.g. Food_Category_834.jpg

                        // โค้ดนี้เป็นส่วนของการอัพโหลดรูปภาพขึ้นที่เซิร์ฟเวอร์ โดยกำหนดต้นทางของไฟล์รูปภาพในตัวแปร $source_path จาก $_FILES['image']['tmp_name'] 
                        //ซึ่งจะเป็นตัวแปรชั่วคราวที่เก็บไฟล์รูปภาพที่ถูกอัพโหลดขึ้นมา และกำหนดตำแหน่งปลายทางของไฟล์รูปภาพในตัวแปร $destination_path 
                        //โดยเป็นตำแหน่งที่เราต้องการให้ไฟล์รูปภาพถูกบันทึกไว้ในโฟลเดอร์ images/category/ และกำหนดชื่อไฟล์รูปภาพให้เป็น $image_name 
                        //ที่เรากำหนดไว้ก่อนหน้านี้ หลังจากนั้นจะทำการอัพโหลดไฟล์รูปภาพโดยใช้ฟังก์ชัน move_uploaded_file() 
                        //ซึ่งจะทำการย้ายไฟล์รูปภาพจากตำแหน่งต้นทาง $source_path ไปยังตำแหน่งปลายทาง $destination_path ที่เรากำหนดไว้ 
                        //โดยฟังก์ชันนี้จะส่งค่ากลับมาในตัวแปร $upload ซึ่งจะเป็น true หากการอัพโหลดไฟล์รูปภาพสำเร็จ และ false หากไม่สำเร็จ
                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //SEt message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            //Redirect to Add CAtegory Page
                            header('location:'.SITEURL.'admin/add-category.php');
                            //STop the Process
                            die();
                        }

                    }
                }
                else
                {
                    //Không tải lên hình ảnh và đặt giá trị image_name thành trống
                    $image_name="";
                }

                //2. Create SQL Query to Insert CAtegory into Database
                $sql = "INSERT INTO tbl_category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                "; 

                //3. Execute the Query and Save in Database
                $res = mysqli_query($conn, $sql);

                //4. Check whether the query executed or not and data added or not
                if($res==true)
                {
                    //Query Executed and Category Added
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    //Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Failed to Add CAtegory
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                    //Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>