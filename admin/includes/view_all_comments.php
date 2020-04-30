 <table class="table">
    <thead>
       <tr>
         <td>Id</td>
         <td>Author</td>
         <td>Comment</td>
         <td>Email</td>
         <td>Status</td>
         <td>In Response to</td>
         <td>Date</td>
         <td>Approve</td>
         <td>Unapprove</td>
         <td>Delete</td>
         
      </tr>
   </thead>
   <tbody>
      <?php get_comments() ?>
      
     
   </tbody>
                      
</table> 

<?php delete_comments(); ?>
<?php approve(); ?>
<?php unapprove(); ?>