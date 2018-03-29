<?php
/**
 * Created by PhpStorm.
 * User: Kirilloid
 * Date: 29.03.2018
 * Time: 0:35
 */

namespace frontend\modules\news\controllers;
use frontend\modules\news\models\Category;
use yii\web\UploadedFile;
use yii\base\Controller;
use Yii;
use frontend\modules\news\models\News;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;

class CrudController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'update' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect('/site/index');
        }

        $model = new News();

        // Default value
        $model->date = date('Y-m-d');
        $model->user_id = Yii::$app->user->identity->id;
        $categories = Category::find()->asArray()->all();
        $categories = ArrayHelper::map($categories, 'id', 'title');

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'image');
            $path = $model->getFolder();

            $fileName = $model->generateFileName($file).$file->extension;
                if ($file->saveAs($path . $fileName))
                {
                    $model->image = $fileName;
                    $model->save();
                }
            return Yii::$app->response->redirect(['/news/default/view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => $categories
        ]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        echo '123'; die;
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect('/site/index');
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/news/default/view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect('/site/index');
        }

        $this->findModel($id)->delete();

        return $this->redirect(['/site/index']);
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