<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 16/10/2013
 * Time: 23:17
 * To change this template use File | Settings | File Templates.
 */
class Smart_Assignment_Block_Adminhtml_Vendor extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'smart_assignment';
        $this->_controller = 'adminhtml_vendor';
        $this->_headerText = $this->__('Vendor');

        parent::__construct();
    }
}