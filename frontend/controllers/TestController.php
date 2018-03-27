<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;


/**
 * Site controller
 */
class TestController extends Controller
{
    public function actionIndex()
    {
        var_dump(123);
    }

}
