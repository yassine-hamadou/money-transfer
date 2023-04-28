<?php
$db = mysqli_connect('localhost', 'root', '', 'money-transfert', '3306');
if (!$db) {
    die('Could not connect: ' . mysqli_error($db));
}


