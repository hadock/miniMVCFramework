<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mdbconstantsquerys
 *
 * @author hadock
 */
class Mdbconstantsquerys extends Mdbhandler {
    public function userInfo(){
        $uinfo = $_SESSION['Usession'];
        $username = base64_decode($uinfo['uid']);
        $result = $this->selectQuery('USERS', array('nombre_usuario', 'tipo_usuario', 'name_usuario'), array('AND' => array("name_usuario = '$username'")));
        return $result;
    }

    public function clientsCount(){
        return $this->selectQuery('CLIENTE', array('COUNT(*) as total'));
    }

    public function salesCount(){
        return $this->selectQuery('COMPRA', array('COUNT(*) as total'));
    }

    public function paymentsCount(){
        return $this->selectQuery('PAGO', array('COUNT(*) as total'));
    }

    public function cityList(){
        return $this->selectQuery('CIUDAD', array('id_ciudad', 'nombre_ciudad'), '', array('DESC' => array('nombre_ciudad')));
    }

    public function EvaluationsTypes(){
        return $this->selectQuery('EVALUACION', array('id_evaluacion', 'tipo_evaluacion'), '', array('ASC' => array('id_evaluacion')));
    }

    public function getZones($cityid){
        return $this->selectQuery('ZONA', array('id_zona', 'nombre_zona'), array('AND' => array("id_ciudad_zona = $cityid")), array('ASC' => array('nombre_zona')));
    }

    public function getActiveUserName(){
        if($this->checkUserSession() && !isset ($_GET['ajaxRequest'])){
            $result = $this->userInfo();
            return $result['USERS'][0]['name_usuario'];
        }else{
            //header("Location: index.php?load=login&action=doLogout");
        }
        
        if($this->checkUserSession() && isset ($_GET['ajaxRequest'])){
            $result = $this->userInfo();
            return array('user_name' => $result['USERS'][0]['name_usuario']);
        }else{
            return false;
        }

    }

    public function checkUserSession(){
        if(isset($_SESSION['Usession'])){
            $username = base64_decode($_SESSION['Usession']['uid']);
            $result = $this->selectQuery('USERS', array('nombre_usuario', 'tipo_usuario'), array('AND' => array("name_usuario = '$username'")));
            if(count($result)>0){
                return true;
            }else{
                //header("Location: index.php?load=login&action=doLogout");
                return false;
            }
        }else{
            return false;
        }
    }
}
?>
