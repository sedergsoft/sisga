<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Indicadoresgestion;
use frontend\models\IndicadoresgestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IndicadoresgestionController implements the CRUD actions for Indicadoresgestion model.
 */
class IndicadoresgestionController extends Controller
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
     * Lists all Indicadoresgestion models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);  
        }
        $forma = 0;
        $searchModel = new IndicadoresgestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['status'=>1])->orderBy(['objetivoid' => SORT_ASC, 'orden' => SORT_ASC]);
        
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
             'forma' => $forma,
        ]);
    }
    
     public function actionLlenar()
    {
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);  
        }  
        
        $forma = 1;
        $searchModel = new IndicadoresgestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['direccionid'=> UserController::findmodel(\Yii::$app->user->getId())->direccionid])->andFilterWhere(['status'=>1]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'forma' => $forma,
        ]);
    }
    
     public function actionEdit($id)
    {
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);  
        }
     $model=$this->findModel($id);
     if($model->editable == 1)
     {
        return $this->redirect(['cumplimiento/create','id'=>$id]);
     }
     else{
          Yii::$app->session->setFlash("error_cerrado"); 
        // Yii::$app->session->setFlash('kv-detail-danger', );
         $this->redirect(['llenar']);
     }
    }

    /**
     * Displays a single Indicadoresgestion model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);  
        }
        $model=$this->findModel($id);
           $modelTope = TopeIndicadorController::findModel($model->topeid);
           $modelsentido = SentidoController::findModel($modelTope->idsentido);
          
           //$modelTope = \frontend\models\Tope::find(['id'=>$model->topeid]);


        if ($model->load(Yii::$app->request->post())) 
            {
            $post = Yii::$app->request->post(); 
            
            $tope =$_POST['IndicadoresGestion'];
            $tope = $tope['tope'];
            //return print_r($tope);//$trimestre1= $tope['Itrimestre'];
            $modelTope->valor= $tope['valor']; 
            $modelTope->idsentido = $tope['idsentido'];
           
            
            if($model->save() && $modelTope->update())
            {
            Yii::$app->session->setFlash('kv-detail-success', 'Sus datos han sido guardados correctamente. ');
            // Multiple alerts can be set like below
           // Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            //Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            return $this->redirect(['view', 'id'=>$model->id]);
            }
            else{
                 Yii::$app->session->setFlash('kv-detail-danger', 'Sus datos no se han guardado correctamente...Intentelo una vez más. ');
                 return $this->redirect(['view', 'id'=>$model->id]);
           
            }
        } else {
            return $this->render('view', ['model'=>$model/*,'modelTope'=>$modelTope*/]);
        }
    }

    /**
     * Creates a new Indicadoresgestion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
         if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);  
        }
        $model = new Indicadoresgestion();
        $modeltope = new \frontend\models\TopeIndicador();

        if ($model->load(Yii::$app->request->post()) && $modeltope->load(Yii::$app->request->post())) 
            
            {
            if($modeltope->save())
            {
            $model->topeid = $modeltope->id;
            if($model->save())
            {
                  TrazasController::actionCreate('Indicadores de Gestión','Creó',$model->id,'','frontend\models\Indicadoresgestion');
                  return $this->redirect(['view', 'id' => $model->id]);
           }
            
            }
            
            }

        return $this->render('create', [
            'model' => $model,
            'modeltope' => $modeltope,
        ]);
    }

    /**
     * Updates an existing Indicadoresgestion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
         if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);  
        }
        $model=$this->findModel($id);
     if($model->editable == 1)
     {
        return $this->redirect(['cumplimiento/update','id'=>$id]);
     }
     else{
          Yii::$app->session->setFlash("error_cerrado"); 
        // Yii::$app->session->setFlash('kv-detail-danger', );
         $this->redirect(['llenar']);
     }
    }

    /**
     * Deletes an existing Indicadoresgestion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionDelete() {
         if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);  
        }
         $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['custom_param'])) {
            $id = $post['id'];
            $model = $this->findModel($id);
            if ($model->updateAttributes(['status'=>0])) {
            TrazasController::actionCreate('Indicadores de Gestión','Eliminó','',$model->id,'frontend\models\Indicadoresgestion');

                return $this->redirect(['index']);
            } else {
                   return $this->redirect(['view', 'id' => $model->id]);
            }
          
        }
        throw new InvalidCallException("Usted no tiene permitido realiazar esta operación.Contacte con el administrador del sistema.");
    }

    /**
     * Finds the Indicadoresgestion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Indicadoresgestion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id)
    {
        if (($model = Indicadoresgestion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
      public static function buscarOrdenGeneral($id) 
    {
        $indicador = IndicadoresgestionController::findModel($id);
        $ordenObjetivo = $indicador->objetivo->orden;
        $ordenIndicador = $indicador->orden;
        
       return  $ordenObjetivo.".".$ordenIndicador;
        
        
    }
    
    public function comprobar() //funcion que comprueba si el el indicador de encuentra en el periodo editable
    {
        if(\frontend\models\IndicadoresGestion::findOne(['editable'=>1,'status'=>1])!== NULL)
        {
           return TRUE; 
        }else{
            return FALSE;
        }
        
    }
    
    public function actionCerrarperiodoevaluacion() //funcion que cierra el periodo de evaluacion delos indicadores de gestion
    {
         if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);  
        }
        if($this->comprobar())
        {
        \frontend\models\IndicadoresGestion::updateAll(['editable'=>0],['status'=>1]); 
         TrazasController::actionCreate('Indicadores de Gestión','Cerró el periodo de Evaluación','','','');
                 
        Yii::$app->session->setFlash("ok_cerrado");
        return $this->redirect(['index']);
        }
        else{
        Yii::$app->session->setFlash("ya_cerrado");
        return $this->redirect(['index']);    
        }
        
        }
    
     public function actionActivarperiodoevaluacion() //funcion que activa el periodo de edicion de los indicadores
    {
      if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);  
        }
        if(!$this->comprobar())
        {
        \frontend\models\IndicadoresGestion::updateAll(['editable'=>1],['status'=>1]);  
         TrazasController::actionCreate('Indicadores de Gestión','Activó el periodo de Evaluación','','','');
                 
        Yii::$app->session->setFlash("ok_activado");
        return $this->redirect(['index']);
        }else{
        Yii::$app->session->setFlash("ya_abierto");
        return $this->redirect(['index']);    
            
        }
        
        }

     public function actionCerrarmes() //funcion que activa el periodo de edicion de los indicadores
    {
     
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/login']);  
        }
         \frontend\models\Cumplimiento::updateAll(['actual'=>0],['actual'=>1]);
        \frontend\models\IndicadoresGestion::updateAll(['editable'=>1,'evaluado'=>0],['status'=>1]);  
         TrazasController::actionCreate('Indicadores de Gestión','Cerró la información del mes','','','');
                 
        Yii::$app->session->setFlash("ok_mes_cerrado");
        return $this->redirect(['index']);
        
        
    }
        
        } 
