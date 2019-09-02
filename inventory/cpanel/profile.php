<?php
require_once '../lib/user.php';
require_once '../lib/category.php';
require_once '../lib/item.php';
require_once 'template/header.php';
require_once 'template/navbar.php';

if(!(isset($_SESSION['id']) && isset($_SESSION['name'])&& isset($_SESSION['job_type']))){
     echo '<div id="loginImage"><a href="login.php"title="login"><img src="template/images/Log In.jpg"/></a></div>';
}else{
    if(!($_SESSION['job_type']==1 || $_SESSION['job_type']==2)){
        echo '<div class="message"><h4>sorry you don’t have permession to access </h4></div>';
       
    }else{
        //echo $_SESSION['id'].' '.$_SESSION['name'].' '.$_SESSION['job_type'];
?>
<div id="form">
    <?php
    if(isset($_GET['u'])){
        $id=$_GET['u'];
        if($_SESSION['id']!=$id){
            echo '<div class="message"><h4>sorry you don’t have permission</h4></div>';
            echo '<div class="scam_image"><img src="template/images/important notice.jpg"></div>';
        }else{
            $user=User::retrieveUserById($_SESSION['id']);
            if($user['job_type']==1){
                $user['job_type']='admin';
            }elseif ($user['job_type']==2) {
                    $user['job_type']='stock keeper';
                }else{
                    $usre['job_type']='user';
                }
    ?>
    <form class="form-horizontal"action="<?= $_SERVER['PHP_SELF'] ?>"method="post">
        <div class="control-group">
            <label>name:</label>
            <div class="controls">
                <input type="text"name="name"value="<?= $user['name'] ?>"/>
            </div>
        </div>
        <div class="control-group">
            <label>E-mail:</label>
            <div class="controls">
                <input type="text"name="email"value="<?= $user['email'] ?>"/>
            </div>
        </div>
         <div class="control-group">
            <label>Password:</label>
            <div class="controls">
                <input type="password"name="password"value="<?= $user['password'] ?>"/>
            </div>
        </div>
         <div class="control-group">
            <label>Job type:</label>
            <div class="controls">
                <input type="text"name="job_type"value="<?= $user['job_type'] ?>"disabled="disabled">
            </div>
        </div>
        <div class="control-group">

            <div class="controls">
                <input type="submit"name="updateUser"value="update user"/>
            </div>
        </div>
    </form>

<!--</div>-->
<?php
    }
  }else{
      echo '<div class="message"><h4>you want to see your profile<a style="color:#FFF;"href="profile.php?u='.$_SESSION['id'].'"> your profile </a></h4></div>';
  }
    if(isset($_POST['updateUser'])){
            $id=$_SESSION['id'];
            $name=$_POST['name'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $job_type= $_SESSION['job_type'];
            if($name==null){
                echo '<div class="message"><h4>please name must be inserted</h4></div>';
            }elseif(is_numeric($name)){
                echo '<div class="message"><h4>please name must be letters</h4></div>';
            }elseif($email == null){
                echo '<div class="message"><h4>please email must be inserted</h4></div>';
            }elseif(is_numeric($email)){
                echo '<div class="message"><h4>please email must be letters</h4></div>';
            }elseif($password==null){
                 echo '<div class="message"><h4>please password must be inserted</h4></div>';
            }elseif(strlen($password)<8){
                echo '<div class="message"><h4>please password must be at least 8 columns</h4></div>';
            }elseif($job_type==null){
                echo '<div class="message"><h4>please job type must be selected</h4></div>';
            }elseif ($job_type <1 || $job_type >2){
                echo '<div class="message"><h4>invalid value for job type</h4></div>';
            }else{
                $user= new User($name, $email, $password, $job_type,$id);
                if($user->updateUser()){
                    echo '<div class="message"><h4>successful updating</h4></div> ';
                }else{
                    echo '<div class="message"><h4>error in updating processing</h4></div>';
                }
            }
        }
  }
  echo '</div>';
}

require_once 'template/menu.php';
require_once 'template/footer.php';
?>



