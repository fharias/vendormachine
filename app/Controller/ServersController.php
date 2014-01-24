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
        $this->set('response',  compact('data'));
    }

    function image($item) {
        $this->layout = null;
        $this->loadModel('ItemImage');
        $data = $this->ItemImage->find('first', 
                array(
                    'conditions' => 
                        array('Code' => $item)
                ));
        $this->set('data', $this->hextostr($data['ItemImage']['Picture']));
    }

    protected function hextostr($x) {
        $s = '';
        foreach (explode("\n", trim(chunk_split($x, 2))) as $h)
            $s.=chr(hexdec($h));
        return($s);
    }

}

?>
