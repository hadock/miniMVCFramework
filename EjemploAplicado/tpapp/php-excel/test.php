<?php

// load library
require 'php-excel.class.php';

// create a simple 2-dimensional array
$style = array("header" => 
                           array(
                                  "font" => array(
                                                    "size" => "14",
                                                    "bold","underline"
                                                 ),
                                  "border" => array(
                                                    array(
                                                            "position"  => "Left",
                                                            "linestyle" =>"Continuous",
                                                            "Weight"    =>"1",
                                                            "Color"     =>"#000000"
                                                         )
                                                   )
                                )
              );
$data = array(
		"header" => array ('Columna 1', "Columna 2", 'Columna 3'),
		"1" => array("2010", 'Dato 2', 'Dato 3'),
		"2" => array('Dato 4', 'Dato 5')
        );

// generate file (constructor parameters are optional)
$xls = new Excel_XML('UTF-8', true, 'My Test Sheet');
$xls->addArray($data);
$xls->generateXML('my-test');

?>
