<?php

require_once '../config.php';

class Paginator{
    /*
    private $tbl_name;
    private $page;
    private $start;
    private $per_page;
    
    public function __construct($tbl_name,$page,$start,$per_page){
        $this->tbl_name=$tbl_name;
        $this->page=$page;
        $this->start=$start;
        $this->per_page=$per_page;
    }
    public function paginate(){
        global $dbh;
        $sql=$dbh->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM {$this->tbl_name} LIMIT {$this->start} , {$this->per_page}");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)):
            $data[]=$fetch;
        endwhile;
        return $data;
    }
     
     */
     public static function pagination($tbl_name,$start,$per_page){
        global $dbh;
        $sql=$dbh->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM {$tbl_name} LIMIT {$start} , {$per_page}");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)):
            $data[]=$fetch;
        endwhile;
        return $data;
    }
    public static function paginationById($tbl_name,$start,$per_page,$tbl_column,$comparative){
        global $dbh;
        $sql=$dbh->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM {$tbl_name} WHERE {$tbl_column} = '$comparative' LIMIT {$start} , {$per_page}");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)):
            $data[]=$fetch;
        endwhile;
        return $data;
    }
    public static function calcTotal($tbl_name, $start, $per_page){
        global $dbh;
        $paginate=  Paginator::pagination($tbl_name, $start, $per_page);
        $total=$dbh->query("SELECT FOUND_ROWS() AS total ")->fetch()['total'];
        return $total;
    }
}
/*
$per_page=isset($_GET['per_page']) && $_GET['per_page'] <=11?(int)$_GET['per_page']:4;
echo $page=isset($_GET['page'])?(int)$_GET['page']:1;
$start=($page >1)?($page *$per_page)-$per_page:0;
//$p=new Paginator('item',$page,$start, $per_page);
$allDa=  Paginator::pagination('item', $start, $per_page);
//$allData=$p->paginate();
//$total=$p->calcTotal();
$total=  Paginator::calcTotal('item', $start, $per_page);
echo '<br>'.$total;
$pages=ceil($total/$per_page);
foreach ($allDa as $data):
    echo '<h1>'.$data['id'].' '.$data['title'].' '.$data['description'].'</h1>';
    
endforeach;
for($i=1;$i<=$pages;$i++):
    echo '<a href="?page='.$i.'">'.$i.'</a>';
    
endfor;
*/

