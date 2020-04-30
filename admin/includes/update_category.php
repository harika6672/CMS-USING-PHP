      
<form action="" method="post">
    <div class="form-group">
      <label for="cat-title">Edit Category</label>
      <?php
         if(isset($_GET['update'])){
           $updateId=$_GET['update'];
           $query="SELECT * FROM categories WHERE cat_id={$updateId}";                                        
           $select_category_query=mysqli_query($connection,$query);
             if($select_category_query){
             while($row=mysqli_fetch_assoc($select_category_query)){
               $cat_id=$row['cat_id'];
               $cat_title=$row['cat_title'];
             }}} ?>
              <input value="<?php if(isset($cat_title)) echo $cat_title ?>" type="text" name="cat_title_edit" class="form-control">

        
                                   
     </div>
    <div class="form-group">
        <?php
        if(isset($_POST['update'])){
            $cat_title_edit=$_POST['cat_title_edit'];
            $query = "UPDATE categories SET cat_title='{$cat_title_edit}' WHERE cat_id={$updateId}";
            $edit_query = mysqli_query($connection,$query);
        }
        ?>
        <input class="btn btn-primary" type="submit" name="update" value="Update Category">
    </div>
</form>