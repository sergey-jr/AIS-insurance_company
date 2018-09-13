<?php

namespace app\controllers;

use Yii;
use app\models\Types;
use app\models\TypesSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TypesController implements the CRUD actions for Types model.
 */
class TypesController extends Controller
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
     * Lists all Types models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TypesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Types model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Types model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws HttpException
     */
    public function actionCreate()
    {
        if(Yii::$app->user->isGuest || (!Yii::$app->user->identity->isAdmin() && !Yii::$app->user->identity->isWorker()))
            throw new HttpException(403, "Доступ только для администраторов и сотрудников");

        $model = new Types();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Types model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws HttpException
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->isGuest || (!Yii::$app->user->identity->isAdmin() && !Yii::$app->user->identity->isWorker()))
            throw new HttpException(403, "Доступ только для администраторов и сотрудников");
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Types model.
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
     * Finds the Types model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Types the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Types::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
