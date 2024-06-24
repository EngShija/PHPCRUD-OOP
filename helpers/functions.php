<?php
function redirectTo($url){
    header('location: '.$url);
    exit;
}