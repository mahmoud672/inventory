<?php
require_once '../lib/user.php';
require_once '../lib/category.php';
require_once '../lib/item.php';
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
    if(isset($_GET['action'],$_GET['id'])){
        $action=$_GET['action'];
        $id=$_GET['id'];
        switch($action){
            case'delete':
                if(Item::deleteItemById($id)){
                    echo '<div class="message"><h4>successful deleting</h4><div>';
                }else{
                    echo 'error in deleting process';
                }
                break;
            case'edit':
                $item=Item::retrieveItemById($id);
                ?>
                <div id="form">
                    <form class="form-horizontal"action="<?= $_SERVER['PHP_SELF'] ?>"method="post"enctype="multipart/form-data">
                        <div class="control-group">
                            <label>item title:</label>
                            <div class="controls">
                                <input type="text"name="title"value="<?= $item['title'] ?>"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label>item description:</label>
                            <div class="controls">
                                <textarea name="description" placeholder="write some description......">
                                    <?= $item['description'] ?>
                                </textarea>
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
                                <input type="text"name="price"value="<?= $item['price'] ?>"/>
                            </div>
                        </div>
                         <div class="control-group">
                            <label>item number:</label>
                            <div class="controls">
                                <input type="text"name="number"value="<?= $item['number'] ?>"/>
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
                                                if($categories['id']==$item['id_category']){
                                                     echo '<option value="'.$categories['id'].'"selected="selected">'.$categories['name'].'</option>';
                                                }else{
                                                    
                                                  echo '<option value="'.$categories['id'].'">'.$categories['name'].'</option>';
                                                }
                                                
                                            endforeach;
                                        }else{
                                            echo '<option>there is no data</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
<!--                         <div class="control-group">
                            <label>employee:</label>
                            <div class="controls">
                                <select class="select"name="id_user">   
                                    <option>--select an employee--</option>
                                    <?php
//                                        $allEmployees= User::retrieveAllUsers();
//                                        if(is_array($allEmployees)){
//                                            foreach ($allEmployees as $employees):
//                                                if($item['id_user']==$employees['id']){
//                                                    echo '<option value="'.$employees['id'].'"selected="selected">'.$employees['name'].'</option>';
//                                                }else{
//                                                   echo '<option value="'.$employees['id'].'">'.$employees['name'].'</option>'; 
//                                                }   
//                                            endforeach;
//                                        }else{
//                                            echo '<option>there is no data</option>';
//                                        }
                                    ?>
                                </select>
                            </div>
                        </div>-->
                        <div class="control-group">

                            <div class="controls">
                                <input type="hidden"name="id"value="<?= $id ?>"/>
                                <input type="submit"name="updateItem"value="update item"/>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                break;
            default:
                echo 'invalid action';
                
        }
    }
    if(isset($_POST['updateItem'])){
        $id=$_POST['id']; 
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
        }else{
           $item= new Item($title, $description, $image, $image_tmp, $price, $number, $id_category, $id_user, $id);
           if($item->updateItem()){
               echo '<div class="message"><h4>successful updating</h4></div>'; 
           }else{
               echo '<div class="message"><h4>error in updating process</h4></div>';
           }
        }
    }
?>
 <table class="table table-bordered "id="item_tbl">
        <thead>
            <tr>
                <th>title</th>
                <th>description</th>
                <th>image</th>
                <th>price</th>
                <th>number</th>
                <th>category</th>
                <th>employee</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
           <?php
           $items=Item::retrieveAllItems();
           //
           $page=  isset($_GET['page'])?(int)$_GET['page']:1;
           $per_page=isset($_GET['per_page']) && $_GET['per_page']<= count($items)?(int)$_GET['per_page']:5;
           $start=($page >1)?($page *$per_page)-$per_page:0;
           $allItems=  Paginator::pagination('item', $start, $per_page);
           //$total=  Paginator::calcTotal('item', $start, $per_page);
           $total=count($items);
           if($per_page==0){
               echo '<div class="message"><h4>not acceptable value</h4></div>';
               $per_page=5;
           }
           $pages=  ceil($total/$per_page);
           //        
           if(is_array($allItems)){
               foreach ($allItems as $items):
                 $category=Category::retrieveCategoryById($items['id_category']);
                 $user=User::retrieveUserById($items['id_user']);
            echo'     
            <tr>
                <td>'.$items['title'].'</td>
                <td>'.$items['description'].'</td>
                <td><img src="../upload/'.$items['image'].'"></td>
                <td>'.$items['price'].' '.'EP</td>
                <td>'.$items['number'].'</td>
                <td>'.$category['name'].'</td>
                <td>'.$user['name'].'</td>
                <td><a href="?action=edit&id='.$items['id'].'">Edit</a></td>
                <td><a href="?action=delete&id='.$items['id'].'">Delete</a></td>   
            </tr>
            ';
               endforeach;
           }else{
               ?>
            <tr><td colspan="5">there is no data to show</td></tr>
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
?>



