<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Vehiculo;
use frontend\models\VehiculoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VehiculoController implements the CRUD actions for Vehiculo model.
 */
class VehiculoController extends Controller
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
     * Lists all Vehiculo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VehiculoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vehiculo model.
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
     * Creates a new Vehiculo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cuadroid)
    {
        $model = new Vehiculo();
        $model->scenario = 'CVehiculo'; 
        $cuadro = \frontend\models\Cuadro::findOne(['id'=>$cuadroid]);

        if ($model->load(Yii::$app->request->post()))
            {
            $model->cuadroid=$cuadro->id;
            $model->save();
            return $this->redirect(['cuadro/view', 'id' => $model->cuadroid]);
        }

        return $this->render('create', [
            'model' => $model,
            'cuadro'=>$cuadro,
        ]);
    }

    /**
     * Updates an existing Vehiculo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'CVehiculo';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['cuadro/view', 'id' => $model->cuadroid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Vehiculo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id,$cuadroid)
    {
        $this->findModel($id)->delete();

          return $this->redirect(['cuadro/view', 'id' => $cuadroid]);
      
    }

    /**
     * Finds the Vehiculo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vehiculo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vehiculo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
