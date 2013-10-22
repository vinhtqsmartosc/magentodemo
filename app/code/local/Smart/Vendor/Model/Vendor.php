<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 22/10/2013
 * Time: 15:06
 * To change this template use File | Settings | File Templates.
 */
class Smart_Vendor_Model_Vendor extends Mage_Core_Model_Abstract
{
    protected function _construct(){
        $this->_init('smart_vendor/vendor');
    }    
}