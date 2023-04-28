<?php
require_once ('../includes/db.php');
require_once ('../includes/functions.php');

if (isset($_POST['login'])) 
{
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    loginAgent($db, $email, $password);
}
else 
{
    header("Location: ../html/agentlogin.php?error=error");
}