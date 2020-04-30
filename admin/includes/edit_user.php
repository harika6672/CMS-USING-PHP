<?php
    if(isset($_GET['update'])){
        $update_id=$_GET['update'];
        $edit_query="SELECT * from users WHERE user_id={$update_id}";
        $select_editable_data=mysqli_query($connection,$edit_query);
        if($select_editable_data){
            while($row=mysqli_fetch_assoc($select_editable_data)){
                    $user_id=$row['user_id'];
                    $username=$row['username'];
                    $user_firstname=$row['user_firstname'];
                    $user_lastname=$row['user_lastname'];
                    $user_email=$row['user_email'];
                    $user_role=$row['user_role'];
                    $user_password=$row['user_password'];
                    
            }
        }else{
            echo mysqli_error($select_editable_data);
        }
    }

    if(isset($_POST['update_user'])){
         $username=$_POST['username'];
         $user_firstname=$_POST['user_firstname'];
         $user_lastname=$_POST['user_lastname'];
         $user_email=$_POST['user_email'];
         $user_password=$_POST['user_password'];
         $user_role=$_POST['user_role'];
        
        $user_password=crypt($user_password,'$1$rasmusle$');
          $upd_query="UPDATE users SET username='{$username}',user_firstname='{$user_firstname}',user_lastname='{$user_lastname}',user_email='{$user_email}',user_password='{$user_password}',user_role='{$user_role}' WHERE user_id={$update_id}";
          $edit_post_query=mysqli_query($connection,$upd_query);
         if(!$edit_post_query){
             echo "err";
         }
         echo "Updated Successfully";
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
        <input type="submit" class="btn btn-primary" name="update_user" value="ADD USER">
    </div>
</form>