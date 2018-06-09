<?php include "includes/admin_header.php";?>
<?php include "functions.php";?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
       <?php include "includes/admin_navigation.php";?>

                       <div class="col-xs-6">
                       <?php insert_categories();?>
                       
    
                       <form action="" method="post">
                           
                          <div class="form-group">
                             <label for="cat_title">Add Category</label>
                              <input type="text" class="form-control" name="cat_title">
                          </div> 
                           <div class="form-group">
                              <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                          </div> 
                           
                       </form>
                       
                       <?php update_categories();  ?>
                       
                      
                         <div class="col-xs-6">
                         <table class="table table-bordered table-hover">
                            <thead>
                             <tr>
                             <th>Id</th>
                             <th>Category Title</th>
                             </tr>
                         </thead>
                         <tbody>
                            
                       <?php
                findAllCategories();
                                
                                ?>
                              <?php delete_categories();?>
                           
                             
                             
                             
                         </tbody>
                         </table>
                         
                        </div>
                       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
       
        
        <?php include "includes/admin_footer.php";?>