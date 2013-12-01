<?php
class RvSWebdesign_IcecatCategories_Model_Icecatcats extends Mage_Core_Model_Abstract
{
	protected function _construct()
	{
		$this->_init('icecatcategories/icecatcats');
	}
	
	public function ImportCatsToDb()
	{
		$helper = Mage::helper('icecatcategories');
		$filename=$helper->getFileName();
		//$filename = MAGENTO_ROOT.$filename;
		$xml= simplexml_load_file($filename);
		//$this->InfotoArray($xml);
		
		return $xml;
	}
	
	// Get XML info
	
	
	//Make Array of XML info
	
	function InfotoArray($xml)
	{
		foreach ($xml as $CatData)
		{
			$ID=$CatData->IcecatID;
			$Name=$CatData->CatName;
			$Description=$CatData->Descrption;
			$ParentCat = $CatData->ParentCategoryID;
	
			$Image=$CatData->LowPic;
			$ThumbImage=$CatData->ThumbPic;
	
			$data = array(
			 	'name' => (string)$Name,
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
					'description' => (string)$Description,
					'display_mode' => null,
					'is_anchor' => 1,
					'image' => (string)$Image,
					'thumbnail' => (string)$ThumbImage,
					'landing_page' => null,
					'meta_description' => (string)$Description,
					'meta_keywords' => 'Category meta keywords',
					'meta_title' => (string)$Name,
					'page_layout' => 'two_columns_left',
					'url_key' => (string)$Name,
					'include_in_menu' => 1,
					'icecatid' => (int)$ID,
					'parent_id' => (int)$ParentCat,
					'attribute_set_id' => 3,
			);
		//$this->createCategory($data,$ParentCat);
		return $data;
		}
	}

	//Create Category form Array
	
	function createCategory($data, $defaultStore, $storeId)
	{
		
	$model = Mage::getModel('catalog/category')->loadByAttribute('name', $data['name']);

	if (!$model)
		{
		if ($defaultStore==$storeId)
			{
		  		$model = Mage::getModel('catalog/category')->setStoreId(0);
				$parentCategory = Mage::getModel('catalog/category')->load($data['parent_id']);
				$model->setPath($parentCategory->getPath());
				$model->addData($data);
				$model->save();
			}
		else
			{
				$model = Mage::getModel('catalog/category')->setStoreId($storeId);
				$parentCategory = Mage::getModel('catalog/category')->load($data['parent_id']);
				$model->setPath($parentCategory->getPath());
				$model->addData($data);
				$model->save();
			}
		}

		$model->setStoreId($storeId);
		$model->addData($data);
		$model->save();
		
	
		return Mage::helper('icecatcategories')->__("The create Categorie sAction has been reached.");
	}
	
	public function getStoresPerCategory()
	{
	$category_model= Mage::getModel('catalog/category')->getCollection()->addAttributeToSelect('*')->load();

	foreach ($category_model as $key=>$cat)
		{
			$id=$cat->getId();
		
			$catsPerShop[$key]['id']=$id;
			$catsPerShop[$key]['store']=Mage::getModel('catalog/category')->load($id)->getStoreIds();
		
		}
	return $catsPerShop;
	
	}
	
	public function getCategoriesPerStore($storeIds)
	{
		
	if(isset($storeIds))
		{
		
		foreach($storeIds as $key=>$stores)
				{
				$storeId = $stores;
				$categoryRootId = Mage::app()->getStore($storeId)->getRootCategoryId();
				
				$category_model = Mage::getResourceModel('catalog/category_collection')
				->addFieldToFilter('path', array('like' => "%{$categoryRootId}%"))
				->addAttributeToSelect('*')
				->load();
				
					foreach( $category_model as $id=>$info)
						{
							$store['store']= $storeId;
							$store['language']=Mage::getStoreConfig('general/locale/code', Mage::app()->getStore($storeId));
							$store['cats'][$id]= $info->getName();
						}
						
					$storeInfo[]=$store;
				
				}
		return $storeInfo;
		}
	
		
	}
	
}