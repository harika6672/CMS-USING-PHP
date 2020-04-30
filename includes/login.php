<?php include './db.php';?>
<?php session_start(); ?>
<?php
if(isset($_POST['login_submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $query="SELECT * FROM users WHERE username='{$username}'";
    $user_query=mysqli_query($connection,$query);
    if(!$user_query){
        echo "ERR";
    }
    while($row=mysqli_fetch_array($user_query)){
        $db_username=$row['username'];
        $db_password=$row['user_password']; 
        $db_role=$row['user_role'];
    }
   
        $password=crypt($password,$db_password);
        
        if($db_username===$username && $db_password===$password && $db_role=='admin'){
            $_SESSION['username']=$db_username;
            $_SESSION['user_role']='admin';
            header('Location:../admin/index.php');
        }else{
//           echo "err";
            header('Location:../index.php');
        }
    }
//if(isset($_POST['forgot_pwd'])){
//    $msg = "HI Harika..it's really nice that you are learning how to send mail using PHP";
//
//    // use wordwrap() if lines are longer than 70 characters
//    $msg = wordwrap($msg,70);
//
//    // send email
//    mail("rajasiri1998@gmail.com","Your PHP code says",$msg);
//}
 
?>


//This is for testing 