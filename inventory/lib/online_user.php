<?php

require_once '../config.php';

class Online_user{
    private $id_user;
    private $status;
    
    public function __construct($id_user,$status){
        $this->id_user=$id_user;
        $this->status=$status;
    }
    public function addUserStatus(){
        global $dbh;
        $sql=$dbh->prepare("INSERT INTO online_user(id_user,status)VALUES('$this->id_user','$this->status')");
        $sql->execute();
    }
    public static function deleteUserStatus($id_user){
        global $dbh;
        $sql=$dbh->prepare("DELETE FROM online_user WHERE id_user='$id_user'");
        $sql->execute();
    }
    public static function retrieveAllUsersStatus(){
        global $dbh;
        $sql=$dbh->prepare("SELECT * FROM online_user");
        $sql->execute();
        $data=null;
        while($fetch=$sql->fetch(PDO::FETCH_ASSOC)):
            $data[]=$fetch;
        endwhile;
        return $data;
    }
    public static function getIpAddress(){
        $ipaddress="";
        if(getenv('HTTP_CLINT_IP')){
            $ip.=getenv('HTTP_CLINT_IP');
        }else if(getenv('HTTP_X_FORWARDED_FOR')){
            $ipaddress .= getenv('HTTP_X_FORWARDED_FOR');
        }else if(getenv('HTTP_X_FORWARDED')){
            $ipaddress .= getenv('HTTP_X_FORWARDED');
        }else if(getenv('HTTP_FORWARDED_FOR')){
            $ipaddress .= getenv('HTTP_FORWARDED_FOR');
        }else if(getenv('HTTP_FORWARDED')){
            $ipaddress .= getenv('HTTP_FORWARDED');
        }else if(getenv('REMOTE_ADDR')){
            $ipaddress .= getenv('REMOTE_ADDR');
        }else{
            $ipaddress .= 'UNKNOWN';
        }
        return $ipaddress;
    }
    public static function addToXml($id_user,$status){
        $browser=  get_browser(null,true);      
        $xml= new DOMDocument('1.0','UTF-8');
        $filename='../cpanel/template/data/online_users.xml';
        $xml->formatOutput=true;
        $xml->preserveWhiteSpace=false;
        $xml->load($filename);
        
        $document=$xml->getElementsByTagName('document')->item(0);
            $user=$xml->createElement('user');
                $id_user=$xml->createElement('id_user',$id_user);
                $status=$xml->createElement('status',$status);
                $ip_address=$xml->createElement('ip_address',Online_user::getIpAddress());
                $browser_name=$xml->createElement('browser_name',$browser['browser']);
                $platform=$xml->createElement('platform',$browser['platform']);
                $device_name=$xml->createElement('device_name',$browser['device_name']);
                $device_type=$xml->createElement('device_type',$browser['device_type']);
                $user->appendChild($id_user);
                $user->appendChild($status);
                $user->appendChild($ip_address);
                $user->appendChild($browser_name);
                $user->appendChild($platform);
                $user->appendChild($device_name);
                $user->appendChild($device_type);
            $document->appendChild($user);
        //echo '<xmp>'.$xml->saveXML().'</xmp>'
        $xml->save('../cpanel/template/data/online_users.xml');
        //$data=array('id_user'=>1,'status'=>1,'ip_address'=>'127.0.0.1','browser_name'=>'firefox','user_platform'=>'windos7');
    }
    public static function deleteFromXml($id_user){
        $xml=new DOMDocument('1.0','UTF-8');
        $xml->formatOutput=true;
        $xml->preserveWhiteSpace=false;
        $filename='../cpanel/template/data/online_users.xml';
        $xml->load($filename);
        $xpath= new DOMXPath($xml);
        foreach($xpath->query('/document/user[id_user='.$id_user.']') as $node):
            $node->parentNode->removeChild($node);
        endforeach;
        $xml->save($filename);
    }
}

//Online_user::addToXml(4,1);
//Online_user::deleteFromXml(2);