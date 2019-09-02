<?php
require_once '../lib/online_user.php';
if(session_start()){
    Online_user::deleteUserStatus($_SESSION['id']);
    Online_user::deleteFromXml($_SESSION['id']);
    session_destroy();
    header("location:login.php");
    exit();
}else{
    header("location:adduser.php");
    exit();
}

