<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Msearch
 *
 * @author hadock
 */
class Msearch extends Mdbconstantsquerys {
    protected function clientInfo($client_id){
        $return = array();
        $query = "SELECT c.id_cliente, z.id_zona, z.nombre_zona, ci.id_ciudad, ci.nombre_ciudad,
                        e.id_evaluacion, e.tipo_evaluacion, c.fono_cliente, c.nombre_cliente,
                        c.apellido_cliente, c.apellido1_cliente, c.direccion_cliente,
                        c.observaciones_cliente, c.hora_ing
                  FROM CLIENTE c, ZONA z, CIUDAD ci, EVALUACION e
                  WHERE ci.id_ciudad = z.id_ciudad_zona AND c.id_zona_cliente = z.id_zona
                  AND e.id_evaluacion = c.id_evaluacion_cliente AND c.id_cliente = '$client_id'";
        $result = $this->Query($query);
        if($this->RecordsCount($result)>0){
            while($row = $this->FetchAssoc($result)){
                $return[] = $row;
            }
            return $return;
        }else{
            return $return['error'] = "No hay resultados para la busqueda '$client_id'";
        }
    }

    protected function searchClientByAddress($address){
        $arrayDir = explode(' ', $address);
        $whereCondition = '';
        foreach($arrayDir as $val):
            $whereCondition.= " AND direccion_cliente like '%$val%' ";
        endforeach;
        $query = "SELECT c.id_cliente, z.id_zona, z.nombre_zona, ci.id_ciudad, ci.nombre_ciudad,
                        e.id_evaluacion, e.tipo_evaluacion, c.fono_cliente, c.nombre_cliente,
                        c.apellido_cliente, c.apellido1_cliente, c.direccion_cliente,
                        c.observaciones_cliente, c.hora_ing
                  FROM CLIENTE c, ZONA z, CIUDAD ci, EVALUACION e
                  WHERE ci.id_ciudad = z.id_ciudad_zona AND c.id_zona_cliente = z.id_zona
                  AND e.id_evaluacion = c.id_evaluacion_cliente $whereCondition LIMIT 0,100";
        $result = $this->Query($query);
        if($this->RecordsCount($result)>0){
            while($row = $this->FetchAssoc($result)){
                $return[] = $row;
            }
            return $return;
        }else{
            return $return['error'] = "No hay resultados para la busqueda '$address'";
        }
    }

    protected function searchClientByName($name){
        $arrayNames = explode(' ', $name);
        $whereCondition = '';
        foreach($arrayNames as $val):
            $whereCondition.= " AND concat(c.nombre_cliente, ' ', c.apellido_cliente, ' ', c.apellido1_cliente) like '%$val%' ";
        endforeach;
        $query = "SELECT c.id_cliente, z.id_zona, z.nombre_zona, ci.id_ciudad, ci.nombre_ciudad,
                        e.id_evaluacion, e.tipo_evaluacion, c.fono_cliente, c.nombre_cliente,
                        c.apellido_cliente, c.apellido1_cliente, c.direccion_cliente,
                        c.observaciones_cliente, c.hora_ing
                  FROM CLIENTE c, ZONA z, CIUDAD ci, EVALUACION e
                  WHERE ci.id_ciudad = z.id_ciudad_zona AND c.id_zona_cliente = z.id_zona
                  AND e.id_evaluacion = c.id_evaluacion_cliente $whereCondition LIMIT 0,100";
        $result = $this->Query($query);
        if($this->RecordsCount($result)>0){
            while($row = $this->FetchAssoc($result)){
                $return[] = $row;
            }
            return $return;
        }else{
            return $return['error'] = "No hay resultados para la busqueda '$name'";
        }
    }

    protected function searchSellerByName($name){
        $arrayNames = explode(' ', $name);
        $whereCondition = '';
        $cont=0;
        foreach($arrayNames as $val):
            $cont++;
            $whereCondition.= " AND concat(run_empleado, ' ', nombre_empleado) like '%$val%' ";
        endforeach;
        $query = "SELECT run_empleado, nombre_empleado
                    FROM EMPLEADO WHERE 1 $whereCondition";

        if($name==''){
            return $return['empty'] = "empty";
        }

        $result = $this->Query($query);
        if($this->RecordsCount($result)>0){
            while($row = $this->FetchAssoc($result)){
                $return[] = $row;
            }
            return $return;
        }else{
            $return = array('error' => "No hay resultados para la busqueda '$name'");
            return $return;
        }
    }

    protected function searchArticleByAttributes($atributes){
        $arrayAtributes = explode(' ', $atributes);
        $whereCondition = '';
        $cont=0;
        foreach($arrayAtributes as $val):
            $cont++;
            $whereCondition.= " AND concat(codigo_producto, ' ', descripcion_producto, ' ', precio_producto) like '%$val%' ";
        endforeach;
        $query = "SELECT codigo_producto, descripcion_producto, precio_producto, stock_producto
                    FROM PRODUCTO WHERE 1 $whereCondition";

        if($atributes==''){
            return $return['empty'] = "empty";
        }

        $result = $this->Query($query);
        if($this->RecordsCount($result)>0){
            while($row = $this->FetchAssoc($result)){
                $row['descripcion_producto'] = utf8_encode($row['descripcion_producto']);
                $return[] =  $row;
            }
            return $return;
        }else{
            $return = array('error' => "No hay resultados para la busqueda '$atributes'");
            return $return;
        }
    }
}
?>
