<?php include 'includes/db.php';?>
<?php include 'includes/header.php';?>
<!DOCTYPE html>
<html lang="en">


    <!-- Navigation -->
    <?php include 'includes/navigation.php'?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php 
                    if(isset($_GET['pid'])){
                         $post_id=$_GET['pid'];
                         $query="SELECT * FROM posts WHERE post_id={$post_id}";
                         $select_all_posts_query=mysqli_query($connection,$query);   
                         while($row = mysqli_fetch_assoc($select_all_posts_query)) {  
                             $post_title=$row['post_title'];
                             $post_author=$row['post_author'];
                             $post_date=$row['post_date'];
                             $post_image=$row['post_image'];
                             $post_content=$row['post_content']; 
                       }
                        $query="UPDATE POSTS SET views_count=views_count+1 WHERE post_id={$post_id}";
                        $views_update_query=mysqli_query($connection,$query);
                       
                ?>
                
<!--
                <h1 class="page-header">
                    Primary Text
                    <small>Secondary Text</small>
                </h1>
-->

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo "Posted on $post_date"?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                   <?php } ?>
            
                <!-- Blog Comments -->
                <?php
                    if(isset($_POST['create_comment'])){
                        $post_id=$_GET['pid'];
                        $comment=$_POST['create_comment'];
                        $comment_author=$_POST['comment_author'];
                        $comment_email=$_POST['comment_email'];
                        $comment_content=$_POST['comment_content'];
                        $comment_date=date('d-m-y');
                        $query="INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_date,comment_content,comment_status) VALUES($post_id,'$comment_author','$comment_email',now(),'$comment_content','Unapproved')";
                        $comment_post_query=mysqli_query($connection,$query);
                        if(!$comment_post_query){
                            echo "ERR";
                        }
                        $comm_count_query="UPDATE posts SET post_comment_count=post_comment_count+1 WHERE post_id=$post_id";
                        $comm_count_query_result=mysqli_query($connection,$comm_count_query);
                        if(!$comm_count_query_result){
                            echo "ERR";
                        }
                    }
                
                ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post" action="">
                       <div class="form-group">
                           <label for="author">Name</label>
                            <input type="text" name="comment_author" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="comment_email" class="form-control">
                        </div>
                        <div class="form-group">
                           <label for="comment">Your Comment</label>
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <?php 
                        $comments_query="SELECT * from comments WHERE comment_post_id=$post_id ORDER BY comment_id DESC";
                        $get_comments_query=mysqli_query($connection,$comments_query);
                        while($row=mysqli_fetch_assoc($get_comments_query)){
                            $comment_author=$row['comment_author'];
                            $comment_content=$row['comment_content'];
                            $comment_date=$row['comment_date'];
                            $comment_status=$row['comment_status'];
                            if($comment_status=='approved'){
                     ?>
                    <a href="#" style="inline">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?>
                            <small><?php $comment_date?></small>
                        </h4>
                        <?php echo $comment_content?>
                    </div>
                    <?php } }?>
                </div>

               
            </div>
            
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>

        </div>
        <!-- /.row -->

        <hr>

<?php 
        include "includes/footer.php";        
?>
