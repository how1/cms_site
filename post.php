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
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
               <?php 
                
                if (isset($_GET['p_id'])){
                    $post_id = $_GET['p_id'];
                }
                
               
                $query = "SELECT * FROM posts WHERE post_id = $post_id ";
                $select_all_posts_query = mysqli_query($connection, $query);
                
                while($row =   mysqli_fetch_assoc($select_all_posts_query)){
                $postTitle = $row['post_title'];

                $postAuthor = $row['post_author'];
                $postDate = $row['post_date'];
                $postImage = $row['post_image'];
                $postContent = $row['post_content'];
                     ?>
                         
                         
                         
                   

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $postTitle;?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $postAuthor;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate;?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $postImage;?> " alt="">
                <hr>
                <p><?php echo $postContent;?></p>
               

                <hr>       
              
             <?php   }?>

           
           
                <!-- Blog Comments -->
<?php 
                
      if (isset($_POST['create_comment'])){
          $post_id = $_GET['p_id'];
          $com_author = $_POST['comment_author'];
          $com_email = $_POST['comment_email'];
          $com_content = $_POST['comment_content'];
          $query = "INSERT INTO comments (comment_post_id, comment_date, comment_author, comment_content, comment_status, comment_email) "; 
          $query .= " VALUES ($post_id, now(), '{$com_author}', '{$com_content}', 'unapproved', '{$com_email}')";
          
          $comment_query = mysqli_query($connection, $query);
          if (!$comment_query){
                die("query failed " . mysqli_error($connection));
          }
          
          $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
          $increment_com_count = mysqli_query($connection, $query);
        if (!$increment_com_count){
                die("query failed " . mysqli_error($connection));
          }
          
      }
            ?>
            
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                           <label for="Author">Author</label>
                           <?php 
if (isset($_SESSION['username'])){
    $value = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$value}' ";
    $get_email = mysqli_query($connection, $query);
    if (!$get_email){
        die("Query failed: ". mysqli_error($connection));
    }
    $row = mysqli_fetch_assoc($get_email);
    $email = $row['user_email'];
} else {
    $value = '';
    $email = '';
}
                            ?>
                            <input type="text" value="<?php echo $value;?>" name="comment_author" class="form-control">
                        </div>
                        <div class="form-group">
                           <label for="Email">Email</label>
                            <input type="email" name="comment_email" 
                            value="<?php echo $email;?>" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                           <label for="comment">Comment</label>
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>
    
                <!-- Posted Comments -->

                <!-- Comment -->
                
                <?php 
                $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} ";
                $query .= "AND comment_status = 'approved' ";
                $query .= "ORDER BY comment_id DESC ";
                $select_comment_query = mysqli_query($connection, $query);
                if (!$select_comment_query){
                    die("Query failed: " . mysqli_error($connection));
                }
                while ($row = mysqli_fetch_assoc($select_comment_query)){
                    $com_date = $row['comment_date'];
                    $com_content = $row['comment_content'];
                    $com_author = $row['comment_author'];
                ?>
                
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $com_author; ?>
                            <small><?php echo $com_date;?></small>
                        </h4>
                        <?php echo $com_content;?>
                    </div>
                </div>
           <?php } ?>
            </div>

           
           
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>

        </div>
        <!-- /.row -->

        <hr>

      <?php include "includes/footer.php";?>