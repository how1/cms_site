<?php  
if (isset($_POST['submit'])){
    $to = "hnryown@gmail.com";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    echo $subject;
    $headers = "From: me@henrywowen.com";
    $sent = mail($to, $subject, $message, $headers);
    if (!$sent){
        echo "not sent";
    }
}
?>