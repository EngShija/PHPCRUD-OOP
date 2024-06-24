<?php
session_start();
require_once __DIR__. "/../models/Database.php";
require_once __DIR__. "/../models/Users.php";
require_once __DIR__. "/../helpers/functions.php";
$database = new Database();
$user = new User($database);
$user_id = $_SESSION['userId'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
if($user->update_user($user_id, $name, $email, $password)){
    redirectTo(' ../views/register.php?edited');
}
else{
    echo $user_id;
    // redirectTo(' ../views/register.php?failedToUpdate');
}