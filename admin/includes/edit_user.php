<?php

if (isset($_GET['u_id'])){
    $the_user_id = escape($_GET['u_id']);
    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $select_user_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_user_query)){
        $user_firstname = escape($row['user_firstname']);
        $user_lastname = escape($row['user_lastname']);
        $user_role = escape($row['user_role']);
    
//    $image = $_FILES['image']['name'];
//    $image_temp = $_FILES['image']['tmp_name'];
    
        $username = escape($row['username']);
        $user_email = escape($row['user_email']);
        $user_password = escape($row['user_password']);
    }
}

if (isset($_POST['update_user'])){
    $user_id = escape($_GET['u_id']);
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname =escape($_POST['user_lastname']);
    $user_role = escape($_POST['user_role']);
    
//    $image = $_FILES['image']['name'];
//    $image_temp = $_FILES['image']['tmp_name'];
    
    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);
//    $date = date('d-m-y');
//    $post_comment_count = 4;
    
//    move_uploaded_file($image_temp, "../images/$image");
    
     $query = "SELECT randSalt FROM users";
     $select_randsalt_query = mysqli_query($connection, $query);
        if (!$select_randsalt_query){
            die("Query failed " . mysqli_error($connection));
        }
    
     $row = mysqli_fetch_assoc($select_randsalt_query);
     $salt = $row['randSalt'];
     $user_password = crypt($user_password, $salt);
    
    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= "WHERE user_id = {$user_id} ";
    
    $update_user_query = mysqli_query($connection, $query);
    
    confirmQuery($update_user_query);
}
?>

   <form action="" method="post" enctype="multipart/form-data">
        
    <div class="form-group">
        <label for="post_author">Firstname</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>
       
    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
    </div>
   <div class="form-group">
        <select name="user_role" id="">
           
            <option value="<?php echo $user_role; ?>"><?php echo $user_role;?></option>
            <?php if ($user_role == 'admin'){
                echo "<option value='admin'>subscriber</option>";
            } else {
                echo "<option value='subscriber'>admin</option>";
            }   
        ?>
        
        </select>
    </div>
       
<!--
    <div class="form-group">
        <label for="post_image">User Image</label>
        <input type="file" name="user_image">
    </div>
-->
       
    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>    
       
    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
    </div>
      
    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password">
    </div>
       
    <div class="form-group">
        <label for=""></label>
        <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
    </div>

    
    
    
    
    
</form>