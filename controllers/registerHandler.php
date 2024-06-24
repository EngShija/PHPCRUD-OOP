<?php
require_once __DIR__."/../models/Database.php";
require_once __DIR__. "/../models/Users.php";
require_once __DIR__. "/../helpers/functions.php";
$database = new Database();
$user = new User($database);
$name = $user->set_name($_POST['name']);
$email = $user->set_email($_POST['email']);
$password = $user->set_password($_POST['password']);

if(empty($name)){
   redirectTo('../views/register.php?emptyName');
    exit;
}
if($user->register_user($name, $email, $password)){
    redirectTo('../views/register.php');
}