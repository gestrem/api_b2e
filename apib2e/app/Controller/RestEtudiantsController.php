<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 07/12/15
 * Time: 17:32
 */

App::uses('Model','Etudiant');
App::import('Controller', 'Rest');

class RestVinsController extends RestController{
    public $uses = array('Etudiant');



    public function all_students() {
            $etudiant = $this->Etudiant->find('all',array('recursive'=>0));

            $this->set(array(
                'etudiant'=>$etudiant,

                '_serialize' => array('etuidant')
            ));
    }
}
