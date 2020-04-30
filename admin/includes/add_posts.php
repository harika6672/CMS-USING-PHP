<?php 
    if(isset($_POST['create_post'])){
         $post_category_id=$_POST['post_category'];
         $post_title=$_POST['post_title'];
         $post_author=$_POST['post_author'];
         $post_date=date('d-m-y');
         $post_image=$_FILES['post_image']['name'];
         $post_image_temp=$_FILES['post_image']['tmp_name'];
         $post_content=$_POST['post_content'];
         $post_tags=$_POST['post_tags'];
         $post_comment_count=0;
         $post_status=$_POST['post_status'];
        
        move_uploaded_file($post_image_temp,"../images/$post_image");
          $query="INSERT INTO posts (post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status) VALUES ('$post_category_id','$post_title','$post_author',now(),'$post_image','$post_content','$post_tags','$post_comment_count','$post_status')";
          $add_post_query=mysqli_query($connection,$query);
          confirm_query($add_post_query);
    }
   

?>
   
<form action="" method="post" enctype='multipart/form-data'>
   <label for="post_category">Post Category ID</label>
    <div class="form-group">
         <select name="post_category" id="post_category" class="form-control">
           <?php
                $query="SELECT * FROM categories";
                $select_categories_query=mysqli_query($connection,$query);
                while($row=mysqli_fetch_assoc($select_categories_query)){
                  $cat_id=$row['cat_id'];
                  $cat_title=$row['cat_title'];
                 echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>       
    </select>
    </div>  
     <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
     <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="post_image">
    </div>
     <div class="form-group">
        <label for="post_content">Post Content</label>
         <textarea class="form-control" name="post_content" id="body"></textarea>
    </div>
     <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
     <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" class="form-control">
            <option value="">Select</option>
            <option value="draft">Draft</option>
            <option value="publish">Publish</option>
        </select>
<!--        <input type="text" class="form-control" name="post_status">-->
    </div>
     <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="ADD POST">
    </div>
</form>