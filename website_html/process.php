<?php  
if (isset($_POST['submit'])){
    $to = "hnryown@gmail.com";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    echo $subject;
    $headers = "From: me@asdf.com";
    mail($to, $subject, $message, $headers);
    
}
?>