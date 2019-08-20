<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Akun extends CI_Model
{

    private $username;
    private $password;

    function __construct()
    {
        parent::__construct();
        $this->username="";
        $this->password="";
     
    }

    
    public function getUsername(){
        return $this->username;
    }
    
    public function setUsername($username){

        $this->username = $username;
    }

    public function getPassword(){
        return $this->password;
    }
    
    public function setPassword($password){

        $this->password = $password;
    }
    
}   

?>