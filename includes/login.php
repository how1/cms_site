<?php 
include "db.php";
session_start();
?>

<?php 
if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username) || empty($password)){
        header("Location: ../index.php");
    }
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query){
        die("Query failed " . mysqli_error($connection));
    }
//    if (mysqli_num_rows($select_user_query) == 0){
//        header("Location: ../index.php");
//    }
     while($row = mysqli_fetch_assoc($select_user_query)){

        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_firstname = $row['user_firstname'];
        $db_lastname = $row['user_lastname'];
        $db_role = $row['user_role'];
        $db_password = $row['user_password'];

    }

    $password = crypt($password, $db_password);
    if ($username === $db_username && $password === $db_password){
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_firstname;
        $_SESSION['lastname'] = $db_lastname;
        $_SESSION['user_role'] = $db_role;
        header("Location: ../admin");
    } else {
        header("Location: ../index.php");
    }
}



?>