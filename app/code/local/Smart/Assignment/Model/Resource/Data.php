<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 14/10/2013
 * Time: 22:32
 * To change this template use File | Settings | File Templates.
 */
class Smart_Assignment_Model_Resource_Data extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct() {
        $this->_init('smart_assignment/data', 'vendor_id');
    }
}