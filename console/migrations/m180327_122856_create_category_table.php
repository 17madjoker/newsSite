<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m180327_122856_create_category_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('category');
    }
}
