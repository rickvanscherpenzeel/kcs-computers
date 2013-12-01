<?php
class RvSWebdesign_IcecatCategories_Model_Resource_Icecatcats_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {
	protected function _construct()
	{
		$this->_init('icecatcategories/icecatcats');
	}
}