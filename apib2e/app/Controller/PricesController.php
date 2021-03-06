<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 08/12/15
 * Time: 17:35
 */



class PricesController extends AppController {
    public function index() {
        $this->loadModel('Cepage');
        $this->loadModel('Vin');
        $this->loadModel('Origine');
        $this->loadModel('Price');
        $cepages=$this->Cepage->find('all');
        $origines=$this->Origine->find('all');
        $vins=$this->Vin->find('all');
        $this->set('vins',$vins);
        $this->set('origines',$origines);
        $this->set('cepages',$cepages);

        /*if($this->request->is('post')) {
            if($this->request->data['selectedOrigine'] || $this->request->data['selectedCepage']) {
                $vins=$this->Vin->findAllByOrigineIdOrCepageId($this->request->data['selectedOrigine'],$this->request->data['selectedCepage']);
                $this->set('vins',$vins);
            }
        }*/
    }

    public function addvin() {
        if($this->request->is('post')) {
            $this->loadModel('Vin');
            $this->loadModel('Comment');
            $vin=$this->request->data['Vin'];
            if($this->Vin->save($vin)) {
                $comment= array();
                $comment['Comment']['vin_id']=$this->Vin->id;
                $comment['Comment']['commentaire']='';
                $this->Comment->save($comment);
                $this->redirect('/prices');
            }
        }
    }

    public function deleteVin($id) {
        $this->loadModel('Vin');
        $this->Vin->delete($id);
        $this->redirect('/prices');

    }

    public function savePrices() {
        $this->loadModel('Vin');
        $this->loadModel('Price');
        $this->loadModel('Comment');
        foreach($this->request->data['vins'] as $vin) {
            $this->Price->create();
            $now = new DateTime();
            $vin['Vin']['Price']['vin_id']=$vin['Vin']['id'];
            $vin['Vin']['Price']['date_price']=$now->format('Y-m-d H:i:s');// MySQL datetime format
            $this->Price->save($vin['Vin']['Price']);
            $id = $this->Price->id;
            $this->Price->clear();
            unset($vin['Vin']['Price']);
            $vin['Vin']['price_id']=$id;

            if($comment=$this->Comment->findByVinId($vin['Vin']['id'])) {
                $comment['Comment']['commentaire']=$vin['Vin']['Comment']['commentaire'];
                $this->Comment->save($comment);

            } else {
                $comment['Comment']['vin_id']=$vin['Vin']['id'];
                $comment['Comment']['commentaire']=$vin['Vin']['Comment']['commentaire'];
                $this->Comment->save($comment);

            }
            var_dump($vin['Vin']['Comment']['commentaire']);
            $this->Vin->save($vin['Vin']);
        }
        $this->redirect('/prices');
    }
}