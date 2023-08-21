<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Trazas;
use frontend\models\TrazasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Cumplimiento;

/**
 * TrazasController implements the CRUD actions for Trazas model.
 */
class TrazasController extends Controller
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
     * Lists all Trazas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrazasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['fecha'=>'DESC']);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Trazas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
      $tarea = 0;
      $evaluacion = 0;
      $dataactual = 0;
      $dataanterior = 0;
       $model = $this->findModel($id);
       $anterior = $model->valor_antiguo;
       $actual = $model->valor_actual;
       
        if($model->tarea_realizada == 'Actualizó')
        {
            $tarea = 1;
        }
        if($model->Tabla_Afectada == 'Evaluacion')
        {
            $evaluacion = 1;
        }
        if($model->Tabla_Afectada == 'Cumplimiento')
        {
            $evaluacion = 4;
        }
        if($model->Tabla_Afectada == 'Criterio de Medida')
        {
            $evaluacion = 2;
        }
        if($model->Tabla_Afectada == 'Indicadores de Gestión')
        {
            $evaluacion = 3;
        }
         if($model->Tabla_Afectada == 'Objetivo')
        {
            $evaluacion = 5;
        }
        if($model->tarea_realizada == 'Creó')
        {
            $tarea = 2;
        }
        if($model->tarea_realizada == 'Eliminó')
        {
            $tarea = 3;
        }
         if($model->tarea_realizada == 'Certificó evaluación')
        {
            $tarea = 2;
        }
       
        if($tarea != 0)
       {
       $data = Yii::createObject($model->ubicacion);
       $dataactual = $data::findOne(['id'=>$actual]);
       $dataanterior = $data::findOne(['id'=>$anterior]);
       //return print_r([$dataanterior,$dataactual]);
       }
        return $this->render('view', [
            'model' => $model,
            'dataactual'=>$dataactual,
            'dataanterior'=>$dataanterior,
            'tarea' => $tarea,
            'evaluacion' => $evaluacion,
        ]);
    }

    /**
     * Creates a new Trazas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public static function actionCreate($tabl,$acc,$idnew,$idold,$ubicacion)
    {
      date_default_timezone_set('America/Bogota'); //fija el huso horario en UTC-05:00
     $traza = new Trazas();
     $traza->IdUsuario = \Yii::$app->user->getId();
     $traza->valor_antiguo = $idold;
     $traza->valor_actual = $idnew;
     $traza->Tabla_Afectada = $tabl;
     $traza->ubicacion = $ubicacion;
     $traza->fecha =  date("Y-m-d");
     $traza ->hora =  date("H:i:s");
     $traza->id_modificado = $idold;
     $traza->tarea_realizada = $acc;
          if(Yii::$app->request->userIP == "::1")
      { 
         $traza->ip = "127.0.0.1";   
      }
      else
      {        
         $traza->ip = Yii::$app->request->userIP;  
      } 
    // return print_r($traza);
      if($traza->save())
      {
          return TRUE;
          
      }
      else{          return FALSE;}
      }

    /**
     * Updates an existing Trazas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->IdTraza]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Trazas model.
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
     * Finds the Trazas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Trazas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Trazas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
