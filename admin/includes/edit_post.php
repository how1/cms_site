<?php 
if (isset($_GET['p_id'])){
    $post_id = $_GET['p_id'];
}
$query = "SELECT * FROM posts WHERE post_id = {$post_id} ";
$select_posts_by_id = mysqli_query($connection, $query);


while($row = mysqli_fetch_assoc($select_posts_by_id)){
    $post_id =  escape($row['post_id']);
    $post_author =  escape($row['post_author']);
    $post_title =  escape($row['post_title']);
    $post_cat_id =  escape($row['post_category_id']);
    $post_status = escape( $row['post_status']);
    $post_image = escape( $row['post_image']);
    $post_tags = escape( $row['post_tags']);
    $post_comment_count = escape( $row['post_comment_count']);
    $post_date = escape( $row['post_date']);
    $post_content = escape($row['post_content']);
}

if (isset($_POST['update_post'])){
    
    $title = escape($_POST['title']);
    $author = escape($_POST['author']);
    $category = escape($_POST['post_category']);
    $status =  escape($_POST['post_status']);
    
    $image =  escape($_FILES['image']['name']);
    $image_temp =  escape($_FILES['image']['tmp_name']);
    
    $tags = escape($_POST['post_tags']);
    $content = escape($_POST['post_content']);
    
    move_uploaded_file($image_temp, "../images/$image");
    
    if (empty($image)){
        
        $query = "SELECT * FROM posts WHERE post_id = $post_id ";
        $select_image = mysqli_query($connection, $query);
        while($row = mysqli_fetch_array($select_image)){
            $image = $row['post_image'];
        }
        
    }
    
    
    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$title}', ";
    $query .= "post_category_id = '{$category}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$author}', ";
    $query .= "post_status = '{$status}', ";
    $query .= "post_tags = '{$tags}', ";
    $query .= "post_content = '{$content}', ";
    $query .= "post_image = '{$image}' ";
    $query .= "WHERE post_id = {$post_id} ";
    

    
    $update_post_query = mysqli_query($connection, $query);
    confirmQuery($update_post_query);
    echo "<h6>Your changes have been saved</h6>";
    header("Location: posts.php?source=edit_post&p_id=$post_id");
}
?>
   

<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title;?>" type="text" class="form-control" name="title">
    </div>
    
    <div class="form-group">
        <select name="post_category" id="post_category">
        <?php 
        $query = "SELECT * FROM categories WHERE cat_id = '{$post_cat_id}' ";
     $select_categories = mysqli_query($connection, $query);

     confirmQuery($select_categories);

     $row =           mysqli_fetch_assoc($select_categories);
     $current_cat_title = escape($row['cat_title']);
     ?>
     
     <option value="<?php echo $post_cat_id;?>"><?php echo $current_cat_title;?></option>
     
     <?php
     $query = "SELECT * FROM categories ";
     $select_categories = mysqli_query($connection, $query);

     confirmQuery($select_categories);

     while($row =           mysqli_fetch_assoc($select_categories)){
     $cat_title = escape($row['cat_title']);
     $cat_id = escape($row['cat_id']);


    echo "<option value='{$cat_id}'>$cat_title</option>";
    }


    ?>
  
            
        </select>
    </div>
    
    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author;?>" type="text" class="form-control" name="author">
    </div>
      
    <div class="form-group">
        <select name="post_status" id="">
            <option value="<?php echo $post_status;?>"><?php echo $post_status ?></option>
          <?php
           if ($post_status == "draft") {
               echo "<option value='published'>published</option>";
           } else {
               echo "<option value='draft'>draft</option>";
           }
            
        ?>
            
        </select>
    </div>
       
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img style="margin: 5px" width = '100' src="../images/<?php echo $post_image;?>" alt="">
        <input type="file" name="image">
    </div>
       
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags;?>" type="text" class="form-control" name="post_tags">
    </div>
       
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"><?php echo $post_content;?></textarea>
    </div>
       
    <div class="form-group">
        <label for=""></label>
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
    
</form>