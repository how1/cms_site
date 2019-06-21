<div id="sidebar" class="col-sm-4">
               
                <!-- Blog Search Well -->
                <div class="side-bar-card">
                    <h5>Blog Search</h5>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name='submit' class="btn btn-default" type="submit">
                                <span class="fas fa-search"></span>
                        </button>
                        
                        </span>
                    </div>
                    </form> <!--SEARCH FORM-->
                    <!-- /.input-group -->
                </div>

               <!-- Login Form -->
                
               
               
                <!-- Blog Categories Well -->
                <?php
                 $query = "SELECT * FROM categories ";
                    $select_categories_sidebar = mysqli_query($connection, $query);
                  
                ?>
                <div class="side-bar-card">
                    <h5>Blog Categories</h5>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-group">
                               
                               <?php 
                                
    while($row = mysqli_fetch_assoc(
        $select_categories_sidebar)){
        $quantity_query = "SELECT * FROM posts WHERE post_category_id={$row['cat_id']} AND post_status = 'published' ";
        $send = mysqli_query($connection, $quantity_query);
        $numPosts = mysqli_num_rows($send);
        $catTitle =  $row['cat_title'];
        $catId = $row['cat_id'];
        echo "<a class='list-group-item-action' href='category.php?category=$catId'>{$catTitle}<span style='float: right' class='badge badge-primary badge-pill'>{$numPosts}</span></a>";
                    }    
                                ?>
                               
                                
                            </ul>
                        </div>
                        
                        
                        
                    </div>
                    <!-- /.row -->
                </div>

               
            
               
                <!-- Side Widget Well -->
                <?php include "widget.php";?>

            </div>