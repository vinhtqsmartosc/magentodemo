<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 14/10/2013
 * Time: 22:33
 * To change this template use File | Settings | File Templates.
 */
class Smart_Assignment_Model_Resource_Data_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {
    protected function _construct() {
        $this->_init('smart_assignment/data');
    }
}