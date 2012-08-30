<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cnews
 *
 * @author hadock
 */
class Cnews {
    public function  DefaultParams() {
        //$this->use_thirdPartyApp();
        return array('MainSelected' => array(
                                            'home'      => false,
                                            'catalog'   => false,
                                            'us'        => false,
                                            'services'  => false,
                                            'clients'   => false,
                                            'projects'  => false,
                                            'quote'     => false,
                                            'news'      => true,
                                            'contactus' => false,
                                            'intranet'  => false,
                                        ),
                      'news'        => $this->getFeed('http://feeds.feedburner.com/fayerwayer')
                    );
    }

    public function use_thirdPartyApp(){
        return array('Abs_Xml_Rss/AbsRssReader20/class.AbsRssReader20.php');
    }

    public function getFeed($feedUrl){
        $xml = new AbsRssReader20();
        $xml->Load($feedUrl);
        return $xml->GetItems();
    }

    public function Css(){
        return array('file' => 'news.css');
    }

    public function Jscripts(){
        return array('file' => array('jquery.jgfeed-min.js', 'news.js'));
    }
}
?>
