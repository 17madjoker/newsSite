<?php
namespace frontend\controllers;

use frontend\modules\news\models\Category;
use frontend\modules\news\models\Tags;
use Yii;
use yii\web\Controller;
use frontend\modules\user\models\SignupForm;
use frontend\modules\news\models\News;
use yii\data\Pagination;
use yii\data\Sort;


/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actionIndex()
    {
        $sort = new Sort([
            'attributes' => [
                'date' => [
                    'asc' => ['date' => SORT_ASC],
                    'desc' => ['date' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'Date',
                ],
                'likes',
                'viewed',

            ],
        ]);

        $query_news = News::find();
        $countQuery = clone $query_news;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
        $news = $query_news->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy($sort->orders)
            ->all();

        $popular = News::getPopular();
        $categories = Category::find()->all();
        $tags = Tags::find()->all();

        return $this->render('index',[
            'news' => $news,
            'pages' => $pages,
            'popular' => $popular,
            'categories' => $categories,
            'tags' => $tags,
            'sort' => $sort
        ]);
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

}

