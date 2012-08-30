<?php
require_once 'config.php';

$dbConn = mysql_connect ($dbHost, $dbUser, $dbPass) or die ('<br><strong>A ocurrido un error en la conexion a la base de datos, verificar.</strong><br>. El error que arroja el motor es el siguiente: <br>' . mysql_error());
mysql_select_db($dbName) or die('<br><strong>No se puede seleccionar la base de datos, compruebe que existe y que el nombre est&eacute; bien escrito</strong><br>. El error que arroja el motor es el siguiente: <br>' . mysql_error());

//################## FIN DE FUNCIONES PARA EL SERVIDOR  SQL SERVER #####################//

function dbConsultaSegura($string){
        return mysql_real_escape_string($string);
}

function dbConsulta($sql)
{
	$result = mysql_query($sql) or die(mysql_error());
	
	return $result;
}

function dbFilasAfectadas()
{
	global $dbConn;
	
	return mysql_affected_rows($dbConn);
}

function dbOrdenaArreglo($result, $resultType = MYSQL_NUM) {
	return mysql_fetch_array($result, $resultType);
}

function dbFetchAssoc($result)
{
	return mysql_fetch_assoc($result);
}

function dbFetchRow($result) 
{
	return mysql_fetch_row($result);
}

function dbFreeResult($result)
{
	return mysql_free_result($result);
}

function dbNumRows($result)
{
	return mysql_num_rows($result);
}

function dbSelect($dbName)
{
	return mysql_select_db($dbName);
}

function dbInsertId()
{
	return mysql_insert_id();
}
?>
