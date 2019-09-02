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

<div id="form">
    <?php
        if(isset($_POST['addCategory'])){
            $name=$_POST['name'];
            if($name==null){
                echo 'please category name must be inserted';
            }elseif(is_numeric($name)){
                echo 'please name must be letters';
            }else{
                $category= new Category($name);
                if($category->addCategory()){
                    echo 'successful addition ';
                }else{
                    echo 'error in addition processing';
                }
            }
        }
    ?>
    <form class="form-horizontal"action="<?= $_SERVER['PHP_SELF'] ?>"method="post">
        <div class="control-group">
            <label>category name:</label>
            <div class="controls">
                <input type="text"name="name"placeholder="<category name>"/>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <input type="submit"name="addCategory"value="add category"/>
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



