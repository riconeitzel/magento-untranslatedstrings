<?php
$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$tableName = $installer->getTable('ew_untranslatedstrings/string');
if(!Mage::getSingleton('core/resource')->getConnection('core_write')->isTableExists($tableName)) {
    $table = new Varien_Db_Ddl_Table();
    $table->setName($tableName);

    $table->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array('nullable' => FALSE, 'identity' => TRUE, 'primary' => TRUE));
    $table->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_INTEGER, 11, array('nullable' => FALSE));
    $table->addColumn('untranslated_string', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array('nullable' => FALSE));
    $table->addColumn('translation_code', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array('nullable' => FALSE));
    $table->addColumn('translation_module', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array('nullable' => TRUE));
    $table->addColumn('locale', Varien_Db_Ddl_Table::TYPE_VARCHAR, 10, array('nullable' => TRUE));
    $table->addColumn('url_found', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array('nullable' => TRUE));
    $table->addColumn('date_found', Varien_Db_Ddl_Table::TYPE_DATETIME, NULL, array('nullable' => FALSE));

    $installer->getConnection()->createTable($table);

    $uniqueFields = array(
        'store_id',
        'untranslated_string',
        'translation_code',
        'locale'
    );
    $installer->getConnection()->addIndex(
        $tableName,
        $installer->getIdxName(
            $tableName,
            $uniqueFields,
            Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
        ),
        $uniqueFields,
        Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
    );

}
$installer->endSetup();