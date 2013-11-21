<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 18/11/2013
 * Time: 09:12
 * To change this template use File | Settings | File Templates.
 */
class Smart_Vendor_Block_Adminhtml_Renderer_Custom extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row){
        $value =  $row->getData($this->getColumn()->getIndex());
        $color_value = Mage::getStoreConfig('vendor/grid_color_setting/color');
        if($color_value)
            $_code_html = '<span style="color: #'.$color_value.'; font-weight:bold;">'.$value.'</span>';
        else
            $_code_html = '<span style="font-weight:bold;">'.$value.'</span>';
        return $_code_html;
    }
}