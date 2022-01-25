<?php
/**
 * Created by PhpStorm.
 * User: Okhamafe Emmanuel
 * Date: 7/8/2019
 * Time: 4:25 AM
 */

namespace Osarz\Quote\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        try {
            $installer = $setup;
            $installer->startSetup();

            $tableName = $installer->getTable('me3energy_quotes');
            // Check if the table already exists
            if ($installer->getConnection()->isTableExists($tableName) != true) {
                // Create tutorial_simplenews table
                $table = $installer->getConnection()
                    ->newTable($tableName)
                    ->addColumn(
                        'id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'unsigned' => true,
                            'nullable' => false,
                            'primary' => true
                        ],
                        'ID'
                    )
                    ->addColumn(
                        'first_name',
                        Table::TYPE_TEXT,
                        100,
                        ['nullable' => false, 'default' => ''],
                        'First Name'
                    )
                    ->addColumn(
                        'last_name',
                        Table::TYPE_TEXT,
                        100,
                        ['nullable' => false, 'default' => ''],
                        'Last Name'
                    )
                    ->addColumn(
                        'phone_number',
                        Table::TYPE_TEXT,
                        20,
                        ['nullable' => false, 'default' => ''],
                        'Phone Number'
                    )
                    ->addColumn(
                        'email',
                        Table::TYPE_TEXT,
                        null,
                        ['nullable' => false, 'default' => ''],
                        'Email'
                    )
                    ->addColumn(
                        'comment',
                        Table::TYPE_TEXT,
                        null,
                        ['nullable' => false, 'default' => ''],
                        'Comment'
                    )
                    ->addColumn(
                        'created_at',
                        Table::TYPE_DATETIME,
                        null,
                        ['nullable' => false],
                        'Created At'
                    )
                   ->addColumn(
                       'status',
                       Table::TYPE_SMALLINT,
                       null,
                       ['nullable' => false, 'default' => '0'],
                       'Status'
                   )
                    ->setComment('Quote Table')
                    ->setOption('type', 'InnoDB')
                    ->setOption('charset', 'utf8');
                $installer->getConnection()->createTable($table);
            }

            $installer->endSetup();
        }catch (\Exception $error){
        }
    }
}
