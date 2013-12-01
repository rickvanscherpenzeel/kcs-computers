<?php

class RvSWebdesign_IcecatCategories_Helper_Data extends Mage_Core_Helper_Abstract
{

	//File to extract
	public function getFileName($zip=null)
	{
		if($zip)
		{
		return $filename=MAGENTO_ROOT."/var/import/icecat/CategoriesList.xml.gz";
		}
		else
			{
				return $filename=MAGENTO_ROOT."/var/import/icecat/CategoriesList.xml";
			}
	}
	
	//Get Type of IceCat! Catelog URL(free of full IceCat)
	public function getIcecatURL($icecatType)
	{
		if($icecatType=="free")
		{
			$icecatelog="data.icecat.biz/export/freexml/refs/CategoriesList.xml.gz";
		}
		else
		{
			$icecatelog="data.icecat.biz/export/level4/refs/CategoriesList.xml.gz";
		}
		
		return $icecatelog;
	}

	public function installIcecatFile($filename,$icecatelog)
	{
		// Username and password for usage with ICEcat
		$username = "openIcecat-xml";
		$password = "freeaccess";
	
	
		$this->getIcecatFile($username,$password,$filename,$icecatelog);
		
	}
		
	public function updateIcecatXML($filename,$icecatelog)
	{	
	// Username and password for usage with ICEcat
		$username = Mage::getStoreConfig('icecat_options/account/account_username');
		$password = Mage::getStoreConfig('icecat_options/account/account_password');

	$this->getIcecatFile($username,$password,$filename,$icecatelog,$addSucces="1");	
			
	}
	
	public function getIcecatFile($username,$password,$filename,$icecatelog,$addSucces=null)
	{
	// Get the product specifications in XML format
	$context = stream_context_create(array(
			'http' => array(
					'header' => "Authorization: Basic " . base64_encode($username.":".$password)
			)
	));
	
	//get categoriesList.xml.gz file from Icecat Refs directory
	try
	{
		// Open the file using the HTTP headers set above
		$file = file_put_contents($filename,file_get_contents('http://'.$icecatelog, false , $context ));
		$filecheck = substr_replace($filename,'',-3);
		$string = implode("", gzfile($filename));
		$fp = fopen($filecheck, "w");
		fwrite($fp, $string, strlen($string));
		fclose($fp);
		
		if($addSucces)
		{
		Mage::getSingleton('adminhtml/session')->addSuccess($this->__("CategoriesList.xml is opgeslagen op de server!."));
		}
	}
	catch (Exception $e)
		{
			if($addSucces)
			{
			Mage::getSingleton('adminhtml/session')->addError($this->__('"%s" messages:<pre>%s</pre>', '', $e));
			}
			else 
			{
			throw $e;
			}
		}	
	}
	
	public function getStoreInfo($websiteName,$all=null)
	{
		
		if(isset($websiteName))
		{
			
			$websiteModel = Mage::getModel('core/website')->load($websiteName); //website model
	
			$website = $websiteModel->getData('website_id');
			$siteModel = Mage::getModel('core/store')
			->getCollection()
			->addWebsiteFilter($website);
	
			$sites = array();
	
			$i=0;
			
			foreach($siteModel as $key=>$site)
			{
				if($all==null)
				{
				$groupId= $site->getData('group_id');
						
				$sites[$i]['store_id'] = $site->getData('store_id');
				$sites[$i]['language'] = Mage::getStoreConfig('general/locale/code', Mage::app()->getStore($site->getData('store_id')));
				$sites[$i]['storegroup'] = $groupId;
				$sites[$i]['defaultStoreId'] = Mage::getModel('core/store_group')->load($groupId)->getData('default_store_id');
				$sites[$i]['rootcategory'] = Mage::getModel('core/store_group')->load($groupId)->getData('root_category_id');
				$i++;
				}
				else 
				{
				$sites[] = $site->getData('store_id');
				}
			}
			return $sites;
		}
	
	
	}
		
}