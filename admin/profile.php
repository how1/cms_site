<?php include "includes/admin_header.php";?>
<?php include "functions.php";?>
<body>

    <div id="wrapper">

        <!-- Navigation -->
       <?php include "includes/admin_navigation.php";?>

        
                        <?php
                        
                        if (isset($_SESSION['username'])){
    $the_username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$the_username}' ";
    $select_user_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_user_query)){
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
    
//    $image = $_FILES['image']['name'];
//    $image_temp = $_FILES['image']['tmp_name'];
    
        $username = $row['username'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
    }
                            
    if (isset($_POST['update_profile'])){
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    
//    $image = $_FILES['image']['name'];
//    $image_temp = $_FILES['image']['tmp_name'];
    
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
//    $date = date('d-m-y');
//    $post_comment_count = 4;
    
//    move_uploaded_file($image_temp, "../images/$image");
    
    
    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= "WHERE username = '{$username}' ";
    
    $update_profile_query = mysqli_query($connection, $query);
    
    confirmQuery($update_profile_query);
    echo "<h6>Your changes have been saved</h6";
}
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
           
            <option value="admin"><?php echo $user_role;?></option>
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
        <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
    </div>

    
    
    
    
    
</form>
                       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
       
        
        <?php include "includes/admin_footer.php";?>