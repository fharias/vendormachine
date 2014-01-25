<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ServersController extends AppController {

    public $components = array('RequestHandler');

    function index() {
        $this->loadModel('Bin');
        $data = $this->Bin->find('all');
        $this->set(array(
            'response' => $data,
            '_serialize' => array('response')
        ));
    }

    function categories() {
        CakeLog::debug("ENTRANDO");
        $this->loadModel('Item');
        $data = $this->Item->find('all',array(
                    'fields'=>array('Code', 'Description1', 'Cost')
                    ));
        $this->set('response',  $data);
    }

    function image($item) {
        $this->layout = null;
        $this->loadModel('ItemImage');
        $data = $this->ItemImage->find('first', 
                array(
                    'conditions' => 
                        array('Code' => $item)
                ));
        $bytes = hex2bin($data['ItemImage']['Picture']);
        $data = base64_encode($bytes);
        $this->set('data', $data);
    }
    
    function imageitem($item) {
        $this->layout = null;
        $this->loadModel('ItemImage');
        $data = $this->ItemImage->find('first', 
                array(
                    'conditions' => 
                        array('Code' => $item)
                ));
        $bytes = hex2bin($data['ItemImage']['Picture']);
        $data = base64_encode($bytes);
        $this->set('data', $data);
    }

    protected function hextostr($x) {
        $s = '';
        foreach (explode("\n", trim(chunk_split($x, 2))) as $h)
            $s.=chr(hexdec($h));
        return($s);
    }

}

?>
