<?php
    function escape($string){
        global $connection;
        return mysqli_real_escape_string($connection, trim($string));
    }
?>


<?php
//ADD CATEGORY
    function insert_category(){
        
                           global $connection;
        if(isset($_POST['submit'])){
                                    $cat_title=$_POST['cat_title'];
                                    if($cat_title == ""){
                                        echo "This field shouldn't be empty";
                                    }else{
                                         $query="INSERT INTO categories (cat_id,cat_title) VALUES (null,'$cat_title')";
                                         $add_category_query=mysqli_query($connection,$query);
                                         if(!$add_category_query){
                                             die('Query Failed'.mysqli_error($connection));
                                         }
                                    }
                                   
                                }
            
    }
?>
<?php
//FIND ALL CATEGORIES
    function get_allcategories(){
        global $connection;
        $query="SELECT * FROM categories";
        $select_categories_query=mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($select_categories_query)){
          $cat_id=$row['cat_id'];
          $cat_title=$row['cat_title'];
          echo "<tr>
                  <td>{$cat_id}</td>
                  <td>{$cat_title}</td>
                  <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
                  <td><a href='categories.php?update={$cat_id}'>edit</a></td>
              </tr>";
       }
    }
?>
<?php
//DELETE CATEGORY
    function delete_category(){
        global $connection;
         if(isset($_GET['delete'])){
           $id=$_GET['delete'];
           $query="DELETE FROM categories WHERE cat_id={$id}";
           $delete_category_query=mysqli_query($connection,$query);
           header("Location:categories.php");
        }
    }
?>
<?php
//CONFIRM WHETHER QUERY IS WORKING OR NOT
function confirm_query($result){
    global $connection;
    if(!$result){
            die('Query Failed'.mysqli_error($result));
    }
}
?>
<?php

