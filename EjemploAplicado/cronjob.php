<?php
include 'system/config.php';
include 'system/GlobalFunctions.php';
include 'model/Mdbmodel.php';
include 'model/Mdbhandler.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cronjob
 *
 * @author teresa
 */

class cronjob extends Mdbhandler {
    
    public function lista_ultimas_apuestas(){
        //$horas = '00', $min = '15', $segundos = '00'
        //TIMEDIFF(NOW(), t.fecha_hora_apuesta) >= '$horas:$min:$segundos' AND
        
        $query = "SELECT t.id_juego, t.id_trans, t.id_apuesta_prom, t.id_cliente, t.monto_apuesta, 
                        t.observacion, t.ultima_apuesta FROM tbl_transaccion t, tbl_juego j 
                WHERE j.id_juego = t.id_juego AND j.estado_juego = 1 AND 
                      ultima_apuesta = 1 
                GROUP BY t.id_juego";
        $apuestas = $this->Query($query);
        $resultados = array();
        while($fila = $this->FetchAssoc($apuestas)){
            $resultados[] = $fila;
        }
        
        return $resultados;
    }
    
    public function inserta_apuestas_automaticas($array = array()){
        if(count($array)>0){
            foreach ($array as $key => $value){
                $query = "UPDATE tbl_transaccion SET ultima_apuesta = 0 WHERE id_trans = {$value['id_trans']}";
                $this->Query($query);
                $insert = array(
                    "id_juego" => $value['id_juego'],
                    "id_apuesta_prom" => $value['id_apuesta_prom'],
                    "id_cliente" => $value['id_cliente'],
                    "monto_apuesta" => $value['monto_apuesta'],
                    "observacion" => "TRANSACCI&Oacute;N AUTOM&Aacute;TICA - (TRACKING)",
                    "contar_apuesta" => "1"
                );
                $this->insertQuery("tbl_transaccion", $insert);
            }
        }
    }
}

$cron = new cronjob();
$cron->inserta_apuestas_automaticas($cron->lista_ultimas_apuestas());
?>
