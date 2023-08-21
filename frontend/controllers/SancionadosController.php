<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Sancionados;
use frontend\models\SancionadosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SancionadosController implements the CRUD actions for Sancionados model.
 */
class SancionadosController extends Controller
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
     * Lists all Sancionados models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SancionadosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sancionados model.
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
     * Creates a new Sancionados model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($familiarid)
    {
        $model = new Sancionados();
        $model->scenario = 'CSancionados';
        $cuadro = \frontend\models\CuadroFamiliar::findOne(['familiarid'=>$familiarid])->cuadro;
        $familiar = \frontend\models\Familiar::findOne(['id'=>$familiarid]);


        if ($model->load(Yii::$app->request->post()))
        {
            $model->familiarid=$familiarid; 
            if($model->save())
            {
            $familiar->updateAttributes(['sancionado'=>1]);
            Yii::$app->session->setFlash('mensaje');
        $mensaje = 'La Sanción ha sido agregada correctamente al familiar';
        $style = 'alert-success';
         
         return $this->redirect(['cuadro/view', 
                                 'id' => $cuadro->id,
                                 'mensaje'=>$mensaje,
                                 'style'=>$style,
             ]);
            }}

        return $this->render('create', [
            'model' => $model,
            'cuadro'=>$cuadro,
            'familiar'=>$familiar,
        ]);
    }

    /**
     * Updates an existing Sancionados model.
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
     * Deletes an existing Sancionados model.
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
     * Finds the Sancionados model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sancionados the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sancionados::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
