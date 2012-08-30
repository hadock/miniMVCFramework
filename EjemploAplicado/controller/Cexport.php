<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cexport
 *
 * @author hadock
 */
class Cexport extends Mdbconstantsquerys {
    public function DefaultParams(){
        return array('MainSelected' => array(
                                            'main'      => true,
                                            'profile'   => false,
                                            'Lista'     => false,
                                            'Juegos'    => false,
                                            'Nuevo'     => false,
                                            'Exportar'  => true,
                                        ),
                     'welcome' => $this->userInfo(),
                     'cuentajuegos' => $this->cuentaJuegosAbiertos(),
                     'listaJefes' => $this->obtenerListaJefes()
                    );
    }
    
    public function use_thirdPartyApp(){
        return array("php-excel/php-excel.class.php");
    }
    
    public function byTypeandDate(){
        $fromdate = cambiafecha_a_mysql($_POST['fromdate'])." ".$_POST['fromhour'].":".$_POST['fromminutes'];
        $todate = cambiafecha_a_mysql($_POST['todate'])." ".$_POST['tohour'].":".$_POST['tominutes'];
        $type = $_POST['tipoexportacion'];
        if($type){
            $filtro = "";
            if($type == 1)$filtro = " AND contar_apuesta = 1";
            if($type == 2)$filtro = " AND contar_apuesta = 0";
            
            $query = "SELECT cli.id_cliente, cli.nombre_cliente, cli.des_categoria, tj.nombre_juego,
                         u.nombre_usuario, DATE(j.fecha_hora_inicio) as fecha_inicio, TIME(j.fecha_hora_inicio) as hora_inicio,
                         t.monto_apuesta, DATE(t.fecha_hora_apuesta) as fecha_apuesta,
                         TIME(t.fecha_hora_apuesta) as hora_apuesta, jef.nombre_usuario as nombre_jefe, 
                         DATE(cj.fecha_hora_cierre) as fecha_cierre, 
                         TIME(cj.fecha_hora_cierre) as hora_cierre
                      FROM tbl_cierre_juego cj, tbl_juego j, tbl_cliente cli, tbl_usuario u, tbl_usuario jef,
                           tbl_tipo_juego tj, tbl_transaccion t
                      WHERE cj.fk_id_juego = j.id_juego AND cli.id_cliente = j.fk_cliente AND
                            j.fk_tipo_juego = tj.id_tipo_juego AND u.id_usuario = j.fk_id_usuario AND
                            cj.fk_id_jefe = jef.id_usuario AND j.id_juego = t.id_juego AND
                            t.fecha_hora_apuesta BETWEEN '$fromdate' AND '$todate' $filtro" ;
            
            $resultado = $this->Query($query);
            $data = array();
            $data[] = array("ID CLIENTE", "NOMBRE CLIENTE", "CATEGORIA", 
                            "JUEGO", "REGISTRADO POR", "FECHA INICIO JUEGO", 
                            "HORA INICIO JUEGO", "MONTO JUEGO", "FECHA TRACKING", 
                            "HORA TRACKING", "CERRADO POR", "FECHA CIERRE", "HORA CIERRE");
            while($fila = $this->FetchAssoc($resultado)){
                $data[] = array($fila['id_cliente'],$fila['nombre_cliente'],$fila['des_categoria'],
                                $fila['nombre_juego'],$fila['nombre_usuario'],
                                cambiafecha_a_normal_inverida_cnguion($fila['fecha_inicio']),
                                $fila['hora_inicio'],$fila['monto_apuesta'],
                                cambiafecha_a_normal_inverida_cnguion($fila['fecha_apuesta']),
                                $fila['hora_apuesta'], $fila['nombre_jefe'],
                                cambiafecha_a_normal_inverida_cnguion($fila['fecha_cierre']), 
                                $fila['hora_cierre']);
            }
        }
        
       /* $data = array(
		"header" => array ('Columna 1', "Columna 2", 'Columna 3'),
		"1" => array("2010", 'Dato 2', 'Dato 3'),
		"2" => array('Dato 4', 'Dato 5')
        );*/

        // generate file (constructor parameters are optional)
        $xls = new Excel_XML('UTF-8', true, 'EXPORTADO');
        $xls->addArray($data);
        $xls->generateXML('TRACKING-EXP');
        exit;
    }
}

?>
