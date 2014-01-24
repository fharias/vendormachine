<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ServersController extends AppController {

    public $components = array(
        'RequestHandler',
        'Rest.Rest' => array(
            'catchredir' => true, // Recommended unless you implement something yourself
            'debug' => 0,
            'actions' => array(
                'view' => array(
                    'extract' => array('server.Server' => 'servers.0'),
                ),
                'index' => array(
                    'extract' => array('rows.{n}.Server' => 'servers'),
                ),
            ),
        ),
    );

    /**
     * Shortcut so you can check in your Controllers wether
     * REST Component is currently active.
     *
     * Use it in your ->flash() methods
     * to forward errors to REST with e.g. $this->Rest->error()
     *
     * @return boolean
     */
    protected function _isRest() {
        return !empty($this->Rest) && is_object($this->Rest) && $this->Rest->isActive();
    }

}

?>
