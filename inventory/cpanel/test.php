<html>
    <head>
        <title>inventory</title>
        <link href="template/css/bootstrap.css"rel="stylesheet"type="text/css"/>
        <link href="template/css/base.css"rel="stylesheet"type="text/css"/>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div class="container">
                    <div class="row">
                        <div class="span12">
                            <div class="well headerWell">
                                <div class="logo">
                                    <h3>store</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="navbar">
                <div class="container">
                    <div class="row">
                        <div class="span12">
                            <div class="well-large navbar_well">
                                <ul class="navbar nav-tabs nav">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Log In</a></li>
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
                                    <div class="message">
                                        <h4>result here</h4>
                                    </div>
                                    <div id="form">
                                        <form class="form-horizontal"action="<?= $_SERVER['PHP_SELF'] ?>"method="post"enctype="multipart/form-data">
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
                                </div>
                                <div id="rightContent">
                                    <div id="menu">
                                        <div id="menuHeader">
                                            <h2>welcome</h2>
                                        </div>

                                        <div class="menuList">
                                            <div class="listHead">
                                                <h3>user</h3>
                                            </div>
                                            <div class="listContent">
                                                <ul>
                                                    <li><a href="#">add user</a></li>
                                                    <li><a href="#">edit user</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="menuList">
                                            <div class="listHead">
                                                <h3>category</h3>
                                            </div>
                                            <div class="listContent">
                                                <ul>
                                                    <li><a href="#">add category</a></li>
                                                    <li><a href="#">edit category</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="menuList">
                                            <div class="listHead">
                                                <h3>product</h3>
                                            </div>
                                            <div class="listContent">
                                                <ul>
                                                    <li><a href="#">add product</a></li>
                                                    <li><a href="#">edit product</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>    
            <div id="footer">
                <div class="container">
                    <div class="row">
                        <div clas="span12">
                            <div class="well footerWell">
                                <center><p>copy right for Mr. fifty cent </p></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
$filename='template/data/online_users.xml';
$xml= new DOMDocument('1.0','UTF-8');
$xml->formatOutput=true;
$xml->preserveWhiteSpace=false;
$xml->load($filename);
/*if(!$xml){
    $online_users=$xml->createElement('online_users');
    $xml->appendChild($online_users);
}else{
    $online_users=$xml->firstChild;
}*/
//$root_tag=$xml->getElementsByTagName('document')->item(0);
//$data_tag=$xml->createElement('user');
//$id_user=$xml->createElement('id_user',7);
//$data_tag->appendChild($id_user);
//$status_tag=$xml->createElement('status',1);
//$data_tag->appendChild($status_tag);
//$ip_address=$xml->createElement('ip_adress','127.0.0.1');
//$data_tag->appendChild($ip_address);
//
//$root_tag->appendChild($data_tag);
//$xml->save($filename);
//
//$xpath=new DOMXPath($xml);
//foreach ($xpath->query("/document/user[id_user=4]")as $node):
//    $node->parentNode->removeChild($node);
//endforeach;
//$xml->formatOutput=true;
//$xml->save($filename);

?>
