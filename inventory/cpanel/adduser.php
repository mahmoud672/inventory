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
        if(isset($_POST['addUser'])){
            $name=$_POST['name'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $job_type=$_POST['job_type'];
            if($name==null){
                echo 'please name must be inserted';
            }elseif(is_numeric($name)){
                echo 'please name must be letters';
            }elseif($email == null){
                echo 'please email must be inserted';
            }elseif(is_numeric($email)){
                echo 'please email must be letters';
            }elseif($password==null){
                 echo 'please password must be inserted';
            }elseif(strlen($password)<8){
                echo 'please password must be at least 8 columns';
            }elseif($job_type==null){
                echo 'please job type must be selected';
            }elseif ($job_type <1 || $job_type >2){
                echo 'invalid value for job type';
            }else{
                $user= new User($name, $email, $password, $job_type);
                if($user->addUser()){
                    echo 'successful addition ';
                }else{
                    echo 'error in addition processing';
                }
            }
        }
    ?>
    <form class="form-horizontal"action="<?= $_SERVER['PHP_SELF'] ?>"method="post">
        <div class="control-group">
            <label>name:</label>
            <div class="controls">
                <input type="text"name="name"placeholder="<name>"/>
            </div>
        </div>
        <div class="control-group">
            <label>E-mail:</label>
            <div class="controls">
                <input type="text"name="email"placeholder="<E-mail>"/>
            </div>
        </div>
         <div class="control-group">
            <label>Password:</label>
            <div class="controls">
                <input type="password"name="password"placeholder="<password>"/>
            </div>
        </div>
         <div class="control-group">
            <label>Job type:</label>
            <div class="controls">
                <select class="select"name="job_type">
                    <option></option>
                    <option value="1">Admin</option>
                    <option value="2">Stock Keeper</option>
                </select>
            </div>
        </div>
        <div class="control-group">

            <div class="controls">
                <input type="submit"name="addUser"value="add user"/>
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



