<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Item extends AppModel{
    public $useTable = 'Item';
    public $primaryKey = 'Code';
    public $hasOne = array(
        'ItemImage' => array(
			'className' => 'ItemImage',
			'foreignKey' => 'Code',
			
		)
    );
}
?>
