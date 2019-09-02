<?php
require_once '../lib/user.php';
require_once'../lib/online_user.php';
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


    <table class="table table-bordered "id="user_tbl">
        <thead>
            <tr>
                <th>name</th>
                <th>status</th>
                <th>date</th>
                <th>ip</th>
                <th>browser</th>
                <th>platform</th>
                <th>device name</th>
                <th>device type</th>
            </tr>
        </thead>
        <tbody>
           <?php
           $allOnlineUsers= Online_user::retrieveAllUsersStatus();  
           $xml=  simplexml_load_file('template/data/online_users.xml');  
           if(is_array($allOnlineUsers)){
                for($i=0;$i<count($allOnlineUsers);$i++):
                    //echo $allOnlineUsers[$i]['id_user'];
                    //echo $xml->user[$i]->status;
                 //foreach ($xml->user as $user):
                   $userData=  User::retrieveUserById($xml->user[$i]->id_user);
                   if ($xml->user[$i]->status==0) {
                       $status='offline';
                  }else{
                       $status='online';
                   }
                   if($xml->user[$i]->ip_address == '::1') {
                       $xml->user[$i]->ip_address='127.0.0.1';
                   }
            echo'     
            <tr>
                <td>'.$userData['name'].'</td>
                <td>'.$status.'</td>  
                <td>'.$allOnlineUsers[$i]['login_date'].'</td> 
                <td>'.$xml->user[$i]->ip_address.'</td>
                <td>'.$xml->user[$i]->browser_name.'</td>
                <td>'.$xml->user[$i]->platform.'</td>
                <td>'.$xml->user[$i]->device_name.'</td>    
                <td>'.$xml->user[$i]->device_type.'</td> 
            </tr>
            ';
                //endforeach;
            endfor;
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



