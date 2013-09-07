Magento-PSR-0-Autoloader
========================

This Extension adds a PSR-0 Autoloader before the Magento Autoloader

To initialize a new namespace, insert following code in the `<global/>`-node of local.xml:


    <psr0_namespaces>
        <NewNamespace />
    </psr0_namespaces>
