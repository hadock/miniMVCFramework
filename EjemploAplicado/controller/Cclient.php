<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cclient
 *
 * @author hadock
 */
class Cclient extends Mclient {
    public function addNew(){
        if(isset($_POST)){
            extract($_POST);
            if(strlen($idtarjetanueva)<10){
                $error[] = array("error" => array("msg" => "Id de tarjeta inv&aacute;lido", "action" => "showmessage", "textin" => "simpledialogtext"));
                return json_encode($error);
            }
            if(strlen($nombreclientenuevo)<7){
                $error[] = array("error" => array("msg" => "Debe ingresar el nombre y apellido del cliente", "action" => "showmessage", "textin" => "simpledialogtext"));
                return json_encode($error);
            }
            if(!is_numeric($idclientenuevo)){
                $error[] = array("error" => array("msg" => "El ID del cliente debe ser num&eacute;rico", "action" => "showmessage", "textin" => "simpledialogtext"));
                return json_encode($error);
            }elseif(!isset ($error)){
                $cliente = $this->selectQuery("tbl_cliente", array("count(*) as encontrado"), array("AND" => array("id_cliente = '$idclientenuevo'")));
                if($cliente['tbl_cliente'][0]['encontrado']){
                    $error[] = array("idexiste" => array("msg" => "El ID del cliente ya corresponde a otra tarjeta <br> &iquest;Desea asociar al cliente a esta tarjeta?", "action" => "showmessage_yesno", "textin" => "modaldialogtext"));
                    return json_encode($error);
                }
            }
            
                
            
            if(!isset($error)){
                $insertArray = array(
                    "id_cliente" => $idclientenuevo,
                    "nombre_cliente" => $nombreclientenuevo,
                    "id_tarjeta" => $idtarjetanueva,
                    "des_categoria" => $topcategorias
                );
                $this->insertQuery("tbl_cliente", $insertArray, true);
                return json_encode(array("0" => array("success" => array("focusinput" => "idtarjeta", "msg" => "Se a registrado correctamente al cliente",  "action" => "showmessage", "textin" => "simpledialogtext"))));
            }else{
                return json_encode($error);
            }
        }
    }
    
    public function updateCliente(){
        if(isset($_POST)){
            extract($_POST);
            if(strlen($idtarjetanueva)<10){
                $error[] = array("error" => array("msg" => "Id de tarjeta inv&aacute;lido", "action" => "showmessage", "textin" => "simpledialogtext"));
                return json_encode($error);
            }
            if(strlen($nombreclientenuevo)<7){
                $error[] = array("error" => array("msg" => "Debe ingresar el nombre y apellido del cliente", "action" => "showmessage", "textin" => "simpledialogtext"));
                return json_encode($error);
            }
            if(!is_numeric($idclientenuevo)){
                $error[] = array("error" => array("msg" => "El ID del cliente debe ser num&eacute;rico", "action" => "showmessage", "textin" => "simpledialogtext"));
                return json_encode($error);
            }
            if(!isset($error)){
                $query = "UPDATE tbl_cliente SET id_tarjeta = '$idtarjetanueva', nombre_cliente = '$nombreclientenuevo', des_categoria = '$topcategorias' WHERE id_cliente = $idclientenuevo";
                $this->Query($query);
                return json_encode(array("0" => array("success" => array("focusinput" => "idtarjeta", "msg" => "Se a registrado correctamente al cliente",  "action" => "showmessage", "textin" => "simpledialogtext"))));
            }
        }
    }

}

?>
