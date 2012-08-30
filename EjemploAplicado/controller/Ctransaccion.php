<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ctransaccion
 *
 * @author hadock
 */
class Ctransaccion extends Mtransaccion {
    public function  DefaultParams() {
        return array('MainSelected' => array(
                                            'main'      => true,
                                            'profile'   => false,
                                            'Lista'     => false,
                                            'Juegos'    => false,
                                            'Nuevo'     => true,
                                            'Exportar'  => false,
                                        ),
                     'welcome' => $this->userInfo(),
                     'cuentajuegos' => $this->cuentaJuegosAbiertos() 
                    );
    }
    
    public function Jscripts(){
        return array("file" => array("jmsgboxes.js","Jtransaccion.js","jquery.tables.js"), "text" => "var loading_gif = '"._THEME_DIRNAME_."images/loadingbar.gif'");
    }
    
    public function mostrarForm(){
        if(isset($_GET['idjuego'])){
            $mostrar_lista_juegos = false;
            $idjuego = $_GET['idjuego'];
            $idtipojuego = $this->idtipojuego($idjuego);
            $transaccion = array("tipo" => "nueva_apuesta", 
                                 "datos" => array("idtarjeta" => $this->traeTarjetaEnJuego($idjuego)));
        }else{
            $mostrar_lista_juegos = true;
            $idtipojuego = '0';
            $transaccion = array("tipo" => "nuevo_juego", "datos" => "");
        }
        return array('MainSelected' => array(
                                            'main'      => true,
                                            'profile'   => false,
                                            'Lista'     => false,
                                            'Juegos'    => false,
                                            'Nuevo'     => true,
                                            'Exportar'  => false,
                                        ),
                     'welcome' => $this->userInfo(),
                     'Juegos' => $this->obtenerListaJuegos($idtipojuego),
                     'tradicional' => $this->obtenerApuestas(1),
                     'vip' => $this->obtenerApuestas(2),
                     'listaJefes' => $this->obtenerListaJefes(),
                     'cuentajuegos' => $this->cuentaJuegosAbiertos(),
                     'mostrarlistajuegos' => $mostrar_lista_juegos,
                     'transaccion' => $transaccion
                    );
    }
    
    public function mostrarlista(){
        return array('MainSelected' => array(
                                            'main'      => true,
                                            'profile'   => false,
                                            'Lista'     => false,
                                            'Juegos'    => false,
                                            'Nuevo'     => true,
                                            'Exportar'  => false,
                                        ),
                     'welcome' => $this->userInfo(),
                     'listaApuestas' => $this->traelistaapuestas((int)$_GET['idjuego'], 80, "apuestas"),
                     'listaTracking' => $this->traelistaapuestas((int)$_GET['idjuego'], 80, "tracking"),
                     'cuentajuegos' => $this->cuentaJuegosAbiertos(),
                     'clienteJugando' => $this->resumenTransacciones($_GET['idjuego'])
                    );
    }

    public function cerrarForm(){
        if(isset($_GET['idjuego'])){
            $idjuego = $_GET['idjuego'];
            if(is_numeric($idjuego)){
                return array('MainSelected' => array(
                                                    'main'      => true,
                                                    'profile'   => false,
                                                    'Lista'     => false,
                                                    'Juegos'    => false,
                                                    'Nuevo'     => true,
                                                    'Exportar'  => false,
                                                ),
                            'welcome' => $this->userInfo(),
                            'listaJefes' => $this->obtenerListaJefes(),
                            'cuentajuegos' => $this->cuentaJuegosAbiertos(),
                            'resumen' => $this->resumenTransacciones($idjuego)
                            );
            }
        }
        header("Location: ?load=trackinglist");
        
    }


