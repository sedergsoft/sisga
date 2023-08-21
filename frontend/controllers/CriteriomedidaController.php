<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Criteriomedida;
use frontend\models\CriteriomedidaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CriteriomedidaController implements the CRUD actions for Criteriomedida model.
 */
class CriteriomedidaController extends Controller
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
     * Lists all Criteriomedida models.
     * @return mixed
     */
    public function actionIndex()
    {
        $forma = 0;
        $searchModel = new CriteriomedidaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['status'=>1])->orderBy(['Objetivoid' => SORT_ASC, 'orden' => SORT_ASC]);;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'forma'=>$forma,
        ]);
    }

     public function actionLlenar()
    {
       $forma = 1;
        $searchModel = new CriteriomedidaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['status'=>1])->andFilterWhere(['direccionid'=> UserController::findmodel(\Yii::$app->user->getId())->direccionid]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'forma'=>$forma,
        ]);
    }
    /**
     * Displays a single Criteriomedida model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
           $model=$this->findModel($id);
           $modelTope = TopeController::findModel($model->topeid);
          
           //$modelTope = \frontend\models\Tope::find(['id'=>$model->topeid]);


        if ($model->load(Yii::$app->request->post())) 
            {
            $post = Yii::$app->request->post(); 
            $tope =$_POST['Criteriomedida'];
            $tope = $tope['tope'];
            //$trimestre1= $tope['Itrimestre'];
            $modelTope->Itrimestre = $tope['Itrimestre']; 
            $modelTope->IItrimestre = $tope['IItrimestre'];
            $modelTope->IIItrimestre = $tope['IIItrimestre'];
            $modelTope->IVtrimestre = $tope['IVtrimestre'];
            
            if($model->save() && $modelTope->update())
            {
            Yii::$app->session->setFlash('kv-detail-success', 'Sus datos han sido guardados correctamente. ');
            // Multiple alerts can be set like below
           // Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            //Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            return $this->redirect(['view', 'id'=>$model->id]);
            }
            else{
                 Yii::$app->session->setFlash('kv-detail-danger', 'Sus datos no se han guardado correctamente...Intentelo una vez m�s. ');
                 return $this->redirect(['view', 'id'=>$model->id]);
           
            }
        } else {
            return $this->render('view', ['model'=>$model/*,'modelTope'=>$modelTope*/]);
        }
    }

    /**
     * Creates a new Criteriomedida model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Criteriomedida();
        $modelTope = new \frontend\models\Tope();

        if ($model->load(Yii::$app->request->post()) && $modelTope->load(Yii::$app->request->post()))
        {
            $modelTope->save ();
            $model->topeid = $modelTope->id;
            $model->save();
            TrazasController::actionCreate('Criterio de Medida','Creó',$model->id,'','frontend\models\Criteriomedida');
            
         return $this->redirect(['view', 'id' => $model->id]);
            
        }
        return $this->render('create', [
            'modelTope' => $modelTope,
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Criteriomedida model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
       $model=$this->findModel($id);
     if($model->editable == 1)
     {
        return $this->redirect(['evaluacion/update','id'=>$id]);
     }
     else{
          Yii::$app->session->setFlash("error_cerrado"); 
        // Yii::$app->session->setFlash('kv-detail-danger', );
         $this->redirect(['llenar']);
     }
    }

    /**
     * Deletes an existing Criteriomedida model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
       public function actionDelete() {
        $post = Yii::$app->request->post();
        if (Yii::$app->request->isAjax && isset($post['custom_param'])) {
            $id = $post['id'];
            $model = $this->findModel($id);
            if ($model->updateAttributes(['status'=>0])) {
            TrazasController::actionCreate('Criterio de Medida','Eliminó','',$model->id,'frontend\models\Criteriomedida');

                return $this->redirect(['index']);
            } else {
                   return $this->redirect(['view', 'id' => $model->id]);
            }
          
        }
        throw new InvalidCallException("Usted no tiene permitido realiazar esta operación.Contacte con el administrador del sistema.");
    }
 /**
     * Finds the Criteriomedida model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Criteriomedida the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id)
    {
        if (($model = Criteriomedida::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    public static function buscarOrdenGeneral($id) 
    {
        $criterio = CriteriomedidaController::findModel($id);
        $ordenObjetivo = $criterio->objetivo->orden;
        $ordenCriterio = $criterio->orden;
        
       return  $ordenObjetivo.".".$ordenCriterio;
        
        
    }
    public static function buscarevaluacion($id)
    {
     return $evaluacion = \frontend\models\Evaluacion::findOne(['criteriomedidaid'=>$id,'status'=>1]);      
    }
     public function comprobar() //funcion que comprueba si el criterio de medida se encuentra en el periodo editable
    {
        if(\frontend\models\Criteriomedida::findOne(['editable'=>1])!== NULL)
        {
           return TRUE; 
        }else{
            return FALSE;
        }
        
    }
    
    public function actionCerrarperiodoevaluacion() //funcion que cierra el periodo de evaluacion delos criterio de medida
    {
        if($this->comprobar())
        {
            \frontend\models\Criteriomedida::updateAll(['editable'=>0],['status'=>1]); 
             TrazasController::actionCreate('Criterio de Medida','Cerró el periodo de Evaluación','','','');
             Yii::$app->session->setFlash("ok_cerrado");
        return $this->redirect(['index']);
        }
        else{
        Yii::$app->session->setFlash("ya_cerrado");
        return $this->redirect(['index']);    
        }
        
        }
    
     public function actionActivarperiodoevaluacion() //funcion que activa el periodo de edicion de los criterios
    {
     
        if(!$this->comprobar())
        {
            \frontend\models\Criteriomedida::updateAll(['editable'=>1],['status'=>1]);  
            TrazasController::actionCreate('Criterio de Medida','Abrio el periodo de Edición','','','');
        Yii::$app->session->setFlash("ok_activado");
        return $this->redirect(['index']);
        }else{
        Yii::$app->session->setFlash("ya_abierto");
        return $this->redirect(['index']);    
            
        }
        
    }
    
       public function actionCerrarmes() //funcion que activa el periodo de edicion de los indicadores
    {
     
       
        
           \frontend\models\Criteriomedida::updateAll(['editable'=>1,'evaluado'=>0],['status'=>1]); 
           \frontend\models\Evaluacion::updateAll(['actual'=>0],['actual'=>1]);
           TrazasController::actionCreate('Criterio de Medida','Cerró información mensual','','','');
        Yii::$app->session->setFlash("ok_mes_cerrado");
        return $this->redirect(['index']);
        
        
    }
    
}
