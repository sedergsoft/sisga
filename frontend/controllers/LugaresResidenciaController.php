<?php

namespace frontend\controllers;

use Yii;
use frontend\models\LugaresResidencia;
use frontend\models\LugaresResidenciaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LugaresResidenciaController implements the CRUD actions for LugaresResidencia model.
 */
class LugaresResidenciaController extends Controller
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
     * Lists all LugaresResidencia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LugaresResidenciaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LugaresResidencia model.
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
     * Creates a new LugaresResidencia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cuadroid)
    {
        $model = new LugaresResidencia();
        $cuadro = \frontend\models\Cuadro::findOne(['id'=>$cuadroid]);
        $modelDireResidencia = new \frontend\models\Direcciones();
        if (($model->load(Yii::$app->request->post()))&&($modelDireResidencia->load(Yii::$app->request->post())))
            {
            $modelDireResidencia->save();
            $model->cuadroid = $cuadroid;
            $model->direccionesid = $modelDireResidencia->id; 
            $model->save();
            return $this->redirect(['cuadro/view', 'id' => $cuadroid]);
       
        }
        return $this->render('create', [
            'model' => $model,
            'cuadro'=>$cuadro,
            'modelDireResidencia'=>$modelDireResidencia,
        ]);
    }
    
    /**
     * Updates an existing LugaresResidencia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id,$cuadroid)
    {
        $model = $this->findModel($id);

         $cuadro = \frontend\models\Cuadro::findOne(['id'=>$cuadroid]);
        $modelDireResidencia = \frontend\models\Direcciones::findOne([$model->direccionesid]);
        if (($model->load(Yii::$app->request->post()))&&($modelDireResidencia->load(Yii::$app->request->post())))
            {
            $modelDireResidencia->save();
            $model->direccionesid = $modelDireResidencia->id; 
            $model->save();
            return $this->redirect(['cuadro/view', 'id' => $cuadroid]);
       
        }
        return $this->render('update', [
            'model' => $model,
            'cuadro'=>$cuadro,
            'modelDireResidencia'=>$modelDireResidencia,
        ]);

        
    }

    /**
     * Deletes an existing LugaresResidencia model.
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
     * Finds the LugaresResidencia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LugaresResidencia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LugaresResidencia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionLists($id) 
    {
    frontend\controllers\CuadroController::actionLists($id);
    }

}
