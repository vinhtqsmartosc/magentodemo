<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 16/10/2013
 * Time: 23:36
 * To change this template use File | Settings | File Templates.
 */
class Smart_Assignment_Adminhtml_VendorController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        // Let's call our initAction method which will set some basic params for each action
        $this->_initAction()
            ->renderLayout();
    }

    public function newAction()
    {
        // We just forward the new action to a blank edit form
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_initAction();

        // Get id if available
        $id  = $this->getRequest()->getParam('id');
        $model = Mage::getModel('smart_assignment/data');

        if ($id) {
            // Load record
            $model->load($id);

            // Check if record is loaded
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This vendor no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }

        $this->_title($model->getId() ? $model->getName() : $this->__('New Vendor'));

        $data = Mage::getSingleton('adminhtml/session')->getVendorData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('smart_assignment', $model);

        $this->_initAction()
            ->_addBreadcrumb($id ? $this->__('Edit Vendor') : $this->__('New Vendor'), $id ? $this->__('Edit Vendor') : $this->__('New Vendor'))
            ->_addContent($this->getLayout()->createBlock('smart_assignment/adminhtml_vendor_edit')->setData('action', $this->getUrl('*/*/save')))
            ->renderLayout();
    }

    public function deleteAction()
    {
        if($this->getRequest()->getParam('id') > 0)
        {
            try
            {
                $model = Mage::getModel('smart_assignment/data');
                $model->setId($this->getRequest()
                    ->getParam('id'))
                    ->delete();
                Mage::getSingleton('adminhtml/session')
                    ->addSuccess('successfully deleted');
                $this->_redirect('*/*/');
            }
            catch (Exception $e)
            {
                Mage::getSingleton('adminhtml/session')
                    ->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }



    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            $model = Mage::getSingleton('smart_assignment/data');
            //var_dump($postData);die;
            $model->setData($postData);

            try {
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The vendor has been saved.'));
                $this->_redirect('*/*/');

                return;
            }
            catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this vendor.'));
            }

            Mage::getSingleton('adminhtml/session')->setVendorData($postData);
            $this->_redirectReferer();
        }
    }

    public function messageAction()
    {
        $data = Mage::getModel('smart_assignmetn/data')->load($this->getRequest()->getParam('id'));
        echo $data->getContent();
    }

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('sales/smart_assignment_vendor')
            ->_title($this->__('Sales'))->_title($this->__('Vendor'))
            ->_addBreadcrumb($this->__('Sales'), $this->__('Sales'))
            ->_addBreadcrumb($this->__('Vendor'), $this->__('Vendor'));
        return $this;
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('sales/smart_assignment_vendor');
    }

    public function massDeleteAction()
    {
        $vendorIds = $this->getRequest()->getParam('vendor');
        $model = Mage::getModel('smart_assignment/data');
        if (!is_array($vendorIds)) {
            $this->_getSession()->addError($this->__('Please select vendor(s).'));
        } else {
            if (!empty($vendorIds)) {
                try {
                    foreach ($vendorIds as $vendorID) {
                        $model->load($vendorID);
                        $model->delete();
                    }
                    $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) have been deleted.', count($vendorIds))
                    );
                } catch (Exception $e) {
                    $this->_getSession()->addError($e->getMessage());
                }
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massStatusAction()
    {
        $vendorIds = (array)$this->getRequest()->getParam('vendor');
        $statusActive = (int)$this->getRequest()->getParam('status');
        try {

            $model = Mage::getModel('smart_assignment/data');
            foreach ($vendorIds as $vendorID) {
                $model->load($vendorID);
                $model->setIsActive($statusActive);
                $model->save();
            }

            $this->_getSession()->addSuccess(
                $this->__('Total of %d record(s) have been updated.', count($vendorIds))
            );
        }
        catch (Mage_Core_Model_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Mage_Core_Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        } catch (Exception $e) {
            $this->_getSession()
                ->addException($e, $this->__('An error occurred while updating the vendor(s) status.'));
        }

        $this->_redirect('*/*/');
    }
}