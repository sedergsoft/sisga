<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Sanciones;
use frontend\models\SancionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SancionesController implements the CRUD actions for Sanciones model.
 */
class SancionesController extends Controller
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
     * Lists all Sanciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SancionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sanciones model.
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
     * Creates a new Sanciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cuadroid)
    {
        $model = new Sanciones();
        $model->scenario = 'CSanciones';
        $cuadro = \frontend\models\Cuadro::findOne(['id'=>$cuadroid]);

        if ($model->load(Yii::$app->request->post())) 
            {
            $model->save(); 
            $modelCuadroSanciones = new \frontend\models\CuadroSanciones;
            $modelCuadroSanciones->cuadroid = $cuadro->id;
            $modelCuadroSanciones->sancionesid = $model->id;
            $modelCuadroSanciones->save();
           return $this->redirect(['cuadro/view', 'id' => $cuadroid]);
        }

        return $this->render('create', [
            'model' => $model,
            'cuadro'=>$cuadro,
        ]);
    }

    /**
     * Updates an existing Sanciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['cuadro/view', 'id' => $model->cuadroSanciones[0]->cuadroid]);
        }

        return $this->render('update', [
            'model' => $model,
          
            
        ]);
    }

    /**
     * Deletes an existing Sanciones model.
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
     * Finds the Sanciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sanciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sanciones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
