<?php
require_once '../lib/user.php';
require_once '../lib/category.php';
require_once '../lib/item.php';
require_once '../lib/salesList.php';
require_once '../lib/salesdate.php';
require_once 'template/header.php';
require_once 'template/navbar.php';

if(!(isset($_SESSION['id']) && isset($_SESSION['name'])&& isset($_SESSION['job_type']))){
     echo '<div id="loginImage"><a href="login.php"title="login"><img src="template/images/Log In.jpg"></a></div>';
}else{
    if($_SESSION['job_type']!=2){
        echo '<div class="message"><h4>sorry you don`t have permession to access </h4></div>';
       
    }else{
        //echo $_SESSION['id'].' '.$_SESSION['name'].' '.$_SESSION['job_type'];
?>
<?php 
if(isset($_GET['action'],$_GET['id_item'],$_GET['id_employee'])){
    $id_employee=$_GET['id_employee'];
    $id_item=$_GET['id_item'];
    if($id_employee != $_SESSION['id']){
        echo '<div class="message"><h4>sorry you don’t have permission</h4></div>';
        //echo '<div class="scam_image"><img src="template/images/important notice.jpg"></div>';
    }else{
    switch($_GET['action']):
        case('show'):
            $salesDate=SalesDate::retrieveInfoAboutItemFromSalesDateByItemIdAndEmpId($id_item,$_SESSION['id']);
            ?>
            <table class="table table-bordered "id="item_tbl">
        <thead>
            <tr>
                <th>quantity</th>
                <th>price</th>
                <th>date of sale</th>
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
}
?> 
<div id="page_content">
<!-- <table class="table table-bordered "id="item_tbl">
        <thead>
            <tr>
                <th>item</th>
                <th>employee</th>
                <th>quantity</th>
                <th>total price</th>
                <th>more details</th>
            </tr>
        </thead>
        <tbody class="user_activity">-->
           <?php
          $allUaerSoldItems=  SalesList::retrieveSoldItemByEmpId($_SESSION['id']);
         /*  if(is_array($allUaerSoldItems)){
               foreach ($allUaerSoldItems as $userSoldItems):
                 //$category=Category::retrieveCategoryById($items['id_category']);
                 $user=User::retrieveUserById($userSoldItems['id_employee']);
                 $item=  Item::retrieveItemById($userSoldItems['id_item']);
            echo'     
            <tr>
                <td>'.$item['title'].'</td>
                <td>'.$user['name'].'</td>
                <td>'.$userSoldItems['number'].' '.'</td>
                <td>'.$userSoldItems['total_price'].' EP</td>
                <td><a href="?action=show&id_item='.$userSoldItems['id_item'].'&id_employee='.$userSoldItems['id_employee'].'">more details</a></td>
            </tr>
            ';
               endforeach;
           }else{
               ?>
            <tr><td colspan="7">there is no data to show</td></tr>
           <?php
           }*/
           ?>
<!--        </tbody>
    </table>-->

<!--number of rows <input style="width:50px;"type="number"class="num_rows"value="5">--->
<input style="width:50px;"type="hidden"name="id_employee"value="<?= $_SESSION['id']?>"class="id_employee">
    <!---<div class ="pagination_list">
        <ul class='pager'>-->
    <?php 
//   $total=count($allUaerSoldItems);
//    $per_page=5;
//    $pages=ceil($total/$per_page);
//    for($i=1;$i<=$pages;$i++){ 
        ?>
<!--            <li><button class="btn" data-id="<?= $i?>"><?= $i?></button></li>-->
        
<?php //}?>
<!--        </ul>
        
    </div>-->
<!------->
</div>
<?php
  }
}

require_once 'template/menu.php';
require_once 'template/footer.php';
?>



