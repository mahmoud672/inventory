 
<div id="footer">
                <div class="container">
                    <div class="row">
                        <div clas="span12">
                            <div class="well-large footer_well_large">
                                <div class="info_block">
                                    <div class="info_block_header">
                                        <h4>categories</h4>
                                    </div>
                                    <div class="info_block_body">                                      
                                        <ul>
                                             <?php 
                                            $allCategories=Category::retrieveAllCategories();
                                            if(is_array($allCategories)){
                                                foreach ($allCategories as $categories){
                                                    echo ' <li>'.$categories['name'].'</li>';
                                                }
                                            }else{
                                                echo '<li>there is no category</li>';
                                            }
                                        ?>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="info_block">
                                    <div class="info_block_header">
                                        <h4>latest items</h4>
                                    </div>
                                    <div class="info_block_body">
                                        <ul>
                                            <?php
                                                $allLastItems=Item::retrieveLastItems();
                                                if(is_array($allLastItems)){
                                                    foreach ($allLastItems as $lastItems):
                                                        echo '<li><a href="#">'.$lastItems['title'].'</a></li>';
                                                    endforeach;
                                                }else{
                                                    echo '<li><a href="#">there is no item</a></li>';
                                                }
                                            ?>
                                           
                                        </ul>
                                    </div>
                                </div>
                                <div class="info_block">
                                    <div class="info_block_header"style="border-bottom:1px solid #000;">
                                        <h4 style="color:#000;text-transform:uppercase;text-shadow: 2px 2px 0px #FFF;">sponsor</h4>
                                    </div>
                                    <div class="info_block_body">
                                        <ul>
                                            <li><img  style="width:200px;height:135px;background:#FFF;"src="template/images/Pepsi_logo_2008.png"></li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="well footerWell">
                                <center><p>copy right for Mr. fifty cent </p></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="template/js/jquery-3.0.0.min.js"></script>
        <script src="template/js/plugins.js"></script>
    </body>
</html>



