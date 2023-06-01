<?php 
   //include
   include ('../config/constraints.php');
   //1. Destroy to session
   session_destroy(); //unset[$_SESSION('user')]

   //2. login page
   header('location:'.SITEURL.'admin/login.php');
?> 