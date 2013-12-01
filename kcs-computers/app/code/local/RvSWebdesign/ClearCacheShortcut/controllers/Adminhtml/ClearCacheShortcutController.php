<?php 

include_once Mage::getBaseDir().'/app/code/core/Mage/Adminhtml/controllers/CacheController.php';

class RvSWebdesign_ClearCacheShortcut_Adminhtml_ClearCacheShortcutController extends Mage_Adminhtml_CacheController {

	public function indexAction()
	{
		$this->_title($this->__('System'))->_title($this->__('Cache Management'));
		$this->loadLayout()
		->_setActiveMenu('shortcuts/clearcacheshortcut');
		$this->renderLayout();
	}
}