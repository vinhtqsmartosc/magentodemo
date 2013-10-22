<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 14/10/2013
 * Time: 18:17
 * To change this template use File | Settings | File Templates.
 */
class Smart_Assignment_Model_Vendors extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {

        if (is_null($this->_options)) {
            $result = array();
            $result[] = array(
                'label' => '-- Please Select --',
                'value' => ''
            );
            $colection = Mage::getModel('smart_assignment/data')->getCollection();
            if($colection){
                foreach($colection as $vendor){
                    $result[] = array(
                        'label' => $vendor->getName(),
                        'value' => $vendor->getId()
                    );
                }
            }
            $this->_options = $result;

        }
        return $this->_options;
    }
}