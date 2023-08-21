<?php

namespace frontend\controllers;

use Yii;
use frontend\models\LimitacionesSalud;
use frontend\models\LimitacionesSaludSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LimitacionesSaludController implements the CRUD actions for LimitacionesSalud model.
 */
class LimitacionesSaludController extends Controller
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
     * Lists all LimitacionesSalud models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LimitacionesSaludSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LimitacionesSalud model.
     * @param integer $limitacionesid
     * @param integer $saludid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($limitacionesid, $saludid)
    {
        return $this->render('view', [
            'model' => $this->findModel($limitacionesid, $saludid),
        ]);
    }

    /**
     * Creates a new LimitacionesSalud model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LimitacionesSalud();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'limitacionesid' => $model->limitacionesid, 'saludid' => $model->saludid]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LimitacionesSalud model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $limitacionesid
     * @param integer $saludid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($limitacionesid, $saludid)
    {
        $model = $this->findModel($limitacionesid, $saludid);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'limitacionesid' => $model->limitacionesid, 'saludid' => $model->saludid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LimitacionesSalud model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $limitacionesid
     * @param integer $saludid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($limitacionesid, $saludid)
    {
        $this->findModel($limitacionesid, $saludid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the LimitacionesSalud model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $limitacionesid
     * @param integer $saludid
     * @return LimitacionesSalud the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($limitacionesid, $saludid)
    {
        if (($model = LimitacionesSalud::findOne(['limitacionesid' => $limitacionesid, 'saludid' => $saludid])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
