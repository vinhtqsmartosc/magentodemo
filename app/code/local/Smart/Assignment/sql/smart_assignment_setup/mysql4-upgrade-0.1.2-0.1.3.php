<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 14/10/2013
 * Time: 18:12
 * To change this template use File | Settings | File Templates.
 */ 
/* @var $installer Mage_Catalog_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->removeAttribute('catalog_product','vendors_id');
$installer->removeAttribute('catalog_product','attr_demo');
$installer->removeAttribute('catalog_product','vendor_id');
$installer->removeAttribute('catalog_product','attr_demo1');
$installer->endSetup();