<?php
class RvSWebdesign_IcecatCategories_Adminhtml_IcecatCategoriesController extends Mage_Adminhtml_Controller_Action {
	
	
	
	public function indexAction()
	{
		$params=$this->getRequest()->getParams();
		$this->_title($this->__('Icecat Categories'));
		
		$this->loadLayout()->_setActiveMenu('dropship/icecatcategoriesbackend');
		
		//$block = $this->getLayout()->getBlock('icecatcategories.buttons');
		//$block->setData('data',$params);
		
		$this->renderLayout();
			
	}
	
	public function updateCategoriesAction() {
		 
		 
	  $this->_getSession()->addSuccess(Mage::helper('icecatcategories')->__("The updateCategoriesAction has been reached."));
      $this->_redirect('*/*');
	}
	
	public function updateAllCategoriesAction() {
		
		$test= $this->getRequest()->getParam('store');
		$name = Mage::app()->getStore($test)->getName();
		
		
		//$test = Mage::app()->getWebsite(1)->getStore('default')->getLocaleCode();
		//$test = Mage::app()->getStore('french')->getLocaleCode(); 
		
		//$test=Mage::app()->getLocale()->getLocaleCode();
		//$this->_getSession()->addSuccess(Mage::helper('icecatcategories')->__($test));
		//$this->_redirect('*/*');
	}
	
	public function getRunSetupAction()
	{
		$this->_getSession()->addSuccess(Mage::helper('icecatcategories')->__("The getRunSetupAction has been reached."));
		$this->_redirect('*/*');
	}
	
	public function getXmlManuallyAction()
	{
		$icecatType="free";
		$helper = Mage::helper('icecatcategories');
		$icecatelog = $helper->getIcecatURL($icecatType);;
		$filename=$helper->getFileName();
		$helper->updateIcecatXML($filename,$icecatelog);
		$this->_redirect('*/*');
	}
	
	public function getAdditionalCategoriesAction()
	{
	$websiteName= $this->getRequest()->getParam('website');
	
	$storeIds=Mage::helper('icecatcategories')->getStoreInfo($websiteName,$all='1');
	$storeId=$storeIds['1'];
	
	$defaultStore=Mage::helper('icecatcategories')->getStoreInfo($websiteName);
	$defaultStore=$defaultStore['0']['defaultStoreId'];
	$storeId = '2';
	$defaultStore = '1';
	
	
	$data = array(
			'name' => 'laatste',
			'is_active' => 1,
			'position' => 1,
			//<!-- position parameter is deprecated, category anyway will be positioned in the end of list
			//and you can not set position directly, use catalog_category.move instead -->
			'available_sort_by' => 'position',
			'custom_design' => null,
			'custom_apply_to_products' => null,
			'custom_design_from' => null,
			'custom_design_to' => null,
			'custom_layout_update' => null,
			'default_sort_by' => 'position',
			'description' => 'tEjkghjgG',
			'display_mode' => null,
			'is_anchor' => 1,
			'image' => null,
			'thumbnail' => null,
			'landing_page' => null,
			'meta_description' => null,
			'meta_keywords' => 'Category meta keywords',
			'meta_title' => null,
			'page_layout' => 'two_columns_left',
			'url_key' => 'henk',
			'include_in_menu' => 1,
			'icecatid' => '12',
			'parent_id' => 2,
			'attribute_set_id' => 3,
	);
	
	
	Mage::getModel('icecatcategories/icecatcats')->createCategory($data , $defaultStore , $storeId);
	$this->_redirect('*/*');
	}
}