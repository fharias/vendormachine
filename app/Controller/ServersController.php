<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ServersController extends AppController {
    public $components = array('RequestHandler');
    function index(){
        $this->loadModel('Bin');
        $data = $this->Bin->find('all');
        $this->set(array(
            'response' => $data,
            '_serialize' => array('response')
        ));
    }
    
}

?>
