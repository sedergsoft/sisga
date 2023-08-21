<?php

namespace frontend\controllers;

use Yii;
use frontend\models\MiitanciaPoliticCuadro;
use frontend\models\MiitanciaPoliticCuadroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MiitanciaPoliticCuadroController implements the CRUD actions for MiitanciaPoliticCuadro model.
 */
class MiitanciaPoliticCuadroController extends Controller
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
     * Lists all MiitanciaPoliticCuadro models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MiitanciaPoliticCuadroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MiitanciaPoliticCuadro model.
     * @param integer $miitancia_politicid
     * @param integer $cuadroid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($miitancia_politicid, $cuadroid)
    {
        return $this->render('view', [
            'model' => $this->findModel($miitancia_politicid, $cuadroid),
        ]);
    }

    /**
     * Creates a new MiitanciaPoliticCuadro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MiitanciaPoliticCuadro();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'miitancia_politicid' => $model->miitancia_politicid, 'cuadroid' => $model->cuadroid]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MiitanciaPoliticCuadro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $miitancia_politicid
     * @param integer $cuadroid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($miitancia_politicid, $cuadroid)
    {
        $model = $this->findModel($miitancia_politicid, $cuadroid);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'miitancia_politicid' => $model->miitancia_politicid, 'cuadroid' => $model->cuadroid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MiitanciaPoliticCuadro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $miitancia_politicid
     * @param integer $cuadroid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($miitancia_politicid, $cuadroid)
    {
        $this->findModel($miitancia_politicid, $cuadroid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MiitanciaPoliticCuadro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $miitancia_politicid
     * @param integer $cuadroid
     * @return MiitanciaPoliticCuadro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($miitancia_politicid, $cuadroid)
    {
        if (($model = MiitanciaPoliticCuadro::findOne(['miitancia_politicid' => $miitancia_politicid, 'cuadroid' => $cuadroid])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