//GET ALL POSTS
function get_posts(){
     global $connection;
     $query="SELECT * FROM posts";
         $select_all_posts=mysqli_query($connection,$query);
               while($row = mysqli_fetch_assoc($select_all_posts)) {
                    $post_id=$row['post_id'];
                    $post_category_id=$row['post_category_id'];
                    $post_title=$row['post_title'];
                    $post_author=$row['post_author'];
                    $post_date=$row['post_date'];
                    $post_image=$row['post_image'];
                    $post_tags=$row['post_tags'];
                    $post_comments=$row['post_comment_count'];
                    $post_status=$row['post_status'];
                    $views_count=$row['views_count'];
                   
                    echo "<tr>";
                    ?>
                    <td><input type='checkbox' class='chk' value='<?php echo $post_id?>' name='chkBoxArray[]'></td> 
                    <?php
                    echo "<td>$post_id</td>";
                    echo "<td>$post_author</td>";
                    echo "<td>$post_title</td>"; 
                    $query= "SELECT * FROM categories WHERE cat_id={$post_category_id}";
                                $select_categories_query=mysqli_query($connection,$query);
                                while($row=mysqli_fetch_assoc($select_categories_query)){
                                  $cat_id=$row['cat_id'];
                                  $cat_title=$row['cat_title']; 
                                } 
                    echo "<td>$cat_title</td>";
                   
                     echo "<td>$post_status</td>
                            <td><img width='40px' src='../images/$post_image' alt='image'></td>
                            <td>$post_tags</td>
                            <td>$post_comments</td>
                            <td>$post_date</td>
                            <td><a href='posts.php?source=edit_post&update={$post_id}'>Edit</a></td>
                            <td><a onClick=\"javscript: return confirm('Are u sure?);\" href='posts.php?delete={$post_id}'>Delete</a></td>";
                     echo  "<td><a href='../post.php?pid={$post_id}'>View Post</a></td>";
                     echo  "<td>$views_count</td>";
                     echo  "</tr>"; 
               }
}
?>
<?php
//DELETE POST
function delete_posts(){
    global $connection;
     if(isset($_GET['delete'])){
                if($_SESSION['user_role']){ 
                if($_SESSION['user_role']=='admin'){ 
                $delete_id=mysqli_real_escape_string($connection,$_GET['delete']);
                $del_query="DELETE FROM posts WHERE post_id={$delete_id}";
                $delete_post_query=mysqli_query($connection, $del_query);
                header("Location:posts.php");
                confirm_query($delete_post_query);
            }
        }
     }
}
?>
<?php
function delete_comments(){
    global $connection;
     if(isset($_GET['delete_comment'])){
        $delete_comment_id=$_GET['delete_comment'];
        $del_com_query="DELETE FROM comments WHERE comment_id={$delete_comment_id}";
        $delete_comment_query=mysqli_query($connection, $del_com_query);
        header("Location:comments.php");
        confirm_query($delete_comment_query);
 }
}
?>
<?php
//GET ALL COMMENTS
function get_comments(){
     global $connection;
     $query="SELECT * FROM comments";
         $select_all_comments=mysqli_query($connection,$query);
               while($row = mysqli_fetch_assoc($select_all_comments)) {
                    $comment_id=$row['comment_id'];
                    $comment_post_id=$row['comment_post_id'];
                    $comment_author=$row['comment_author'];
                    $comment_content=$row['comment_content'];
                    $comment_email=$row['comment_email'];
                    $comment_date=$row['comment_date'];
                    $comment_status=$row['comment_status'];
                   
                     echo "<tr>";
                     echo "<td>$comment_id</td>";
                     echo "<td>$comment_author</td>";
                     echo "<td>$comment_content</td>";
                     echo "<td>$comment_email</td>";
                     echo "<td>$comment_status</td>";
                     $query= "SELECT * FROM posts WHERE post_id={$comment_post_id}";
                                $select_post_id_query=mysqli_query($connection,$query);
                                confirm_query($select_post_id_query);
                                while($row=mysqli_fetch_assoc($select_post_id_query)){
                                  $posted_title=$row['post_title']; 
                                  echo "<td><a href='../post.php?pid=$comment_post_id'>$posted_title</a></td>";
                                }
                     
                     echo " <td>$comment_date</td>";      
                     echo " <td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                     echo " <td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                     echo " <td><a href='comments.php?delete_comment=$comment_id'>Delete</a></td>";
                     echo "</tr>"; 
               }
}
?>
<?php
//APPROVE THE COMMENT
function approve(){
    global $connection;
     if(isset($_GET['approve'])){  
         $comm_id=$_GET['approve'];
         $status="approved";
         $query_approve="UPDATE comments SET comment_status='$status' WHERE comment_id= {$comm_id}";
         $approve_query_result=mysqli_query($connection,$query_approve);
         confirm_query($approve_query_result);
         header("Location:comments.php");
                       
     }
}
?>
<?php
//UNAPPROVE THE COMMENT
function unapprove(){
    global $connection;
     if(isset($_GET['unapprove'])){  
         $comm_id=$_GET['unapprove'];
         $status="unapproved";
         $query_unapprove="UPDATE comments SET comment_status='$status' WHERE comment_id= {$comm_id}";
         $unapprove_query_result=mysqli_query($connection,$query_unapprove);
         confirm_query($unapprove_query_result);
         header("Location:comments.php");            
     }
}
?>
<?php
//GET ALL USERS
function get_users(){
  global $connection;
     $query="SELECT * FROM users";
         $select_all_users=mysqli_query($connection,$query);
               while($row = mysqli_fetch_assoc($select_all_users)) {
                    $user_id=$row['user_id'];
                    $username=$row['username'];
                    $user_firstname=$row['user_firstname'];
                    $user_lastname=$row['user_lastname'];
                    $user_email=$row['user_email'];
                    $user_image=$row['user_image'];
                    $user_role=$row['user_role'];
                    
                   
                    echo "<tr>";
                    echo "<td>$user_id</td>";
                    echo "<td>$username</td>";
                    echo "<td>$user_firstname</td>"; 
                    echo "<td>$user_lastname</td>"; 
                    echo "<td>$user_email</td>";
                    echo "<td>$user_role</td>";
                    echo "<td><a href='users.php?admin=$user_id'>Admin</a></td>";
                    echo "<td><a href='users.php?subscriber=$user_id'>Subscriber</a></td>";
                    echo "<td><a href='users.php?source=edit_user&update=$user_id'>Edit</a></td>";
                    echo "<td><a href='users.php?delete_user=$user_id'>Delete</a></td>";
                    echo "</tr>"; 
               }  
} 
?>
<?php
//DELETE USER
function delete_users(){
    global $connection;
     if(isset($_GET['delete_user'])){
        $delete_user_id=$_GET['delete_user'];
        $del_user_query="DELETE FROM users WHERE user_id={$delete_user_id}";
        $delete_user_query=mysqli_query($connection, $del_user_query);
        header("Location:users.php");
        confirm_query($delete_user_query);
 }
}
?>
<?php
//USER IS ADMIN
function admin(){
    global $connection;
     if(isset($_GET['admin'])){  
         $user_id=$_GET['admin'];
         $role="admin";
         $query_admin="UPDATE users SET user_role='$role' WHERE user_id= {$user_id}";
         $admin_query_result=mysqli_query($connection,$query_admin);
         confirm_query($admin_query_result);
         header("Location:users.php");            
     }
}
?>
<?php
//USER IS SUBSCRIBER
function subscriber(){
    global $connection;
     if(isset($_GET['subscriber'])){  
         $user_id=$_GET['subscriber'];
         $role="subscriber";
         $query_subscriber="UPDATE users SET user_role='$role' WHERE user_id= {$user_id}";
         $subscriber_query_result=mysqli_query($connection,$query_subscriber);
         confirm_query($subscriber_query_result);
         header("Location:users.php");            
     }
}

?>
