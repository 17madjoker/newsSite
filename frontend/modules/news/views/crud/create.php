<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\news\models\News */

$this->title = 'Create News';
?>
<div class="news-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
