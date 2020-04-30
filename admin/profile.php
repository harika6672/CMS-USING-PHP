<!DOCTYPE html>
<html lang="en">


     <?php include "includes/header.php" ?>
    <div id="wrapper">
        <?php 
           if($connection){
               echo "Connected";
           }
    ?>
        <!-- Navigation -->
       <?php include "includes/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['username']?></small>
                        </h1>
                        <?php
    if(isset($_SESSION['username'])){
        $session_name=$_SESSION['username'];
        $profile_query="SELECT * from users WHERE username='{$session_name}'";
        $select_profile_query=mysqli_query($connection,$profile_query);
        if($select_profile_query){
            while($row=mysqli_fetch_assoc($select_profile_query)){
                    $user_id=$row['user_id'];
                    $username=$row['username'];
                    $user_firstname=$row['user_firstname'];
                    $user_lastname=$row['user_lastname'];
                    $user_email=$row['user_email'];
                    $user_role=$row['user_role'];
                    $user_password=$row['user_password'];
            }
        }else{
            echo mysqli_error($connection);
        }
    }

    if(isset($_POST['update_profile'])){
         $username=$_POST['username'];
         $user_firstname=$_POST['user_firstname'];
         $user_lastname=$_POST['user_lastname'];
         $user_email=$_POST['user_email'];
         $user_password=$_POST['user_password'];
         $user_role=$_POST['user_role'];
        
          $upd_profile_query="UPDATE users SET username='{$username}',user_firstname='{$user_firstname}',user_lastname='{$user_lastname}',user_email='{$user_email}',user_password='{$user_password}',user_role='{$user_role}' WHERE username='{$session_name}'";
          $edit_post_query=mysqli_query($connection,$upd_profile_query);
         if(!$edit_post_query){
             echo "err";
         }
    }

?>
                        <form action="" method="post" enctype='multipart/form-data'> 
                                <div class="form-group">
                                    <label for="user_firstname">First Name</label>
                                    <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>"   >
                                </div>
                                <div class="form-group">
                                    <label for="user_firstname">Last Name</label>
                                    <input type="text" class="form-control" name="user_lastname"  value="<?php echo $user_lastname ?>">
                                </div>
                                <div class="form-group"> 
                                 <select name="user_role" id="user_role" class="form-control">
                                    <option  value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
                                    <option value="admin">admin</option>
                                    <option value="subscriber">subscriber</option>
                                 </select>
                                </div>  
                               <div class="form-group">
                                <label for="username">User Name</label>
                                <input type="text" class="form-control" name="username"  value="<?php echo $username ?>">
                               </div>
                                 <div class="form-group">
                                    <label for="user_email">Email</label>
                                    <input type="text-area" class="form-control" name="user_email"  value="<?php echo $user_email ?>">
                                </div>
                                 <div class="form-group">
                                    <label for="user_password">Password</label>
                                    <input type="text" class="form-control" name="user_password"  value="<?php echo $user_password ?>">
                                </div>
                                 <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="update_profile" value="ADD USER">
                                </div>
</form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/footer.php" ?>