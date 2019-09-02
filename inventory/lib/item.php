<?php
require_once '../config.php';

class Item{
    private $id;
    private $title;
    private $description;
    private $image;
    private $image_tmp;
    private $price;
    private $number;
    private $id_category;
    private $id_user;
    
    public function __construct($title,$description,$image,$image_tmp,$price,$number,$id_category,$id_user,$id="") {
        $this->title=$title;
        $this->description=$description;
        $this->image=$image;
        $this->image_tmp=$image_tmp;
        $this->price=$price;
        $this->number=$number;
        $this->id_category=$id_category;
        $this->id_user=$id_user;
        $this->id=$id;
    }
    public function addItem(){
        if(is_uploaded_file($this->image_tmp)){
            $this->image=time().$this->image;
            if(move_uploaded_file($this->image_tmp,'../upload/'. $this->image)){
                global $dbh;
                $sql=$dbh->prepare("INSERT INTO item(title,description,image,price,number,id_category,id_user)VALUES('$this->title','$this->description','$this->image','$this->price','$this->number','$this->id_category','$this->id_user')");
                $sql->execute();
                if(FALSE !== $sql){
                    return TRUE;
                }else{
                    return FALSE;
                }
            }   
        }   
    }
     public function updateItem(){
        if(is_uploaded_file($this->image_tmp)){
            $this->image=$this->image.time();
            if(move_uploaded_file($this->image_tmp,'../upload/'. $this->image)){
                global $dbh;
                $sql=$dbh->prepare("UPDATE item SET title='$this->title',description='$this->description',image='$this->image',price='$this->price',number='$this->number',id_category='$this->id_category',id_user='$this->id_user'WHERE id='$this->id'");
                $sql->execute();
                if(FALSE !== $sql){
                    return TRUE;
                }else{
                    return FALSE;
                }
            }   
        }   
    }
    public static function updateItemNumber($id,$newNumber){
        global $dbh;
        $sql=$dbh->prepare("UPDATE item SET number ='$newNumber' WHERE id='$id'");
        $sql->execute();
        if(FALSE !== $sql){
            return TRUE;
        }else{
            return FALSE;
        }   
    }
    public static function deleteItemById($id){
        global $dbh;
        $sql=$dbh->prepare("DELETE FROM item WHERE id='$id'");
        $sql->execute();
        if(FALSE !== $sql){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public static function retrieveAllItems(){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM item");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)):
            $data[]=$fetch;
        endwhile;
        return $data;
    }
    public static function retrieveItemById($id){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM item WHERE id='$id'");
        $sql->execute();
        $fetch=$sql->fetch(PDO::FETCH_ASSOC);
        return $fetch;
    }
    public static function retrieveLastItems(){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM item ORDER BY id DESC limit 7");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)):
            $data[]=$fetch;
        endwhile;
        return $data;
    }
    public static function retrieveItemsByIdCategory($id_category){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM item WHERE id_category='$id_category'");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)){
            $data[]=$fetch;
        }
        return $data;
    }
    public static function retrievecountOfCategoryFromItemByIdCategory($id_category){
        global $dbh;
        $sql=$dbh->prepare("SELECT id_category FROM item WHERE id_category='$id_category'");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)){
            $data[]=$fetch;
        }
        return $data;
    }
}

/*$allItemsForSpecificCategory=  Item::retrieveItemByIdCategory(3);
if(is_array($allItemsForSpecificCategory)){
    foreach ($allItemsForSpecificCategory as $itemsOfCategory):
        echo count($itemsOfCategory['id_category']).'<br/>';
    endforeach;
}else{
    echo 'there is no item';
}
*/

