<?php
require_once '../lib/user.php';
require_once '../lib/category.php';
require_once '../lib/item.php';
require_once 'template/header.php';
require_once 'template/navbar.php';
?>
<div id="form">
    <?php
        if(isset($_POST['logIn'])){
            $name=$_POST['name'];
            $password=$_POST['password'];
            if($name==null){
                echo '<div class="message"><h4>please name must be inserted</h4></div>';
            }elseif(is_numeric($name)){
                echo '<div class="message"><h4>please name must be letters</h4></div>';
            }elseif($password==null){
                 echo '<div class="message"><h4>please password must be inserted</h4></div>';
            }elseif(strlen($password)<8){
                echo '<div class="message"><h4>please password must be at least 8 columns</h4></div>';
            }else{
                User::logIn($name, $password);
                
            }
        }
    ?>
    <form class="form-horizontal"action="<?= $_SERVER['PHP_SELF'] ?>"method="post">
        <div class="control-group">
            <label>user name:</label>
            <div class="controls">
                <input type="text"name="name"placeholder="<name>"/>
            </div>
        </div>
         <div class="control-group">
            <label>Password:</label>
            <div class="controls">
                <input type="password"name="password"placeholder="<password>"/>
            </div>
        </div>
        <div class="control-group">

            <div class="controls">
                <input type="submit"name="logIn"value="log in"/>
            </div>
        </div>
    </form>
</div>

<?php
require_once 'template/menu.php';
require_once 'template/footer.php';
?>



