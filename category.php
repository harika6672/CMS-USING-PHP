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
                    if(isset($_GET['c_id'])){
                        $c_id=$_GET['c_id'];
                            $query="SELECT * FROM posts where post_category_id={$c_id}";
                            $select_all_posts_query=mysqli_query($connection,$query);   
                            while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                                 $post_id=$row['post_id'];
                                 $post_title=$row['post_title'];
                                 $post_author=$row['post_author'];
                                 $post_date=$row['post_date'];
                                 $post_image=$row['post_image'];
                                 $post_status=$row['post_status'];
                                 $post_content=$row['post_content'];
                          if($post_status=='publish'){
                              
                                       
                ?>
                
                <h1 class="page-header">
                    Primary Text
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?pid=<?php echo $post_id?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo "Posted on $post_date"?></p>
                <hr>
                <img width="100" class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="post.php?pid=<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                   <?php }} }?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"?>

        </div>
        <!-- /.row -->

        <hr>

<?php 
        include "includes/footer.php";        
?>
