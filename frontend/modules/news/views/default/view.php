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
            <p><span class="glyphicon glyphicon-eye-open"></span> <mark>Viewed</mark> <?=Html::encode($news->viewed)?></p>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span>&nbsp;<mark>Posted
                on</mark> <?= Yii::$app->formatter->asDate($news->date) ?>
            </p>
            <p>   <?php if(!$news->isLiked()): ?>
                    <a class="btn btn-default" href="<?=Url::to(['/news/default/like','id' => $news->id])?>"><span class="badge"><?=$news->likes?></span> Likes <span class="glyphicon glyphicon-thumbs-up"></span></a>
                <?php else: ?>
                    <a class="btn btn-danger" href="<?=Url::to(['/news/default/dislike','id' => $news->id])?>"><span class="badge"><?=$news->likes?></span> Dislike <span class="glyphicon glyphicon-thumbs-up"></span></a>
                <?php endif ?>
            </p>
            <p>
                <a href="<?=Url::to(['/news/crud/update','id' => $news->id,'method' => 'post',])?>" class="btn btn-default">Update</a>
                <a href="<?=Url::to(['/news/crud/delete','id' => $news->id])?>" class="btn btn-default">Delete</a>
            </p>


            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="<?=$news->getImage()?>" alt="">

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