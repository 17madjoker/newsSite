<?php

use yii\helpers\Html;
use yii\i18n\Formatter;
use yii\widgets\LinkPager;
use yii\helpers\Url;

?>

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-12">
        <h1 class="page-header">
            Welcome,
            <small><?php if (Yii::$app->user->identity): ?>
                    <?= Html::encode(Yii::$app->user->identity->username) ?>
                <?php else: ?>
                    Guest
                <?php endif ?>
            </small>
        </h1>

        <!-- First Blog Post -->
        <?php foreach ($news as $oneNews): ?>
            <h2>
                <a href="<?= Url::to(['/news/default/view', 'id' => $oneNews->id]) ?>"><?= Html::encode($oneNews->title) ?></a>
            </h2>

            <p class="lead">
                by <a href="#"><?= Html::encode($oneNews->getNewsAuthor()) ?></a>
            </p>

            <p><span class="glyphicon glyphicon-time"></span> Posted
                on <?= Yii::$app->formatter->asDate($oneNews->date) ?></p>
            <hr>
            <img class="img-responsive" src="<?=$oneNews->getImage()?>" alt="">
            <hr>
            <p><?= Html::encode($oneNews->description) ?></p>
            <p>
                <a class="btn btn-primary" href="<?= Url::to(['/news/default/view', 'id' => $oneNews->id]) ?>">Read More
                    <span class="glyphicon glyphicon-chevron-right"></span></a>
                <a class="btn btn-default" href="#"><span class="badge"><?= $oneNews->likes ?></span> Likes <span
                        class="glyphicon glyphicon-thumbs-up"></span></a>
            </p>
            <hr>

            <p>Tags:
                <?php foreach ($oneNews->tags as $tag): ?>
                    <a href="#"><span class="label label-primary"><?= $tag->title ?></span></a>
                <?php endforeach ?>
            </p>

            <hr>
        <?php endforeach ?>

        <?= LinkPager::widget([
            'pagination' => $pages,
        ]); ?>

    </div>
</div>

