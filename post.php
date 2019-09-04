<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include "includes/db.php";?>
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
        $postContent = $row['post_content'];}
             ?>
    <title id='page_title'><?php echo $postTitle; ?></title>

    <meta property='og:title' content="<?php echo $page_title ?>"/>
    <meta property="og:type" content="website" />
    <meta property='og:image:width:600'/>
    <meta property='og:image:height:400'/>
    <meta property='og:image' content='http://henrywowen.com/images/<?php echo $postImage ?>'/>
    <meta property='og:description' content='Henry on henrywowen.com'/>
    <meta property='og:url' content='http://henrywowen.com/post.php?p_id=5' />

    <?php include "recaptcha.php"; ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo $site_key;?>"></script>
    <script>
    grecaptcha.ready(function () {
        grecaptcha.execute( '<?php echo $site_key;?>' , { action: 'contact' }).then(function (token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
    </script>

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">


    <!-- Custom CSS -->
    <link href="styles/styles.css" rel="stylesheet">

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
                $postCategory = $row['post_category_id'];
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

                <?php // Check if form was submitted:
                
                include "recaptcha.php";
                $user_not_bot = false;
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {

                        // Build POST request:
                        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
                        $recaptcha_secret = $secret_key;
                        $recaptcha_response = $_POST['recaptcha_response'];

                        // Make and decode POST request:
                        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
                        $recaptcha = json_decode($recaptcha);

                        // Take action based on the score returned:
                        if ($recaptcha->score >= 0.5) {
                            $user_not_bot = true;
                        } else {
                            // Not verified - show form error
                        }

                    } ?>

<!-- Related reads -->
<div>
    <h3>Related Articles</h3>
    <?php 
    $query = "SELECT * FROM posts WHERE post_category_id = $postCategory AND post_status = 'published' ORDER BY post_date DESC";
    $select_all_posts_query = mysqli_query($connection, $query);
    if (!$select_all_posts_query){
    die("Query failed: " . mysqli_error($connection));
    }
    while($row =   mysqli_fetch_assoc($select_all_posts_query)){
    $r_postTitle = $row['post_title'];
    $r_post_id = $row['post_id'];
    $r_postAuthor = $row['post_author'];
    $r_postDate = $row['post_date'];
    $r_postImage = $row['post_image'];
    $r_postContent = substr($row['post_content'],0,20);
    if ($r_post_id != $post_id){
    ?>

    <!-- Related Blog Post -->
    <ul class="related-posts-list">
        <li style="float: left; margin-right: 1rem">
            <a href="post.php?p_id=<?php echo $r_post_id; ?>">
            <img class="post-preview-img" src="images/<?php echo $r_postImage;?> " alt=""></a>
        </li>
        <li>
            <h4 class="article-title">
            <a href="post.php?p_id=<?php echo $r_post_id;?> "><?php echo $r_postTitle;?></a>
            </h4>
            <p style="display:inline-block"><?php echo filter_var($r_postContent, FILTER_SANITIZE_STRING) . " . . . ";?></p>
            <a style="display:inline-block" class="btn btn-primary" href="post.php?p_id=<?php echo $r_post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        </li>
    </ul>
    <hr> 

    <?php }} ?>

</div>


<?php 
                
      if (isset($_POST['create_comment']) &&  $user_not_bot){
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
          $msg = "Comment approval needed at henrywowen.com";
          mail("hnryown@gmail.com", "Comment Approval Needed", $msg, "From: me@henrywowen.com");
          
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
                        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
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