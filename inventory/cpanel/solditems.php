<?php
require_once '../lib/user.php';
require_once '../lib/category.php';
require_once '../lib/item.php';
require_once '../lib/salesList.php';
require_once '../lib/salesdate.php';
require_once '../lib/paginator.php';
require_once 'template/header.php';
require_once 'template/navbar.php';

if(!(isset($_SESSION['id']) && isset($_SESSION['name'])&& isset($_SESSION['job_type']))){
     echo '<div id="loginImage"><a href="login.php"title="login"><img src="template/images/Log In.jpg"></a></div>';
}else{
    if($_SESSION['job_type']!=1){
        echo '<div class="message"><h4>sorry you don`t have permession to access </h4></div>';
       
    }else{
        //echo $_SESSION['id'].' '.$_SESSION['name'].' '.$_SESSION['job_type'];
?>
<?php 
if(isset($_GET['action'],$_GET['id_item'],$_GET['id_employee'])){
    $id_employee=$_GET['id_employee'];
    $id_item=$_GET['id_item'];
    switch($_GET['action']):
        case('show'):
            $salesDate=SalesDate::retrieveInfoAboutItemFromSalesDateByItemIdAndEmpId($id_item,$id_employee);
            ?>
            <table class="table table-bordered "id="item_tbl">
        <thead>
            <tr>
                <th>quantity</th>
                <th>price</th>
                <th>date of sale</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
           <?php
           if(is_array($salesDate)){
               foreach ($salesDate as $dateOfItem):
                   echo'     
            <tr>
                <td>'.$dateOfItem['quantity'].' '.'</td>
                <td>'.$dateOfItem['price'].' EP</td>
                <td>'.$dateOfItem['sale_date'].'</td>
                <td><a href="?behavior=edit&date='.$dateOfItem['sale_date'].'&id_item='.$id_item.'">edit</a></td>
                <td><a href="?behavior=delete&date='.$dateOfItem['sale_date'].'&id_item='.$id_item.'">delete</a></td>
            </tr>
            ';
               endforeach;
                 //$category=Category::retrieveCategoryById($items['id_category']);
                 //$user=User::retrieveUserById($salesDate[$id_employee]);
                 //$item=  Item::retrieveItemById($salesDate[$id_item]);
            
           }else{
               ?>
            <tr><td colspan="5">there is no data to show</td></tr>
           <?php
           }
           ?>
        </tbody>
    </table>
<?php
            break;
        DEFAULT:
            echo '<div class="message"><h4>invalid action</h4><div>';
    endswitch;
}
?>

<?php
    if(isset($_GET['behavior'],$_GET['date'],$_GET['id_item'])){
        $behavior=$_GET['behavior'];
        $sale_date=$_GET['date'];
        $id_item=$_GET['id_item'];
        
        if($behavior=='edit'){
            $itemSaleDate=  SalesDate::retrieveInfoAboutItemFromSalesDateBySaleDate($sale_date);
            $item=Item::retrieveItemById($id_item);
            ?>
<div id="form">
     <div class="so_form">
                    <form class="form-horizontal"action="<?= $_SERVER['PHP_SELF'] ?>"method="post">
                        <div class="so_form_title">
                            <h4><?= $item['title'] ?></h4>
                        </div>
                        <div class="so_form_description">
                            <p><?= $item['description']?></p>
                        </div>
                         <div class="so_form_price">
                            <label style="color:#FFF;">total price(sold item):</label>
                            <p><?= $itemSaleDate['price'] ?> EP</p>
                        </div>
                        <div class="so_form_price">
                            <label style="color:#FFF;">sold quantity:</label>
                            <p><?= $itemSaleDate['quantity'] ?> pieces</p>
                        </div>
                        <div class="so_form_quantity">
                            <div class="so_form_price">
                                <label style="color:#FFF;">retrieved quantity:</label>
                                
                            </div>
                            <input type="text"name="retrieved_quantity"placeholder="type here"/>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <input type="hidden"name="sale_date"value="<?= $sale_date ?>"/>
                                <input type="hidden"name="id_item"value="<?= $id_item ?>"/>
                                <input type="submit"name="updateSaleProcess"value="update sale"class="sell_btn"/>
                            </div>
                        </div>
                    </form>
                </div>
</div>
<?php
        }elseif($behavior=='delete'){
            echo '<div class="message"><h4> we are working in developing it</h4></div>';
        }else{
            echo '<div class="message"><h4> invalid action</h4></div>';
        }
    }
    
    if(isset($_POST['updateSaleProcess'])){
        $id_item=$_POST['id_item'];
        $sale_date=$_POST['sale_date'];
        $retrieved_quantity=$_POST['retrieved_quantity'];
        $itemSaleDate=  SalesDate::retrieveInfoAboutItemFromSalesDateBySaleDate($sale_date);
        $item=Item::retrieveItemById($id_item);
            
        if($retrieved_quantity > $itemSaleDate['quantity']){
            echo '<div class="message"><h4>how you sold '.$itemSaleDate['quantity'].' item(s) and you want to retrieve '.$retrieved_quantity.' item(s) be careful !!!</h4></div>';
        }elseif($retrieved_quantity == $itemSaleDate['quantity']){
            echo '<div class="message"><h4>you do nothing </h4></div>';
        }else{
            $itemPriceInSoldDateTbl=$itemSaleDate['price']-$item['price']*$retrieved_quantity;
            $itemQuantityInSoldDateTbl=$itemSaleDate['quantity']-$retrieved_quantity;
            SalesDate::updateInfoAboutItemFromSalesDateBySaleDate($itemQuantityInSoldDateTbl, $itemPriceInSoldDateTbl, $sale_date);
            echo '<div class="message"><h4>new price in sals date table '.$itemPriceInSoldDateTbl.'</h4></div>';
            echo '<div class="message"><h4>new quantity in sals date table '.$itemQuantityInSoldDateTbl.'</h4></div>';
            $newItemNumberInItemTable=$item['number']+$retrieved_quantity;
            Item::updateItemNumber($id_item, $newItemNumberInItemTable);
            echo '<div class="message"><h4>new quantity number of item in sals date table '.$newItemNumberInItemTable.'</h4></div><br/>';
            $id_employee=$itemSaleDate['id_employee'];
            $itemInSalesList=SalesList::retrieveItemFromSalesListByItemIdAndEmpId($id_item, $id_employee);
            $itemPriceInSalesListTbl=$itemInSalesList['total_price']-$item['price']*$retrieved_quantity;
            $itemQuantityInSalesListTbl=$itemInSalesList['number']-$retrieved_quantity;
            SalesList::updateSaledItemNumberTotalPriceInLsitByItemIdAndEmpId($id_item, $id_employee,$itemQuantityInSalesListTbl,$itemPriceInSalesListTbl);
            echo '<div class="message"><h4>new price in sals list table '.$itemPriceInSalesListTbl.'</h4></div>';
            echo '<div class="message"><h4>new quantity in sals list table '.$itemQuantityInSalesListTbl.'</h4></div>';
        }
    }

?>
 <table class="table table-bordered "id="item_tbl">
        <thead>
            <tr>
                <th>item</th>
                <th>employee</th>
                <th>quantity</th>
                <th>total price</th>
                <th>more details</th>
            </tr>
        </thead>
        <tbody>
           <?php
           $allSoldItemss=  SalesList::retrieveAllSoldItems();
           $page=(isset($_GET['page']))?$_GET['page']:1;
           $per_page=isset($_GET['per_page']) && $_GET['per_page']<=count($allSoldItemss)?$_GET['per_page']:5;
           $start=($page > 1)?($page *$per_page)-$per_page:0;
           $total_pages=count($allSoldItemss);
           $pages=ceil($total_pages/$per_page);
           $allSoldItems=  Paginator::pagination('sales_list', $start, $per_page);
           if(is_array($allSoldItems)){
               foreach ($allSoldItems as $soldItems):
                 //$category=Category::retrieveCategoryById($items['id_category']);
                 $user=User::retrieveUserById($soldItems['id_employee']);
                 $item=  Item::retrieveItemById($soldItems['id_item']);
            echo'     
            <tr>
                <td>'.$item['title'].'</td>
                <td>'.$user['name'].'</td>
                <td>'.$soldItems['number'].' '.'</td>
                <td>'.$soldItems['total_price'].' EP</td>
                <td><a href="?action=show&id_item='.$soldItems['id_item'].'&id_employee='.$soldItems['id_employee'].'">more details</a></td>
            </tr>
            ';
               endforeach;
           }else{
               ?>
            <tr><td colspan="7">there is no data to show</td></tr>
           <?php
           }
           ?>
        </tbody>
    </table>
    <div class ="pagination_list">
        <ul class='pager'>
    <?php for($i=1;$i<=$pages;$i++){ ?>
            <li><a href="?page=<?= $i?>"> <?= $i?></a></li>
        
<?php }?>
        </ul>
        
    </div>
<?php
  }
}
require_once 'template/menu.php';
require_once 'template/footer.php';
// 	2018-01-22 18:59:47
?>



