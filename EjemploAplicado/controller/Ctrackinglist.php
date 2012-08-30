<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cmain
 *
 * @author hadock
 */
class Ctrackinglist extends Mtrackinglist{
    public function  DefaultParams() {
        return array('MainSelected' => array(
                                            'main'      => true,
                                            'profile'   => false,
                                            'Lista'     => true,
                                            'Juegos'    => false,
                                            'Nuevo'     => false,
                                            'Exportar'  => false,
                                        ),
                     'welcome' => $this->userInfo(),
                     'lista' => $this->traejuegos(),
                     'cuentajuegos' => $this->cuentaJuegosAbiertos()
                    );
    }

    public function Css(){
        return array('file' => 'trackinglist.css');
    }

    public function Jscripts(){
        return array('file' => array('jwplayer.js','jquery.js','jquery.tabSwitch.yui.js','jquery.timers.js'));
    }
/*
    public function showResume(){
        $result = $this->selectQuery('USERS', array('COUNT(*) as usuarios'), '', '');

    }
*/
}
?>
