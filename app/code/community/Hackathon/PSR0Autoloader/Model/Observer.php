<?php

class Hackathon_PSR0Autoloader_Model_Observer extends Mage_Core_Model_Observer {

	const CONFIG_PATH_PSR0NAMESPACES = 'global/psr0_namespaces';
	const CONFIG_PATH_COMPOSER_VENDOR_PATH = 'global/composer_vendor_path';
    const CONFIG_PATH_BASE_AUTOLOADER_DISABLE = 'global/base_autoloader_disable';

	static $shouldAdd = true;

	protected function getNamespacesToRegister(){
		$namespaces = array();
		$node = Mage::getConfig()->getNode(self::CONFIG_PATH_PSR0NAMESPACES);
		if ($node && is_array($node->asArray())){
			$namespaces = array_keys($node->asArray());
		}
		return $namespaces;
	}

	/**
	 * return false, if no composer Vendor Path is set in local.xml
	 */
	protected function getComposerVendorPath(){
		$node = Mage::getConfig()->getNode(self::CONFIG_PATH_COMPOSER_VENDOR_PATH);
		$path = str_replace( '{{root_dir}}', Mage::getBaseDir(), $node);
		return $path;
	}

    protected function shouldDisableBaseAutoloader() {
        $config = Mage::getConfig()->getNode(self::CONFIG_PATH_BASE_AUTOLOADER_DISABLE);
        if($config && $config != "0" && $config != "false"){
            return true;
        }else{
            return false;
        }
    }

	public function addAutoloader() {
		if(!self::$shouldAdd){
			return;
		}
		foreach ($this->getNamespacesToRegister() as $namespace){
			if (is_dir(Mage::getBaseDir('lib') . DS . $namespace)){
				$args = array($namespace, Mage::getBaseDir('lib') . DS . $namespace);
				$autoloader = Mage::getModel("psr0autoloader/splAutoloader", $args);
				$autoloader->register();
			}
		}
		if($composerVendorPath = $this->getComposerVendorPath()){
			require_once $composerVendorPath . '/autoload.php';
		}
        if ($this->shouldDisableBaseAutoloader()) {
            spl_autoload_unregister(array(Varien_Autoload::instance(), 'autoload'));
        }
		self::$shouldAdd = false;
	}

}