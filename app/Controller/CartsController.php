<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CartsController extends AppController {

    public $components = array('RequestHandler');

    public function add($uuid, $sku) {
        $this->loadModel('Cart');
        $this->loadModel('CartItem');
        $cart = $this->Cart->find('first', array('conditions' => array('uuid' => $uuid, 'state' => '1')));
        if (!$cart) {
            $data = array();
            $data['Cart']['uuid'] = $uuid;
            $this->Cart->save($data);
            $id = $this->Cart->getLastInsertId();
        } else {
            $id = $cart['Cart']['id'];
        }
        $itemCart = $this->CartItem->find('first', array('conditions' => array('cart_id' => $id, 'ItemCode' => $sku)));
        if (!$itemCart) {
            $data = array();
            $data['CartItem']['cart_id'] = $id;
            $data['CartItem']['ItemCode'] = $sku;
            $data['CartItem']['Cantidad'] = 1;
            $this->CartItem->save($data);
        } else {
            $this->CartItem->updateAll(array('Cantidad' => $itemCart['CartItem']['Cantidad'] + 1), array('cart_id' => $id, 'ItemCode' => $sku));
        }
        $response = new Object();
        $response->state = 'OK';
        $response->message = 'PROCESO EXITOSO';
        $this->set('response', $response);
    }

    public function show($uuid) {
        $this->loadModel('Cart');
        $cart = $this->Cart->query("select a.*, b.*, c.Description1, c.Description2, c.Cost from Cart a, CartItem b, Item c where a.id = b.cart_id and c.Code = b.ItemCode and a.uuid = '" . $uuid . "' and a.state=1");
        $cartObject = array();
        foreach ($cart as $c) {
            $cartObject[]['Item'] = $c[0];
        }
        $this->set('response', $cartObject);
    }

    public function checkout($uuid, $vendorcode, $factura, $pincajero) {
        $this->loadModel('Cart');
        $this->loadModel('CartItem');
        $this->loadModel('Job');
        $this->loadModel('JobItem');
        $cart = $this->Cart->find('first', array('conditions' => array('uuid' => $uuid, 'state' => '1')));
        $id = $cart['Cart']['id'];
        $items = $this->CartItem->find(
                'all', array(
            'conditions' =>
            array('cart_id' => $id)
                )
        );
        $jobId = mt_rand(1000, 999999);
        $data = array();
        $data['Job']['MyNo'] = $jobId;
        $data['Job']['Description'] = $factura;
        $data['Job']['Active'] = 1;
        $data['Job']['Notes'] = $vendorcode;
        $this->Job->save($data);
        foreach ($cart as $c) {
            $data = array();
            $data['JobItem']['MyNo'] = $jobId;
            $data['JobItem']['ItemCode'] = $c['Code'];
            $data['JobItem']['QtyReq'] = $c['Cantidad'];
            $data['JobItem']['Description'] = $c['Description1'];
            $this->JobItem->save($data);
        }
        $this->Cart->updateAll(array('state' => 2, 'vendor'=>$vendorcode, 'cashier'=>$pincajero, 'void'=>$factura), array('uuid' => $uuid));
        $response = new Object();
        $response->state = 'OK';
        $response->message = 'PROCESO EXITOSO';
        $response->codigo = $jobId;
        $this->set('response', $response);
    }
    
    public function lastpurchases($uuid){
        $this->loadModel('Cart');
        $cart = $this->Cart->query("select a.*, b.*, c.Description1, c.Description2, c.Cost from Cart a, CartItem b, Item c where a.id = b.cart_id and c.Code = b.ItemCode and a.uuid = '" . $uuid . "' and a.state=2");
        $cartObject = array();
        foreach ($cart as $c) {
            $cartObject[]['Item'] = $c[0];
        }
        $this->set('response', $cartObject);
    }

    public function cancel($uuid) {
        $this->loadModel('Cart');
        $this->Cart->updateAll(array('state' => 3), array('uuid' => $uuid));
        $response = new Object();
        $response->state = 'OK';
        $response->message = 'CANCELADA SU COMPRA';
        $this->set('response', $response);
    }

}

?>
