</div>
<div id="rightContent">
    
    <div id="menu">
        <div id="menuHeader">
            <h2>welcome</h2>
        </div>
        <?php
        if(@$_SESSION['job_type']==1){
 
        
    ?>
        <div class="menuList">
            <div class="listHead">
                <h3>user</h3>
            </div>
            <div class="listContent">
                <ul>
                    <li><a href="adduser.php">add user</a></li>
                    <li><a href="edituser.php">edit user</a></li>
                </ul>
            </div>
        </div>
        <div class="menuList">
            <div class="listHead">
                <h3>category</h3>
            </div>
            <div class="listContent">
                <ul>
                    <li><a href="addcategory.php">add category</a></li>
                    <li><a href="editcategory.php">edit category</a></li>
                </ul>
            </div>
        </div>
        <div class="menuList">
            <div class="listHead">
                <h3>item</h3>
            </div>
            <div class="listContent">
                <ul>
                    <li><a href="addItem.php">add item</a></li>
                    <li><a href="editItem.php">edit item</a></li>
                </ul>
            </div>
        </div>
        <div class="menuList">
            <div class="listHead">
                <h3>sales list</h3>
            </div>
            <div class="listContent">
                <ul>
                    <li><a href="solditems.php">item that sold</a></li>
                </ul>
            </div>
            
        </div>
         <div class="menuList">
            <div class="listHead">
                <h3>logged in users</h3>
            </div>
            <div class="listContent">
                <ul>
                    <li><a href="loggedinusers.php">logged in users</a></li>
                </ul>
            </div>
            
        </div>
        <?php
        }elseif(@$_SESSION['job_type']==2){
         ?>
        <div class="menuList">
            <div class="listHead">
                <h3>items</h3>
            </div>
            <div class="listContent">
                <ul>
                    <li><a href="allitems.php">all items</a></li>
                   
                </ul>
            </div>
            
        </div>
         <div class="menuList">
            <div class="listHead">
                <h3>categories</h3>
            </div>
            <div class="listContent">
                <ul>
                    
                    <li><a href="allcategories.php">all categories</a></li>
                </ul>
            </div>
            
        </div>
        <div class="menuList">
            <div class="listHead">
                <h3>user activity</h3>
            </div>
            <div class="listContent">
                <ul>
                    
                    <li><a href="useractivity.php">user activity</a></li>
                </ul>
            </div>
            
        </div>
        <?php
        }else{
            echo '<div class="message message_menu"><h4 style="color:#000;">please log in</h4></div>';
        }
        ?>

    </div>
    
</div>
</div>
</div>
</div>
</div> 
</div>    
