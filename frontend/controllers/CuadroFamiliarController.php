<?php

namespace frontend\controllers;

use Yii;
use frontend\models\CuadroFamiliar;
use frontend\models\CuadroFamiliarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CuadroFamiliarController implements the CRUD actions for CuadroFamiliar model.
 */
class CuadroFamiliarController extends Controller
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
     * Lists all CuadroFamiliar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CuadroFamiliarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CuadroFamiliar model.
     * @param integer $cuadroid
     * @param integer $familiarid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($cuadroid, $familiarid)
    {
        return $this->render('view', [
            'model' => $this->findModel($cuadroid, $familiarid),
        ]);
    }

    /**
     * Creates a new CuadroFamiliar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CuadroFamiliar();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'cuadroid' => $model->cuadroid, 'familiarid' => $model->familiarid]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CuadroFamiliar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $cuadroid
     * @param integer $familiarid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($cuadroid, $familiarid)
    {
        $model = $this->findModel($cuadroid, $familiarid);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'cuadroid' => $model->cuadroid, 'familiarid' => $model->familiarid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CuadroFamiliar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $cuadroid
     * @param integer $familiarid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($cuadroid, $familiarid)
    {
        $this->findModel($cuadroid, $familiarid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CuadroFamiliar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $cuadroid
     * @param integer $familiarid
     * @return CuadroFamiliar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($cuadroid, $familiarid)
    {
        if (($model = CuadroFamiliar::findOne(['cuadroid' => $cuadroid, 'familiarid' => $familiarid])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
