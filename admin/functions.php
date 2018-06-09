<?php 

function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}



function confirmQuery($queryResult){
    global $connection;
    if (!$queryResult){
        die("query failed " . mysqli_error($connection));
    }
}



function insert_categories(){
    global $connection;
     if (isset($_POST['submit'])){
                               
                               $title = $_POST['cat_title'];
                               
                               if ($title == '' || empty($title)){
                                   echo "This field should not be empty";
                               } else {
                                   $query = "INSERT INTO categories(cat_title) ";
                                   $query .= "VALUE('{$title}') ";
                                   $createCategory = mysqli_query($connection, $query);
                                   if (!$createCategory){
                                       die("QUERY FAILED " . mysqli_error($connection));
                                   }
                               }
                               
                           }
    
    
    
}

function update_categories(){
    global $connection;
     if (isset($_GET['edit'])){
                               $cat_id = $_GET['edit'];
                                include "includes/update_categories.php";
                               
                           }
    
    
    
}


//Find all categories
function findAllCategories(){
    global $connection;
    $query = "SELECT * FROM categories ";
    $select_categories = mysqli_query($connection, $query);
            
                                
    while($row =      mysqli_fetch_assoc($select_categories )){
        $catTitle =  $row['cat_title'];
        $catId =  $row['cat_id'];
        echo "<tr>";
        echo "<td>{$catId}</td>";
        echo "<td>{$catTitle}</td>";
        echo "<td><a href='categories.php?delete={$catId}'>Delete</a></td>";

        echo "<td><a href='categories.php?edit={$catId}'>Edit</a></td>";
        echo "</td>";
    }
}


function delete_categories(){
    
    global $connection;
     if (isset($_GET['delete'])){
                                 
                                 $the_cat_id = $_GET['delete'];
                                 $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
                                 $delete_query = mysqli_query($connection, $query);
                                 header("Location: categories.php");
                                 
                                 
                             } 


}







?>