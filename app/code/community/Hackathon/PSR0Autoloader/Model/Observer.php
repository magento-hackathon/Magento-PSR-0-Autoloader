<?php

class Hackathon_PSR0Autoloader_Model_Observer extends Mage_Core_Model_Observer {

	const CONFIG_PATH_PSR0NAMESPACES = 'global/psr0_namespaces';

	static $shouldAdd = true;

	protected function getNamespacesToRegister(){
		$namespaces = array();
		$node = Mage::getConfig()->getNode(self::CONFIG_PATH_PSR0NAMESPACES);
		if ($node && is_array($node->asArray())){
			$namespaces = array_keys($node->asArray());
		}
		return $namespaces;
	}

	public function addAutoloader() {
		if(self::$shouldAdd){
			return;
		}
		foreach ($this->getNamespacesToRegister() as $namespace){
			if (is_dir(Mage::getBaseDir('lib') . DS . $namespace)){
				$args = array($namespace, Mage::getBaseDir('lib') . DS . $namespace);
				$autoloader = Mage::getModel("psr0autoloader/splAutoloader", $args);
				$autoloader->register();
			}
		}
		self::$shouldAdd = false;
	}

}