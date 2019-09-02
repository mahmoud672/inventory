     <div id="navbar">
                <div class="container">
                    <div class="row">
                        <div class="span12">
                            <div class="well-large navbar_well">
                                <ul class="navbar nav-tabs nav">
                                    <li><a href="home.php">Home</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <?php
                                        if(!(isset($_SESSION['id']) && isset($_SESSION['name'])&& isset($_SESSION['job_type']))){
                                            echo '<li><a href="login.php">Log In</a></li>';
                                        }else{
                                            if($_SESSION['job_type']==1){
                                                $job_type='Admin';
                                            }elseif($_SESSION['job_type']==2){ 
                                                $job_type='Stock keeper';  
                                            }else{
                                                $job_type='user';
                                            }
                                            echo '<li><a href="logout.php">Log out</a></li>
                                                  <li class="profile_list">
                                                    <a class="list_image" href="profile.php?u='.$_SESSION['id'].'">
                                                        <img src="template/images/user-login.png"title="'.$_SESSION['name'].' profile">
                                                     </a>
                                                   </li> 
                                                   <li class="profile_list"><span>'.$job_type.'</span></li>
                                                 ';
                                        }
                                    ?>
                                    <!--<li><a href="login.php">Log In</a></li>
                                    <li><a href="logout.php">Log out</a></li>--->
                                    
                                </ul> 
                                
                            </div>
                        </div>
                    </div>
                </div>    

            </div>
      <div id="content">
                <div class="container">
                    <div class="row">
                        <div class="span12">
                            <div class="well wellContent">
                               
                                <div id="leftContent">

