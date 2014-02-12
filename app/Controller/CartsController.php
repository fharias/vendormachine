<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class CartsController extends AppController{
    
    public $components = array('RequestHandler');
    
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
        $itemCart = $this->CartItem->find('first', array('conditions'=>array('cart_id'=>$id, 'ItemCode'=>$sku)));
        if(!$itemCart){
            $data = array();
            $data['CartItem']['cart_id'] = $id;
            $data['CartItem']['ItemCode'] = $sku;
            $data['CartItem']['Cantidad'] = 1;
            $this->CartItem->save($data);
        }else{
            $this->CartItem->updateAll(array('Cantidad' => $itemCart['CartItem']['Cantidad']+1),array('cart_id'=>$id, 'ItemCode'=>$sku));
        }
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
