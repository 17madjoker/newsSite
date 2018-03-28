<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<div class="wrap">
    <nav id="w0" class="navbar-inverse navbar-fixed-top navbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse"><span
                        class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <a class="navbar-brand" href="<?=Url::to(['/'])?>"><span class="glyphicon glyphicon-home"></span> News</a></div>
            <div id="w0-collapse" class="collapse navbar-collapse">
                <ul id="w1" class="navbar-nav navbar-right nav">
                    <li><a href="<?=Url::to(['/user/default/signup'])?>"><span class="glyphicon glyphicon-pencil"></span> Signup</a></li>
                    <li><a href="<?=Url::to(['/user/default/login'])?>"><span class="glyphicon glyphicon-user"></span> Login</a></li>

                    <?php if(!Yii::$app->user->isGuest):?>
                        <li><a href="<?=Url::to(['/news/default/create'])?>"><span class="glyphicon glyphicon-plus"></span>
                                Create news</a></li>
                        <li><a href="<?=Url::to(['/user/default/logout'])?>"><span class="glyphicon glyphicon-off"></span> Logout
                                <?php if (Yii::$app->user->identity): ?>
                                    <?= '('.Yii::$app->user->identity->username.')'?>
                                <?php endif?>
                            </a></li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>


<!-- Footer -->
<footer>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
    </div>

</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
