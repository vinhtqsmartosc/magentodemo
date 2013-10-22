<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 15/10/2013
 * Time: 07:41
 * To change this template use File | Settings | File Templates.
 */
class Smart_Assignment_Block_Show extends Mage_Core_Block_Template {
    protected function _construct() {
        $this->setTemplate('assignment/main.phtml');
    }

    public function getVendorCollection() {
        $configVendor = Mage::getStoreConfig('vendor/active_vendor/is_active');
        if($configVendor == '0') {
            $colection = Mage::getModel('smart_assignment/data')->getCollection()
                ->addFieldToFilter('is_active', array('eq' => 1));

        } else {
            $colection = Mage::getModel('smart_assignment/data')->getCollection();
        }
        return $colection;

    }

    public function getProductByAttr() {

        $vendor = Mage::registry('vendor');
        $collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('vendors_ids', $vendor);
        if(count($collection) > 0)
            return $collection;
        else return null;
    }
}