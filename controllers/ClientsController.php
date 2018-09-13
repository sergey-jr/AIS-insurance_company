<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\Clients;
use app\models\ClientsSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientsController implements the CRUD actions for Clients model.
 */
class ClientsController extends Controller
{
    /**
     * {@inheritdoc}
     * @throws HttpException
     */
    function hasAccess(){
        if(Yii::$app->user->isGuest || !(Yii::$app->user->identity->isAdmin() || Yii::$app->user->identity->isWorker()))
            throw new HttpException(403, 'У вас нет доступа к этой возможности');
    }
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
     * Lists all Clients models.
     * @return mixed
     * @throws HttpException
     */
    public function actionIndex()
    {
        $this->hasAccess();
        $searchModel = new ClientsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $users = User::find()
            ->select(['id as value', "CONCAT_WS(' ',last_name, first_name, patronymic_name) as label"])
            ->asArray()
            ->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users,
        ]);
    }

    /**
     * Displays a single Clients model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws HttpException
     */
    public function actionView($id)
    {
        $this->hasAccess();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Clients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws HttpException
     */
    public function actionCreate()
    {
        $this->hasAccess();
        $model = new Clients();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Clients model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws HttpException
     */
    public function actionUpdate($id)
    {
        if(!Yii::$app->user->identity->isAdmin())
            throw new HttpException(403, 'У вас нет доступа к этой возможности');
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Clients model.
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
        if(!Yii::$app->user->identity->isAdmin())
            throw new HttpException(403, 'У вас нет доступа к этой возможности');

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Clients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Clients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clients::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
