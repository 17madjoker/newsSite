<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comments`.
 */
class m180327_122920_create_comments_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'article_id' => $this->integer(),
            'text' => $this->text(),
            'status' => $this->integer(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('comments');
    }
}
