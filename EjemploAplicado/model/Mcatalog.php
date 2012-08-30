<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mcatalog
 *
 * @author hadock
 */
class Mcatalog extends Mdbconstantsquerys {
    public function getCatParentList(){
        return $this->selectQuery('llx_categorie', array('*'), array(
                                                                        'AND' => array('rowid in (SELECT a.fk_categorie FROM llx_categorie_product a, llx_product b WHERE b.rowid = a.fk_product AND b.finished = "1" AND b.label<>"" AND b.note <> "")')
                                                                    ),
                                                               array('ASC' => array('label')));
    }

    public function getProductsList($cat=0){
        if(!$cat){
            return $this->selectQuery('llx_product', array('*'),
                                        array('AND' =>
                                                array(
                                                      "finished = '1'",
                                                      "label <> ''",
                                                      "note <> ''"
                                                     )
                                             ) ,array('ASC' => array('description'))
                                     );
            return $this->Query($query);
        }else{
            return $this->selectQuery('llx_categorie_product cp, llx_product p',
                                        array('p.rowid', 'p.label', 'p.note', 'p.note as image'),
                                        array('AND' =>
                                                array(
                                                      "p.finished = '1'",
                                                      "cp.fk_categorie = $cat",
                                                      "p.label <> ''",
                                                      "p.note <> ''",
                                                      "p.rowid = cp.fk_product"
                                                      )
                                                     ),
                                        array('ASC' => array('description'))
                                     );
        }
    }
}
?>
