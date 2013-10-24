<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 16/10/2013
 * Time: 23:21
 * To change this template use File | Settings | File Templates.
 */
class Smart_Assignment_Block_Adminhtml_Vendor_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('vendor_id');
        $this->setId('smart_assignment_vendor_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('smart_assignment/data_collection');
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        // Add the columns that should appear in the grid
        $this->addColumn('vendor_id',
            array(
                'header'=> $this->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'type'  => 'number',
                'index' => 'vendor_id'
            )
        );

        $this->addColumn('name',
            array(
                'header'=> $this->__('Name'),
                'index' => 'name'
            )
        );

        $this->addColumn('is_active',
            array(
                'header'=> $this->__('Is Active'),
                'width' => '50px',
                'index' => 'is_active',
                'type' => 'options',
                'options' => array (
                    '1' => 'Enabled','0' => 'Disabled'
                )
            )
        );

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('vendor_id');
        $this->getMassactionBlock()->setFormFieldName('vendor');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> $this->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete'),
            'confirm' => $this->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('is_active', array(
            'label'=> Mage::helper('smart_assignment')->__('Change activation'),
            'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
            'additional' => array(
                'visibility' => array(
                    'name'      => 'status',
                    'type'      => 'select',
                    'class'     => 'required-entry',
                    'label'     => $this->__('Is Active'),
                    'values'    => array(
                        1       => $this->__('Enabled'),
                        0       => $this->__('Disabled'),
                    ),
                )
            )
        ));


        return $this;
    }

    public function getRowUrl($row)
    {
        // This is where our row data will link to
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}