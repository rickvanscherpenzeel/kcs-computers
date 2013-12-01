<?php
class RvSWebdesign_IcecatCategories_Block_Adminhtml_Icecatcategories_Buttons extends Mage_Adminhtml_Block_Template
{
	public function getRunSetupUrl()
	{
		return $this->getUrl('*/*/getRunSetup');
	}
	
	public function getXmlManuallyUrl()
	{
		return $this->getUrl('*/*/getXmlManually');
	}
	
	public function getMessage()
	{
		$message = Mage::helper('icecatcategories')->__('All imported Categories will be deleted and the setup wizard will restart! \n Are you sure you wish to continue?');
		
		return $message;
	}
	

	public function getMessageForStore()
	{
		$message = Mage::helper('icecatcategories')->__('please choose a store');
	
		return $message;
	}
	
	public function getStoreInfo($all=null)
	{
		$websiteName= $this->getRequest()->getParam('website');
		
		if(isset($all))
		{
		$stores = Mage::helper('icecatcategories')->getStoreInfo($websiteName,$all='1');
		}
		else 
			{
				$stores = Mage::helper('icecatcategories')->getStoreInfo($websiteName);
			}	
		return $stores;
	}

	
	public function getCategoriesPerStore($storeIds)
	{
		$cats = Mage::getModel('icecatcategories/icecatcats')->getCategoriesPerStore($storeIds);
		
		return $cats;
	}
	
	
	public function xmlArray()
	{
		//$model = Mage::getModel('icecatcategories/icecatcats');
		$helper = Mage::helper('icecatcategories');
		
		$filename=$helper->getFileName();
		$xml= simplexml_load_file($filename);
		
		print_r($xml);
		//return $model->ImportCatsToDb();
		
		
	}
	
	public function addAdditionalCategories()
	{
		
		return $this->getUrl('*/*/getAdditionalCategories');
	
	
	}
}