<?php  if (isset($_GET['submit'])){
    $to = "hnryown@gmail.com";
    $name = $_GET['name'];
    $email = $_GET['email'];
    $subject = $_GET['subject'];
    echo $subject;
    $headers = "From: me@asdf.com" . "\r\n" . "CC: somebodyelse@example.com";
    mail($to, $subject, $message, $headers);
    
} ?>