<?php

namespace frontend\modules\news\controllers;

use Yii;
use frontend\modules\news\models\News;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\modules\news\models\Category;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * CrudController implements the CRUD actions for News model.
 */
class CrudController extends Controller
{
    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect('/user/default/login');
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

            $fileName = $model->generateFileName().'.'.$file->extension;
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
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->redirect('/user/default/login');
        }

        $model = $this->findModel($id);
        $oldImage = $model->image;
        $categories = Category::find()->asArray()->all();
        $categories = ArrayHelper::map($categories, 'id', 'title');

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'image');
            $path = $model->getFolder();

            unlink($path.$oldImage);

            $fileName = $model->generateFileName().'.'.$file->extension;
            if ($file->saveAs($path . $fileName))
            {
                $model->image = $fileName;
                $model->save();
            }
            return Yii::$app->response->redirect(['/news/default/view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => $categories,
        ]);
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if($model = $this->findModel($id))
        {
            $model->delete();
        }

        return Yii::$app->response->redirect(['site/index']);
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
