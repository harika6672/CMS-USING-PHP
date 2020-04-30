<?php 
    if(isset($_POST['create_user'])){
         $username=$_POST['username'];
         $user_firstname=$_POST['user_firstname'];
         $user_lastname=$_POST['user_lastname'];
         $user_email=$_POST['user_password'];
         $user_password=$_POST['user_email'];
         $user_role=$_POST['user_role'];
        
        
          $query="INSERT INTO users (username,user_firstname,user_lastname,user_password,user_email,user_role) VALUES ('$username','$user_firstname','$user_lastname','$user_email','$user_password','$user_role')";
          $add_user_query=mysqli_query($connection,$query);
          confirm_query($add_user_query);
    }
   

?>
   
<form action="" method="post" enctype='multipart/form-data'>
   
        
        <div class="form-group">
            <label for="user_firstname">First Name</label>
            <input type="text" class="form-control" name="user_firstname">
        </div>
        <div class="form-group">
            <label for="user_firstname">Last Name</label>
            <input type="text" class="form-control" name="user_lastname">
        </div>
        <div class="form-group"> 
         <select name="user_role" id="user_role" class="form-control">
            <option value="subscriber">Select Options</option>";
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
         </select>
        </div>  
     <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" class="form-control" name="username">
    </div>
     <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text-area" class="form-control" name="user_email">
    </div>
     <div class="form-group">
        <label for="user_password">Password</label>
        <input type="text" class="form-control" name="user_password">
    </div>
     <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="ADD USER">
    </div>
</form>