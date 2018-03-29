<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<!-- Page Content -->
<div class="container">

    <?php foreach($allnews as $news): ?>
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-12">

            <!-- Blog Post -->

            <!-- Title -->
            <h3><?= Html::encode($news->title) ?></h3>

            <!-- Author -->
            <p class="lead">
                by <a href="<?=Url::to(['/news/default/user-posts','id' => $news->getUser()->id])?>"><?= Html::encode($news->getNewsAuthor()) ?></a>
            <hr>
            </p>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span>&nbsp;<mark>Posted
                    on</mark> <?= Yii::$app->formatter->asDate($news->date) ?>
            </p>

            <hr>

            <?php if($news->image): ?>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
            <?php endif ?>

            <p><?= $news->content ?></p>
            <hr>

            <p>
                Category:
                <a href="<?=Url::to(['/news/default/view-news-category','id' => $news->category_id])?>"><span class="label label-primary"><?= $news->getCategoryTitle() ?></span></a>
            </p>
            <hr>

            <p>Tags:
                <?php foreach ($tags as $tag): ?>
                    <a href="<?=Url::to(['/news/default/view-news-tags','id' => $tag->id])?>"><span class="label label-primary"><?= $tag->title ?></span></a>
                <?php endforeach ?>
            </p>
            <hr>
            <?php if(!$news->isLiked()): ?>
                <a class="btn btn-default" href="<?=Url::to(['/news/default/like','id' => $news->id])?>"><span class="badge"><?=$news->likes?></span> Likes <span class="glyphicon glyphicon-thumbs-up"></span></a>
            <?php else: ?>
                <a class="btn btn-danger" href="<?=Url::to(['/news/default/dislike','id' => $news->id])?>"><span class="badge"><?=$news->likes?></span> Dislike <span class="glyphicon glyphicon-thumbs-down"></span></a>
            <?php endif ?>

        </div>
    </div>
    <?php endforeach; ?>
</div>
<!-- /.row -->