<?php
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
   
<?php
    if(isset($_GET['action'],$_GET['id'])){
        $action=$_GET['action'];
        $id=$_GET['id'];
        
        switch($action):
            case('delete'):
                if(Category::deleteCategoryById($id)){
                    echo 'successful deleting';
                }else{
                    echo 'error in  deleting process';
                }
                break;
            case('edit'):
                $category=  Category::retrieveCategoryById($id);
                ?>
                <div id="form">
                    <form class="form-horizontal"action="<?= $_SERVER['PHP_SELF'] ?>"method="post">
                        <div class="control-group">
                            <label>category name:</label>
                            <div class="controls">
                                <input type="text"name="name"value="<?= $category['name']?>"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <input type="hidden"name="id"value="<?= $id ?>"/>
                                <input type="submit"name="updateCategory"value="update category"/>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                break;
            default:
                echo 'invalid action';
        endswitch;
    }
    
    if(isset($_POST['updateCategory'])){
            $id=$_POST['id'];
            $name=$_POST['name'];
            if($name==null){
                echo 'please category name must be inserted';
            }elseif(is_numeric($name)){
                echo 'please name must be letters';
            }else{
                $category= new Category($name, $id);
                if($category->updateCategory()){
                    echo 'successful updating ';
                }else{
                    echo 'error in updating processing';
                }
            }
        }
?>
 <table class="table table-bordered "id="user_tbl">
        <thead>
            <tr>
                <th>name</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
           <?php
           $allCategories= Category::retrieveAllCategories();
           if(is_array($allCategories)){
               foreach ($allCategories as $categories):
            echo'     
            <tr>
                <td>'.$categories['name'].'</td>
                <td><a href="?action=edit&id='.$categories['id'].'">Edit</a></td>
                <td><a href="?action=delete&id='.$categories['id'].'">Delete</a></td>   
            </tr>
            ';
               endforeach;
           }else{
               ?>
            <tr><td colspan="3">there is no data to show</td></tr>
           <?php
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



