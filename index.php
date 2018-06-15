<?php include "includes/header.php";?>
    <?php include "includes/db.php";?>

    <!-- Navigation -->
   <?php include "includes/navigation.php";?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
<h1 class="page-header">
                    All Posts
<!--                <small>Secondary Text</small>-->
                </h1>
               <?php 
               
                $query = "SELECT * FROM posts ";
                $select_all_posts_query = mysqli_query($connection, $query);
                $post_count = 0;
                while($row =   mysqli_fetch_assoc($select_all_posts_query)){
                $postTitle = $row['post_title'];
                $post_id = $row['post_id'];
                $postAuthor = $row['post_author'];
                $postDate = $row['post_date'];
                $postImage = $row['post_image'];
                $postContent = substr($row['post_content'],0,100);
                $post_status = $row['post_status'];
         if ($post_status == 'published'){
             $post_count++;
                     ?>

                <!-- First Blog Post -->
                <h2>
                     <a href="post.php?p_id=<?php echo $post_id;?> "><?php echo $postTitle;?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $postAuthor;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate;?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" width="200" src="images/<?php echo $postImage;?> " alt=""></a>
                <hr>
                <p><?php echo $postContent;?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>       
              
             <?php }} if ($post_count == 0){ echo "<h1>No Posts Published Yet";}?>

            </div>

           
           
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>

        </div>
        <!-- /.row -->

        <hr>

      <?php include "includes/footer.php";?>