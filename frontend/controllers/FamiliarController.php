<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Familiar;
use frontend\models\FamiliarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * FamiliarController implements the CRUD actions for Familiar model.
 */
class FamiliarController extends Controller
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
     * Lists all Familiar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FamiliarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Familiar model.
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
     * Creates a new Familiar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($cuadroid)
    {
        $model = new Familiar();
        $cuadro = \frontend\models\Cuadro::findOne(['id'=> $cuadroid]);
       $modelPersonaFamiliar = new \frontend\models\Persona;
       
        if ($model->load(Yii::$app->request->post()) && $modelPersonaFamiliar->load(Yii::$app->request->post()))
        {
         $model->personaCI = $modelPersonaFamiliar->CI;
         $model->sancionado = 0;
         $model->residenteExterior = 0;
         $model->viaje = 0;
        // return print_r($model->validate());
            
         if($modelPersonaFamiliar->save())
         {
         $model->save();
       //  return print_r($model->id);
         $modelcuadoFamiliar = new \frontend\models\CuadroFamiliar();
         $modelcuadoFamiliar->cuadroid = $cuadroid;
         $modelcuadoFamiliar->familiarid = $model->id;
         $modelcuadoFamiliar->save();
         Yii::$app->session->setFlash('mensaje');
        $mensaje = 'El familiar ha sido Agregado correctamente';
        $style = 'alert-success';
         
         return $this->redirect(['cuadro/view', 
                                 'id' => $cuadroid,
                                 'mensaje'=>$mensaje,
                                 'style'=>$style,
             ]);
         }else{
              return $this->render('create', [
            'model' => $model,
            'cuadro'=>$cuadro, 
            'modelPersonaFamiliar'=>$modelPersonaFamiliar,
            
        ]);
         }
        
         }
         

        return $this->render('create', [
            'model' => $model,
            'cuadro'=>$cuadro, 
            'modelPersonaFamiliar'=>$modelPersonaFamiliar,
            
        ]);
    }

    /**
     * Updates an existing Familiar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelPersonaFamiliar = $model->personaCI0;
        $modelCuadroFamiliar = \frontend\models\CuadroFamiliar::findOne(['familiarid'=>$id]);
        $cuadro = $modelCuadroFamiliar->cuadro;
       // return print_r($cuadro);

        if ($model->load(Yii::$app->request->post())&& $modelPersonaFamiliar->load(Yii::$app->request->post()) && $model->save()&& $modelPersonaFamiliar->save()) {
            return $this->redirect(['cuadro/view', 'id' => $cuadro->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'cuadro'=>$cuadro,
            'modelPersonaFamiliar'=>$modelPersonaFamiliar,
        ]);
    }

    /**
     * Deletes an existing Familiar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       
        $model = $this->findModel($id);
       $modelCuadroFamiliar = \frontend\models\CuadroFamiliar::findOne(['familiarid'=>$id]);
    
        
        $model->updateAttributes(['active'=>0]);
        Yii::$app->session->setFlash('mensaje');
        $mensaje = 'El familiar ha sido eliminado correctamente';
        $style = 'alert-success';
                                        

        return $this->redirect(['cuadro/view','id'=>$modelCuadroFamiliar->cuadro->id,'mensaje'=>$mensaje,'style'=>$style]);
    }

    /**
     * Finds the Familiar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Familiar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Familiar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
