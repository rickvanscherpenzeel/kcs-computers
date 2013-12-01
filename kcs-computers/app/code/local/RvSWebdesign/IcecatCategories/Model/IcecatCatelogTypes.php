<?php
class RvSWebdesign_IcecatCategories_Model_IcecatCatelogTypes
{
	public function toOptionArray()
	{
		return array(
				array('value'=>'free', 'label'=>Mage::helper('icecatcategories')->__('Free Catelog')),
				array('value'=>'full', 'label'=>Mage::helper('icecatcategories')->__('Full(paid) Catelog')),
				);
	}

}
