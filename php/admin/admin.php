<?php
include('../../includes/db.php');
include('../../includes/functions.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
        
    loginAdmin($db, $email, $pwd);
}
else {
    header('Location: /money-transfert/html/adminlogin.php');
    exit();
}