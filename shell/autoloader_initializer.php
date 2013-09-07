<?php

abstract class AutoloaderInitializer extends Mage_Shell_Abstract {

	/**
	 * Initializes global area and dispatches an event to trigger autoloader initialization
	 *
	 * @return AutoloaderInitializer
	 */
	protected  function _construct() {
		parent::_construct();
		Mage::getConfig()->init()->loadEventObservers('global');
		Mage::app()->addEventArea('global');
		Mage::dispatchEvent('add_spl_autoloader');
		return $this;
	}
}