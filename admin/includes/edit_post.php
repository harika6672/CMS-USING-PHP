<?php
    if(isset($_GET['update'])){
        $update_id=$_GET['update'];
        $edit_query="SELECT * from posts WHERE post_id={$update_id}";
        $select_editable_data=mysqli_query($connection,$edit_query);
        if($select_editable_data){
            while($row=mysqli_fetch_assoc($select_editable_data)){
                    $post_category_id=$row['post_category_id'];
                    $post_title=$row['post_title'];
                    $post_author=$row['post_author'];
                    $post_image=$row['post_image'];
                    $post_content=$row['post_content'];
                    $post_tags=$row['post_tags'];
                    $post_status=$row['post_status'];
            }
        }else{
            echo mysqli_error($select_editable_data);
        }
    }

    if(isset($_POST['edit_post'])){
         $post_category_id=$_POST['post_category'];//we will get category id of selected one..
         $post_title=$_POST['post_title'];
         $post_author=$_POST['post_author'];
         $post_image=$_FILES['post_image']['name'];
         $post_image_temp=$_FILES['post_image']['tmp_name'];
         $post_content=$_POST['post_content'];
         $post_tags=$_POST['post_tags'];
         $post_status=$_POST['post_status'];
        
        move_uploaded_file($post_image_temp,"../images/$post_image");
        if(empty($post_image)){
            $query="SELECT * from posts WHERE post_id={$update_id}";
            $image_query=mysqli_query($connection, $query);
            while($row=mysqli_fetch_array($image_query)){
                $post_image=$row['post_image'];
            }
        }
          $upd_query="UPDATE posts SET post_category_id ='{$post_category_id}', post_title='{$post_title}',post_author='{$post_author}',post_image='{$post_image}',post_content='{$post_content}',post_tags='{$post_tags}',post_status='{$post_status}' WHERE post_id={$update_id}";
          $edit_post_query=mysqli_query($connection,$upd_query);
         if(!$edit_post_query){
             echo "err";
         }
        echo "Updated Successfully";
    }

?>
<form action="" method="post" enctype='multipart/form-data'>
     <div class="form-group">
        <label for="post_category_id">Post Category ID</label>
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
        <input type="text" class="form-control" name="post_title" value="<?php if(isset($post_title)) echo $post_title ?>">
    </div>
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php if(isset($post_author)) echo $post_author ?>">
    </div>
     <div class="form-group">
        <label for="post_image">Post Image</label>
        <img width="100" src = "../images/<?php echo $post_image?>" alt="nnn">
        <input type="file" class="form-control" name="post_image">
    </div>
     <div class="form-group">
        <label for="post_content">Post Content</label>
        <input type="text-area" class="form-control" name="post_content" value="<?php if(isset($post_content)) echo $post_content ?>">
    </div>
     <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php if(isset($post_tags)) echo $post_tags ?>">
    </div>
     <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php if(isset($post_status)) echo $post_status ?>">
    </div>
     <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_post" value="EDIT POST">
    </div>
</form>