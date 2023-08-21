<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PreparacionIntelectualIdiomas;
use frontend\models\PreparacionIntelectualIdiomasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PreparacionIntelectualIdiomasController implements the CRUD actions for PreparacionIntelectualIdiomas model.
 */
class PreparacionIntelectualIdiomasController extends Controller
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
     * Lists all PreparacionIntelectualIdiomas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PreparacionIntelectualIdiomasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PreparacionIntelectualIdiomas model.
     * @param integer $preparacion_intelectualid
     * @param integer $idiomasid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($preparacion_intelectualid, $idiomasid)
    {
        return $this->render('view', [
            'model' => $this->findModel($preparacion_intelectualid, $idiomasid),
        ]);
    }

    /**
     * Creates a new PreparacionIntelectualIdiomas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PreparacionIntelectualIdiomas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'preparacion_intelectualid' => $model->preparacion_intelectualid, 'idiomasid' => $model->idiomasid]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PreparacionIntelectualIdiomas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $preparacion_intelectualid
     * @param integer $idiomasid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($preparacion_intelectualid, $idiomasid)
    {
        $model = $this->findModel($preparacion_intelectualid, $idiomasid);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'preparacion_intelectualid' => $model->preparacion_intelectualid, 'idiomasid' => $model->idiomasid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PreparacionIntelectualIdiomas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $preparacion_intelectualid
     * @param integer $idiomasid
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($preparacion_intelectualid, $idiomasid)
    {
        $this->findModel($preparacion_intelectualid, $idiomasid)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PreparacionIntelectualIdiomas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $preparacion_intelectualid
     * @param integer $idiomasid
     * @return PreparacionIntelectualIdiomas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($preparacion_intelectualid, $idiomasid)
    {
        if (($model = PreparacionIntelectualIdiomas::findOne(['preparacion_intelectualid' => $preparacion_intelectualid, 'idiomasid' => $idiomasid])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
