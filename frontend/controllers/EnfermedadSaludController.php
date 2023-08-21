<?php

namespace frontend\controllers;

use Yii;
use frontend\models\EnfermedadSalud;
use frontend\models\EnfermedadSaludSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EnfermedadSaludController implements the CRUD actions for EnfermedadSalud model.
 */
class EnfermedadSaludController extends Controller
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
     * Lists all EnfermedadSalud models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EnfermedadSaludSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EnfermedadSalud model.
     * @param integer $enfermedadid
     * @param integer $saludid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($enfermedadid, $saludid)
    {
        return $this->render('view', [
            'model' => $this->findModel($enfermedadid, $saludid),
        ]);
    }

    /**
     * Creates a new EnfermedadSalud model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EnfermedadSalud();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'enfermedadid' => $model->enfermedadid, 'saludid' => $model->saludid]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EnfermedadSalud model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $enfermedadid
     * @param integer $saludid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($enfermedadid, $saludid)
    {
        $model = $this->findModel($enfermedadid, $saludid);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'enfermedadid' => $model->enfermedadid, 'saludid' => $model->saludid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EnfermedadSalud model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $enfermedadid
     * @param integer $saludid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($enfermedadid, $saludid)
    {
        $this->findModel($enfermedadid, $saludid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EnfermedadSalud model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $enfermedadid
     * @param integer $saludid
     * @return EnfermedadSalud the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($enfermedadid, $saludid)
    {
        if (($model = EnfermedadSalud::findOne(['enfermedadid' => $enfermedadid, 'saludid' => $saludid])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
