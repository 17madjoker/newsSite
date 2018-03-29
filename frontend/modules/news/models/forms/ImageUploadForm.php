<?php

namespace frontend\modules\news\models\forms;
use yii\base\Model;

class ImageUploadForm extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'],'required'],
            [['image'],'file','extensions' => 'jpg,png']
        ];
    }


}