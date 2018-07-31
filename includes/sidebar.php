<div id="sidebar" class="col-sm-4">
               
                <!-- Blog Search Well -->
                <div>
                    <h4>Blog Search</h4>
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
                <div>
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">
                    <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="Enter Username">
                    </div>
                    
                    <div class="input-group">
                        <input name="password" type="password" class="form-control" placeholder="Enter Password">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" name="login" type="submit">Submit
                            </button>
                        </span>
                    </div>
                    </form> <!--SEARCH FORM-->
                    <!-- /.input-group -->
                </div>
               
               
                <!-- Blog Categories Well -->
                <?php
                 $query = "SELECT * FROM categories ";
                    $select_categories_sidebar = mysqli_query($connection, $query);
                  
                ?>
                <div>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-group">
                               
                               <?php 
                                
    while($row = mysqli_fetch_assoc(
        $select_categories_sidebar)){
        $quantity_query = "SELECT * FROM posts WHERE post_category_id={$row['cat_id']}";
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