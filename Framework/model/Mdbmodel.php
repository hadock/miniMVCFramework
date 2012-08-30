<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mdbmodel
 *
 * @author hadock
 */
class Mdbmodel {
    protected $model = array();
    public function  __construct() {
        $this->model = array(
            'ciudad' => array('CIUDAD' =>
                            array('id' => 'id_ciudad',
                                  'nombre' => 'nombre_ciudad',
                                  'usuario' => 'user_ciudad')),
            'cliente' => array('CLIENTE' =>
                            array('id' => 'id_cliente',
                                  'zona' => 'id_zona_cliente',
                                  'evaluacion' => 'id_evaluacion_cliente',
                                  'fono' => 'fono_cliente',
                                  'nombre' => 'nombre_cliente',
                                  'apellido1' => 'apellido_cliente',
                                  'apellido2' => 'apellido1_cliente',
                                  'direccion' => 'direccion_cliente',
                                  'trabajo' => 'lugar_trabajo_cliente',
                                  'observaciones' => 'observaciones_cliente',
                                  'bloqueo' => 'bloqueo_cliente',
                                  'usuario' => 'user_cliente',
                                  'registro' => 'hora_ing',
                                  'bloqueo' => 'sistem_block',
                                  'atrasos' => 'atrasos_cliente',
                                  'desbloqueo' => 'desbloc_adm')),
            'venta' => array('COMPRA' =>
                            array('folio' => 'numero_folio',
                                  'cliente' => 'run_cliente',
                                  'vendedor' => 'id_vendedor_compra',
                                  'primer_pago' => 'fecha_1er_pago_compra',
                                  'fecha' => 'fecha_compra',
                                  'abono_pago' => 'abono_pactado_compra',
                                  'forma_pago' => 'forma_de_pago_compra',
                                  'total' => 'total_a_pagar')),
            'conyuge' => array('CONYUGE' =>
                            array('id' => 'id_conyuge',
                                  'cliente' => 'id_cliente_conyuge',
                                  'nombre' => 'nombre_conyuge',
                                  'fono' => 'fono_conyuge',
                                  'user' => 'user_conyuge')),
            'item_venta' => array('CP' =>
                            array('folio' => 'id_folio_cp',
                                  'producto' => 'id_producto',
                                  'cantidad' => 'cantidad_cp',
                                  'precio' => 'precio_cp',
                                  'usuario' => 'user_cp',
                                  'estado' => 'eliminado_cp')),
            'deudores' => array('DEUDORES' =>
                            array('folio' => 'folio',
                                  'cliente' => 'id_cliente',
                                  'nombre' => 'nombre',
                                  'direccion' => 'direccion',
                                  'ultimo' => 'ultimo',
                                  'total' => 'total')),
            'direccion' => array('DIRECCION' =>
                            array('id' => 'id_direccion',
                                  'zona' => 'id_zona_direccion',
                                  'direccion' => 'nombre_direccion',
                                  'usuario' => 'user_direccion')),
            'empleado' => array('EMPLEADO' =>
                            array('id' => 'run_empleado',
                                  'nombre' => 'nombre_empleado',
                                  'direccion' => 'direccion_empleado',
                                  'fono' => 'fono_empleado',
                                  'cargo' => 'cargo_empleado',
                                  'observacion' => 'observacion_empleado',
                                  'usuario' => 'user_empleado')),
            'usuario'  => array('USERS' =>
                            array('id' => 'id_usuario',
                                  'accname' => 'name_usuario',
                                  'nombre' => 'nombre_usuario',
                                  'direccion' => 'direccion_usario',
                                  'observacion' => 'observacion',
                                  'password' => 'pass_usuario',
                                  'nivel' => 'tipo_usuario',
                                  'pregunta' => 'preg_secreta',
                                  'respuesta' => 'respuesta_secreta',
                                  'creado_por' => 'user_empleado'))
        );
    }
    public function getTableName($alias){

    }
}
?>
