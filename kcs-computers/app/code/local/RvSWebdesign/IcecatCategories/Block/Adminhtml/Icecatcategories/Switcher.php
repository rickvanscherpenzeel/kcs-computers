<?php
class RvSWebdesign_IcecatCategories_Block_Adminhtml_Icecatcategories_Switcher extends Mage_Adminhtml_Block_Template
{
/**
 * Enter description here...
 *
 * @return array
 */
public function getStoreSelectOptions()
{
	$section = $this->getRequest()->getParam('section');

	$curWebsite = $this->getRequest()->getParam('website');
	$curStore   = $this->getRequest()->getParam('store');

	$storeModel = Mage::getSingleton('adminhtml/system_store');
	/* @var $storeModel Mage_Adminhtml_Model_System_Store */

	$url = Mage::getModel('adminhtml/url');

	$options = array();
	$options['default'] = array(
			'label'    => Mage::helper('adminhtml')->__('Select a Store'),
			'url'      => $url->getUrl('*/*/*', array('section'=>$section)),
			'selected' => !$curWebsite && !$curStore,
			'style'    => 'background:#ccc; font-weight:bold;',
	);

	foreach ($storeModel->getWebsiteCollection() as $website) {
		$websiteShow = false;
		foreach ($storeModel->getGroupCollection() as $group) {
			if ($group->getWebsiteId() != $website->getId()) {
				continue;
			}
			$groupShow = false;
			foreach ($storeModel->getStoreCollection() as $store) {
				if ($store->getGroupId() != $group->getId()) {
					continue;
				}
				if (!$websiteShow) {
					$websiteShow = true;
					$options['website_' . $website->getCode()] = array(
							'label'    => $website->getName(),
							'url'      => $url->getUrl('*/*/*', array('section'=>$section, 'website'=>$website->getCode())),
							'selected' => !$curStore && $curWebsite == $website->getCode(),
							'style'    => 'padding-left:16px; background:#DDD; font-weight:bold;',
					);
				}

			}
			if ($groupShow) {
				$options['group_' . $group->getId() . '_close'] = array(
						'is_group'  => true,
						'is_close'  => true,
				);
			}
		}
	}

	return $options;
}

/**
 * Return store switcher hint html
 *
 * @return mixed
 */
public function getHintHtml()
{
	return Mage::getBlockSingleton('adminhtml/store_switcher')->getHintHtml();
}
}