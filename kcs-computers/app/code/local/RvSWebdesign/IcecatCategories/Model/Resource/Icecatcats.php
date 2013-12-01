<?php

class RvSWebdesign_IcecatCategories_Model_Resource_Icecatcats extends Mage_Core_Model_Resource_Db_Abstract{
	protected function _construct()
	{
		$this->_init('icecatcategories/icecatcats', 'cat_id');
	}
}