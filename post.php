<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include "db.php";?>
    <?php 
                
        if (isset($_GET['p_id'])){
            $post_id = $_GET['p_id'];
        }
        
       
        $query = "SELECT * FROM posts WHERE post_id = $post_id ";
        $select_all_posts_query = mysqli_query($connection, $query);
        
        while($row =   mysqli_fetch_assoc($select_all_posts_query)){
        $postTitle = $row['post_title'];
        $page_title = $postTitle;
        $postAuthor = $row['post_author'];
        $postDate = $row['post_date'];
        $postImage = $row['post_image'];
        $postContent = $row['post_content'];
             ?>
    <title id='page_title'><?php echo $postTitle; ?></title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">


    <!-- Custom CSS -->
    <link href="../styles/styles.css" rel="stylesheet">

     <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="../images/blank_favicon.png" type="image/x-icon"/>
</head>

<body>

    <!-- Navigation -->
   <?php include "includes/navigation.php";?>

    <!-- Page Content -->
    <div class="container" id="post-container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
<!--
<h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
-->
               <?php 
                
                if (isset($_GET['p_id'])){
                    $post_id = $_GET['p_id'];
                }
                
               
                $query = "SELECT * FROM posts WHERE post_id = $post_id ";
                $select_all_posts_query = mysqli_query($connection, $query);
                
                while($row =   mysqli_fetch_assoc($select_all_posts_query)){
                $postTitle = $row['post_title'];
                $page_title = $postTitle;
                $postAuthor = $row['post_author'];
                $postDate = $row['post_date'];
                $postImage = $row['post_image'];
                $postContent = $row['post_content'];
                     ?>

                         
                         
                   

                <!-- First Blog Post -->
                <h2 class="article-title">
                    <a href="#"><?php echo $postTitle;?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $postAuthor;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate;?></p>
                <hr>
                <img class="img-responsive" style="width: 80%" src="images/<?php echo $postImage;?> " alt="">
                <hr>
                <p><?php echo $postContent;?></p>
                <?php 
                    if ($post_id == 5) 
                        echo "<object width='100%' height='1000px' type='application/pdf' data='/autonomous_vehicle_briefing.pdf?#zoom=85&scrollbar=0&toolbar=0&navpanes=0'>
                             <p>PDF cannot be displayed.</p>
                            </object>";
                ?>
               
                <hr>       
              <!-- keep dont delete bracket-->
             <?php   }?>
             <!-- keep bracket -->
        
           
           
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

          mail("hnryown@gmail.com", "Comment Approval Needed", "Comment approval needed at henrywowen.com", "From: me@henrywowen.com");
          
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
                    $img_query = "SELECT user_image FROM users WHERE username = '{$com_author}'";
                    $image_query = mysqli_query($connection, $img_query);
                    $row = mysqli_fetch_assoc($image_query);
                    $user_image = $row['user_image'];
                    if ($user_image == ""){
                        $user_image = "http://placehold.it/64x64";
                    } else {
                        $user_image = "user_images/" . $user_image;
                    }
                ?>
                
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" style="width:64px" src="<?php echo $user_image;?>" alt="">
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