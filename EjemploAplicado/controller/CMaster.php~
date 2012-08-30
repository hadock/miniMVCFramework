<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CMaster
 *
 * @author hadock
 */
class CMaster extends Cview {
    public $methods = array();
    public function  __construct($configFile, $includes = array()) {
        if(file_exists($configFile)){
            require $configFile;
            if(count($includes)>0){
                foreach($includes as $fileroute):
                    require $fileroute;
                endforeach;
            }
        }else{
            echo 'no se a especificado un archivo de configuracion o la ruta a este no se encuentra';
        }
    }
    public function  use_thirdPartyApp($file_to_Include = array()) {
            if(count($file_to_Include)>0){
                foreach($file_to_Include as $fileroute):
                    require TPAPP.'/'.$fileroute;
                endforeach;
            }
    }
    public function  show() {
        //defino el nombre del controlador con la vista del mismo nombre
        //pregunto, si existe algun controlador que cargar.. de no existir niguno
        //por defecto cargo el index como principal
        if(isset ($_GET['load'])){
            $controller = 'C'.$_GET['load'];
            $viewname = 'V'.$_GET['load'];
            $model = 'M'.$_GET['load'];
        }else{
            $controller = 'Cwelcome';
            $viewname = 'Vwelcome';
            $model = "Mdbhandler";
        }
        switch ($controller){
            case '':
                $this->loadController($model,$controller, $viewname);
                break;
            default:
                $this->loadController($model,$controller, $viewname);
                break;
        }
    }
    //Funcion que carga el controlador a utilizar
    private function loadController($model,$controller, $viewname){
        if(file_exists('controller/'.$controller.'.php')){
            
            //si existe un modelo implementado para este controlador, lo cargo
            //siendo este modelo necesariamente la extension de Mdbhandler
            if(file_exists('model/'.$model.'.php')&&$model!='Mdbhandler'){
                require 'model/'.$model.'.php';
            }

            require 'controller/'.$controller.'.php';
            $this->methods[$controller] = new $controller;
            $params = "";
            $this->use_thirdPartyApp($this->loadMethod($controller, 'use_thirdPartyApp'));
            if(isset($_GET['action'])){
                //recibo respuesta del metodo en caso de responder algo
                $params = $this->loadMethod($controller,$_GET['action']);
            }else{
                $params = $this->loadMethod($controller, 'DefaultParams');
            }

            //siempre y cuando exista una vista html para el controlador y no sea una
            //peticion ajax, cargo la que tiene el mismo nombre del controlador
            if(file_exists(_THEME_DIRNAME_.$viewname.'.php')&& !isset($_GET['ajaxRequest'])){
                //Pregunto si el controlador tiene un metodo para javascript
                // de tenerlo, es porque necesita ejecutar algunos por tanto los cargo
                $this->addScript($this->loadMethod($controller, 'Jscripts'));
                $this->addCss($this->loadMethod($controller, 'Css'));
                if($controller == 'Clogin'){
                    $this->loadlogin(_THEME_DIRNAME_.$viewname.'.php');
                }else{
                    if(isset($_GET['extraview'])){
                        if(file_exists(_THEME_DIRNAME_.$_GET['extraview'].'.php')){
                            $this->loadPlataform(_THEME_DIRNAME_.$_GET['extraview'].'.php',_THEME_DIRNAME_, $params);
                        }
                    }else{
                        $this->loadPlataform(_THEME_DIRNAME_.$viewname.'.php',_THEME_DIRNAME_, $params);
                    }
                }
            }
            
        }else{
            echo 'El archivo no existe';
            exit;
        }
    }
    //Funcion que me carga el metodo a utilizar de controlador seleccionado
    private function loadMethod($classname, $methodname){
        if(method_exists($this->methods[$classname], $methodname)){
            if(!isset ($_GET['ajaxRequest'])){
                return $this->methods[$classname]->$methodname();
            }else{
                if(!isset($_GET['extraview'])){
                    $this->loadajaxResponse(_THEME_DIRNAME_,$this->methods[$classname]->$methodname());
                }else{
                    $this->loadajaxResponse(_THEME_DIRNAME_,$this->methods[$classname]->$methodname($_GET['extraview']));
                }
            }
        }
    }
    //Funcion que me carga la vista del controlador seleccionado
    protected function loadlogin($viewfile, $params = '', $params2 = false){
        parent::loadlogin($viewfile, _THEME_DIRNAME_ ,$params);
    }

}
?>
