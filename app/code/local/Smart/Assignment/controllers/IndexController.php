<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 14/10/2013
 * Time: 23:18
 * To change this template use File | Settings | File Templates.
 */
class Smart_Assignment_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function showAction() {

        $vendor = $this->getRequest()->getParam('vendor');
        Mage::register('vendor', $vendor);

        $this->loadLayout();
        $this->renderLayout();

    }

}