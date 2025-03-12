<?php

namespace frontend\controllers;

use Yii;
use frontend\models\EvaluacionCuadro;
use frontend\models\EvaluacionCuadroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * EvaluacionCuadroController implements the CRUD actions for EvaluacionCuadro model.
 */
class EvaluacionCuadroController extends Controller
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
     * Lists all EvaluacionCuadro models.
     * @return mixed
     */
    public function actionIndex()
    {
       if(Yii::$app->user->isGuest)
     {
         $this->redirect(['site/login']);   
     }
           
        $searchModel = new EvaluacionCuadroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
  
    public function actionVerevaluacioncuadro()
    {
      
         $model = new \frontend\models\Cuadro();

        if ($model->load(Yii::$app->request->post()) ) {
           
           // return print_r($_POST['Cuadro']['id']);
            return $this->redirect(['evaluacionxcuadro', 'id' => $_POST['Cuadro']['id']]);
        }

       return $this->render('selecionarcuadro',[
           'model'=>$model]);
                  
 
            
       
    }
    
    public function actionEvaluacionxcuadro($id=null)
    {
       
        //return print_r($_POST);
        if(Yii::$app->user->isGuest)
        {
         $this->redirect(['site/login']);   
        }
        if($id == null)
        {
            $id = $_POST['Cuadro']['id'];
            
        }
        $model = new \frontend\models\Cuadro;    
        $searchModel = new EvaluacionCuadroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['cuadroid'=>$id])->all();
        $cuadro = \frontend\models\Cuadro::findOne(['id'=>$id]);

        return $this->render('evaluacionxcuadro', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cuadro'=>$cuadro,
            'model'=>$model,
        ]);
    }
    /**
     * Displays a single EvaluacionCuadro model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
       if(Yii::$app->user->isGuest)
     {
         $this->redirect(['site/login']);   
     }
        
        $searchModel = new \frontend\models\EvaluacionCuadroIndicadoresEvaluacionSearch();
        $modelsEvaluaciones = $searchModel->search(Yii::$app->request->queryParams);

        $modelsEvaluaciones->query->andWhere(['evaluacion_cuadroid'=>$id])->all();
        return $this->render('view', [
            
            'model' => $this->findModel($id),
            'modelsEvaluaciones'=>$modelsEvaluaciones,
        ]);
    }

    /**
     * Creates a new EvaluacionCuadro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id, $mensaje = null,$style=null)
    {
         if(Yii::$app->user->isGuest)
     {
         $this->redirect(['site/login']);   
     }
        $cuadro = \frontend\models\Cuadro::findOne(['id'=>$id]);
        $model = new EvaluacionCuadro();
        $modelPeriodoEvaluado = new \frontend\models\PeriodoEvaluado();
        $modelExperiencia = new \frontend\models\Experiencia();
        $modelProyeccion = new \frontend\models\Proyeccion();
        $query = \frontend\models\IndicadoresEvaluacion::find()->andFilterWhere(['active'=>1]);
        $modelConfeccionado = new \frontend\models\Confecionado();

$dataProviderIndicadores = new \yii\data\ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pagesize' => 10
    ]
]);
        $modelEvaluacion_Indicador = new \frontend\models\EvaluacionCuadroIndicadoresEvaluacion();
        $modelEvaluacionIndicador[] = "";
        $modelReserva = new \frontend\models\Reserva();
        $modelOpinionEvaluado = new \frontend\models\OpinionEvaluado();
        if ($model->load(Yii::$app->request->post())
            && $modelExperiencia->load(Yii::$app->request->post())
            &&$modelOpinionEvaluado->load(Yii::$app->request->post())
            &&$modelPeriodoEvaluado->load(Yii::$app->request->post())
            &&$modelReserva->load(Yii::$app->request->post())
           &&$modelProyeccion->load(Yii::$app->request->post())
           &&$modelConfeccionado->load(Yii::$app->request->post()))
            
        {
            
            
            //return print_r($_POST);
            
            if($modelReserva->save()
                    && $modelPeriodoEvaluado->save() 
                    && $modelExperiencia->save() 
                    && $modelOpinionEvaluado->save() 
                    && $modelProyeccion->save()
                    && $modelConfeccionado->save())
            {
                
             $model->cuadroid = $cuadro->id;
             $model->reservaid = $modelReserva->id;
             $model->periodo_evaluadoid = $modelPeriodoEvaluado->id;
             $model->experienciaid = $modelExperiencia->id;
             $model->opinion_evaluadoid = $modelOpinionEvaluado->id;
             $model->confecionado = $modelConfeccionado->id;
             $model->proyeccionid = $modelProyeccion->id;
             $model->fecha = date('y-m-d');
             if(CuadroController::evaluado($cuadro->id)!=FALSE)
             {
             EvaluacionCuadro::find()->where(['ultima'=>1,'cuadroid'=>$cuadro->id])->one()->updateAttributes(['ultima'=>0]);             
             }
             if($model->save())
             {
               //  return print_r('guardado ok');
             if(isset($_POST['IndicadoresEvaluacion']))
             {
                 foreach ($_POST['IndicadoresEvaluacion'] as $key => $modelEvaluacionIndicador) 
                 {
                     //return print_r($modelEvaluacionIndicador);
                  $modelCuadroEvacluacionIndicador = new \frontend\models\EvaluacionCuadroIndicadoresEvaluacion();
                  $modelCuadroEvacluacionIndicador->evaluacion_cuadroid = $model->id;
                  $modelCuadroEvacluacionIndicador->Indicadores_evaluacionid = $modelEvaluacionIndicador['id'];
                  $modelCuadroEvacluacionIndicador->evaluacion = $modelEvaluacionIndicador['active'];
                  $modelCuadroEvacluacionIndicador->save();
                  
                 }  
             }
            if(\frontend\models\PlanEvaluacion::findOne(['idcuadro'=>$model->cuadroid,'status'=>0,'ultima'=>1]))
            {
                \frontend\models\PlanEvaluacion::findOne(['idcuadro'=>$model->cuadroid,'status'=>0,'ultima'=>1])->updateAttributes(['status'=>1]);
            }
             
             return $this->redirect(['view', 'id' => $model->id]);
             }
            else{return print_r('Error guardar model');}
             
            }
            
            }
      if($mensaje != null)
      {
          Yii::$app->session->setFlash('mensaje');
                       
      }
            
        return $this->render('create', [
            'model' => $model,
            'cuadro'=>$cuadro,
            'style'=>$style,
            'mensaje'=>$mensaje,
            'modelPeriodoEvaluado'=>$modelPeriodoEvaluado,
            'modelExperiencia'=>$modelExperiencia,
            'dataProviderIndicadores'=>$dataProviderIndicadores,
            'modelEvaluacionIndicador' => $modelEvaluacionIndicador,
            'modelEvaluacion_Indicador'=>/*(empty($modelEvaluacionIndicador))?[new \frontend\models\EvaluacionCuadroIndicadoresEvaluacion()]:*/$modelEvaluacion_Indicador,
            'modelProyeccion'=>$modelProyeccion,
            'modelReserva' => $modelReserva,
            'modelOpinionEvaluado'=>$modelOpinionEvaluado,
            'modelConfeccionado'=>$modelConfeccionado,
            ]);
    }

    /**
     * Updates an existing EvaluacionCuadro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
         if(Yii::$app->user->isGuest)
     {
         $this->redirect(['site/login']);   
     }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EvaluacionCuadro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->isGuest)
     {
         $this->redirect(['site/login']);   
     }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionExportarpdf() 
    {
       if(Yii::$app->user->isGuest)
     {
         $this->redirect(['site/login']);   
     }
        $searchModel = new EvaluacionCuadroSearch();
        $id = 31;
    $modelplantilla  = \frontend\models\Plantilla::find()->andWhere(['empresaid'=>$id])->one();
    
      //  $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
          $sql = 'SELECT DISTINCT calificacion.calificacion as indicador,(SELECT COUNT(evaluacion_cuadro.resultado_evaluacion ) FROM evaluacion_cuadro WHERE evaluacion_cuadro.resultado_evaluacion = calificacion.id AND evaluacion_cuadro.ultima = 1) AS total FROM calificacion';
    $rawcalificacion = Yii::$app->db->createCommand($sql)->queryAll();
    $sql = 'SELECT DISTINCT tipo_proyeccion.tipo as indicador,(SELECT COUNT(proyeccion.tipo_proyeccionid ) FROM evaluacion_cuadro INNER JOIN proyeccion ON evaluacion_cuadro.proyeccionid = proyeccion.id WHERE proyeccion.tipo_proyeccionid = tipo_proyeccion.id AND evaluacion_cuadro.ultima = 1) AS total FROM tipo_proyeccion';
    $rawProyeccion = Yii::$app->db->createCommand($sql)->queryAll();
   $sql = 'SELECT DISTINCT tipo_movimiento.tipo_movimiento as indicador,(SELECT COUNT(proyeccion.tipo_movimientoid ) FROM evaluacion_cuadro INNER JOIN proyeccion ON evaluacion_cuadro.proyeccionid = proyeccion.id WHERE proyeccion.tipo_movimientoid = tipo_movimiento.id AND evaluacion_cuadro.ultima = 1) AS total FROM tipo_movimiento';
    $rawmovimiento = Yii::$app->db->createCommand($sql)->queryAll();
    $sql = 'SELECT DISTINCT tipo_reserva.tipo as indicador,(SELECT COUNT(reserva.tipo ) FROM evaluacion_cuadro INNER JOIN reserva ON evaluacion_cuadro.reservaid = reserva.id WHERE reserva.tipo = tipo_reserva.id AND evaluacion_cuadro.ultima = 1 ) AS total FROM tipo_reserva';
    $reservaData = Yii::$app->db->createCommand($sql)->queryAll();
 
   $result =  \yii\helpers\ArrayHelper::merge($rawcalificacion, $rawProyeccion);
   $result =  \yii\helpers\ArrayHelper::merge($result, $rawmovimiento);
   $result =  \yii\helpers\ArrayHelper::merge($result, $reservaData);
   
   $dataProvider =  new \yii\data\ArrayDataProvider(['allModels'=>$result, 'sort'=>['attributes'=>['indicador','total'],],]);
  $nombre = 'Modelo Estadistico del Proceso de evaluación ';
    $content =  $this->renderPartial('pdfEstadistica', [
            //'searchModel' => $searchModel,
            'rawcalificacion'=>$rawcalificacion,
            'rawProyeccion'=>$rawProyeccion,
            'rawmovimiento'=>$rawmovimiento,
            'reservaData'=>$reservaData,
            'result' => $result,
            'dataProvider'=>$dataProvider,
            'modelplantilla'=>$modelplantilla,
                   
       
   ]); 
   
   
  $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_CORE, 
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_PORTRAIT, 
        // stream to browser inline
        'destination' => Pdf::DEST_BROWSER, 
        // your html content input
        'content' => $content,  
        'defaultFontSize'=>60,
        // format content from your own css file if needed or use the
       // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
        'cssInline' => 'td{font-size:10px},th{font-size:12px},div.panel-heading{font-size:12px},.panel-title {
    margin-top: 0;
    margin-bottom: 0;
    font-size: 12px;
    color: inherit;
}

sisga.css:144
h1',    // format content from your own css file if needed or use the
       'filename' => $nombre.date('M, Y'),
       'options' => ['title' => "OSDE GA"],
         // call mPDF methods on the fly
        
        'methods' => [ 
            //'SetHeader'=>[ '<img class="pull-left"  src="'. Yii::$app->request->baseUrl.'/'.'images/logomincin1.png" style="display:inline; horizontal-align: top; height:35px;">'], 
            'SetFooter'=>['{PAGENO}'],
        ]
    ]);
       
        
     
       return $pdf->render();   
       return  $this->renderPartial('pdfEstadistica', [
            //'searchModel' => $searchModel,
            'rawcalificacion'=>$rawcalificacion,
            'rawProyeccion'=>$rawProyeccion,
            'rawmovimiento'=>$rawmovimiento,
            'reservaData'=>$reservaData,
            'result' => $result,
            'dataProvider'=>$dataProvider,
            'modelplantilla'=>$modelplantilla,
           
       
   ]);
 
   
    }
    
    public function actionEstadistica() 
    {
       if(Yii::$app->user->isGuest)
     {
         $this->redirect(['site/login']);   
     }  
      $searchModel = new EvaluacionCuadroSearch();
      if(Yii::$app->user->identity->rolid!=1)
      {
        $id = Yii::$app->user->identity->direccionid;
      }
      
    $modelplantilla  = \frontend\models\Plantilla::find()->andWhere(['empresaid'=>$id])->one();
    if(!$modelplantilla){
        $this->redirect(['plantilla/create']);
    }
          $sql = 'SELECT DISTINCT calificacion.calificacion as indicador,(SELECT COUNT(evaluacion_cuadro.resultado_evaluacion ) FROM evaluacion_cuadro INNER JOIN cuadro ON evaluacion_cuadro.cuadroid=cuadro.id  WHERE evaluacion_cuadro.resultado_evaluacion = calificacion.id AND evaluacion_cuadro.ultima = 1 AND cuadro.entidadid = '.$id.') AS total FROM calificacion';
    $rawcalificacion = Yii::$app->db->createCommand($sql)->queryAll();
    $sql = 'SELECT DISTINCT tipo_proyeccion.tipo as indicador,(SELECT COUNT(proyeccion.tipo_proyeccionid ) FROM evaluacion_cuadro INNER JOIN proyeccion ON evaluacion_cuadro.proyeccionid = proyeccion.id INNER JOIN cuadro ON evaluacion_cuadro.cuadroid=cuadro.id WHERE proyeccion.tipo_proyeccionid = tipo_proyeccion.id AND evaluacion_cuadro.ultima = 1 AND cuadro.entidadid = '.$id.') AS total FROM tipo_proyeccion';
    $rawProyeccion = Yii::$app->db->createCommand($sql)->queryAll();
   $sql = 'SELECT DISTINCT tipo_movimiento.tipo_movimiento as indicador,(SELECT COUNT(proyeccion.tipo_movimientoid ) FROM evaluacion_cuadro INNER JOIN proyeccion ON evaluacion_cuadro.proyeccionid = proyeccion.id INNER JOIN cuadro ON evaluacion_cuadro.cuadroid=cuadro.id WHERE proyeccion.tipo_movimientoid = tipo_movimiento.id AND evaluacion_cuadro.ultima = 1 AND cuadro.entidadid = '.$id.') AS total FROM tipo_movimiento';
    $rawmovimiento = Yii::$app->db->createCommand($sql)->queryAll();
    $sql = 'SELECT DISTINCT tipo_reserva.tipo as indicador,(SELECT COUNT(reserva.tipo ) FROM evaluacion_cuadro INNER JOIN reserva ON evaluacion_cuadro.reservaid = reserva.id INNER JOIN cuadro ON evaluacion_cuadro.cuadroid=cuadro.id WHERE reserva.tipo = tipo_reserva.id AND evaluacion_cuadro.ultima = 1 AND cuadro.entidadid = '.$id.') AS total FROM tipo_reserva';
    $reservaData = Yii::$app->db->createCommand($sql)->queryAll();
    $sql = 'SELECT COUNT(ec.cuadroid) AS evaluados 
    FROM evaluacion_cuadro ec 
    INNER JOIN cuadro c ON ec.cuadroid = c.id 
    WHERE c.entidadid = :id AND ec.ultima = 1';
$evaluados = Yii::$app->db->createCommand($sql)
->bindValue(':id', $id) // Asegúrate de usar bindValue para evitar inyecciones SQL
->queryScalar(); // queryScalar devuelve el primer valor de la primera fila
echo $evaluados;
$result =  \yii\helpers\ArrayHelper::merge($rawcalificacion, $rawProyeccion);
   $result =  \yii\helpers\ArrayHelper::merge($result, $rawmovimiento);
   $result =  \yii\helpers\ArrayHelper::merge($result, $reservaData);
   
   
   $dataProvider =  new \yii\data\ArrayDataProvider(['allModels'=>$result, 'sort'=>['attributes'=>['indicador','total'],],]);
        
 //return print_r($dataProvider);
 
        return $this->render('estadistica', [
            //'searchModel' => $searchModel,
            'rawcalificacion'=>$rawcalificacion,
            'rawProyeccion'=>$rawProyeccion,
            'rawmovimiento'=>$rawmovimiento,
            'reservaData'=>$reservaData,
            'evaluados'=>$evaluados,
            'result' => $result,
            'dataProvider'=>$dataProvider,
            'modelplantilla'=>$modelplantilla,
            
        ]);    
    }
    /**
     * Finds the EvaluacionCuadro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EvaluacionCuadro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EvaluacionCuadro::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
     public function actionGrafico() 
    {
       if(Yii::$app->user->isGuest)
     {
         $this->redirect(['site/login']);   
     }
        return $this->render('analisisGrafico');    
    }
   
}
