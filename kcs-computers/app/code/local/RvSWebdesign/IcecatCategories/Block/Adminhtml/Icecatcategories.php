<?php
class RvSWebdesign_IcecatCategories_Block_Adminhtml_Icecatcategories extends Mage_Adminhtml_Block_Widget_Grid_Container {

	/**
	 * Class constructor
	 * 
	 *     $_prevStoreId = Mage::getSingleton('admin/session')
            ->getLastViewedStore(true);
	 */
	
	
	public function __construct()
  	{
  		
  		$this->_controller = 'adminhtml_icecatcategories';
	    $this->_blockGroup = 'icecatcategories';
	    $this->_headerText = Mage::helper('icecatcategories')->__('Icecat Category Management');
	    parent::__construct();
	    $this->_removeButton('add');
		$this->_addButton('update_categories', array(
	    		'label'     => Mage::helper('icecatcategories')->__('Update Selected Categories'),
	    		'onclick'   => 'setLocation(\'' . $this->getUpdateCategoriesUrl() .'\')',
	    		'class'     => 'update',
	    ));
		
		
		$this->_addButton('update_all_categories', array(
				'label'     => Mage::helper('icecatcategories')->__('Update All Categories'),
				'onclick'   => 'setLocation(\'' . $this->getUpdateAllCategoriesUrl() .'\')',
				'class'     => 'update',
		));
 	}
  
	public function getUpdateCategoriesUrl()
  	{
  		return $this->getUrl('*/*/updateCategories');
  	}

  	public function getUpdateAllCategoriesUrl()
  	{
  		$params['store'] = $this->getRequest()->getParam('store');
  		return $this->getUrl('*/*/updateAllCategories',$params);
  	}
}