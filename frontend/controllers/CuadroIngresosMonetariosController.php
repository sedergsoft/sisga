<?php

namespace frontend\controllers;

use Yii;
use frontend\models\CuadroIngresosMonetarios;
use frontend\models\CuadroIngresosMonetariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\IngresosMonetarios;
/**
 * CuadroIngresosMonetariosController implements the CRUD actions for CuadroIngresosMonetarios model.
 */
class CuadroIngresosMonetariosController extends Controller
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
     * Lists all CuadroIngresosMonetarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CuadroIngresosMonetariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CuadroIngresosMonetarios model.
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
     * Creates a new CuadroIngresosMonetarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cuadroid)
    {
//        $model = new CuadroIngresosMonetarios();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);
        
        if(\yii::$app->user->can('create_ingreso'))
        {
        $model = new IngresosMonetarios();
        $modelcuadroIngreso = new CuadroIngresosMonetarios();
      
        $cuadro = \frontend\models\Cuadro::findOne(['id'=>$cuadroid]);
        

        if ($model->load(Yii::$app->request->post()))
            {
            //$model->cuadroid = $cuadro->id;
            if($model->save())
            {
             $modelcuadroIngreso->ingresos_monetariosid = $model->id;
             $modelcuadroIngreso->cuadroid = $cuadro->id;
             if($modelcuadroIngreso->save())
             {
                return $this->redirect(['cuadro/view', 'id' => $cuadro->id]);
         
             }
            }
            
            }

        return $this->render('create', [
            'model' => $model,
            'cuadro' => $cuadro,
        ]);
        }
        else{
            
            throw new \yii\web\ForbiddenHttpException('No tiene permisos para realizar esta acción');
        }
    }

    /**
     * Updates an existing CuadroIngresosMonetarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = IngresosMonetariosController::findModel($id);
        $modelcuadroIngreso = CuadroIngresosMonetarios::find()->where(['ingresos_monetariosid'=>$id,'status'=>1])->one();
        $cuadro = \frontend\models\Cuadro::findOne(['id'=>$modelcuadroIngreso->cuadroid]);
        //return print_r($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['cuadro/view', 'id' => $modelcuadroIngreso->cuadroid]);
        }

        return $this->render('update', [
            'model' => $model,
            'cuadro'=>$cuadro,
        ]);
    }

    /**
     * Deletes an existing CuadroIngresosMonetarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        
        $model = IngresosMonetariosController::findModel($id);
        $modelcuadroIngreso = CuadroIngresosMonetarios::find()->where(['ingresos_monetariosid'=>$id,'status'=>1])->one();
        $cuadro = \frontend\models\Cuadro::findOne(['id'=>$modelcuadroIngreso->cuadroid]);
      
        $this->findModel($modelcuadroIngreso->id)->updateAttributes(['status'=>0]);

       return $this->redirect(['cuadro/view', 'id' => $modelcuadroIngreso->cuadroid]);
     
    }

    /**
     * Finds the CuadroIngresosMonetarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CuadroIngresosMonetarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CuadroIngresosMonetarios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
