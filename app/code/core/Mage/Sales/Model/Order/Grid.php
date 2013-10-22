<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 15/10/2013
 * Time: 17:19
 * To change this template use File | Settings | File Templates.
 */
class Mage_Sales_Model_Order_Grid extends Mage_Core_Model_Abstract {
    protected function _construct() {
        $this->_init('sales/order_grid');
    }
}