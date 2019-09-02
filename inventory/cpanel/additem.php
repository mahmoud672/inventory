<?php
require_once '../lib/user.php';
require_once '../lib/category.php';
require_once '../lib/item.php';
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
<div id="form">
    <?php
     if(isset($_POST['addItem'])){
        $title=$_POST['title'];
        $description=$_POST['description'];
        $image=$_FILES['image']['name'];
        $image_tmp=$_FILES['image']['tmp_name'];
        $image_type=$_FILES['image']['type'];
        $image_error=$_FILES['image']['error'];
        $image_size=$_FILES['image']['size'];
        $price=$_POST['price'];
        $number=$_POST['number'];
        $id_user=$_SESSION['id'];
        $id_category=$_POST['id_category'];
        if($title==null){
            echo '<div class="message"><h4>please item title must be inserted</h4></div>';
        }elseif (is_numeric($title)) {
             echo '<div class="message"><h4>the value of item title must be letters</h4></div>';
        }elseif ($description==null) {
            echo '<div class="message"><h4>please item description must be inserted</h4></div>';
        }elseif ($image ==null) {
            echo '<div class="message"><h4>please choose an image for this item</h4></div>';
        }elseif (!($image_type =='image/jpeg' || $image_type=='image/png')) { 
            echo '<div class="message"><h4>Please image type must be jpeg or png !</h4></div>';
        }elseif ($image_error) {
            echo '<div class="message"><h4>Please choose another image !</h4></div>';
        }elseif ($price==null) {
            echo '<div class="message"><h4>please item price must be inserted</h4></div>';
        }elseif (!is_numeric($price)) {
            echo '<div class="message"><h4>please item price must be number</h4></div>';
        }elseif ($number==null) {
            echo '<div class="message"><h4>please item number must be inserted</h4></div>';
        }elseif (!is_numeric($number)) {
            echo '<div class="message"><h4>please item number must be number</h4></div>';
        }elseif ($id_category==null) {
            echo '<div class="message"><h4>please choose a category for this product ! </h4></div>';
        }elseif ($id_user==null) {
            echo '<div class="message"><h4>please choose an user for this item !</h4></div>';
        }else{
           $item= new Item($title, $description, $image, $image_tmp, $price, $number, $id_category, $id_user);
           if($item->addItem()){
               echo '<div class="message"><h4>successful addition</h4></div>'; 
           }else{
               echo '<div class="message"><h4>error in addition process</h4></div>';
           }
        }
     }
    ?>
    <form class="form-horizontal"action="<?= $_SERVER['PHP_SELF'] ?>"method="post"enctype="multipart/form-data">
        <div class="control-group">
            <label>item title:</label>
            <div class="controls">
                <input type="text"name="title"placeholder="<title>"/>
            </div>
        </div>
        <div class="control-group">
            <label>item description:</label>
            <div class="controls">
                <textarea name="description" placeholder="write some description......"></textarea>
            </div>
        </div>
         <div class="control-group">
            <label>item image:</label>
            <div class="controls">
                <input type="file"name="image"class="btn"/>
            </div>
        </div>
         <div class="control-group">
            <label>item price:</label>
            <div class="controls">
                <input type="text"name="price"placeholder="<price>"/>
            </div>
        </div>
         <div class="control-group">
            <label>item number:</label>
            <div class="controls">
                <input type="text"name="number"placeholder="<number>"/>
            </div>
        </div>
         <div class="control-group">
            <label>category:</label>
            <div class="controls">
                <select class="select"name="id_category">    
                    <option>--select an category--</option>
                    <?php
                        $allCategories=  Category::retrieveAllCategories();
                        if(is_array($allCategories)){
                            foreach ($allCategories as $categories):
                                echo '<option value="'.$categories['id'].'">'.$categories['name'].'</option>';
                            endforeach;
                        }else{
                            echo '<option>there is no data</option>';
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="control-group">

            <div class="controls">
                <input type="submit"name="addItem"value="add item"/>
            </div>
        </div>
    </form>
</div>

<?php
  }
}
require_once 'template/menu.php';
require_once 'template/footer.php';
?>



