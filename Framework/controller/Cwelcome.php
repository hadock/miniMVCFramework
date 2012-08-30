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
class Cwelcome{
    public function  DefaultParams() {
        return array('MainSelected' => array(
                                            'home'      => true,
                                            'catalog'   => false,
                                            'us'        => false,
                                            'services'  => false,
                                            'clients'   => false,
                                            'projects'  => false,
                                            'quote'     => false,
                                            'news'      => false,
                                            'contactus' => false,
                                            'intranet'  => false,
                                        )
                    );
    }

    public function Css(){
        return array('file' => 'welcome.css');
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
