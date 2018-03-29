<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\news\models\News */

?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
