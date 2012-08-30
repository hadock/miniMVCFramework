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
        $result = $this->selectQuery('tbl_usuario', array('nombre_usuario', 'jefatura', 'login_usuario', 'id_usuario'), array('AND' => array("login_usuario = '$username'")));
        return $result;
    }

    protected function obtenerListaJuegos($juego_selecionado = ''){
        $resultado = $this->selectQuery("tbl_tipo_juego", array("id_tipo_juego","nombre_juego"));
        $retorno = array();
        foreach($resultado['tbl_tipo_juego'] as $key => $value):
            if(is_numeric($juego_selecionado)){
                if($juego_selecionado == $value['id_tipo_juego']){
                    $selected = 1;
                }else{
                    $selected = 0;
                }
            }
            $retorno[] = array("id_tipo_juego" => $value['id_tipo_juego'], 
                             "nombre_juego" => $value['nombre_juego'],
                             "selected" => $selected);
        endforeach;
        return $retorno;
    }
    
    protected function obtenerApuestas($tipo){
        $resultado = $this->selectQuery("tbl_apuesta_prom", array("id_apuesta_prom","valor_apuesta_prom"), 
                                                       array("AND" => 
                                                                array(
                                                                    "fk_id_tipo = $tipo"
                                                                )
                                                            ));
        return $resultado;
    }
    
    protected function obtenerListaJefes(){
        $resultado = $this->selectQuery("tbl_usuario", array("nombre_usuario", "id_usuario"), 
                                                       array("AND" => array("jefatura = 1"))
                                        );
        return $resultado;
    }
    
    protected function cuentaJuegosAbiertos(){
        $resultado = $this->selectQuery("tbl_juego", array("count(*) as cuenta"), array("AND" => array("estado_juego = 1")));
        $cuenta = $resultado["tbl_juego"][0]["cuenta"];
        return $cuenta;
    }





    public function checkUserSession(){
        if(isset($_SESSION['Usession'])){
            $username = base64_decode($_SESSION['Usession']['uid']);
            $result = $this->selectQuery('tbl_usuario', array('nombre_usuario', 'tipo_usuario'), array('AND' => array("name_usuario = '$username'")));
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
