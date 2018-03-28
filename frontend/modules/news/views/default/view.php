<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-12">

            <!-- Blog Post -->

            <!-- Title -->
            <h1><?= Html::encode($news->title) ?></h1>

            <!-- Author -->
            <p class="lead">
                by <a href="<?=Url::to(['/news/default/user-posts','id' => $news->getUser()->id])?>"><?= Html::encode($news->getNewsAuthor()) ?></a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span>&nbsp;Posted
                on <?= Yii::$app->formatter->asDate($news->date) ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="http://placehold.it/900x300" alt="">

            <hr>

            <p><?= $news->content ?></p>
            <hr>
            <p>
                Category:
                <span class="label label-primary"><?= $news->getCategoryTitle() ?></span>
            </p>

            <hr>
            <p>Tags:
                <?php foreach ($tags as $tag): ?>
                    <a href="#"><span class="label label-primary"><?= $tag->title ?></span></a>
                <?php endforeach ?>
            </p>

            <hr>

        </div>
    </div>
</div>
<!-- /.row -->