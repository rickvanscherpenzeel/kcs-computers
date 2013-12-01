<?php


//DROP TABLE `{$installer->getTable('icecatcategories/icecatcats')}`;
$installer = $this;
$installer->startSetup();

$installer->run("
		
		
		CREATE TABLE `{$installer->getTable('icecatcategories/icecatcats')}` (
		`cat_id` int(11) NOT NULL auto_increment,
		`title` text,
		`icecatid` int(11),
		`parentid` int(11),
		`date` datetime default NULL,
  		`timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
		PRIMARY KEY  (`cat_id`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;
		");


		$installer->addAttribute("catalog_category", "icecatid",  array(
		"type"     => "varchar",
		"backend"  => "",
		"frontend" => "",
				"label"    => "IceCatID",
				"input"    => "text",
				"class"    => "",
				"source"   => "",
				"global"   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
				"visible"  => true,
		"required" => false,
		"user_defined"  => false,
		"default" => "",
		"searchable" => false,
		"filterable" => false,
		"comparable" => false,
		"group" => "General Information",
		"visible_on_front"  => false,
		"unique"     => false,
		"note"       => "",
		"sort_order" => "1"

));


$installer->addAttribute('catalog_category', 'edited',  array(
'type'     => 'int',
'label'    => 'Edited',
'input'    => 'select',
'source'   => 'eav/entity_attribute_source_boolean',
'global'   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
		'required' => false,
'default'  => 1,
'user_defined'  => 1,
		'group' => 'General Information',
'default'  => 0,
		"sort_order" => "3"
 ));


$installer->updateAttribute("catalog_category", "thumbnail", "","", $sortOrder="5");


$icecatType=Mage::getStoreConfig('icecat_options/account/icecat_cattype', Mage::app()->getStore('default'));
if(!$icecatType)
{
	$icecatType="free";
}

$helper = Mage::helper('icecatcategories');
$icecatelog = $helper->getIcecatURL($icecatType);
$filename=$helper->getFileName($zip=1);
$helper->installIcecatFile($filename,$icecatelog);

$installer->endSetup();

