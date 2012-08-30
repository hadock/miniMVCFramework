<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Clogin
 *
 * @author hadock
 */

class Clogin extends Mdbhandler{
    protected $uinfo;
    public function  doLogin() {
        $response = array();
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($username == "" || $username == "Usuario"){
            $response['error'] = 'Debe introducir un nombre de usuario';
            return json_encode($response);
        }
        if($password == "" || $password == "password"){
            $response['error'] = 'Debe introducir una contrase&ntilde;a';
            return json_encode($response);
        }

        if($this->checklogin($username, $password)){
            //session_register('Usession', $this->uinfo);
            $_SESSION['Usession'] = $this->uinfo;
            return json_encode(array('load'=>'trackinglist'));
        }else{
            $response['error'] = 'Usuario y/o Contrase&ntilde;a Incorrectos';
            return json_encode($response);
        }

        
    }

    public function Jscripts(){
        return array('text' => 'var theme_dir = "'._THEME_DIRNAME_.'"',
                     'file' => 'login.js');
    }

    public function checklogin($username, $password){
        $result = $this->Query("SELECT * FROM tbl_usuario WHERE login_usuario = '$username' AND pass_usuario = MD5('$password')");
        if($this->RecordsCount($result)>0){
            $row = $this->FetchAssoc($result);
            $this->uinfo['uid'] = base64_encode($row['login_usuario']);
            $this->uinfo['uuid'] = base64_encode($row['pass_usuario']);
            return true;
        }else{
            return false;
        }
    }

    public function doLogout(){
        session_destroy();
        header("Location: index.php");
    }
    
}
?>
