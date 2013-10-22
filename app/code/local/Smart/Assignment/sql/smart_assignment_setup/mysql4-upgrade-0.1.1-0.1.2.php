<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kazu
 * Date: 14/10/2013
 * Time: 18:12
 * To change this template use File | Settings | File Templates.
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$setup = Mage::getModel('eav/entity_setup','core_setup');

$attribiteCode = 'vendors_ids';
$attributeLabel = 'Vendors IDs';

$setup->addAttribute('catalog_product', $attribiteCode, array(
    'group' => 'General',
    'type' => 'int',
    'backend' => '',
    'frontend' => '',
    'label' => $attributeLabel,
    'input' => 'select',
    'class' => '',
    'source' => 'smart_assignment/vendors',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible' => true,
    'required' => false,
    'user_defined' => true,
    'default' => '0',
    'wysiwyg_enabled' => true,
    'searchable' => false,
    'filterable' => false,
    'comparable' => false,
    'visible_on_front' => false,
    'unique' => false,
    'apply_to' => 'simple,configurable,virtual,bundle,downloadable,grouped',
    'is_configurable' => false,
    'used_in_product_listing' => '1'
));

$installer->endSetup();