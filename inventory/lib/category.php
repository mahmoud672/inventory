<?php
require_once '../config.php';

class Category{
    private $id;
    private $name;
    
    public function __construct($name,$id="") {
        $this->name=$name;
        $this->id=$id;
    }
    public function addCategory(){
        global $dbh;
        $sql=$dbh->prepare("INSERT INTO category(name)VALUES('$this->name')");
        $sql->execute();
        if(FALSE !==$sql){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function updateCategory(){
        global $dbh;
        $sql=$dbh->prepare("UPDATE category SET name='$this->name' WHERE id='$this->id'");
        $sql->execute();
        if(FALSE !==$sql){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public static function deleteCategoryById($id){
        global $dbh;
        $sql=$dbh->prepare("DELETE FROM category WHERE id='$id'");
        $sql->execute();
        if(FALSE !==$sql){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public static function retrieveAllCategories(){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM category");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)):
            $data[]=$fetch;
        endwhile;
        return $data;
    }
    public static function retrieveCategoryById($id){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM category WHERE id ='$id'");
        $sql->execute();
        $fetch=$sql->fetch(PDO::FETCH_ASSOC);
        return $fetch;
    }
}

