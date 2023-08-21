<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Objetivo;
use frontend\models\ObjetivoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use frontend\controllers\TrazasController;

/**
 * ObjetivoController implements the CRUD actions for Objetivo model.
 */
class ObjetivoController extends Controller
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
     * Lists all Objetivo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ObjetivoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['Status'=>1]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Objetivo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
         $model=$this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('kv-detail-success', 'Sus datos han sido guardados correctamente. ');
            // Multiple alerts can be set like below
           // Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            //Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            return $this->redirect(['view', 'id'=>$model->id]);
        } else {
            return $this->render('view', ['model'=>$model]);
        }
    
    }

    /**
     * Creates a new Objetivo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Objetivo();

        if ($model->load(Yii::$app->request->post()))
        {   
             date_default_timezone_set('America/Bogota'); //fija el huso horario en UTC-05:00
            $model->fechaAct = date('Y-m-d');
            $model->save(); 
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionDelete() {
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['custom_param'])) 
            {
            $id = $post['id'];
            if ($this->findModel($id)->updateAttributes(['Status'=>0])) 
            { 
                $accion = 'Eliminó';
                $tabla = 'Objetivo';
                $old = $id;
                $new = "";
                 TrazasController::actionCreate($tabla,$accion,$new,$old,'frontend\models\Objetivo');
            
            $models = \frontend\models\Criteriomedida::find()->andFilterWhere(['Objetivoid'=>$id])->andFilterWhere(['status'=>'1'])->all();
            $indicadores = \frontend\models\IndicadoresGestion::find()->andFilterWhere(['Objetivoid'=>$id])->andFilterWhere(['status'=>'1'])->all();
             foreach ($models as $model) 
                 {
                    $model->status = 0;
                      if($model->update(false)) // skipping validation as no user input is involved
                      {
                         $accion = 'Eliminó';
                         $tabla = 'Criterio de Medida';
                         $old = $model->id;
                         TrazasController::actionCreate($tabla,$accion,$new,$old,'frontend\models\Criteriomedida');

                       }

                }  
          foreach ($indicadores as $model) 
                 {
                    $model->status = 0;
                      if($model->update(false)) // skipping validation as no user input is involved
                      {
                         $accion = 'Eliminó';
                         $tabla = 'Indicadores de Gestión';
                         $old = $model->id;
                         TrazasController::actionCreate($tabla,$accion,$new,$old,'frontend\models\IndicadoresGestion');

                       }

                }  
                return $this->redirect(['index']);
            } else {
                   return $this->redirect(['view', 'id' => $model->id]);
            }
          
        }
        throw new InvalidCallException("Usted no tiene permitido realiazar esta operación.Contacte con el administrador del sistema.");
    }

    /**
     * Finds the Objetivo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Objetivo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Objetivo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
   
     public  function actionEvaluar()
     {
      $searchModel = new ObjetivoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['Status'=>1]);

        return $this->render('evaluacion', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); 
     }
    
    
    public static function EvaluaciondelObjetivo($id) 
    {
       //metodo que evalua el objetivo en dependencia del cumplimiento de los criteros de medida. La evaluación se da en "en retroseso", "en avance", "estancado"
        $cantidad = 0;
      // $criterios = [];
       $cumplido = 0;
       $crit1 = false;
       $crit2 = false;
       
       $criteriomedida = \frontend\models\Criteriomedida::findAll(['Objetivoid' => $id, 'status'=>1]);
       foreach ($criteriomedida as $criteriomedida)
       {
          $cantidad++;
           $criterioencontrado = CriteriomedidaController::buscarevaluacion($criteriomedida->id);
           if( $criterioencontrado!== null )
                {
                if(EvaluacionController::evaluarCumplimiento($criterioencontrado->id)=='Cumplido')
                    {
                    $cumplido++;
                        switch ($criterioencontrado->criteriomedida->orden)
                        {
                            case 1 : 
                                {
                                $crit1 = true;
                                break;
                                }
                            case 2 : 
                                {
                                $crit2 = true;
                                break;
                                }
     
                        }
                    }
                }
       
       }
       if($cantidad == $cumplido )
       {
           return 'avance';
       }    
       else{
           if($cantidad - $cumplido > 3 && $crit1 == FALSE )
           {
               return 'retroceso';
           }
           else{
               if($cumplido > 3 && $crit1 == TRUE && $crit2 == TRUE)
               {
                   return 'estancado';
               }
               else{
                   return 'retroceso';
               }
           }
       }
    }
}
