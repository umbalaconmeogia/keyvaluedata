<?php

use batsg\migrations\BaseMigrationCreateTable;

/**
 * Handles the creation of table `{{%key_value_data}}`.
 */
class m240522_011447_create_key_value_data_table extends BaseMigrationCreateTable
{
    protected $table = 'key_value_data';

    protected function createDbTable()
    {
        $this->createTableWithExtraFields($this->table, [
            'category' => $this->string(),
            'key' => $this->string()->notNull(),
            'value' => $this->string(),
            'name' => $this->string(),
            'remarks' => $this->text(),
            'display_order' => $this->integer(),
        ]);
        $this->createIndexes($this->table, ['category', 'key']);
    }
}
