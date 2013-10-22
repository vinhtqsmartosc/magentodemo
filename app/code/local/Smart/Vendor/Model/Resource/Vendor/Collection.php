<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 22/10/2013
 * Time: 15:10
 * To change this template use File | Settings | File Templates.
 */
class Smart_Vendor_Model_Resource_Vendor_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct(){
        $this->_init('smart_vendor/vendor');
    }
}