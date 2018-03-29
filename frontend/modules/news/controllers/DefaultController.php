<?php

namespace frontend\modules\news\controllers;

use frontend\modules\news\models\LikeNewsUser;
use frontend\modules\news\models\Tags;
use Yii;
use frontend\modules\news\models\News;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use frontend\modules\news\models\Category;


/**
 * DefaultController implements the CRUD actions for News model.
 */
class DefaultController extends Controller
{

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $tags = Tags::find()->all();
        $news = $this->findModel($id);
        $news->viewed += 1;
        $news->save(false);

        return $this->render('view', [
            'news' => $news,
            'tags' => $tags
        ]);
    }

    /**
     * @param $id
     */
    public function actionLike($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['/user/default/login']);
        }

        $news = $this->findModel($id);
        if (!LikeNewsUser::find()
            ->where("user_id = $news->user_id")
            ->andWhere("news_id = $news->id")
            ->one())
        {
            $like = new LikeNewsUser();
            $like->user_id = $news->user_id;
            $like->news_id = $news->id;
                if ($like->save())
                {
                    $news->likes += 1;
                    $news->save(false);
                    return $this->redirect(Yii::$app->request->referrer);
                }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDislike($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect(['/user/default/login']);
        }

        $news = $this->findModel($id);
        if ($like = LikeNewsUser::find()
            ->where("user_id = $news->user_id")
            ->andWhere("news_id = $news->id")
            ->one())
        {
            if ($like->delete())
            {
                $news->likes -= 1;
                $news->save(false);
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionViewNewsTags($id)
    {
        $allnews = Tags::findOne($id)->news;
        $tags = Tags::find()->all();

        return $this->render('viewtags',[
            'allnews' => $allnews,
            'tags' => $tags
        ]);
    }

    public function actionViewNewsCategory($id)
    {
        $category = Category::findOne($id);
        $allnews = $category->news;
        $tags = Tags::find()->all();

        return $this->render('viewcategory',[
            'allnews' => $allnews,
            'tags' => $tags
        ]);
    }

    public function actionUserPosts($id)
    {
        $query_news = News::find()->where("user_id = $id");
        $countQuery = clone $query_news;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 2]);
        $news = $query_news->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $popular = News::getPopular();
        $categories = Category::find()->all();
        $tags = Tags::find()->all();

        return $this->render('usernews',[
            'news' => $news,
            'pages' => $pages,
            'popular' => $popular,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
