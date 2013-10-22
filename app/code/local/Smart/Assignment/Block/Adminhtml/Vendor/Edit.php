<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 16/10/2013
 * Time: 23:29
 * To change this template use File | Settings | File Templates.
 */
class Smart_Assignment_Block_Adminhtml_Vendor_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'smart_assignment';
        $this->_controller = 'adminhtml_vendor';

        parent::__construct();

        $this->_updateButton('save', 'label', $this->__('Save Vendor'));
        $this->_updateButton('delete', 'label', $this->__('Delete Vendor'));
    }

    public function getHeaderText()
    {
        if (Mage::registry('smart_assignment')->getId()) {
            return $this->__('Edit Vendor');
        }
        else {
            return $this->__('New Vendor');
        }
    }
}