<!DOCTYPE html>
<html lang="en">


     <?php include "includes/header.php" ?>
    <div id="wrapper">

        <!-- Navigation -->
       <?php include "includes/navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

   

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 
                    $query="select post_id from posts";
                    $query_posts_result=mysqli_query($connection,$query);
                    $posts_count=mysqli_num_rows($query_posts_result);
                    $data=[];
                    $i=0;
                    while($row=mysqli_fetch_array($query_posts_result)){
                       $data[$i]=$row['post_id'];
                       $i++;
                    }
                    ?>
                  <div class='huge'><?php echo count($data);?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                     <?php 
                    $query="select * from comments";
                    $query_comments_result=mysqli_query($connection,$query);
                    $comments_count=mysqli_num_rows($query_comments_result);
                    ?>
                    <div class="col-xs-9 text-right">
                     <div class='huge'><?php echo $comments_count?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <?php 
                    $query="select * from users";
                    $query_users_result=mysqli_query($connection,$query);
                    $users_count=mysqli_num_rows($query_users_result);
                    ?>
                    <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo $users_count?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <?php 
                    $query="select * from categories";
                    $query_categories_result=mysqli_query($connection,$query);
                    $categories_count=mysqli_num_rows($query_categories_result);
                    ?>
                    <div class="col-xs-9 text-right">
                        <div class='huge'><?php echo $categories_count?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="./categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
          <!-- /.row -->
                <!-- /.row -->
                
    <?php
            $query="SELECT * FROM POSTS WHERE post_status='draft'";
            $query_postsDraft_result=mysqli_query($connection,$query);
            $posts_draftcount=mysqli_num_rows($query_postsDraft_result); 
            $query="SELECT * FROM COMMENTS WHERE comment_status='unapproved'";
            $query_commentsApproval_result=mysqli_query($connection,$query);
            $commentsApproval_count=mysqli_num_rows($query_commentsApproval_result); 
            $query="SELECT * FROM USERS WHERE user_role='subscriber'";
            $query_userstatus_result=mysqli_query($connection,$query);
            $userRole_count=mysqli_num_rows($query_userstatus_result); 
    ?>
    <div class="row">
        <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Data','Count'],
                
                    <?php
                        $element_name=['Total posts','Draft Posts','Comments','UnApproved Comments','Categories','Users','Subscribers'];
                        $elememt_count=[$posts_count,$posts_draftcount,$comments_count,$commentsApproval_count,$categories_count,$users_count,$userRole_count];
                        for($i=0;$i<7;$i++){
                            echo "['{$element_name[$i]}'".","."{$elememt_count[$i]}],";
                        }
                    ?>
               ])
                var options = {
                  chart: {
                    title: '',
                    subtitle: '',
                  }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
</div>
        </div>
        <!-- /#page-wrapper -->
<?php include "includes/footer.php" ?>