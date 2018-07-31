<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
<?php

if (isset($_POST['submit'])){
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    
    if (strlen($username) !== 0 && strlen($password) !== 0 && strlen($email) !== 0){
    
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        $email = mysqli_real_escape_string($connection, $email);
        $check_unique_username = "SELECT * FROM users WHERE username = '{$username}'";
        $unique = mysqli_query($connection, $check_unique_username);
        if (mysqli_num_rows($unique) != 0){
            $message = "Username must be unique";
        } else {
            $query = "SELECT randSalt FROM users";
            $select_randsalt_query = mysqli_query($connection, $query);

            if (!$select_randsalt_query){
                die("Query failed " . mysqli_error($connection));
            }

            $row = mysqli_fetch_assoc($select_randsalt_query);
            $salt = $row['randSalt'];
            $password = crypt($password, $salt);


            $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
            $query .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber')";
            $register_user_query = mysqli_query($connection, $query);
            if (!$register_user_query){
                die("Query failed: " . mysqli_error($connection));
            }
            $message = "Your registration has been submitted";
        }
    } else{
        $message = "Fields cannot be empty";
    }
    
} else {$message = '';}

?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-lg-5"></div>
            <div class="col-xs-6">
                <div class="form-wrap">
                <h1 class="text-center">Register</h1>
                   <h6 class="text-centered"><?php echo $message; ?></h6>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
            
            <div class="col-lg-3"></div>

        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
