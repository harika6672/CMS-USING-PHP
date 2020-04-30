 <table class="table">
    <thead>
       <tr>
         <td>Id</td>
         <td>Usename</td>
         <td>First Name</td>
         <td>Last Name</td>
         <td>Email</td>
         <td>Role</td>
      </tr>
   </thead>
   <tbody>
      <?php get_users() ?>
      <?php delete_users();?>
      <?php admin(); ?>
      <?php subscriber(); ?>
   </tbody>
                      
</table> 


