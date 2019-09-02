<?php

require_once '../config.php';
require_once 'online_user.php';
class User{
    
    private $id;
    private $name;
    private $email;
    private $password;
    private $job_type;
    
    public function __construct($name,$email,$password,$job_type,$id=""){
        $this->name=$name;
        $this->email=$email;
        $this->password=$password;
        $this->job_type=$job_type;
        $this->id=$id;
    }
     public function addUser(){
        global $dbh;
        $sql=$dbh->prepare("INSERT INTO user(name,email,password,job_type)VALUES('$this->name','$this->email','$this->password','$this->job_type')");
        $sql->execute();
        if(!FALSE == $sql){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public static function deleteUserById($id){
        global $dbh;
        $sql=$dbh->prepare("DELETE FROM user WHERE id='$id'");
        $sql->execute();
        if(!FALSE == $sql){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public static function retrieveAllUsers(){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM user");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)):
            $data[]=$fetch;
        endwhile;
        return $data;
    }
    public static function retrieveUserById($id){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM user WHERE id='$id'");
        $sql->execute();
        $fetch=$sql->fetch(PDO::FETCH_ASSOC);
        return $fetch;
    }
    public function updateUser(){
        global $dbh;
        $sql=$dbh->prepare("UPDATE user SET name='$this->name',email='$this->email',password='$this->password',job_type='$this->job_type' WHERE id='$this->id'");
        $sql->execute();
        if(!FALSE == $sql){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public static function logIn($name,$password){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM user WHERE name ='$name' AND password ='$password'");
        $sql->execute();
        $fetch=$sql->fetch(PDO::FETCH_ASSOC);
        
        if(is_array($fetch)){
            $_SESSION['name']=$fetch['name'];
            $_SESSION['id']=$fetch['id'];
            $_SESSION['job_type']=$fetch['job_type'];
            $online_user=new Online_user($_SESSION['id'], 1);
            $online_user->addUserStatus();
            Online_user::addToXml($_SESSION['id'],1);
            if($_SESSION['job_type']==1){
                 header("location:home.php");
            }else{
                header("location:allitems.php");
            }
            
            exit();
        }else{
            header("location:login.php");
        }
    } 
}

