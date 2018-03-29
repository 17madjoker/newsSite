<?php

use yii\db\Migration;

/**
 * Handles the creation of table `like_news_user`.
 */
class m180328_113149_create_like_news_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('like_news_user', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'news_id' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('like_news_user');
    }
}
