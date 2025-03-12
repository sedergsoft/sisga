<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use frontend\models\Trabajador;
use frontend\models\UserSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
       if(\Yii::$app->user->isGuest||\Yii::$app->user->identity->rolid != 2)
        {            
              throw new MethodNotAllowedHttpException('Debe tener permisos de administración para poder acceder a esta parte del sitio.');
        }
        else
        {
           $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['NOT LIKE','rolid', 1])->andFilterWhere((['LIKE','status', 10]));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        
        
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->rolid != 2)
        {            
              throw new MethodNotAllowedHttpException('Debe tener permisos de administración para poder acceder a esta parte del sitio.');
        }
        else
        {
          
            $model=$this->findModel($id);
            $userupd = $model;
            $trabajador = TrabajadorController::findmodel(['iduser'=>$id]);
            $trabajadorupd = $trabajador;
 
        if ($model->load(Yii::$app->request->post()) || $trabajador->load(Yii::$app->request->post())) 
                {
             
            if($userupd->id == Yii::$app->user->getId() && $userupd->rolid == $model->rolid )
                {
                //return print_r('entro23');
                if($userupd->updateAttributes(['username'=>$model->username,'direccionid'=>$model->direccionid]))
               
            {
            Yii::$app->session->setFlash('kv-detail-warning', 'Usted no puede modificar el rol de su propio usuario, los demas datos han sido guardados correctamente ');
            // Multiple alerts can be set like below
           // Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            //Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            return $this->redirect(['view', 'id'=>$model->id]);
                
            }
            else{
                 Yii::$app->session->setFlash('kv-detail-danger', 'Error al guardar los datos ');
           return $this->redirect(['view', 'id'=>$model->id]);
            }
            }else{
            
                /* $userupd->username = $model->username;
                 $userupd->direccionid = $model->direccionid;
                 $userupd->email = $model->email;
                 $userupd->rolid = $model->rolid;*/
              
           if($userupd->updateAttributes(['username'=>$model->username,'direccionid'=>$model->direccionid,'rolid'=>$model->rolid]))
               
            {
            Yii::$app->session->setFlash('kv-detail-success', 'Sus datos han sido guardados correctamente. ');
            // Multiple alerts can be set like below
           // Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            //Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            return $this->redirect(['view', 'id'=>$model->id]);
                
            }
            else{
                 
                if($trabajadorupd->updateAttributes(['nombre'=>$trabajador->nombre,'primerApellido'=>$trabajador->primerApellido,'segundoApellido'=>$trabajador->segundoApellido,'CI'=>$trabajador->CI,'email'=>$trabajador->email,'telefono'=>$trabajador->telefono]))
                 {
            Yii::$app->session->setFlash('kv-detail-success', 'Sus datos han sido guardados correctamente. ');
            // Multiple alerts can be set like below
           // Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            //Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            return $this->redirect(['view', 'id'=>$model->id]);
                
            }
            }
            }
                }
         else {
            return $this->render('view', ['model'=>$model,'trabajador'=>$trabajador]);
        }
        }
    
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->rolid != 2)
        {            
              throw new \yii\web\ForbiddenHttpException('Debe tener permisos de administración para poder crear nuevos usuarios.');
        }
        else
        {
        $model = new User();
        $trabajador = new Trabajador();
        if(Yii::$app->request->isAjax && ($trabajador->load($_POST)))
        {
            Yii::$app->response->format =   'json';
            return \kartik\form\ActiveForm::validate($trabajador);
        }

        
        if ($model->load(Yii::$app->request->post())&& $trabajador->load(Yii::$app->request->post()))
        {
           if($model->rolid == 5 && $this->buscarpresidente()) 
           {
               Yii::$app->session->setFlash("Exixte_usuario");  
            return $this->render('create', [
            'model' => $model,
            'trabajador' => $trabajador,
            ]);   
           }
               
            $model->setPassword($model->password_hash);
            $model->generateAuthKey();
            
            //$model->password = NULL;
        
            if($model->validate()&&$trabajador->validate())
            {
            if($model->save())
            {
                $trabajador->iduser = $model->id;
              $preguntas = ControlUsuarioController::crearpreguntas( new \frontend\models\ControlUsuario);
              $preguntas->userid = $model->id;
              $preguntas->save();
              
               
              if($trabajador->save())
              {
                  $model->updateAttributes(['trabajadorid'=>$trabajador->id]);
                  // return print_r($trabajador);
             return $this->redirect(['view', 'id' => $model->id]);   
              }
             
              }
            }
              }
            
        
        }
        return $this->render('create', [
            'model' => $model,
            'trabajador' => $trabajador,
        ]);
    }
    
    /**
     * Updates an existing User model.
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
    
    public function actionPassword($id)
    {
       if(\Yii::$app->user->getId() != $id)
       {
        if(\Yii::$app->user->identity->rolid != 2 )   
        {
          throw new MethodNotAllowedHttpException('Usted solo puede cambiar la contraseña de su usuario o ser Administrador del sitio.');   
        }else{
                $model = $this->findModel($id);
                $model->password_hash = NULL;
                if($model->load(Yii::$app->request->post())) 
                    {
                    $model->setPassword($model->password_hash);
                    $model->generateAuthKey();
                    if( $model->save())
                        {
                        $_SESSION['user'] = $model->username;
                        Yii::$app->session->setFlash("ok_contraseña"); 
                        return $this->redirect(['/user/index']);
                        }
            
                    }
                    return $this->render('update', [
                    'model' => $model,
                                        ]);
    
            }
            
       }else{
        $model = $this->findModel($id);
        $model->password_hash = NULL;

        if ($model->load(Yii::$app->request->post())) 
            {
             $model->setPassword($model->password_hash);
            $model->generateAuthKey();
            if( $model->save())
            {
            $_SESSION['user'] = $model->username;
            Yii::$app->session->setFlash("ok_contraseña"); 
            return $this->redirect(['/user/index']);
        }
            
            }

        return $this->render('update', [
            'model' => $model,
        ]);
    
        }
       }
    public function actionDesconectar($id)
    {
      
        if(\Yii::$app->user->identity->rolid != 2 )   
        {
          throw new MethodNotAllowedHttpException('Usted no tine permisos para realizar esta acción.');   
        }else{
             if(\Yii::$app->user->getId() != $id)
       {
                $model = $this->findModel($id);
                $model->updateAttributes(['conectado'=>0]);
                    return $this->redirect('index');
    
        } else{
            return $this->redirect('index');
        }
        
       }
            
      
        }
       

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
      if (Yii::$app->user->isGuest || Yii::$app->user->identity->rolid != 2)
        {            
              throw new MethodNotAllowedHttpException('Debe tener permisos de administración para poder eliminar un usuario.');
        }
        else
        {
        $this->findModel($id)->updateAttributes(['status' => 0]) ;

        return $this->redirect(['index']);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    public function buscarpresidente() 
    {
         if (($model = User::findOne(['rolid'=> 5,'status'=>10])) !== null) {
            return true;
        }
    else{
        return false;
        
    }
         
        
    }
    
   
      public static function IsConnected($username)
    {
       return false;
        $user = User::findByUsername($username);
       if($user->rolid == 2)
       {
           return false;
       }
       if($user->conectado == 1)
       {
        
         return TRUE;       
       } else{
           return FALSE;
    }
    }

}
