<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

?>

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">
        <h1 class="page-header">
            Welcome,
            <small><?php if(Yii::$app->user->identity):?>
                    <?=Html::encode(Yii::$app->user->identity->username)?>
                    <?php else: ?>
                    Guest
                    <?php endif?>
            </small>
        </h1>

        <p><mark>Sort all news by:</mark>
            <?php echo $sort->link('date') . ' | ' . $sort->link('viewed').' | '.$sort->link('likes');  ?>
        <hr>
        </p>

        <!-- First Blog Post -->
        <?php foreach($news as $oneNews): ?>

        <h2>
            <a href="<?=Url::to(['/news/default/view','id' => $oneNews->id])?>"><?=Html::encode($oneNews->title)?></a>
        </h2>

        <p class="lead">
            by <a href="<?=Url::to(['/news/default/user-posts','id' => $oneNews->user_id])?>"><?=Html::encode($oneNews->getNewsAuthor())?></a>
        </p>

        <p><span class="glyphicon glyphicon-time"></span> <mark>Posted on</mark> <?=Yii::$app->formatter->asDate($oneNews->date)?></p>
        <p><span class="glyphicon glyphicon-eye-open"></span> <mark>Viewed</mark> <?=Html::encode($oneNews->viewed)?></p>
        <hr>

        <?php if($oneNews->image): ?>
            <img class="img-responsive" src="<?=$oneNews->getImage()?>" alt="">
            <hr>
        <?php endif ?>

        <p><?=Html::encode($oneNews->description)?></p>
        <p>
            <a class="btn btn-primary" href="<?=Url::to(['/news/default/view','id' => $oneNews->id])?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <?php if(!$oneNews->isLiked()): ?>
                <a class="btn btn-default" href="<?=Url::to(['/news/default/like','id' => $oneNews->id])?>"><span class="badge"><?=$oneNews->likes?></span> Likes <span class="glyphicon glyphicon-thumbs-up"></span></a>
            <?php else: ?>
                <a class="btn btn-danger" href="<?=Url::to(['/news/default/dislike','id' => $oneNews->id])?>"><span class="badge"><?=$oneNews->likes?></span> Dislike <span class="glyphicon glyphicon-thumbs-up"></span></a>
            <?php endif ?>
        </p>

        <?php if($oneNews->tags): ?>
        <p>Tags:
            <?php foreach($oneNews->tags as $tag): ?>
                <a href="<?=Url::to(['/news/default/view-news-tags','id' => $tag->id])?>"><span class="label label-primary"><?=$tag->title?></span></a>
            <?php endforeach; ?>
        </p>
        <hr>
        <?php endif ?>

        <?php endforeach ?>

        <?=LinkPager::widget([
            'pagination' => $pages,
        ]);?>


    </div>

    <!-- Blog Sidebar Widgets Column -->
    <div class="col-md-4">

        <!-- Blog Categories Well -->
        <div class="well">
            <h4><mark>Blog Categories</mark></h4>

            <div class="row">
                <?php foreach($categories as $category):?>
                <div class="container">
                    <p>
                        <a href="<?=Url::to(['/news/default/view-news-category','id' => $category->id])?>" class="btn btn-default"><?=$category->title?> <span class="badge"><?=$category->getNewsCount()?></span></a>
                    </p>
                </div>
                <?php endforeach ?>
            </div>
            <!-- /.row -->
        </div>

        <!-- Side Widget Well -->

        <div class="well">
            <h4><mark>Popular posts:</mark></h4>
            <?php foreach($popular as $one):?>
            <h4><a class="text-info" href="<?=Url::to(['/news/default/view','id' => $one->id])?>"><?=Html::encode($one->title)?></a></h4>
            <p><?=Html::encode($one->description)?></p>
                <p><span class="glyphicon glyphicon-eye-open"></span> <?=Html::encode($one->viewed)?></p>
            <hr>
            <?php endforeach ?>
        </div>

        <div class="well">
            <h4><mark>Tags</mark></h4>
            <p>
                <?php foreach($tags as $tag):?>
                    <a href="<?=Url::to(['/news/default/view-news-tags', 'id' => $tag->id])?>"><span class="label label-primary"><?=$tag->title?></span></a>
                <?php endforeach ?>
            </p>
        </div>

    </div>

