<?php
ob_start();
if(!session_start()){
    session_start();
}
$dbh= new PDO("mysql:dbhost=localhost;dbname=store","root","");
if(!$dbh){
    echo 'no connection';
}

