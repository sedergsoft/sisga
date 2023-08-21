<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ControlUsuario;
use frontend\models\ControlUsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ControlUsuarioController implements the CRUD actions for ControlUsuario model.
 */
class ControlUsuarioController extends Controller
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
     * Lists all ControlUsuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ControlUsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ControlUsuario model.
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

    public function actionComprobar($username)
    {
       if($user = \common\models\User::findByUsername($username))
       {
        if($user->conectado == 1)
        {
           return $this->redirect(['controlar', 'id' => $user->id]);
        }
        else{
               Yii::$app->session->setFlash("usuario_error"); 
               return $this->redirect(['site/recuperar']);
            
            }
           
        } else{
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
       }
    }
    
    public function actionControlar($id)
    {
       $preguntas = ControlUsuario::find()->where(['userid'=>$id])->one();
       if($preguntas)
       {
       $newModel = new ControlUsuario();
       //return print_r($preguntas);
       $model = $this->findModel($preguntas->id);
       if ($newModel->load(Yii::$app->request->post())) 
           {
        // return print_r($model);
           if($this->evaluar($model,$newModel))
            {
               $user = \common\models\User::findOne(['id'=>$id]);
               $user->updateAttributes(['conectado'=>0]);
               Yii::$app->session->setFlash("usuario_desconectado"); 
               return $this->redirect(['site/login']);
               
             
            }
            else{
          Yii::$app->session->setFlash("error_respuestas"); 
               return $this->redirect(['site/recuperar']);
            }
           }
        else{
           return $this->render('controlar', [
            'model' => $preguntas,
        ]); 
        }
       }
       else{
            Yii::$app->session->setFlash("sinpreguntas"); 
               return $this->redirect(['site/recuperar']);
              
           
       }
        
    }
    /**
     * Creates a new ControlUsuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       $preguntas = ControlUsuario::find()->where(['userid'=> \Yii::$app->user->id])->one();
       if(!$preguntas)
       {
        $model = new ControlUsuario();

        if ($model->load(Yii::$app->request->post()) ) 
        {
            $model->userid = \Yii::$app->user->getId();
            if($model->save())
            {
           return $this->redirect(['view', 'id' => $model->id]);
            }
            else{
                return $this->render('create', [
            'model' => $model,
        ]);
  
                
            }
            
            }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    else{
        return $this->redirect(['view',
            'id' => $preguntas->id]);
    }
    
            }

    /**
     * Updates an existing ControlUsuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ControlUsuario model.
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
     * Finds the ControlUsuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ControlUsuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ControlUsuario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function evaluar($preguntas,$respuestas) 
    {
     $encontrado  = false;
     if( strtoupper( $preguntas->resp_1) == strtoupper( $respuestas->resp1_user) && strtoupper( $preguntas->resp_2) == strtoupper( $respuestas->resp2_user) && strtoupper( $preguntas->resp_3) == strtoupper( $respuestas->resp3_user) && strtoupper( $preguntas->resp_4) == strtoupper( $respuestas->resp4_user) && strtoupper( $preguntas->resp_5) == strtoupper($respuestas->resp5_user) )
     {
         $encontrado = TRUE;
     }
     return $encontrado;
    }
    public function crearpreguntas($model)
    {
      $model->preg_1 = 'pregunta 1';  
      $model->preg_2 = 'pregunta 2';  
      $model->preg_3 = 'pregunta 3';  
      $model->preg_4 = 'pregunta 4';  
      $model->preg_5 = 'pregunta 5';  
      $model->resp_1 = '1';  
      $model->resp_2 = '2';  
      $model->resp_3 = '3';  
      $model->resp_4 = '4';  
      $model->resp_5 = '5';
      return $model;
    }
}
