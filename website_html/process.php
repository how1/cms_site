<?php  if (isset($_GET['submit'])){
    $to = "hnryown@gmail.com";
    $name = $_GET['name'];
    $email = $_GET['email'];
    $subject = $_GET['subject'];
    $headers = "From: me@asdf.com";
    mail($to, $subject, $message, $headers);
    
} ?>