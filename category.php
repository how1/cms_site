<?php include "includes/header.php";?>
    <?php include "includes/db.php";?>

    <!-- Navigation -->
   <?php include "includes/navigation.php";?>

    <!-- Page Content -->
    <div class="container post-container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
               <?php 
               
                
                if (isset($_GET['category'])){
                    
                    $post_cat = $_GET['category'];
                    
                }
                
                $cat_title_query = "SELECT * FROM categories WHERE cat_id = '{$post_cat}' ";
                $get_title = mysqli_query($connection, $cat_title_query);
                $cat_title_row = mysqli_fetch_assoc($get_title);
                $cat_title = $cat_title_row['cat_title'];
                
                echo "<h1 class='sort-menu'>
                    $cat_title";
                ?>
                <small class='dropdown sort-dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown'> Sort By</a>
                    <ul class='dropdown-menu'>
                        <div style="margin: 5px">
                        <li class="dropdown-item">
                            <a href='category.php?sort=newest&category=<?php echo $post_cat;?>'><i class='far fa-calendar-plus'></i> Newest</a>
                        </li>
                        
                        <li class="dropdown-item">
                            <a href='category.php?sort=oldest&category=<?php echo $post_cat;?>'><i class='far fa-calendar-minus'></i> Oldest</a>
                        </li>
                        </div>
                    </ul>
                </small>
                </h1>
                
                <?php
                if (isset($_GET['sort'])){
                    $sort = $_GET['sort'];
                   if ($sort == 'oldest'){
                        $query = "SELECT * FROM posts WHERE post_category_id = $post_cat AND post_status = 'published' ORDER BY post_date ASC";
                   } else {
                        $query = "SELECT * FROM posts WHERE post_category_id = $post_cat AND post_status = 'published' ORDER BY post_date DESC";
                   }
               } else {
                    $query = "SELECT * FROM posts WHERE post_category_id = $post_cat AND post_status = 'published' ORDER BY post_date DESC";
               }
                $select_all_posts_query = mysqli_query($connection, $query);
                if (!$select_all_posts_query){
                    die("Query failed: " . mysqli_error($connection));
                }
                while($row =   mysqli_fetch_assoc($select_all_posts_query)){
                $postTitle = $row['post_title'];
                $post_id = $row['post_id'];
                $postAuthor = $row['post_author'];
                $postDate = $row['post_date'];
                $postImage = $row['post_image'];
                $postContent = substr($row['post_content'],0,100);
                     ?>

                <!-- First Blog Post -->
                <h2 class="article-title">
                     <a href="post.php?p_id=<?php echo $post_id;?> "><?php echo $postTitle;?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $postAuthor;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate;?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo $postImage;?> " alt=""></a>
                <hr>
                <p><?php echo filter_var($postContent, FILTER_SANITIZE_STRING);?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>       
              
             <?php   }?>

            </div>

           
           
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>

        </div>
        <!-- /.row -->

        <hr>

      <?php include "includes/footer.php";?>