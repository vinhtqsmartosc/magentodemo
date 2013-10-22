<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 22/10/2013
 * Time: 15:23
 * To change this template use File | Settings | File Templates.
 */
class Smart_Vendor_Block_Adminhtml_Vendor extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct(){
        $this->_blockGroup = 'smart_vendor';
        $this->_controller = 'adminhtml_vendor';
        $this->_headerText = 'Vendor Management';

        parent::__construct();
    }
}