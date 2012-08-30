<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mtransaccion
 *
 * @author hadock
 */
class Mtransaccion extends Mdbconstantsquerys {
    protected function resumenTransacciones($idjuego){
        $query = "SELECT c.nombre_cliente, 
                    tj.nombre_juego, TIMEDIFF(NOW(),j.fecha_hora_inicio) as tiempo_juego, 
                    j.id_juego, (SELECT sum(monto_apuesta) FROM tbl_transaccion WHERE id_juego=$idjuego) as monto_total
                  FROM tbl_cliente c, tbl_tipo_juego tj, tbl_juego j
                  WHERE j.fk_cliente = c.id_cliente AND j.fk_tipo_juego = tj.id_tipo_juego AND j.id_juego = $idjuego";
        $obj = $this->Query($query);
        $resumen = array();
        if($this->RecordsCount($obj)){
            while ($fila = $this->FetchAssoc($obj)){
                $fila['monto_total'] = number_format($fila['monto_total']);
                $resumen[] = $fila;
            }
        }
        return $resumen;
    }
    
    protected function traelistaapuestas($idjuego, $filas=40, $filtro = "todas"){
        if($filtro!="todas"){
            if($filtro == "tracking"){
                $filtrado =  " AND contar_apuesta = 1 ";
            }elseif($filtro == "apuestas"){
                $filtrado = " AND contar_apuesta = 0 ";
            }
        }else{
            $filtrado = "";
        }
        $query = "SELECT * FROM tbl_juego WHERE id_juego = '$idjuego'";
        $juego = $this->Query($query);
        $array = array();
        if($this->RecordsCount($juego)){
            $query = "SELECT id_trans, observacion, DATE(fecha_hora_apuesta) as fecha_apuesta,
                        TIME(fecha_hora_apuesta) as hora_apuesta, monto_apuesta
                        FROM tbl_transaccion
                        WHERE id_juego = $idjuego $filtrado
                        ORDER BY fecha_hora_apuesta DESC LIMIT 0,$filas";
            $result = $this->Query($query);
            while($fila = $this->FetchAssoc($result)){
                $fila['fecha_apuesta'] = cambiafecha_a_normal_inverida_cnguion($fila['fecha_apuesta']);
                $array[] = $fila;
            }
            
        }
        return $array;
    }
    
    protected function montoApuesta($idapuesta){
        $resultado = $this->selectQuery("tbl_apuesta_prom", array("valor_apuesta_prom"), array("AND" => array("id_apuesta_prom = $idapuesta")));
        sleep(1);
        return $resultado['tbl_apuesta_prom'][0]['valor_apuesta_prom'];
    }
    
    protected function montoJuego($idjuego){
        $apuestas = $this->selectQuery("tbl_transaccion", array("sum(monto_apuesta) as monto_apuesta"), array("AND" => array("id_juego = $idjuego")));
        $monto_apuesta = $apuestas['tbl_transaccion'][0]['monto_apuesta'];
        return $monto_apuesta;
        
    }


    protected function traeDatosCliente($cardid){
        $resultado = $this->selectQuery("tbl_cliente", "*", array("AND" => array("id_tarjeta = '$cardid'")));
        return $resultado['tbl_cliente'];
    }
    
    protected function traeTarjetaEnJuego($idjuego){
        $resultado = $this->selectQuery("tbl_juego j, tbl_cliente c", 
                                            array("c.id_tarjeta"),
                                            array("AND" => array(
                                                                "j.fk_cliente = c.id_cliente",
                                                                "j.id_juego = $idjuego"
                                                                )
                                                )
                                        );
        return $resultado['tbl_juego j, tbl_cliente c'][0]['id_tarjeta'];
    }
    
    protected function idtipojuego($idjuego){
        if(is_numeric($idjuego)){
            $resultado = $this->selectQuery("tbl_juego", array("fk_tipo_juego"), array("AND" => array("id_juego = $idjuego")));
            $fila = $resultado['tbl_juego'][0]["fk_tipo_juego"];
        }else{
            $fila = 0;
        }
        
        return $fila;
    }
    
    protected function clientejugando($idcliente){
        $result = $this->selectQuery("tbl_juego", array("count(*) as jugando"), array("AND" => array("fk_cliente = $idcliente", "estado_juego = 1")));
        if($result['tbl_juego'][0]['jugando']){
            return true;
        }else{
            return false;
        }
    }
    
    protected function verifica_apuesta_automatica($idjuego){
        $apuesta = $this->selectQuery("tbl_transaccion", 
                                        array("id_trans"), 
                                        array(
                                                "AND" => array(
                                                            "HOUR(fecha_hora_apuesta) = HOUR(NOW())",
                                                            "MINUTE(fecha_hora_apuesta) = MINUTE(NOW())",
                                                            "CAST(SECOND(NOW()) AS SIGNED) BETWEEN 0 AND 59",
                                                            "ultima_apuesta = 1",
                                                            "id_juego = $idjuego"
                                                    )
                                            
                                        )
                                     );
        if(isset($apuesta['tbl_transaccion'][0]['id_trans'])){
            return $apuesta['tbl_transaccion'][0]['id_trans'];
        }else{
            return false;
        }
    }
}

?>
