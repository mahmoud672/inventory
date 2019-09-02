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
<!--
<?php
/* if(isset($_POST['addUser'])){
  
  } */
?>
   -->
<?php
if(isset($_GET['action'],$_GET['id'])){
    $action=$_GET['action'];
    $id=$_GET['id'];
    switch ($action):
        case('delete'):
            if(User::deleteUserById($id)){
                echo 'successful deleting';
            }else{
                echo 'error in deleting process';
            }
            break;
        case('edit'):
            $user=User::retrieveUserById($id);
            if(is_array($user)){
                ?>
<div id="form">
   <form class="form-horizontal"action="<?= $_SERVER['PHP_SELF'] ?>"method="post">
        <div class="control-group">
            <label>name:</label>
            <div class="controls">
                <input type="text"name="name"value="<?= $user['name']?>"/>
            </div>
        </div>
        <div class="control-group">
            <label>E-mail:</label>
            <div class="controls">
                <input type="text"name="email"value="<?= $user['email']?>"/>
            </div>
        </div>
         <div class="control-group">
            <label>Password:</label>
            <div class="controls">
                <input type="password"name="password"value="<?= $user['password']?>"/>
            </div>
        </div>
         <div class="control-group">
            <label>Job type:</label>
            <div class="controls">
                <select class="select"name="job_type">
                    <?php
                        if($user['job_type']==1){
                   
                            echo '<option value="'.$user['job_type'].'"selected="selected">Admin</option>
                                  <option value="2">Stock Keeper</option>
                                ';
                    
                        }elseif($user['job_type']==2){
                            echo '<option value="1">Admin</option>
                                  <option value="'.$user['job_type'].'"selected="selected">Stock Keeper</option>
                                ';
                        }else{
                            echo '<option value="1">Admin</option>
                                  <option value="2">Stock Keeper</option>
                                ';
                        }
                    ?>
                   
                </select>
            </div>
        </div>
        <div class="control-group">

            <div class="controls"> 
                <input type="hidden"name="id"value="<?= $id ?>"/>
                <input type="submit"name="updateUser"value="update user"/>
            </div>
        </div>
    </form>
</div>  
<?php
            }else{
                echo 'there is no data';
            }
            break;
        default:
            echo 'invalid action';
    endswitch;
}
if(isset($_POST['updateUser'])){
    $id=$_POST['id'];
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
      $admin= new User($name, $email, $password, $job_type, $id);
      if($admin->updateUser()){
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
                <th>email</th>
                <th>password</th>
                <th>job type</th>
                <th>edit</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
           <?php
           $allUsers=  User::retrieveAllUsers();
           if(is_array($allUsers)){
               foreach ($allUsers as $users):
                   if($users['job_type']==1){
                      $users['job_type']='admin'; 
                   }elseif ($users['job_type']==2) {
                       $users['job_type']='store keeper';
                   }else{
                       $users['job_type']='user';
                   }
            echo'     
            <tr>
                <td>'.$users['name'].'</td>
                <td>'.$users['email'].'</td>
                <td>'.$users['password'].'</td>
                <td>'.$users['job_type'].'</td>
                <td><a href="?action=edit&id='.$users['id'].'">Edit</a></td>
                <td><a href="?action=delete&id='.$users['id'].'">Delete</a></td>   
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


<?php
  }
}
require_once 'template/menu.php';
require_once 'template/footer.php';
?>



