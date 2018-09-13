<?php

namespace app\controllers;

use DateTime;
use kartik\mpdf\Pdf;
use Yii;
use app\models\Contracts;
use app\models\ContractsSearch;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContractsController implements the CRUD actions for Contracts model.
 */
class ContractsController extends Controller
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
     * Lists all Contracts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContractsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReport_on_contracts(){
        $now_y = date('Y');
        $now = date('Y-m').'-01';
        $now_m = date('n');
        $next = implode('-', [$now_m == 12? $now_y + 1: $now_y,
            $now_m == 12? '01': (($now_m+1)>10? ($now_m + 1): '0' . ($now_m + 1)), '01']);
        $month_contracts = Contracts::find()
            ->select(['worker_id', 'client_id', 'type_id', 'price', 'filial_id',
                'DATE_FORMAT(date, "%d.%m.%Y") as date', 'DATE_FORMAT(date_expired, "%d.%m.%Y") as date_expired'])
            ->where(['between','date', $now, $next])
            ->orderBy('filial_id, worker_id, date')
            ->all();
        $amount = Contracts::find()
            ->where(['between','date', $now, $next])
            ->sum('price');
        $count = Contracts::find()
            ->where(['between','date', $now, $next])
            ->count();
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'content' => $this->renderPartial('report_on_contracts', [
                'contracts' => $month_contracts,
                'amount' => $amount,
                'count'=> $count] ),
            'options' => [
                'title' => 'Отчет по договорам за период: ' .
                    $now . ' - ' .
                    $next,
                'subject' => ''
            ],
            'methods' => [
                'SetHeader' => ['Отчет по договорам за период: ' .
                    $now. ' - ' .
                    $next,
                'SetFooter' => ['|Страница {PAGENO}|'],
            ]
        ]]);
        return $pdf->render();
    }

    /**
     * Displays a single Contracts model.
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
     * Creates a new Contracts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contracts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Contracts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Contracts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Contracts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contracts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contracts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
