<?php

namespace frontend\modules\news\models;

use Yii;

/**
 * This is the model class for table "like_news_user".
 *
 * @property int $id
 * @property int $user_id
 * @property int $news_id
 */
class LikeNewsUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'like_news_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'news_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'news_id' => 'News ID',
        ];
    }
}
