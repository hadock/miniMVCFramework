<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mdbhandler
 *
 * @author hadock
 */
class Mdbhandler extends Mdbmodel {
    protected function Query($query){
        return dbConsulta($query);
    }

    protected function FetchAssoc($result){
        return dbFetchAssoc($result);
    }

    protected function RecordsCount($result){
        return dbNumRows($result);
    }

    protected function ExecuteStandardQuerys(){

        $result = $this->Query("SELECT * FROM crm_categoria");
        if($this->RecordsCount($result)>0){
            while($row = $this->FetchAssoc($result)){
                $return['categorias'][] = $row;
            }
        }
        $result = $this->Query("SELECT * FROM crm_ciudad");
        if($this->RecordsCount($result)>0){
            while($row = $this->FetchAssoc($result)){
                $return['ciudades'][] = $row;
            }
        }
        return $return;
    }

    protected function checkMyAgenda(){
        $uinfo = $_SESSION['Usession'];
        $username = base64_decode($uinfo['uid']);
        $password = base64_decode($uinfo['uuid']);
        $sql = "SELECT e.* FROM crm_empresa e, crm_agenda_empresa a, crm_usuario u
                WHERE DATE(a.fec_agenda) = DATE(NOW()) AND a.est_agenda = 0
                AND a.id_empresa = e.id_empresa AND e.id_usuario = u.id_usuario
                AND u.nic_usuario = '$username' AND u.pas_usuario = '$password'";
        $result = $this->Query($sql);
        if($this->RecordsCount($result)>0){
            while($row = $this->FetchAssoc($result)){
                $return['agenda'][] = $row;
            }
        }else{
            $return['agenda'][] = array();
        }

        $sql = "SELECT e.*, DATEDIFF(NOW(), a.fec_agenda) as dias_atras
                FROM crm_empresa e, crm_agenda_empresa a, crm_usuario u
                WHERE DATEDIFF(NOW(), a.fec_agenda) > 0
                AND est_agenda = 0 AND a.id_empresa = e.id_empresa AND e.id_usuario = u.id_usuario
                AND u.nic_usuario = '$username' AND u.pas_usuario = '$password'
                ORDER BY DATEDIFF(NOW(), fec_agenda) DESC";
        $result = $this->Query($sql);
        if($this->RecordsCount($result)>0){
            while($row = $this->FetchAssoc($result)){
                $return['forgotagenda'][] = $row;
            }
        }else{
            $return['forgotagenda'][] = array();
        }

        return $return;

    }

    protected function getLastContacts(){
        $uinfo = $_SESSION['Usession'];
        $username = base64_decode($uinfo['uid']);
        $password = base64_decode($uinfo['uuid']);
        return $this->selectQuery('crm_empresa e, crm_usuario u', array('e.*') ,array(
            'AND' => array('u.id_usuario = e.id_usuario',
                           "u.nic_usuario = '$username'", "u.pas_usuario = '$password'"
                          )
            ), array('DESC' => 'id_empresa'), '0,10');
    }

    protected function selectQuery($TableName, $FieldsToReturn = array(), $Where = array(), $OrderByFields = array(), $limit = ''){
        $return = array($TableName => '');
        if($TableName == ""){
            return $return;
        }
        $fields = " ";
        if(count($FieldsToReturn)>0 && is_array($FieldsToReturn)){
            $count = 0;
            foreach($FieldsToReturn as $key => $value):
                if($count == 0){
                    $fields.= $value;
                    $count++;
                }else{
                    $fields.= ', '.$value;
                }
            endforeach;
            $fields.= ' ';
        }else{
            $fields = ' * ';
        }

        $whereCondition = " 1 ";
        if(count($Where)>0 && is_array($Where)){
            foreach($Where as $key => $value):
                if($key == "OR" || $key == "or" || $key == "Or"){
                    foreach($value as $condition):
                        $whereCondition.= " $key $condition";
                    endforeach;
                }else{
                    foreach ($value as $condition):
                        $whereCondition.= " $key $condition";
                    endforeach;
                }
            endforeach;
        }

        $orderBy = 'ORDER BY 1 ASC';
        if(count($OrderByFields)>0 && is_array($OrderByFields)){
            $count = 0;
            foreach($OrderByFields as $key => $values):
                if($key != "ASC" && $key != "DESC"){
                    $return = array($TableName => '');
                    return $return;
                }
                foreach($values as $val):
                    if($count){
                        $orderBy.=", $val";
                    }else{
                        $orderBy = "ORDER BY $val";
                    }
                    $count++;
                endforeach;
            endforeach;
            $orderBy.= " $key";
        }

        if($limit){
            $limit = "LIMIT $limit";
        }

        $sql = "SELECT $fields FROM $TableName WHERE $whereCondition $orderBy $limit";
        //echo $sql, '<br>';
        $result = $this->Query($sql);
        if($this->RecordsCount($result)>0){
            while($row = $this->FetchAssoc($result)){
                $return[$TableName][] = $row;
            }
        }else{
            return $return;
        }

        return $return;
    }

    public function insertQuery($TableName, $FieldsAndValuesToInsert = array(), $comitQuery = true, $showQuery = false){
        $FieldsToInsert = "(";
        $valuesToInsert = "(";
        if(count($FieldsAndValuesToInsert)>0){
            $first = true;
            foreach($FieldsAndValuesToInsert as $fieldname => $valuetoinsert):
                if($first){
                    $FieldsToInsert.=$fieldname;
                    if($valuetoinsert == 'NOW()'){
                        $valuesToInsert.= "$valuetoinsert";
                    }else{
                        $valuesToInsert.= "'$valuetoinsert'";
                    }
                    $first = false;
                }else{
                    $FieldsToInsert.=", $fieldname";
                    if($valuetoinsert == 'NOW()'){
                        $valuesToInsert.= ", $valuetoinsert";
                    }else{
                        $valuesToInsert.= ", '$valuetoinsert'";
                    }
                }
            endforeach;
            $FieldsToInsert.= ")";
            $valuesToInsert.= ")";

            $sql = "INSERT INTO $TableName $FieldsToInsert VALUES $valuesToInsert";
            if($showQuery){
                echo $sql,"<br/>";
            }else{
                if($comitQuery){
                    $this->Query($sql);
                    return true;
                }
            }
        }else{
            echo "Se deben especificar los campos y los valores a insertar para cada uno de ellos";
            exit;
        }
    }
}
?>
