<?php
class RvSWebdesign_IcecatCategories_Block_Adminhtml_Icecatcategories_Grid extends Mage_Adminhtml_Block_Widget_Grid
{


	public function __construct()
	{
		parent::__construct();
		$this->setId('icecatGrid');
		$this->setDefaultSort('cat_id');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);
	}

	protected function _prepareCollection()
	{
		$collection = Mage::getModel('icecatcategories/icecatcats')->getCollection();
		$this->setCollection($collection);
		 
		return parent::_prepareCollection();

	}

	protected function _prepareColumns()
	{
		$this->addColumn('cat_id', array(
				'header'    => Mage::helper('icecatcategories')->__('ID'),
				'align'     =>'left',
				'width'     => '20px',
				'index'     => 'cat_id',
		));

		$this->addColumn('title', array(
				'header'    => Mage::helper('icecatcategories')->__('Name'),
				'align'     =>'left',
				'index'     => 'title',
				'width'     => '250px',
		));

		$this->addColumn('icecatid', array(
				'header'    => Mage::helper('icecatcategories')->__('Icecat ID'),
				'align'     =>'left',
				'index'     => 'icecatid',
				'width'     => '20px',
		));

		$this->addColumn('parentid', array(
				'header'    => Mage::helper('icecatcategories')->__('Parent ID'),
				'align'     =>'left',
				'index'     => 'parentid',
				'width'     => '20px',
		));
		
		$this->addColumn('timestamp', array(
				'header'    => Mage::helper('icecatcategories')->__('timestamp'),
				'align'     =>'left',
				'index'     => 'timestamp',
				'width'     => '250px',
		));

		return parent::_prepareColumns();
	}



	
}