<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cview
 *
 * @author hadock
 */
class Cview {
    protected $script = array();
    protected $loadtopmenu = false;
    protected $loadsidemenu = false;
    protected $css = array();

    protected function loadlogin($viewname, $pathdir ,$params){
        $this->loadhead($pathdir);
        include $viewname;
    }

    protected function loadhead($pathdir){
        if(file_exists($pathdir.'Vheader.php')){
            $scripts = $this->script;
            $css = $this->css;
            include $pathdir.'Vheader.php';
        }
    }

    protected function loadfooter($pathdir){
        if(file_exists($pathdir.'Vfooter.php')){
            include $pathdir.'Vfooter.php';
        }
    }
    public function addCss($css){
        if(is_array($css)){
            foreach($css as $key => $value):
                if(is_array($value)){
                    foreach($value as $val):
                        if($key == 'file'){
                            $this->css[] = '<link rel="stylesheet" type="text/css" href="'._THEME_DIRNAME_.'css/'.$val.'" />';
                        }else{
                            $this->css[] = '<style type="text/css" >'.$val.'</style>';
                        }
                    endforeach;
                }else{
                    if($key == 'file'){
                        $this->css[] = '<link rel="stylesheet" type="text/css" href="'._THEME_DIRNAME_.'css/'.$value.'" />';
                    }else{
                        $this->css[] = '<style type="text/css" >'.$value.'</style>';
                    }
                }
            endforeach;
        }
    }
    public function addScript($script){
        if(is_array($script)){
            foreach($script as $key => $value):
                if(is_array($value)){
                    foreach($value as $val):
                        if($key == 'file'){
                            $this->script[] = '<script type="text/javascript" src="'._THEME_DIRNAME_.'js/'.$val.'"></script>';
                        }else{
                            $this->script[] = '<script language="Javascript" type="text/javascript">'.$val.'</script>';
                        }
                    endforeach;
                }else{
                    if($key == 'file'){
                        $this->script[] = '<script type="text/javascript" src="'._THEME_DIRNAME_.'js/'.$value.'"></script>';
                    }else{
                        $this->script[] = '<script language="Javascript" type="text/javascript">'.$value.'</script>';
                    }
                }
            endforeach;
        }
    }

    public function jsonResponse($params){
        echo json_encode($params);
    }

    protected function loadajaxResponse($pathdir, $response){
        if(file_exists($pathdir.'Vajaxresponse.php')){
            include $pathdir.'Vajaxresponse.php';
        }
    }

    public function TopMenu($pathdir, $params){
        if(file_exists($pathdir.'Vtopmenu.php')){
            include $pathdir.'Vtopmenu.php';
        }
    }
    
    public function SideBar($pathdir, $params){
        if(file_exists($pathdir.'Vleftsidebar.php')){
            include $pathdir.'Vleftsidebar.php';
        }
    }

    public function loadPlataform($content, $pathdir ,$params){
        $this->loadhead($pathdir);
        $this->TopMenu($pathdir, $params);
        $this->SideBar($pathdir, $params);
        if(file_exists($content)){
            include $content;
        }
        $this->loadfooter($pathdir);
    }
}
?>
