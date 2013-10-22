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

$installer->run("
DROP TABLE IF EXISTS `vendors`;
CREATE TABLE `vendors` (
`vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci

");


$installer->run("
INSERT INTO `vendors` VALUES ('1', 'Sony', 'Sony Vietnam', '1');
INSERT INTO `vendors` VALUES ('2', 'Nokia', 'Nokia Finland', '1');
INSERT INTO `vendors` VALUES ('3', 'Iphone', 'Iphone USA', '1');

");


$installer->endSetup();