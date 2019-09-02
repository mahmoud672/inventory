<?php

require_once '../config.php';

class SalesList{
    
    private $id_item;
    private $id_employee;
    private $quantity;
    private $total_price;
    
    public function __construct($id_item,$id_employee,$quantity,$total_price){
        $this->id_item=$id_item;
        $this->id_employee=$id_employee;
        $this->quantity=$quantity;
        $this->total_price=$total_price;
    }
    public function addItemToSalesList(){
        global $dbh;
        $sql=$dbh->prepare("INSERT INTO sales_list(id_item,id_employee,number,total_price)VALUES('$this->id_item','$this->id_employee','$this->quantity','$this->total_price')");
        $sql->execute();
        if(FALSE !==$sql){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public static function retrieveAllSoldItems(){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM sales_list");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)):
            $data[]=$fetch;
        endwhile;
        return $data;
    }
    public static function retrieveItemFromSalesListByItemIdAndEmpId($id_item,$id_employee){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM sales_list WHERE id_item ='$id_item' AND id_employee = '$id_employee' ");
        $sql->execute();
        $fetch=$sql->fetch(PDO::FETCH_ASSOC);
        return $fetch;
    }
     public static function retrieveSoldItemByEmpId($id_employee){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM sales_list WHERE id_employee = '$id_employee' ");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)){
            $data[]=$fetch;
        }
        return $data;
    }
    public static function deleteSaledItemByItemIdAndEmpId($id_item,$id_employee){
        global $dbh;
        $sql=$dbh->prepare("DELETE FROM sales_list WHERE id_item ='$id_item' AND id_employee = '$id_employee' ");
        $sql->execute();
    }
    public static function updateSaledItemNumberTotalPriceInLsitByItemIdAndEmpId($id_item,$id_employee,$number,$new_total_price){
        global $dbh;
        $sql=$dbh->prepare("UPDATE sales_list SET total_price ='$new_total_price' , number ='$number' WHERE id_item='$id_item' AND id_employee='$id_employee'");
        $sql->execute();
        if(FALSE !==$sql){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
