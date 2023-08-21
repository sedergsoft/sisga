<?php

namespace frontend\controllers;

use Yii;
use frontend\models\FamiliarIntegracion;
use frontend\models\FamiliarIntegracionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FamiliarIntegracionController implements the CRUD actions for FamiliarIntegracion model.
 */
class FamiliarIntegracionController extends Controller
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
     * Lists all FamiliarIntegracion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FamiliarIntegracionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FamiliarIntegracion model.
     * @param integer $familiarid
     * @param integer $integracionid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($familiarid, $integracionid)
    {
        return $this->render('view', [
            'model' => $this->findModel($familiarid, $integracionid),
        ]);
    }

    /**
     * Creates a new FamiliarIntegracion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FamiliarIntegracion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'familiarid' => $model->familiarid, 'integracionid' => $model->integracionid]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FamiliarIntegracion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $familiarid
     * @param integer $integracionid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($familiarid, $integracionid)
    {
        $model = $this->findModel($familiarid, $integracionid);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'familiarid' => $model->familiarid, 'integracionid' => $model->integracionid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing FamiliarIntegracion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $familiarid
     * @param integer $integracionid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($familiarid, $integracionid)
    {
        $this->findModel($familiarid, $integracionid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FamiliarIntegracion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $familiarid
     * @param integer $integracionid
     * @return FamiliarIntegracion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($familiarid, $integracionid)
    {
        if (($model = FamiliarIntegracion::findOne(['familiarid' => $familiarid, 'integracionid' => $integracionid])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
