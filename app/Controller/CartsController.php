<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class CartsController extends AppController{
    
    public function add($uuid, $sku){
        $this->loadModel('Cart');
        $this->loadModel('CartItem');
        $cart = $this->Cart->find('first', array('conditions'=>array('uuid'=>$uuid, 'state'=>'1')));
        if(!$cart){
            $data = array();
            $data['Cart']['uuid'] = $uuid;
            $data['Cart']['registerdate'] = date('Y-m-d H:i:s');
            $this->Cart->save($data);
            $id = $this->Cart->getLastInsertId();
        }else{
            $id = $cart['Cart']['id'];
        }
        $data = array();
        $data['CartItem']['cart_id'] = $id;
        $data['CartItem']['ItemCode'] = $sku;
        $data['CartItem']['cantidad'] = 1;
        $this->Cart->save($data);
        $response = new Object();
        $response->state = 'OK';
        $response->message = 'PROCESO EXITOSO';
        $this->set('response', $response);
    }
    
    public function show($uuid){
        
    }
    
    public function checkout($uuid, $vendorcode, $factura){
        
    }
}
?>
