  <div class="col-md-4">
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                       <form action="search.php" method="post">
                             <input type="text" name="search" class="form-control">
                             <span class="input-group-btn">
                                <button name="submit" class="btn btn-default" type="submit">
                             <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span> 
                       </form>
                    </div>
                    <!-- /.input-group -->
                </div>
                
                <div class="well">
                    <h4>Login</h4>
                    <div class="input-group">
                       <form action="includes/login.php" method="post">
                            <div class="form-group">
                                 <input type="text" name="username" class="form-control" placeholder="Enter userName">
                            </div>
                            <div class="input-group">
                                 <input type="password" name="password" class="form-control" placeholder="Enter password">
                                  <div class="input-group">
                                    <button name="login_submit" class="btn btn-primary" type="submit">Submit</button>
                                    <button name="forgot_pwd" class="btn btn-primary" type="submit">Forgot Password</button>
                                 </div>
                            </div>                    
                            
                       </form>
                    </div>
                    <!-- /.input-group -->
                </div>


                <!-- Blog Categories Well -->
                <div class="well"> 
                   <?php
                     $query="select * from categories";
                     $select_categories_sidebar=mysqli_query($connection,$query);
                    ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                               <?php 
                               
                                while($row=mysqli_fetch_assoc($select_categories_sidebar)){
                                   $cat_id=$row['cat_id'];
                                   $cat_title=$row['cat_title'];
                                   echo "<li><a href='category.php?c_id={$cat_id}'>{$cat_title}</a></li>";
                                } 
                                ?>
<!-- 
//                                <li><a href="#">Category Name</a>
//                                </li>
//                                <li><a href="#">Category Name</a>
//                                </li>
//                                <li><a href="#">Category Name</a>
//                                </li>
//                                <li><a href="#">Category Name</a>
//                                </li>
-->
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                       
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>