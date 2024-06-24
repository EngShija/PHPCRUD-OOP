<?php
require_once __DIR__. "/../models/Database.php";
require_once __DIR__. "/../models/Users.php";
require_once __DIR__. "/../helpers/functions.php";
$database = new Database();
$user = new User($database);
$users = $user->get_user_single_row();
$user_id = $users['id'];
if($user->delete_user($user_id)){
    redirectTo(' ../views/register.php?deleted');
}