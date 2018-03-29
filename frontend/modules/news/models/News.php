<?php

namespace frontend\modules\news\models;

use Yii;
use frontend\modules\user\models\User;
use frontend\modules\news\models\LikeNewsUser;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property string $description
 * @property string $content
 * @property int $likes
 * @property int $viewed
 * @property int $user_id
 * @property int $category_id
 * @property string $date
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image', 'description', 'content'], 'string'],
            [['likes', 'viewed', 'user_id', 'category_id'], 'integer'],
            [['date'], 'safe'],
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
            'image' => 'Image',
            'description' => 'Description',
            'content' => 'Content',
            'likes' => 'Likes',
            'viewed' => 'Viewed',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'date' => 'Date',
        ];
    }

    public function getUser()
    {
        return User::findOne($this->user_id);
    }

    public function getNewsAuthor()
    {
        return self::getUser()->username;
    }

    public static function getPopular()
    {
        return News::find()->orderBy('viewed DESC')->limit(3)->all();
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(),['id' => 'category_id']);
    }

    public function getCategoryTitle()
    {
        return Category::find()->where("id = $this->category_id")->one()->title;
    }

    public function getTags()
    {
        return $this->hasMany(Tags::className(), ['id' => 'tag_id'])
            ->viaTable('news_tag', ['news_id' => 'id']);
    }

    public function isLiked()
    {
        if ($like = LikeNewsUser::find()
            ->where("user_id = $this->user_id")
            ->andWhere("news_id = $this->id")
            ->one())
        {
            return true;
        }
    }

    public function getFolder()
    {
        return Yii::getAlias('@app').'/web/images/';
    }

    public function getImage()
    {
        return '/frontend/web/images/'.$this->image;
    }

    public function generateFileName()
    {
        return sha1((uniqid($this->image->baseName)));
    }

    public function beforeDelete()
    {
        if ($this->image)
        {
            unlink(self::getFolder().$this->image);
        }
        return parent::beforeDelete();
    }

    public function beforeUpdate()
    {
        if ($this->image)
        {
            unlink(self::getFolder().$this->image);
        }
        return parent::beforeUpdate();
    }



}
