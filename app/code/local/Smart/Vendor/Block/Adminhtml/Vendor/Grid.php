<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 22/10/2013
 * Time: 15:26
 * To change this template use File | Settings | File Templates.
 */
class Smart_Vendor_Block_Adminhtml_Vendor_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct(){
        parent::__construct();

        $this->setDefaultSort('vendor_id');
        $this->setId('smart_vendor_vendor_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection(){
        $vendorCollection = Mage::getModel('smart_vendor/vendor')->getCollection();
        $this->setCollection($vendorCollection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns(){
        $this->addColumn('vendor_id',
            array(
                'header'    =>  $this->__('Vendor ID'),
                'align'     =>  'right',
                'width'     =>  '50px',
                'index'     =>  'vendor_id',
                'type'      =>  'number'
            )
        );

        $this->addColumn('name',
            array(
                'header'    =>  $this->__('Vendor Name'),
                'index'     =>  'name',
            )
        );

        $this->addColumn('is_active',
            array(
                'header'    =>  $this->__('Is Active'),
                'width'     =>  '100px',
                'index'     =>  'is_active',
                'type'      =>  'options',
                'options'   =>  array(
                    1 => 'Enabled',
                    0 => 'Disabled',
                )
            )
        );

        return parent::_prepareColumns();
    }

    public function getRowUrl($row){
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}