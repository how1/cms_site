
<!--
<style>
table{
    width: 100%;
}

th, td {
    max-width: 100px;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
-->
<style>

    #comContent{
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    
</style>
                           <table class="table table-bordered table-hover">
                            
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Re:</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Disapprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                               
                               <?php 
                                
$query = "SELECT * FROM comments ";
$select_posts = mysqli_query($connection, $query);

if (mysqli_num_rows($select_posts) == 0){
    echo "<h3>No comments to display</h3>";
} else {
while($row = mysqli_fetch_assoc($select_posts)){
    $com_id =  $row['comment_id'];
    $com_post_id =  $row['comment_post_id'];
    $com_author =  $row['comment_author'];
    $com_email =  $row['comment_email'];
    $com_content =  $row['comment_content'];
    $com_status =  $row['comment_status'];
    $com_date =  $row['comment_date'];

    echo "<tr style='width:3px'>";
    echo "<td>$com_id</td>";
    echo "<td>$com_author</td>";
    echo "<td><div id='comContent'>$com_content</div></td>";
    

//     $query = "SELECT * FROM categories WHERE cat_id = {$post_cat_id} ";
//     $select_categories_id = mysqli_query($connection, $query);
//
//     while($row =     mysqli_fetch_assoc($select_categories_id )){
//     $catTitle =  $row['cat_title'];
//     }
//    echo "<td>$catTitle</td>";
    
    
    echo "<td>$com_email</td>";
    echo "<td>$com_status</td>";
    
    $query = "SELECT * FROM posts WHERE post_id = $com_post_id ";
    $select_post_id_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_post_id_query)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        
        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</td>";
    }
    
    echo "<td>$com_date</td>";
    
    echo "<td><a href='comments.php?approve={$com_id}'>Approve</a></td>";
    echo "<td><a href='comments.php?disapprove={$com_id}'>Disapprove</a></td>";
    echo "<td><a href='comments.php?delete={$com_id}'>Delete</a></td>";
    echo "</tr";
    echo"<br>";
}
                                
                                
                                
                                ?>
                            </tbody>
                        </table>
                        
  
<?php

if (isset($_GET['disapprove'])){
    
    $the_comment_id = $_GET['disapprove'];
    $query = "UPDATE comments SET comment_status = 'disapproved' WHERE comment_id = $the_comment_id";
    $disapprove_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

if (isset($_GET['approve'])){
    
    $the_comment_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
    $approve_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

if (isset($_GET['delete'])){
    
    $the_comment_id = $_GET['delete'];
    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

}
?>
                        