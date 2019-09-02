<?php
require_once '../lib/user.php';
require_once '../lib/item.php';
require_once '../lib/category.php';
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
if(isset($_GET['behavior'],$_GET['id'])){
    $id_category=$_GET['id'];
    $behavior=$_GET['behavior'];
    switch($behavior):
        case('seeItems'):
            $allCategoryItems=  Item::retrieveItemsByIdCategory($id_category);
            if(is_array($allCategoryItems)){
                foreach ($allCategoryItems as $categoryItems):
                    ?>
                    
                       <div class="box">
                            <div class="box_head">
                                <h4><a href="?action=show&id=<?= $categoryItems['id'] ?>"><?= $categoryItems['title'] ?></a></h4>
                            </div>
                            <div class="box_body">
                                <div class="item_image">
                                    <a href="?action=show&id=<?= $categoryItems['id'] ?>"><img src="../upload/<?= $categoryItems['image'] ?>"/></a>
                                </div>
                            </div>
                            <div class="box_bottom">
                                <div class="item_price">
                                    <h5><?= $categoryItems['price'] ?> EP</h5>
                                </div>
                                <div class="item_number">
                                    <h5><?= $categoryItems['number'] ?> piece</h5>
                                </div>
                            </div>
                        </div>
                    
                    <?php
                endforeach;
            }else{
                echo'there is no item';
            }
            break;
        default:
            echo '<div class="message"><h4>invalid action</h4></div>';
    endswitch;
}
if(isset($_GET['action'],$_GET['id'])){
        $action=$_GET['action'];
        $id=$_GET['id'];
        switch($action):
            case('show'):
                $item=Item::retrieveItemById($id);
                ?>
                <div id="form" class="so_form">
                    <form class="form-horizontal"action="<?= $_SERVER['PHP_SELF'] ?>"method="post">
                        <div class="so_form_title">
                            <h4><?= $item['title'] ?></h4>
                        </div>
                        <div class="so_form_description">
                            <p><?= $item['description']?></p>
                        </div>
                         <div class="so_form_price">
                            <label style="color:#FFF;">item price:</label>
                            <p><?= $item['price'] ?> EP</p>
                        </div>
                        <div class="so_form_price">
                            <label style="color:#FFF;">item number:</label>
                            <p><?= $item['number'] ?> pieces</p>
                        </div>
                        <div class="so_form_quantity">
                            <div class="so_form_price">
                                <label style="color:#FFF;">item quantity:</label>
                                
                            </div>
                            <input type="text"name="quantity"placeholder="type here"/>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <input type="hidden"name="id"value="<?= $id ?>"/>
                                <input type="submit"name="sellItem"value="sell item"class="sell_btn"/>
                            </div>
                        </div>
                    </form>
                </div>
<?php
                break;
            default:
                echo '<div class="message"><h4>invalid action</h4></div>';
        endswitch;
    }
    
    if(isset($_POST['sellItem'])){
        $id=$_POST['id'];
        $quantity=$_POST['quantity'];
        $item=Item::retrieveItemById($id);
        $price=$item['price'];
        $item_number=$item['number'];
        $id_employee=$_SESSION['id'];
        //echo $item['price'].' '.$item['number'].' '.$quanyity;
        if($quantity==null){
            echo '<div class="message"><h4> please your required quantity of that item must be insrted </h4></div>';
        }elseif(!is_numeric($quantity)){
            echo '<div class="message"><h4> please the quantity must be number </h4></div>';
        }elseif($quantity < 0 ){
            echo '<div class="message"><h4> sorry negative numbers are refused </h4></div>';
        }elseif($quantity == 0 ){
            echo '<div class="message"><h4> sorry you didn`t insert any quantity</h4></div>';
        }elseif($quantity >$item_number ){
            echo '<div class="message"><h4> the quantity must be smaller than or equal to '.$item_number.' at this time  </h4></div>';
        }else{
            $totalPrice=$price*$quantity;
            $salesList=new SalesList($id, $id_employee, $quantity, $totalPrice);
            $itemTotalPrice=  SalesList::retrieveItemFromSalesListByItemIdAndEmpId($id, $id_employee);
            $salesDate=new SalesDate($id, $id_employee, $quantity, $totalPrice);
            if($itemTotalPrice ==null){
                $salesList=new SalesList($id, $id_employee, $quantity,$totalPrice);
                $salesList->addItemToSalesList();
                
                $salesDate->addInfoToSalesDate();
                $newNumber=$item_number-$quantity;
                Item::updateItemNumber($id, $newNumber);
                echo'<div class="message"><h4> the cost is '.$totalPrice.' EP </h4></div>';
            }else{
                $new_total_price= $itemTotalPrice['total_price'] + $totalPrice;
                $new_item_number= $itemTotalPrice['number'] + $quantity;
                SalesList::updateSaledItemNumberTotalPriceInLsitByItemIdAndEmpId($id, $id_employee,$new_item_number,$new_total_price);
                $salesDate->addInfoToSalesDate();
                $newNumber=$item_number-$quantity;
                Item::updateItemNumber($id, $newNumber);
                echo'<div class="message"><h4> the cost is '. $totalPrice.' EP </h4></div>';
            }
            //$totalPriceItemSalesList= SalesList::updateSaledItemTotalPriceInLsitByItemIdAndEmpId($id_item, $id_employee, $new_total_price);
            
        }
    }
?>


 <table class="table table-bordered "id="user_tbl">
        <thead>
            <tr>
                <th>name</th>
                <th>the number type of items</th>
                <th>see items</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $allCategories=  Category::retrieveAllCategories();
            
            if(is_array($allCategories)){
                foreach ($allCategories as $categories){
                    $itemOfCategory=Item::retrievecountOfCategoryFromItemByIdCategory($categories['id']);
                    echo '<tr>
                            <td>'.$categories['name'].'</td>
                            <td style="text-align:center;">'.count($itemOfCategory).'</td>
                            <td style="text-align:center;"><a href="?behavior=seeItems&id='.$categories['id'].'">see items</a></td>    
                        </tr>';
                }
            }else{
                echo '<tr><td colspan="3"></td></tr>';
            }
            ?>
        </tbody>
 </table>
<?php
 }
}
require_once 'template/menu.php';
require_once 'template/footer.php';
?>



