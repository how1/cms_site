<?php
if (isset($_POST['create_user'])){
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_role = escape($_POST['user_role']);
    
//    $image = $_FILES['image']['name'];
//    $image_temp = $_FILES['image']['tmp_name'];
    
    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);
//    $date = date('d-m-y');
//    $post_comment_count = 4;
    
//    move_uploaded_file($image_temp, "../images/$image");
    
    
    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email,user_password ) ";
    $query.= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}', '{$username}', '{$user_email}','{$user_password}') ";
    
    $create_user_query = mysqli_query($connection, $query);
    confirmQuery($create_user_query);
    echo "User Created: " . "<a class='active' href='users.php'>View Users</a>";
}
?>
   
   <form action="" method="post" enctype="multipart/form-data">
        
    <div class="form-group">
        <label for="post_author">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
       
    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
   <div class="form-group">
        <select name="user_role" id="">
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>    
        
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
        <input type="text" class="form-control" name="username">
    </div>    
       
    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
      
    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
       

       
    <div class="form-group">
        <label for=""></label>
        <input type="submit" class="btn btn-primary" name="create_user" value="Create User">
    </div>

    
    
    
    
    
</form>