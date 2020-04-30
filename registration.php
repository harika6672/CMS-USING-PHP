<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 <?php
    if(isset($_POST['registration'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $email=$_POST['email'];
        
        $username=mysqli_real_escape_string($connection,$username);
        $password=mysqli_real_escape_string($connection,$password);
        $email=mysqli_real_escape_string($connection,$email);
        
        $query="SELECT randSalt FROM USERS";
        $randSaltquery=mysqli_query($connection,$query);
        $row=mysqli_fetch_array($randSaltquery);
        $hash=$row['randSalt'];
        $password=crypt($password,$hash);
        $query="INSERT INTO USERS(username,user_email,user_password) VALUES('{$username}','{$email}','{$password}')";
        $registerQuery=mysqli_query($connection,$query);
    }
?>
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="registration" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
