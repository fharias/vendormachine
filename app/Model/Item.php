<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Item extends AppModel{
    public $useTable = 'Item';
    public $hasOne = array(
        'Itemimage' => array(
			'className' => 'Itemimage',
			'foreignKey' => 'Code',
			
		)
    );
}
?>
