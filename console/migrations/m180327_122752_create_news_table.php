<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m180327_122752_create_news_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'image' => $this->text(),
            'description' => $this->text(),
            'content' => $this->text(),
            'likes' => $this->integer(10),
            'viewed' => $this->integer(10),
            'user_id' => $this->integer(10),
            'category_id' => $this->integer(10),
            'date' => $this->date(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('news');
    }
}
