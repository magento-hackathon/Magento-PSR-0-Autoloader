Magento-PSR-0-Autoloader
========================

This Extension adds a PSR-0 Autoloader before the Magento Autoloader

To initialize a new namespace, insert following code in the `<global/>`-node of local.xml:


    <psr0_namespaces>
        <NewNamespace />
    </psr0_namespaces>



## Magento Composer Autoloader

You can also use this Extension to add the composer Autoloader.

You need to configure the Path to your Vendor directory in your `<global/>`-node of local.xml:


    <composer_vendor_path><![CDATA[{{root_dir}}/vendor]]></composer_vendor_path>

