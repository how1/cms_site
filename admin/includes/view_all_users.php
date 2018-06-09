                        <table class="table table-bordered table-hover">
                            
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                               
                               
                               <?php 
                                
$query = "SELECT * FROM users ";
$select_users = mysqli_query($connection, $query);


while($row = mysqli_fetch_assoc($select_users)){
    $user_id =  escape($row['user_id']);
    $username =  escape($row['username']);
    $user_firstname =  escape($row['user_firstname']);
    $user_lastname =  escape($row['user_lastname']);
    $user_email =  escape($row['user_email']);
    $user_password =  escape($row['user_password']);
    $user_image =  escape($row['user_image']);
    $user_role = escape($row['user_role']);
 
    
    echo "<tr>";
    echo "<td>$user_id</td>";
    echo "<td>$username</td>";
    echo "<td>$user_firstname</td>";
    
    
//     $query = "SELECT * FROM categories WHERE cat_id = {$post_cat_id} ";
//     $select_categories_id = mysqli_query($connection, $query);
//
//     while($row =     mysqli_fetch_assoc($select_categories_id )){
//     $catTitle =  $row['cat_title'];
//     }
//    echo "<td>$catTitle</td>";
    
    
    echo "<td>$user_lastname</td>";
    echo "<td>$user_email</td>";
    echo "<td>$user_role</td>";
    
    
    echo "<td><a href='users.php?change_to_admin=$user_id'>Change to Admin</a></td>";
    echo "<td><a href='users.php?change_to_subscriber=$user_id'>Change to Subscriber</a></td>";
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \"  href='users.php?delete=$user_id'>Delete</a></td>";
    echo "<td><a href='users.php?source=edit_user&u_id=$user_id'>Edit</a></td>";
    echo "</tr";
    echo"<br>";
}
                                
                                
                                
                                ?>
                            </tbody>
                        </table>
                        
                        
<?php

if (isset($_GET['change_to_subscriber'])){
    
    $the_user_id = escape($_GET['change_to_subscriber']);
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id";
    $ch_sub_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

if (isset($_GET['change_to_admin'])){
    
    $the_user_id = escape($_GET['change_to_admin']);
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id";
    $ch_admin_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

if (isset($_GET['delete'])){
    
    if (isset($_SESSION['user_role'])){
        if ($_SESSION['user_role'] == 'admin'){
    
    
            $the_user_id = escape($_GET['delete']);
            $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
            $delete_query = mysqli_query($connection, $query);
            header("Location: users.php");

        }
    }
}


?>
                        