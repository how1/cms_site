<?php
if (isset($_POST['create_post'])){
    $title =  escape($_POST['title']);
    $author =  escape($_POST['author']);
    $category =  escape($_POST['post_category']);
    $status =  escape($_POST['post_status']);
    
    $image =  escape($_FILES['image']['name']);
    $image_temp = $_FILES['image']['tmp_name'];
    $image_error = $_FILES['image']['error'];
    
    $tags =  escape($_POST['post_tags']);
    $content = $_POST['post_content'];
    $date = date('d-m-y');
//    $post_comment_count = 4;
    
    if ($image_error === 0){
        move_uploaded_file($image_temp, "../images/" . $image);
    } else {
        $content = "upload failed: " . $image_error;  
    }


    
    $query = "INSERT INTO posts(post_title,post_category_id, post_author, post_date, post_image, post_content,post_tags,post_status ) ";
    $query.= "VALUES('{$title}',{$category},'{$author}',now(),'{$image}', '{$content}', '{$tags}','{$status}') ";
    
    $create_post_query = mysqli_query($connection, $query);
    confirmQuery($create_post_query);
    $message = "Your post has been submitted";
} else {$message = '';}
?>
   <?php echo "<h5 style='color: red'>$message</h5>";?>

   <form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    
   <div class="form-group">
        <select name="post_category" id="post_category">
            
    <?php
     $query = "SELECT * FROM categories ";
     $select_categories = mysqli_query($connection, $query);

     confirmQuery($select_categories);

     while($row =           mysqli_fetch_assoc($select_categories)){
     $cat_title =  $row['cat_title'];
     $cat_id =  $row['cat_id'];


     echo "<option value='{$cat_id}'>$cat_title</option>";
    }
    ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>
       
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
       
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
       
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
       
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>
       
    <div class="form-group">
        <label for=""></label>
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
<?php echo "<h5 style='color:red'>$message</h5>";?>
    
    
    
    
    
</form>