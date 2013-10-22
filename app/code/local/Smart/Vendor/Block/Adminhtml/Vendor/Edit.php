<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 22/10/2013
 * Time: 15:37
 * To change this template use File | Settings | File Templates.
 */
class Smart_Vendor_Block_Adminhtml_Vendor_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct(){
        $this->_blockGroup = 'smart_vendor';
        $this->_controller = 'adminhtml_vendor';
        
        parent::__construct();

        $this->_updateButton('save', 'label', $this->__('Save Vendor'));
        $this->_updateButton('delete', 'label', $this->__('Delete Vendor'));
    }

    public function getHeaderText(){
        if(Mage::registry('smart_vendor')->getId()) {
            return $this->__('Edit Vendor');
        }
        else {
            return $this->__('New Vendor');
        }
    }

}