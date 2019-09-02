<?php
require_once '../lib/category.php';
require_once '../lib/item.php';
require_once '../lib/salesdate.php';
require_once '../lib/online_user.php';
require_once 'template/header.php';
require_once 'template/navbar.php';

if(!(isset($_SESSION['id']) && isset($_SESSION['name'])&& isset($_SESSION['job_type']))){
     echo '<div id="loginImage"><a href="login.php"title="login"><img src="template/images/Log In.jpg"></a></div>';
}else{
    if($_SESSION['job_type']!=1){
        echo '<div class="message"><h4>sorry you don`t have permession to access </h4></div>';
       
    }else{
?>
<div id="statistics">
    <?php 
    $allCategories=  Category::retrieveAllCategories();
    $allOnlineUsers=  Online_user::retrieveAllUsersStatus();
    $allItems=  Item::retrieveAllItems();
    $tQI=0;
    foreach ($allItems as $items):
        $tQI+=$items['number'];
    endforeach;
    
    $sales_date= SalesDate::retrieveAllInfoAboutItemsFromSalesDate();
    ?>
    <div class="statistics_box">
         <div class="statistics_box_head">
            <h4>categories</h4>
        </div>
        <div class="statistics_box_body">
            <div class="statistics_box_body_image">
                <img src="template/images/Categories.jpg"/>
            </div>
        </div>
        <div class="statistics_box_bottom">
            <h5><?=count($allCategories) ?> categories</h5>
        </div>
    </div>
     <div class="statistics_box">
         <div class="statistics_box_head">
            <h4>items</h4>
        </div>
        <div class="statistics_box_body">
            <div class="statistics_box_body_image">
                <img src="template/images/products1.png"/>
            </div>
        </div>
        <div class="statistics_box_bottom">
            <h5><?= count($allItems)?> items with quantity of <?= $tQI ?></h5>
        </div>
    </div>
    <div class="statistics_box">
         <div class="statistics_box_head">
            <h4>online</h4>
        </div>
        <div class="statistics_box_body">
            <div class="statistics_box_body_image">
                <img src="template/images/user.jpg"/>
            </div>
        </div>
        <div class="statistics_box_bottom">
            <h5><?= count($allOnlineUsers)?> person(s)</h5>
        </div>
    </div>
    <div class="statistics_box">
         <div class="statistics_box_head">
            <h4>sales report</h4>
        </div>
        <div class="statistics_box_body">
            <div class="statistics_box_body_image">
                <img src="template/images/Money.jpg"/>  
                <select name="start_date" class="start_date">
                    <option value="">--------- select start from ----------</option>
                     <?php
                    if(is_array($sales_date)){
                        foreach ($sales_date as $date):
                            ?>
                    <option  class="start_dates" value="<?= $date['sale_date'] ?>"><?= $date['sale_date'] ?></option>
                    <?php
                        endforeach;
                    }else{
                        ?>
                     <option>there is no date</option>
                    <?php
                    }
                ?> 
                </select>
                <select name="end_date" class="end_date">
                    <option value="">---------- select end to ----------</option>
                    <?php
                    if(is_array($sales_date)){
                        $sales_amount=0; 
                        foreach ($sales_date as $date):
                            $sales_amount+= $date['price'];
                            ?>
                    <option class="end_dates" value="<?= $date['sale_date'] ?>"><?= $date['sale_date'] ?></option>
                    <?php
                        endforeach;
                    }else{
                        ?>
                     <option>there is no date</option>
                    <?php
                    }
                ?> 
                </select>
            </div>
        </div>
        <div class="statistics_box_bottom">
            <h5><?= $sales_amount ?> EGP</h5>
        </div>
    </div>
</div>
<div class="sales_report">
    <h5>
        <span class="span_report1">you should have</span><span class="span_report2"> <?=$sales_amount?> EGP  </span><span class="span_report3"> for this time</span>
   </h5>
</div>
<?php
    }
}
require_once 'template/menu.php';
require_once 'template/footer.php';
?>

