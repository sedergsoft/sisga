<?php

namespace frontend\controllers;

use Yii;
use frontend\models\CuadroSanciones;
use frontend\models\CuadroSancionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CuadroSancionesController implements the CRUD actions for CuadroSanciones model.
 */
class CuadroSancionesController extends Controller
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
     * Lists all CuadroSanciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CuadroSancionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CuadroSanciones model.
     * @param integer $sancionesid
     * @param integer $cuadroid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($sancionesid, $cuadroid)
    {
        return $this->render('view', [
            'model' => $this->findModel($sancionesid, $cuadroid),
        ]);
    }

    /**
     * Creates a new CuadroSanciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CuadroSanciones();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'sancionesid' => $model->sancionesid, 'cuadroid' => $model->cuadroid]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CuadroSanciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $sancionesid
     * @param integer $cuadroid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($sancionesid, $cuadroid)
    {
        $model = $this->findModel($sancionesid, $cuadroid);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'sancionesid' => $model->sancionesid, 'cuadroid' => $model->cuadroid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CuadroSanciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $sancionesid
     * @param integer $cuadroid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($sancionesid, $cuadroid)
    {
        $this->findModel($sancionesid, $cuadroid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CuadroSanciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $sancionesid
     * @param integer $cuadroid
     * @return CuadroSanciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($sancionesid, $cuadroid)
    {
        if (($model = CuadroSanciones::findOne(['sancionesid' => $sancionesid, 'cuadroid' => $cuadroid])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
