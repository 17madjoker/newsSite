<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_tag`.
 */
class m180328_070733_create_news_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news_tag', [
            'id' => $this->primaryKey(),
            'news_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);

        $this->addForeignKey('chain_to_news',
            'news_tag',
            'news_id',
            'news',
            'id',
            'CASCADE'
        );

        $this->addForeignKey('chain_to_tag',
            'news_tag',
            'tag_id',
            'tags',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('article_tag');
    }
}