    public function guardar_registro(){
        $userid = $this->userInfo();
        $userid = $userid['tbl_usuario'][0]['id_usuario'];
        $idcliente = $_POST['idcliente'];
        if(!$idcliente){
            $msg = base64_encode("Debe deslizar la tarjeta del cliente");
            header("Location: ?load={$_GET['load']}&action=mostrarForm&extraview=Vaddtransaccion&error&m=$msg");
            exit;
        }
        if(!isset($_GET['idjuego'])){
            $juego = $_POST['juego'];
            $idjuego = time();
            $primera_transaccion = true;
            if(!$this->clientejugando($idcliente)){
                $this->insertQuery("tbl_juego", 
                                    array(
                                        "id_juego" => $idjuego,
                                        "fk_id_usuario" => $userid,
                                        "fk_tipo_juego" => $juego,
                                        "fk_cliente" => $idcliente,
                                    ));
                $idjuegovalido = true;
            }else{
                $msg = base64_encode("El cliente se encuentra activo en otro juego... <br> Primero debe ser cerrado");
                header("Location: ?load={$_GET['load']}&action=mostrarForm&extraview=Vaddtransaccion&error&m=$msg");
                exit;
            }
        }else{
            $primera_transaccion = false;
            $idjuego = $_GET['idjuego'];
            $juego = $this->selectQuery("tbl_juego", array("*"), array('AND' => array("id_juego = $idjuego")));
            if(is_array($juego['tbl_juego'])){
                if(count($juego['tbl_juego'][0])> 0){
                    $idjuegovalido = true;
                }else{
                    $idjuegovalido = false;
                }
            }else{
                $idjuegovalido = false;
            }
        }
            
        if($_POST['tipo_apuesta']=="tradicional"){
            $apuesta = $_POST['aptradicional'];
        }else{
            $apuesta = $_POST['apvip'];
        }

        $observacion = $_POST['observacion'];
        
        if($idjuegovalido){
                $trans = $this->verifica_apuesta_automatica($idjuego);
                if($trans){
                    if(strlen($observacion)!=0){
                        $observacion.=" - (APUESTA EN TIEMPO DE TRACKING)";
                    }else{
                        $observacion="(APUESTA EN TIEMPO DE TRACKING)";
                    }
                    
                    $query = "UPDATE tbl_transaccion 
                              SET id_apuesta_prom = $apuesta,
                                  monto_apuesta = {$this->montoApuesta($apuesta)},
                                  observacion = '$observacion'
                              WHERE id_trans = $trans";
                    $this->Query($query);
                }else{
                    //$query = "UPDATE tbl_transaccion SET ultima_apuesta = 0 WHERE id_juego = $idjuego";
                    //$this->Query($query);
                    $minutos_tracking = array(0 => "00", 1 => "15", 2 => "30", 3 => "45");
                    if($primera_transaccion){
                        $ultima_apuesta = "1";
                        foreach($minutos_tracking as $key => $value):
                            if($value==date('i')){
                                $contar_apuesta = "1";
                                $observacion.=" - (APUESTA EN TIEMPO DE TRACKING)";
                                break;
                            }else{
                                $contar_apuesta = "0";
                            }
                        endforeach;
                    }else{
                        $ultima_apuesta = "0";
                        $contar_apuesta = "0";
                    }
                    
                    $this->insertQuery("tbl_transaccion", 
                                        array(
                                            "id_apuesta_prom" => $apuesta,
                                            "id_cliente" => $idcliente,
                                            "id_juego" => $idjuego,
                                            "monto_apuesta" => $this->montoApuesta($apuesta),
                                            "observacion" => $observacion,
                                            "ultima_apuesta" => $ultima_apuesta,
                                            "contar_apuesta" => $contar_apuesta
                                            ), true);
                }
                
                
                
                header("Location: ?load=trackinglist");
        }else{
            $msg = base64_encode("La identificaci&oacute;n del juego no es v&aacute;lida");
            header("Location: ?load={$_GET['load']}&action=mostrarForm&extraview=Vaddtransaccion&idjuego={$_GET['idjuego']}&error&m=$msg");
            exit;
        }
        
    }
    
    public function cerrar_juego(){
        if(isset($_POST['idjuego'])){
            if(is_numeric($_POST['idjuego'])){
                if(strlen($_POST['fecha_termino'])>9){
                    $insertArray = array(
                    "fk_id_jefe" => $_POST['jefe'],
                    "fk_id_juego" => $_POST['idjuego'],
                    "monto_total" => $this->montoJuego($_POST['idjuego']),
                    "fecha_hora_cierre" => cambiafecha_a_mysql($_POST['fecha_termino'])." ".$_POST['hora'].":".$_POST['minutos'].":00"
                    );
                    $this->insertQuery("tbl_cierre_juego", $insertArray);

                    $query = "UPDATE tbl_juego SET estado_juego = 0 WHERE id_juego = {$_POST['idjuego']}";
                    $this->Query($query);
                    header("Location: ?load=trackinglist");
                    return true;
                }else{
                    $msg = base64_encode("Debe introducir la fecha para cerrar");
                    header("Location: ?load={$_GET['load']}&action=cerrarForm&extraview=Vclosetransaccion&idjuego={$_POST['idjuego']}&error&m=$msg");
                    exit;
                }
            }
        }
        header("Location: ?load=trackinglist");
    }


    public function getClientInfo(){
        if(isset($_POST['cardid'])){
            if($_POST['cardid']){
                $retorno = $this->traeDatosCliente($_POST['cardid']);
            }else{
                $error = "DEBE DESLIZAR O DIGITAR EL N&Uacute;MERO DE TARJETA";
            }
        }else{
            $error = "No permitido";
        }
        
        if(isset($error)){
            $error = array("error" => array("msg" => $error, "ashooter" => "showmessage", "container" => "simpledialogtext"));
            return json_encode($error);
        }
        
        if(is_array($retorno)){
            $resultado = array("resultado" => array("datos" =>$retorno));
            return json_encode($resultado);
        }else{
            $error = array("error" => array("msg" => "<strong>No hay cliente asociado a esta tarjeta</strong><br>&iquest;Desea ingresar los datos del cliente?",
                                            "ashooter" => "showmessage_yesno", "container" => "modaldialogtext"
                                            ));
            return json_encode($error);
        }
    }
}

?>
