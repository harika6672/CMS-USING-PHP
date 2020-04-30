<?php
                        if(isset($_POST['deleteUsingChk'])){
                            foreach($_POST['chkBoxArray'] as $chkBoxArray){
                                 
                                        $del_query="DELETE FROM posts WHERE post_id={$chkBoxArray}";
                                        $delete_post_query=mysqli_query($connection, $del_query);
                                        header("Location:posts.php");
                                        confirm_query($delete_post_query);
                            }
                        }
                        if(isset($_POST['apply'])){
                            foreach($_POST['chkBoxArray'] as $chkBoxArrayId){
                                $status_value=$_POST['status'];
                                switch($status_value){
                                    case 'publish':
                                    $query="UPDATE POSTS SET post_status='{$status_value}' WHERE post_id={$chkBoxArrayId}";
                                    mysqli_query($connection,$query);
                                        break;
                                    case 'draft':
                                    $query="UPDATE POSTS SET post_status='{$status_value}' WHERE post_id={$chkBoxArrayId}";
                                    mysqli_query($connection,$query);
                                        break;
                                }
                                   
                            }
                        }
                        
?>
<form method="post">
           <div class="col-md-4">
               <select name="status" class="form-control">
                   <option value="draft">Draft</option>
                   <option value="publish">Publish</option>
               </select>
           </div>
           
           <button class='btn btn-success' name="apply" type='submit'>Apply</button>
           <button class='btn btn-primary' name="deleteUsingChk" type='submit'>Delete</button>
            <table class="table">
                <thead>
                   <tr>
                     <td><div class='checkbox'><label><input name="selectAll" id="selectAllCheckbox"type='checkbox' value=''></label></div></td>
                     <td>Id</td>
                     <td>Author</td>
                     <td>Title</td>
                     <td>Category Id</td>
                     <td>Status</td>
                     <td>Image</td>
                     <td>Tags</td>
                     <td>Comment</td>
                     <td>Date</td>
                  </tr>
                </thead>
                <tbody>
                  <?php get_posts() ?>
                  <?php delete_posts();?>
                </tbody>
            </table>
 </form>
 


