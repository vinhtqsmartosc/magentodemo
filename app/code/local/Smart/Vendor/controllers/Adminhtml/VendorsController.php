<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 22/10/2013
 * Time: 17:25
 * To change this template use File | Settings | File Templates.
 */
class Smart_Vendor_Adminhtml_VendorsController extends Mage_Adminhtml_Controller_Action
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

    public function deleteAction()
    {
        try {

            $vendorID = $this->getRequest()->getParam('id');
            $model = Mage::getModel('smart_vendor/vendor');

            $model->load($vendorID);
            $model->delete();
            $model->save();

            Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Delete Successfully.'));
            $this->_redirect('*/*/');
        }
        catch (Mage_Core_Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while deleting this vendor.'));
        }

    }
    
    public function editAction()
    {
        $this->_initAction();

        // Get id if available
        $id  = $this->getRequest()->getParam('id');
        $model = Mage::getModel('smart_vendor/vendor');

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

        Mage::register('smart_vendor', $model);

        $this->_initAction()
            ->_addBreadcrumb($id ? $this->__('Edit Vendor') : $this->__('New Vendor'), $id ? $this->__('Edit Vendor') : $this->__('New Vendor'))
            ->_addContent($this->getLayout()->createBlock('smart_vendor/adminhtml_vendor_edit')->setData('action', $this->getUrl('*/*/save')))
            ->renderLayout();
    }

    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            $model = Mage::getSingleton('smart_vendor/vendor');
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

    public function multiDeleteAction()
    {
        $vendorIDs = $this->getRequest()->getParam('vendor');
        $model = Mage::getModel('smart_vendor/vendor');
        try {
            foreach ($vendorIDs as $vendorID) {

                $model->load($vendorID);
                $model->delete();
                $model->save();
            }
            Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Delete Successfully.'));

        }
        catch (Mage_Core_Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while deleting vendor(s).'));
        }

        $this->_redirect('*/*/');
    }

    public function multiChangeActiveAction()
    {
        $vendorsID = $this->getRequest()->getParam('vendor');
        $is_active = (int) $this->getRequest()->getParam('is_active');
        $model = Mage::getModel('smart_vendor/vendor');
        try {
            foreach ($vendorsID as $vendorID) {
                $model->load($vendorID);
                $model->setIsActive($is_active);
                $model->save();
            }
            $this->_getSession()->addSuccess(
                $this->__('Total of %d record(s) have been updated.', count($vendorsID))
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

    public function messageAction()
    {
        $data = Mage::getModel('smart_vendor/vendor')->load($this->getRequest()->getParam('id'));
        echo $data->getContent();
    }

    /**
     * Initialize action
     *
     * Here, we set the breadcrumbs and the active menu
     *
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        $this->loadLayout()
            // Make the active menu match the menu config nodes (without 'children' inbetween)
            ->_setActiveMenu('catalog/smart_vendor_vendor')
            ->_title($this->__('Catalog'))->_title($this->__('Vendor'))
            ->_addBreadcrumb($this->__('Catalog'), $this->__('Catalog'))
            ->_addBreadcrumb($this->__('Vendor'), $this->__('Vendor'));

        return $this;
    }

    /**
     * Check currently called action by permissions for current user
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/smart_vendor_vendor');
    }
}