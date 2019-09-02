<?php

require_once '../config.php';

class SalesDate{
    
    private $id_item;
    private $id_employee;
    private $quantity;
    private $price;
    
    public function __construct($id_item,$id_employee,$quantity,$price){
        $this->id_item=$id_item;
        $this->id_employee=$id_employee;
        $this->quantity=$quantity;
        $this->price=$price;
    }
    public function addInfoToSalesDate(){
        global $dbh;
        $sql=$dbh->prepare("INSERT INTO sales_date(id_item,id_employee,quantity,price)VALUES('$this->id_item','$this->id_employee','$this->quantity','$this->price')");
        $sql->execute();
        if(FALSE !==$sql){
            return TRUE;
        }else{
            return FALSE;
        }
    }
     public static function retrieveInfoAboutItemFromSalesDateBySaleDate($sale_date){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM sales_date WHERE sale_date ='$sale_date'");
        $sql->execute();
        $fetch=$sql->fetch(PDO::FETCH_ASSOC);
        return $fetch;
    }
    public static function retrieveAllInfoAboutItemsFromSalesDate(){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM sales_date");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)):
            $data[]=$fetch;
        endwhile;
        return $data;
    }
    public static function retrieveInfoAboutItemFromSalesDateByItemIdAndEmpId($id_item,$id_employee){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM sales_date WHERE id_item ='$id_item' AND id_employee = '$id_employee' ");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)):
            $data[]=$fetch;
        endwhile;
        return $data;
    }
    public static function retrievePriceBetween2Dates($start,$end){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM sales_date WHERE sale_date BETWEEN '$start' AND '$end'");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)):
            $data[]=$fetch;
        endwhile;
        return $data;
    }
    public static function updateInfoAboutItemFromSalesDateBySaleDate($quantity,$price,$sale_date){
        global $dbh;
        $sql=$dbh->prepare("UPDATE sales_date SET quantity='$quantity' , price='$price' WHERE sale_date='$sale_date'");
        $sql->execute();
        if(FALSE !==$sql){
            return TRUE;
        }else{
            return FALSE;
        }
    }
   
}

/*$total=0;
$dateRanges=  SalesDate::retrievePriceBetween2Dates('2018-01-21 11:45:54','2018-01-29 20:09:36');
    if(is_array($dateRanges)){
        foreach ($dateRanges as $dates):
            $total+=$dates['price'];
        endforeach;
        echo $total;
    }else{
        echo'there is no data';
    }
*/