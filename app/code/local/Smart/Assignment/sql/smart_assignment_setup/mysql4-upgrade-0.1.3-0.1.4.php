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

$entityTypeId = $installer->getEntityTypeId('catalog_product');
$attributeSetId = $installer->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $installer->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

$installer->addAttributeToSet($entityTypeId, $attributeSetId, $attributeGroupId, 'vendors_ids');

$installer->endSetup();