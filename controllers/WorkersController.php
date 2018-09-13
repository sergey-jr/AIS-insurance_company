<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\Workers;
use app\models\WorkersSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WorkersController implements the CRUD actions for Workers model.
 */
class WorkersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Workers models.
     * @return mixed
     * @throws HttpException
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin())
            throw new HttpException(403, "Доступ только для администраторов");

        $users = User::find()
            ->select(['id as value', "CONCAT_WS(' ',last_name, first_name, patronymic_name) as label"])
            ->asArray()
            ->all();
        $searchModel = new WorkersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users,
        ]);
    }

    /**
     * Displays a single Workers model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws HttpException
     */
    public function actionView($id)
    {
        if(Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin())
            throw new HttpException(403, "Доступ только для администраторов");

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Workers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws HttpException
     */
    public function actionCreate()
    {
        if(Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin())
            throw new HttpException(403, "Доступ только для администраторов");

        $model = new Workers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Workers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws HttpException
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin())
            throw new HttpException(403, "Доступ только для администраторов");

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Workers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws HttpException
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin())
            throw new HttpException(403, "Доступ только для администраторов");

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Workers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Workers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Workers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
