<?php

namespace frontend\modules\news\models;

use Yii;
use frontend\modules\news\models\News;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
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

    public function getNews()
    {
        return $this->hasMany(News::className(),['category_id' => 'id']);
    }

    public function getNewsCount()
    {
        return $this->getNews()->count();
    }

    public function getNewsFromCategory()
    {
        return News::find()->where(['category_id' => $this->id])->all();
    }

}
