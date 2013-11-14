<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 22/10/2013
 * Time: 15:42
 * To change this template use File | Settings | File Templates.
 */
class Smart_Vendor_Block_Adminhtml_Vendor_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct(){
        parent::__construct();

        $this->setId('smart_vendor_vendor_form');
        $this->setTitle($this->__('Vendor Information'));
    }

    protected function _prepareForm(){
        $model = Mage::registry('smart_vendor');

        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method'    => 'post'
        ));

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'    => Mage::helper('checkout')->__('Vendor Information'),
            'class'     => 'fieldset-wide',
        ));

        if ($model->getId()) {
            $fieldset->addField('vendor_id', 'hidden', array(
                'name' => 'vendor_id',
            ));
        }

        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => $this->__('Name'),
            'title'     => $this->__('Name'),
            'required'  => true,
        ));

        $fieldset->addField('description', 'textarea', array(
            'name'      => 'description',
            'label'     => $this->__('Description'),
            'title'     => $this->__('Description'),
            'required'  => true,
        ));

        $fieldset->addField('is_active', 'select', array(
            'name'      => 'is_active',
            'label'     => $this->__('Is Active'),
            'title'     => $this->__('Is Active'),
            'required'  => true,
            'values'    => Mage::getModel('adminhtml/system_config_source_yesno')->toOptionArray(),
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}