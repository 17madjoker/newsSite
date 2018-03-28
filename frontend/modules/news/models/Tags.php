<?php

namespace frontend\modules\news\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property string $title
 *
 * @property NewsTag[] $newsTags
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsTags()
    {
        return $this->hasMany(NewsTag::className(), ['tag_id' => 'id']);
    }

    public function getNews()
    {
        return $this->hasMany(News::className(), ['id' => 'tag_id'])
            ->viaTable('news_tag', ['tag_id' => 'id']);
    }
}
