<?php

require_once '../lib/user.php';
require_once '../lib/item.php';
require_once '../lib/category.php';
require_once '../lib/salesList.php';
require_once '../lib/salesdate.php';
require_once '../lib/paginator.php';

if (isset($_POST['retrieve_user'])) {
    
    $result='';
    $id_employee =$_SESSION['id'];
    $allUaerSoldItems = SalesList::retrieveSoldItemByEmpId($_SESSION['id']);
    $page=isset($_POST['page'])?(int)$_POST['page']:1;
    $per_page=isset($_POST['per_page']) && $_POST['per_page'] <= count($allUaerSoldItems)?(int)$_POST['per_page']:5;
    $start=($page >1)?($page*$per_page)-$per_page:0;
    $paginationOfUserActivity = Paginator::paginationById('sales_list', $start, $per_page, 'id_employee', $id_employee);
    $total=count($allUaerSoldItems);
    $pages=ceil($total/$per_page);
    $result.='<table class="table table-bordered "id="item_tbl">
                        <thead>
                            <tr>
                                <th>item</th>
                                <th>employee</th>
                                <th>quantity</th>
                                <th>total price</th>
                                <th>more details</th>
                            </tr>
                        </thead>
                        <tbody class="user_activity">  '; 
    if (is_array($paginationOfUserActivity)) {
        foreach ($paginationOfUserActivity as $userActivity):
            //$category=Category::retrieveCategoryById($items['id_category']);
            $user = User::retrieveUserById($userActivity['id_employee']);
            $item = Item::retrieveItemById($userActivity['id_item']);
            $result.=" <tr>
                            <td>" . $item['title'] . "</td>
                            <td>" . $user['name'] . "</td>
                            <td>" . $userActivity['number'] . " " . "</td>
                            <td>" . $userActivity['total_price'] . " EP</td>
                            
                            <td><button class='item_link btn' data-id='".$userActivity['id_item']."'>more details</button></td>
                        </tr>

                    ";
        endforeach;      
    }else {
       $result.="<tr><td colspan='7'>there is no data to show</td></tr>";
    }
        $result.="</tbody>
                    </table>
                    <div class ='pagination_list'>
                        <ul class='pager'>
                 ";
        for($i=1;$i<=$pages;$i++):
            $result.='<li><span class="btn pagination_link " style="border-radius: 15px;background: #fff;width: 15px;height: 17px;" data-id="'.$i.'">'.$i.'</span></li>';
        endfor;
        $result.="</ul></div>";
        echo $result;
}

if(isset($_GET['show_sales_data'])){
    $id_item=$_GET['id_item'];
    $id_employee=$_SESSION['id'];
    $result='';
    $salesDate=SalesDate::retrieveInfoAboutItemFromSalesDateByItemIdAndEmpId($id_item,$id_employee);
    $result.='<table class="table table-bordered "id="item_tbl">
                <thead>
                    <tr>
                        <th>quantity</th>
                        <th>price</th>
                        <th>date of sale</th>
                    </tr>
                </thead>
                <tbody>
        ';
     if(is_array($salesDate)){
         foreach ($salesDate as $date):
             $result.='<tr>
                        <td>'.$date['quantity'].' '.'</td>
                        <td>'.$date['price'].' EP</td>
                        <td>'.$date['sale_date'].'</td>
                       </tr>';
         endforeach;
     }else{
         $result.='<tr><td colspan="3">there is no data to show</td></tr>';
     }
      $result.='</tbody></table>';
      echo $result;
}

if(isset($_POST['all_items'])){
    $page=isset($_POST['page'])?(int)$_POST['page']:1;
    $allItems=  Item::retrieveAllItems();
    $per_page=isset($_POST['per_page']) && $_POST['per_page'] <= count($allItems)?(int)$_POST['per_page']:9;
    $start=($page >1)?($page*$per_page)-$per_page:0;
    $paginationOfItems =Paginator::pagination('item', $start, $per_page);
    $total=count($allItems);
    $pages=ceil($total/$per_page);
    $result='';
    $result='<div id="item_coll">';
    if(is_array($paginationOfItems)){
        foreach ($paginationOfItems as $items):
            $result.='<div class="box">
                <div class="box_head">
                    <h4><a href="?action=show&id='.$items['id'].'">'.$items['title'].'</a></h4>
                </div>
                <div class="box_body">
                    <div class="item_image">
                        <a href="?action=show&id='.$items['id'].'"><img src="../upload/'. $items['image'].'"/></a>
                    </div>
                </div>
                <div class="box_bottom">
                    <div class="item_price">
                        <h5>'.$items['price'].' EP</h5>
                    </div>
                    <div class="item_number">
                        <h5>'.$items['number'].' piece</h5>
                    </div>
                </div>
            </div>
                     ';
        endforeach;
        $result.='</div><div class="pagination_list">
                    <ul class="pager item_pager">
                 ';
        for($i=1; $i<=$pages; $i++):
            $result.='<li><span class="btn pagination_item" style="border-radius: 15px;background: #fff;width: 15px;height: 17px;" data-id="'.$i.'">'.$i.'</span></li>';
        endfor;
        $result.='</ul></div>';
    }else{
        $result.='no items';
    }
    echo $result;
    
}

if(isset($_POST['showSpecificSales'])){
    $start_date=$_POST['start_date'];
    $end_date=$_POST['end_date'];
    $result='';
    $total=0;
    //$result='';
    $result.="<h5><span class='span_report1'>you should have</span>";
    $dateRanges=  SalesDate::retrievePriceBetween2Dates($start_date, $end_date);
    if(is_array($dateRanges)){
        foreach ($dateRanges as $dates):
            $total+=$dates['price'];
        endforeach;
        $result.="<span class='span_report2'>$total EGP</span>";
        $result.="<span class='span_report3'>between $start_date and $end_date </span>";
        $result.="</h5>";
    }else{
        $result.='there is no data';
    }

echo $result;
}
