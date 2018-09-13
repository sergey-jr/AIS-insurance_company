<?php

namespace app\controllers;

use kartik\mpdf\Pdf;
use Yii;
use app\models\Payments;
use app\models\PaymentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PaymentsController implements the CRUD actions for Payments model.
 */
class PaymentsController extends Controller
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
     * Lists all Payments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReport_on_payments(){
        $now_y = date('Y');
        $now = date('Y-m').'-01';
        $now_m = date('n');
        $next = implode('-', [$now_m == 12? $now_y + 1: $now_y,
            $now_m == 12? '01': (($now_m+1)>10? ($now_m + 1): '0' . ($now_m + 1)), '01']);
        $monthPayments = Payments::find()->select(['client_id', 'contract_id', 'amount',
            'DATE_FORMAT(date, "%d.%m.%Y") as date'])
            ->where(['between','date', $now, $next])
            ->orderBy('client_id, date')
            ->all();
        $amount = Payments::find()
            ->where(['between','date', $now, $next])
            ->sum('amount');
        $count = Payments::find()
            ->where(['between','date', $now, $next])
            ->count();
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'content' => $this->renderPartial('report_on_payments', [
                'payments' => $monthPayments,
                'amount' => $amount,
                'count'=> $count] ),
            'options' => [
                'title' => 'Отчет по договорам за период: ' .
                    $now . ' - ' .
                    $next,
                'subject' => ''
            ],
            'methods' => [
                'SetHeader' => ['Отчет по платежам за период: ' .
                    $now. ' - ' .
                    $next,
                    'SetFooter' => ['|Страница {PAGENO}|'],
                ]
            ]]);
        return $pdf->render();
    }

    /**
     * Displays a single Payments model.
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
     * Creates a new Payments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Payments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Payments model.
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
     * Deletes an existing Payments model.
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
     * Finds the Payments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Payments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
