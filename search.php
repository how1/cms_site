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
                if (isset($_POST['submit'])){
                    $result = mysqli_real_escape_string($connection, $_POST['search']);
                    
                    echo "<h1 class='page-header'>
                    Results for \"$result\"</h1>";
                        
                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$result%' OR post_title LIKE '%$result%' ";
                    
                    $search_query = mysqli_query($connection, $query);
                    
                    if (!$search_query){
                        die("QUERY FAILED " . mysqli_error($connection));
                    }
                    $count = mysqli_num_rows($search_query);
                    if ($count == 0){
                        echo "<h1> No Results</h1>";
                    } else {
               
               
                while($row =   mysqli_fetch_assoc($search_query)){
                $postTitle = $row['post_title'];

                $postAuthor = $row['post_author'];
                $postDate = $row['post_date'];
                $postImage = $row['post_image'];
                $postContent = substr($row['post_content'],0,100);
                     ?>
                         
                         
                         
                   

                <!-- First Blog Post -->
                <h2 class="article-title">
                    <a href="#"><?php echo $postTitle;?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $postAuthor;?></a>
                </p>
                <p><span class="far fa-clock"></span> <?php echo $postDate;?></p>
                <hr>
                <img class="img-responsive" style="width:30%;" src="images/<?php echo $postImage;?> " alt="">
                <hr>
                <p><?php echo filter_var($postContent, FILTER_SANITIZE_STRING) . " . . . ";?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>       
              
             <?php   }
                    }
                    
                }
               
                ?>
                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>

        </div>
        <!-- /.row -->

        <hr>

      <?php include "includes/footer.php";?>