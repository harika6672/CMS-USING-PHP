<!DOCTYPE html>
<html lang="en">


     <?php include "includes/header.php" ?>
    <div id="wrapper">

        <!-- Navigation -->
       <?php include "includes/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>SIRI</small>
                        </h1>
                         <!--    Add Category Form-->
                        <div class="col-xs-6">
                          <?php insert_category(); ?>
                                 <form action="" method="post"> 
                                <div class="form-group">
                                   <label for="cat-title">Add Category</label>
                                    <input type="text" name="cat_title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>
                           
                            <?php
                                if(isset($_GET['update'])){
                                    $cat_id=$_GET['update'];
                                    include "includes/update_category.php";
                                }
                            ?>
                        </div>
<!--                    Display categories-->
                      <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Category ID</th> 
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php get_allcategories(); ?>
                                <?php delete_category(); ?>                
                            </tbody>
                        </table> 
                      </div>
                     
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/footer.php" ?>