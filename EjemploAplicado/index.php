<?php
//incluyendo controladores basicos

//Controlador encargado de manejar la estructura visual del sistema
require 'controller/Cview.php';

//controlador encargado de recibir las peticiones del cliente y procesarlas
require 'controller/CMaster.php';

// creamos una instancia del controlador principal dando como parametro
// la ruta al archivo de configuracion y los archivos a incluir para el funcionamiento del sistema
$master = new CMaster('system/config.php',
                            //funciones globales utilzadas en el sistema
                     array('system/GlobalFunctions.php',
                            // Estructura de la base de datos
                           'model/Mdbmodel.php',
                            // Manejador de la base de datos, INSERT, UPDATE, SELECT
                           'model/Mdbhandler.php',
                            // Consultas en comun para mas de 1 modulo
                           'model/Mdbconstantsquerys.php'
                     ));
$master->show();
?>