<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Evaluacion;
use frontend\models\EvaluacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use frontend\models\EvaluacionAnexo;


//use frontend\models\VariacionGastos;




/**
 * EvaluacionController implements the CRUD actions for Evaluacion model.
 */
class EvaluacionController extends Controller
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
     * Lists all Evaluacion models.
     * @return mixed
     */
    public function actionIndex()
    {
       if( Yii::$app->user->can('view_evaluacion'))
          {
        $searchModel = new EvaluacionSearch();
           $dataProvider = new \yii\data\SqlDataProvider([
    'sql' => 'SELECT evaluacion.id,evaluacion.valor_vreal, evaluacion.fechacreado, evaluacion.direccionid, evaluacion.criteriomedidaid, evaluacion.estado, evaluacion.periodo,evaluacion.userid,evaluacion.observaciones 
                FROM evaluacion INNER JOIN criteriomedida ON evaluacion.criteriomedidaid = criteriomedida.id
                WHERE criteriomedida.direccionid = :direccionid AND  evaluacion.estado = 1 AND evaluacion.status = 1 AND criteriomedida.evaluado = 1 AND evaluacion.actual = 1',
    'params' => [':direccionid' =>  UserController::findmodel(\Yii::$app->user->getId())->direccionid]
   

   ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
          }else
              {
              throw new \yii\web\ForbiddenHttpException('Usted no tiene permisos para ejecutar esta acción');
          }
    }
    
     public function actionIndexcumplimiento()
    {
     
         $searchModel = new EvaluacionSearch();
           $dataProvider = new \yii\data\SqlDataProvider([
    'sql' => 'SELECT criteriomedida.orden,evaluacion.id,evaluacion.valor_vreal, evaluacion.fechacreado, evaluacion.direccionid, evaluacion.criteriomedidaid, evaluacion.estado, evaluacion.periodo,evaluacion.userid,evaluacion.observaciones 
                FROM evaluacion INNER JOIN criteriomedida ON evaluacion.criteriomedidaid = criteriomedida.id
                WHERE criteriomedida.direccionid = :direccionid AND evaluacion.status = 1 AND criteriomedida.evaluado = 1 AND evaluacion.actual = 1  ORDER BY criteriomedida.orden ',
    'params' => [':direccionid' =>  UserController::findmodel(\Yii::$app->user->getId())->direccionid]
   

   ]);

        return $this->render('cumplimiento', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
      
    }
    
        public function actionIndexall()
    {
     if (!Yii::$app->user->isGuest) {
            
     if(\Yii::$app->user->identity-> rolid== 4)
     {
         return $this->redirect(['criteriomedida/llenar']);
     }else{

        //$forma = 1;
        $searchModel = new EvaluacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['status'=>1])->andFilterWhere(['actual'=>1]);
               /*  $dataProvider = new \yii\data\SqlDataProvider([
    'sql' => 'SELECT evaluacion.id,evaluacion.valor_vreal,evaluacion.fechacreado,evaluacion.direccionid,evaluacion.criteriomedidaid,evaluacion.estado,evaluacion.periodo,evaluacion.userid,evaluacion.observaciones,evaluacion.status,evaluacion.anexo FROM `evaluacion` INNER JOIN criteriomedida ON evaluacion.criteriomedidaid = criteriomedida.id WHERE criteriomedida.evaluado = 1 AND criteriomedida.status =1 AND evaluacion.status = 1',
    
   ]);*/
        //$dataProvider->query->andFilterWhere(['status'=>1])/*->andFilterWhere(['direccionid'=> UserController::findmodel(\Yii::$app->user->getId())->direccionid])*/;

        return $this->render('indexall', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
           // 'forma'=>$forma,
        ]);
    
     }
     }
     else{

        //$forma = 1;
        $searchModel = new EvaluacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['status'=>1])->andFilterWhere(['actual'=>1]);
               /*  $dataProvider = new \yii\data\SqlDataProvider([
    'sql' => 'SELECT evaluacion.id,evaluacion.valor_vreal,evaluacion.fechacreado,evaluacion.direccionid,evaluacion.criteriomedidaid,evaluacion.estado,evaluacion.periodo,evaluacion.userid,evaluacion.observaciones,evaluacion.status,evaluacion.anexo FROM `evaluacion` INNER JOIN criteriomedida ON evaluacion.criteriomedidaid = criteriomedida.id WHERE criteriomedida.evaluado = 1 AND criteriomedida.status =1 AND evaluacion.status = 1',
    
   ]);*/
        //$dataProvider->query->andFilterWhere(['status'=>1])/*->andFilterWhere(['direccionid'=> UserController::findmodel(\Yii::$app->user->getId())->direccionid])*/;

        return $this->render('indexall', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
           // 'forma'=>$forma,
        ]);
    
     }
  
     }
    public function actionIndexmes($mes, $anno)
    {
        
       $mes1 = 1;
       $mes2 = 2;
       $mes3 = 3;
       if($mes == 2)
       {
       $mes1 = 4;
       $mes2 = 5;
       $mes3 = 6;
           
       }else{
           if($mes == 3)
           {
            $mes1 = 7;
            $mes2 = 8;
            $mes3 = 9;
          
           }else{
               if($mes == 4)
               {
                    $mes1 = 10;
                    $mes2 = 11;
                    $mes3 = 12;
       
               }
           }
       }
      
       /* if($mes1 != date('m') || $mes2 != date('m')&&$mes3 != date('m'))
       {
       return print_r($mes1.$mes2.$mes3);
       */ 
        $searchModel = new EvaluacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['status'=>1])->andWhere('YEAR(fechacreado) = '.$anno )/*->andFilterWhere(['actual'=>0])*/->andWhere('MONTH(fechacreado) = '. $mes1. ' or MONTH(fechacreado) = '. $mes2. ' or MONTH(fechacreado) = '. $mes3);
 
        return $this->render('indexall', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
       ]);
      /* }else{
           return   $this->actionIndexall();
       }*/
    }
    public function actionSelecionarmes()
    {
        if(Yii::$app->request->post())
        {
        $mes = $_POST['Mes'];
        $anno = $_POST['Año'];
     
        return $this->actionIndexmes($mes,$anno);  
        }
        else{
            return $this->render('selecionarmes'
                                );
            }
        
}
    /**
     * Displays a single Evaluacion model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('Error_autenticacion');
            $this->redirect(['evaluacion/indexall'
                ]);
        }
        else{
       if($this->findModel($id))
       {
        $model = $this->findModel($id);
        $model->observaciones = str_replace("<br>","\n", $model->observaciones);
          $model->observaciones = str_replace("<br/>","\n", $model->observaciones);
        return $this->render('view', [
            'model' => $model,
        ]);
    }else{return print_r('no encontrado el modelo');}
        }
       }
       
           public function actionVieweval($id)
    {
        $model = Evaluacion::findOne(['criteriomedidaid'=>$id,'status'=>1,'actual'=>1]);
        $model->observaciones = str_replace("<br>","\n", $model->observaciones);
          $model->observaciones = str_replace("<br/>","\n", $model->observaciones); 
        return $this->render('view', [
            'model' => $model,
        ]);
    }


    /**
     * Creates a new Evaluacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        if( Yii::$app->user->can('create_evaluacion'))
          {
        $criteriomedida = CriteriomedidaController::findModel($id);
        $oldmodel = Evaluacion::findOne(['criteriomedidaid'=>$id , 'status'=> 1]);
        $tabla = 'Evaluacion';
        
      if($criteriomedida->editable ==1)
      {
       if($oldmodel)
       {
           if($oldmodel->estado == 2 && $criteriomedida->evaluado == 1)
           {
            Yii::$app->session->setFlash('error_certificado');
          return $this->redirect(['criteriomedida/llenar']);
           }
               
       }
           
          
        $model = new Evaluacion();
        $modelanexo = new \frontend\models\Anexo();
        $modelevaluacionanexo = new EvaluacionAnexo();
        
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            if($model->anexo==1 && $modelevaluacionanexo->load(Yii::$app->request->post()) )
          {
            if($modelevaluacionanexo->anexoid ==26)
            {
             if(UploadedFile::getInstance($modelevaluacionanexo,'anexo')->extension != 'docx'/*&&UploadedFile::getInstance($modelevaluacionanexo,'anexo')->extension != 'xlsx'*/)
             {
                     
                Yii::$app->session->setFlash('archivo_no_valido');
                $model->anexo = 0;
                return $this->render('create', [
                                'model' => $model,
                                'criteriomedida'=>$criteriomedida,
                                'modelanexo'=>$modelanexo,
                                'modelevaluacionanexo'=>$modelevaluacionanexo,
                                ]);
             }
            }
          
          }
            
            date_default_timezone_set('America/Bogota'); //fija el huso horario en UTC-05:00
            $model->fecha_informacion = date('Y-m-d');
            $model->criteriomedidaid = $id;
            if(date('m')< "04")
                {
                $model->periodo = 1;   
                }
                 else{
                    if(date('m')>= "04" && date('m') <= "06")
                        {
                        $model->periodo = 2;   
                        }
                        else{
                             if(date('m')>"06" && date('m') <= "09")
                                {
                                $model->periodo = 3;   
                                }
                                else{$model->periodo = 4;  }
                            }
                    }
     
        if($oldmodel )
        {
            $oldmodel->updateAttributes(['status'=>0]);
            $accion = 'Actualizó';
            $old = $oldmodel->id;          
//$this->desactivarModel($oldmodel);
        }
      //return print_r($oldmodel);
      $model->criteriomedidaid = $id;
      $model->direccionid = UserController::findmodel(\Yii::$app->user->getId())->direccionid;
      $model->userid = \Yii::$app->user->getId();
      $model->observaciones = nl2br($model->observaciones);
     // return print_r($model);
      if($model->save())
      {
            if($criteriomedida->evaluado == 0)
            {
             $accion = 'Creó';
             $old = '';
            }
              $new = $model->id;
              TrazasController::actionCreate($tabla,$accion,$new,$old,'frontend\models\Evaluacion');
            
          
          $criteriomedida->updateAttributes(['evaluado'=>1]);
          if($model->anexo==1 && $modelevaluacionanexo->load(Yii::$app->request->post()) )
          {
             
           
            $tablaName = trim($modelevaluacionanexo->anexo0->anexo. date('ymdHm').$criteriomedida->id);  
            $tablaName =  str_replace([' '],'_', $tablaName);
            $modelevaluacionanexo->file = UploadedFile::getInstance($modelevaluacionanexo,'anexo');
            $modelevaluacionanexo->file->saveAs('uploads/anexos/criterios/'.$tablaName.'.'.$modelevaluacionanexo->file->extension);
            $modelevaluacionanexo->anexo = 'uploads/anexos/criterios/'.$tablaName.'.'.$modelevaluacionanexo->file->extension;
            $modelevaluacionanexo->nombre = $tablaName.'.pdf';
            $modelevaluacionanexo->evaluacionid = $model->id;
            $modelevaluacionanexo->fecha = $model->fecha_informacion;
            $modelevaluacionanexo->idtabla = $model->id;
            $modelevaluacionanexo->save();
          // return print_r(Yii::$app->urlManager->baseUrl.'/'.$modelevaluacionanexo->anexo);
           if($modelevaluacionanexo->anexo0->id==26 )
           {
            if($modelevaluacionanexo->file->extension == "xlsx"||$modelevaluacionanexo->file->extension == "xls")
             {
                CumplimientoController::generarpdfxls($modelevaluacionanexo);   
             }
                else{
                    if($modelevaluacionanexo->file->extension == "doc"||$modelevaluacionanexo->file->extension == "docx")
                    {
                    EvaluacionController::generarpdf($modelevaluacionanexo->anexo,$tablaName);
          
                    }
                }
               
               
               
              // $this->generarpdf($modelevaluacionanexo->anexo,$tablaName);
           }/*else{
               $this->generarpdftabla($modelevaluacionanexo->anexo, $tablaName);
           }*/
            if($modelevaluacionanexo->anexo0->id!=26)
            {
            $this->Importardatos($modelevaluacionanexo);
            }
            
            return $this->redirect(['view', 
                 'id' => $model->id,
                ]);
          }
          return $this->redirect(['view', 'id' => $model->id]);
       }
            }else{

        return $this->render('create', [
            'model' => $model,
            'criteriomedida'=>$criteriomedida,
            'modelanexo'=>$modelanexo,
            'modelevaluacionanexo'=>$modelevaluacionanexo,
        ]);
        }
    
      }
       else{
            Yii::$app->session->setFlash('error_no_editable');
          return $this->redirect(['criteriomedida/llenar']);
           // CriteriomedidaController::actionLlenar();
       } 
          }else{
              throw new \yii\web\ForbiddenHttpException('Usted no tiene permisos para ejecutar esta acción');
             
          }
            }

    /**
     * Updates an existing Evaluacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if( Yii::$app->user->can('update_evaluacion'))
          {
        $criteriomedida = \frontend\models\Criteriomedida::findOne(['id'=>$id]);
        $model = $this->findModel(['criteriomedidaid'=>$id,'actual'=>1]);
        $modelevaluacionanexo = new \frontend\models\EvaluacionAnexo();
         $model->observaciones = str_replace("<br>","\n", $model->observaciones);
          $model->observaciones = str_replace("<br />","", $model->observaciones);
          $oldanexo = null;
       
       
       if($model->estado == 2 && $criteriomedida->evaluado == 1)
            {
              Yii::$app->session->setFlash('error_certificado');
              return $this->redirect(['criteriomedida/llenar']);  
            }
          if($model->anexo ==1)
          {
              $oldanexo = EvaluacionAnexo::findOne(['evaluacionid'=>$model->id,'status'=>1]);
             
          }
         // return print_r($oldanexo);   
          $model->anexo = 0;
         
       
       
        if ($model->load(Yii::$app->request->post())&& $model->validate()) 
        {        
            if($model->anexo==1 && $modelevaluacionanexo->load(Yii::$app->request->post()) )
          {
             //-----
                 if($modelevaluacionanexo->anexoid ==26)
            {
             if(UploadedFile::getInstance($modelevaluacionanexo,'anexo')->extension != 'docx'/*&&UploadedFile::getInstance($modelevaluacionanexo,'anexo')->extension != 'xlsx'*/)
             {
                     
              //  Yii::$app->session->setFlash('archivo_no_valido');
               Yii::$app->session->setFlash('archivo_no_valido');
                $model->anexo = 0;
                  return $this->render('update', [
                                    'model' => $model,
                                    'criteriomedida'=>$criteriomedida,
                                    'modelevaluacionanexo'=>$modelevaluacionanexo,
               
                                ]);
             }
            }
                
                //-----
             /*   if(($modelevaluacionanexo->anexoid ==26 && UploadedFile::getInstance($modelevaluacionanexo,'anexo')->extension != 'docx')||($modelevaluacionanexo->anexoid !=26 && UploadedFile::getInstance($modelevaluacionanexo,'anexo')->extension != 'xlsx'))
              {
                Yii::$app->session->setFlash('archivo_no_valido');
                $model->anexo = 0;
                  return $this->render('update', [
                                    'model' => $model,
                                    'criteriomedida'=>$criteriomedida,
                                    'modelevaluacionanexo'=>$modelevaluacionanexo,
                                                ]); 
              }*/
          }
          
            $newmodel = new Evaluacion();
            date_default_timezone_set('America/Bogota'); //fija el huso horario en UTC-05:00
            $newmodel->fecha_informacion = date('Y-m-d');
            if(date('m')< "04")
                {
                $newmodel->periodo = 1;   
                }
                else{
                     if(date('m')>= "04" && date('m') <= "06")
                        {
                         $newmodel->periodo = 2;   
                        }
                        else{
                             if(date('m')>"06" && date('m') <= "09")
                                {
                                 $newmodel->periodo = 3;   
                                }
                                 else{$newmodel->periodo = 4;  }
                            }
                    }
            
            
            $newmodel->valor_vreal = $model->valor_vreal;
            $newmodel->criteriomedidaid = $id;
            $newmodel->direccionid = UserController::findmodel(\Yii::$app->user->getId())->direccionid;
            $newmodel->userid = \Yii::$app->user->getId();
            $newmodel->observaciones = nl2br($model->observaciones);
            $newmodel->anexo = $model->anexo;
            $newmodel->fechacreado = $model->fechacreado;
                 if($newmodel->save())
                 {
                     if($oldanexo){//se agrego el dia 20191209
                     if( $oldanexo->anexoid != 26)
                     {
                 $oldanexo->updateAttributes(['status'=>0]);
                   $oldtabla = \frontend\models\Anexo::findOne(['id'=>$oldanexo->anexoid]);
                $query = new \yii\db\Connection();
                $query->dsn = \Yii::$app->db->dsn;
                $query->username = \Yii::$app->db->username;
                $query->password = \Yii::$app->db->password;
                $query->createCommand()->update($oldtabla->tabla, ['status'=>0], 'anexoid = '.$oldanexo->id)->execute();
                // $query = "UPDATE ".$oldtabla->tabla." SET `status` = '0' WHERE ".$oldtabla->tabla.".`anexoid` = ".$oldanexo->id.";";
                     }
                     }
                 $model->updateAttributes(['status'=>0]);
                 $model->updateAttributes(['actual'=>0]);
                 TrazasController::actionCreate('Evaluacion','Actualizó',$newmodel->id,$model->id,'frontend\models\Evaluacion');    
                 $criteriomedida->updateAttributes(['evaluado'=>1]);
          if($newmodel->anexo==1 && $modelevaluacionanexo->load(Yii::$app->request->post()) )
          {
             
           
            $tablaName = trim($modelevaluacionanexo->anexo0->anexo. date('ymdHm').$criteriomedida->id);  
            $tablaName =  str_replace([' '],'_', $tablaName);
            $modelevaluacionanexo->file = UploadedFile::getInstance($modelevaluacionanexo,'anexo');
            $modelevaluacionanexo->file->saveAs('uploads/anexos/criterios/'.$tablaName.'.'.$modelevaluacionanexo->file->extension);
            $modelevaluacionanexo->anexo = 'uploads/anexos/criterios/'.$tablaName.'.'.$modelevaluacionanexo->file->extension;
            $modelevaluacionanexo->nombre = $tablaName.'.pdf';
            $modelevaluacionanexo->evaluacionid = $newmodel->id;
            $modelevaluacionanexo->fecha = $newmodel->fecha_informacion;
            $modelevaluacionanexo->idtabla = $newmodel->id;
            $modelevaluacionanexo->save();
          /* if($modelevaluacionanexo->anexo0->id==26)
           {
            $this->generarpdf($modelevaluacionanexo->anexo,$tablaName);
           }/*else{
               $this->generarpdftabla($modelevaluacionanexo->anexo, $tablaName);
           }*/
             if($modelevaluacionanexo->anexo0->id==26 )
           {
            if($modelevaluacionanexo->file->extension == "xlsx"||$modelevaluacionanexo->file->extension == "xls")
             {
                EvaluacionController::generarpdfxls($modelevaluacionanexo);   
             }
                else{
                    if($modelevaluacionanexo->file->extension == "doc"||$modelevaluacionanexo->file->extension == "docx")
                    {
                    EvaluacionController::generarpdf($modelevaluacionanexo->anexo,$tablaName);
          
                    }
                }
               
               
               
              // $this->generarpdf($modelevaluacionanexo->anexo,$tablaName);
           }
           if($modelevaluacionanexo->anexo0->id!=26)
            {
            $this->Importardatos($modelevaluacionanexo);
            }
            
            return $this->redirect(['view', 
                 'id' => $newmodel->id,
                ]);
          }
          return $this->redirect(['view', 'id' => $newmodel->id]);
       
                 
                 
                 
                 }
            return $this->redirect(['view', 'id' => $newmodel->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'criteriomedida'=>$criteriomedida,
            'modelevaluacionanexo'=>$modelevaluacionanexo,
        ]);
          }else{
              throw new \yii\web\ForbiddenHttpException('Usted no tiene permisos para realizar esta acción');
          }
    }

    /**
     * Deletes an existing Evaluacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if( Yii::$app->user->can('delete_evaluacion'))
          {
        $this->findModel($id)->updateAttributes(['actual'=>0,'status'=>0]);//desactivo la evaaluacion
        \frontend\models\Criteriomedida::findOne(['id'=>$this->findModel($id)->criteriomedidaid])->updateAttributes(['evaluado'=>0]);
            
        if($this->findModel($id)->anexo==1) //si la evaluacion tiene anexo
            {
            EvaluacionAnexoController::findModel(['evaluacionid'=>$id])->updateAttributes(['status'=>0]); //desactivo el anexo
            
            }
         TrazasController::actionCreate('Evaluacion','Eliminó',"",$id,'frontend\models\Evaluacion'); //creo la traza de la operacion   
        
        return $this->redirect(['indexall']);
          }else{
              throw new \yii\web\ForbiddenHttpException('Usted no tiene permisos para ejecutar esta acción.');
          }
    }

    /**
     * Finds the Evaluacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Evaluacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id)
    {
        if (($model = Evaluacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
      public function actionCertificar($id)
    {    
          if( Yii::$app->user->can('certificar_evaluacion'))
          {
        $model = $this->findModel($id);
        $orden = CriteriomedidaController::buscarOrdenGeneral($model->criteriomedidaid); 
        Yii::$app->session->setFlash('ok_certificado', $orden);
        //CriteriomedidaController::findModel($model->criteriomedidaid)->updateAttributes(['editable'=>0]);
     
        $model->updateAttributes(['estado'=>2]);
       TrazasController::actionCreate('Evaluacion','Certificó evaluación',$id,'','frontend\models\Evaluacion');
        

        return $this->redirect(['index']);
          }
          else{
              throw new \yii\web\ForbiddenHttpException('No tiene permisos apara ejecutar esta acción');
          }
    }
    
    public static function evaluarCumplimiento($id) 
    {
     $cumplimiento = 'No cumplido';
     $valoractual = EvaluacionController::findModel($id);
     if($valoractual->periodo ==1)
     {
         if($valoractual->criteriomedida->tope->Itrimestre <= $valoractual->valor_vreal)
         {
             $cumplimiento = 'Cumplido';
         }
     }else{
         
          if($valoractual->periodo ==2)
            {
                if($valoractual->criteriomedida->tope->IItrimestre <= $valoractual->valor_vreal)
                {
                $cumplimiento = 'Cumplido';
                }
         
            }
            else{
                
                 if($valoractual->periodo ==3)
                    {
                         if($valoractual->criteriomedida->tope->IIItrimestre <= $valoractual->valor_vreal)
                            {
                                $cumplimiento = 'Cumplido';
                            }
                
                    }else{
                         if($valoractual->periodo ==4)
                            {
                            if($valoractual->criteriomedida->tope->IVtrimestre <= $valoractual->valor_vreal)
                                    {
                                    $cumplimiento = 'Cumplido';
                                    }
                            }
                        }
        
                }
            }
     return $cumplimiento;
    }
    
   public function Importardatos($model)
{
    $inputFile = $model->anexo;
    try{
        $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFile);
    } catch (Exception $e) {
        die('Error');
    }

    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow()-1;
    $highestColumn = $sheet->getHighestColumn();

    for($row=2; $row <= $highestRow; $row++)
    {
        $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);

        if($row==2)
        {
            continue;
        }
        $this->guardardatos($model, $sheet, $highestRow, $rowData);
        
    }
   // die('okay');
}

public function Buscarid($nombre) 
 {
  if($empresa = \frontend\models\Empresa::find()->where(['nombre' => trim(strtoupper($nombre))])->one())
    {
        return $empresa->id;
    } else{
        return print_r('no rncontrado ');
    }  
 }
 
 public function Buscarproductoid($producto) 
 {
  if($producto = \frontend\models\Producto::find()->where(['producto' => trim(strtoupper($producto))])->one())
    {
        return $producto->id;
    } else{
        return print_r('no rncontrado ');
    }  
 }
 
public function guardardatos($model,$sheet,$highestRow,$rowData) 
 {
     switch ($model->anexo0->id)
     {
     case 1 : 
                   {
         $Column = 1; 
         $count = 0;
        $highestColumn = $sheet->getHighestColumn();
        $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
         while ( $Column <= $highestColumnIndex-1 )
            {
                    
                     $datos = new \frontend\models\Ventas();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->plan = $rowData[0][$Column]; 
                     $Column++;
                     $datos->vreal  = $rowData[0][$Column]; 
                     $Column= $Column+2;
                     $datos->fecha = date('Y-m-d') ; 
                     $datos->tipo_ventaid = 3;
                     $datos->anexoid = $model->id;
                     $producto = $sheet->rangeToArray('B1'.':'.$highestColumn.'1',NULL,TRUE,FALSE);
                     
                    // return print_r($producto);
                     $datos->productoid = EvaluacionController::Buscarproductoid($producto[0][$count]) ;
                     $count = $count + 3;
                     $datos->save();
                     print_r($datos->getErrors());
            }
                  break;
                   }
     
    case 2 : $datos = new \frontend\models\Reclamaciones();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->cant_reclamacion = $rowData[0][1]; 
                     $datos->importe_reclamacion  = $rowData[0][2]; 
                     $datos->demanda_cant = $rowData[0][3]; 
                     $datos->demanda_importe  = $rowData[0][4]; 
                     $datos->tipo_reclamacion = 2;
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors());
                     $datos = new \frontend\models\Reclamaciones();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][5]); 
                     $datos->cant_reclamacion = $rowData[0][6]; 
                     $datos->importe_reclamacion  = $rowData[0][7]; 
                     $datos->demanda_cant = $rowData[0][8]; 
                     $datos->demanda_importe  = $rowData[0][9]; 
                     $datos->tipo_reclamacion = 1;
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors());
                   {
                  
        
                  break;
                   }
     case 3 : 
                   {
                  $datos = new \frontend\models\VariacionGastos();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->gastosxperdida  = $rowData[0][1]; 
                     $datos->gastosxfaltante  = $rowData[0][2]; 
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors());
                  break;
                   }
     case 4 : 
                   {
                  
                  break;
                   }
     case 6 :       $datos = new \frontend\models\InformacionLaboratorios();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->cant  = $rowData[0][1]; 
                     $datos->terminados  = $rowData[0][2]; 
                     $datos->cant_func  = $rowData[0][4]; 
                     $datos->cant_no_func  = $rowData[0][5]; 
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors());
                   {
                  
                  break;
                   }
     case 7 : 
                   {
                  
                  break;
                   }
     case 8 : 
                   {
                                 $Column = 1; 
         $count = 0;
        $highestColumn = $sheet->getHighestColumn();
        $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
         while ( $Column <= $highestColumnIndex-1 )
            {
                
                     $datos = new \frontend\models\VariacionGastos();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->gastosxperdida  = $rowData[0][$Column]; 
                     $Column++;
                     $datos->gastosxfaltante  = $rowData[0][$Column]; 
                     $Column= $Column+2;
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                      $periodo = $sheet->rangeToArray('B1'.':'.$highestColumn.'1',NULL,TRUE,FALSE);
                     $datos->periodo = $periodo[0][$count];
                     $datos->save();
                     $count = $count+3;
                     print_r($datos->getErrors());
                    /* $datos = new \frontend\models\VariacionGastos();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->gastosxperdida  = $rowData[0][1]; 
                     $datos->gastosxfaltante  = $rowData[0][2]; 
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors());
            */}
         
                  break;
                   }
     case 9 : 
                     $datos = new \frontend\models\Capital();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->activo_circulante  = $rowData[0][1]; 
                     $datos->pasivo_circulante  = $rowData[0][2]; 
                     $datos->Suma  = $rowData[0][4]; 
                     $datos->creditos_bancarios = $rowData[0][8];
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors()); 
                   {
                  
                  break;
                   }
     case 10 :    $datos = new \frontend\models\Ciclos();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->CE = $rowData[0][1]; 
                     $datos->CEL  = $rowData[0][2]; 
                     $datos->CELD  = $rowData[0][3]; 
                     $datos->CPCE= $rowData[0][4];
                     $datos->CPCED = $rowData[0][5];
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors()); 
                   {
                  
                  break;
                   }
     case 11 :      $datos = new \frontend\models\Cuentas();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->nm_no_vencida= $rowData[0][1]; 
                     $datos->mn_total_vencida  = $rowData[0][2]; 
                     $datos->efectos = $rowData[0][3]; 
                     $datos->cxc_litigio= $rowData[0][4];
                     $datos->ExC_litigio = $rowData[0][5];
                     $datos->saldo_sentencias_judiciales= $rowData[0][6];
                     $datos->ventas_acumuladas = $rowData[0][7];
                     $datos->total_cuentas_vencidas = $rowData[0][8];
                     $datos->efectiviadad = $rowData[0][10];
                     $datos->representatividad = $rowData[0][11];
                     $datos->tipo_cuentaid = 1;
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors()); 
                   {
                  
                  break;
                   }
     case 12 :  
                     $datos = new \frontend\models\Cuentas();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->nm_no_vencida= $rowData[0][1]; 
                     $datos->mn_total_vencida  = $rowData[0][2]; 
                     $datos->efectos = $rowData[0][3]; 
                     $datos->efectiviadad = $rowData[0][5];
         
                     $datos->tipo_cuentaid = 2;
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors()); 
                   {
                  
                  break;
                   }
     case 13 :    $datos = new \frontend\models\PerdidaInvestigacion();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->importe_total= $rowData[0][1]; 
                     $datos->cant_expedientas  = $rowData[0][2]; 
                     $datos->fuera_termino = $rowData[0][3]; 
                     $datos->valor_fuera_termino= $rowData[0][4];
         
                     $datos->tipo_expedienteid = 2;
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors()); 
                   {
                  
                  break;
                   }
     case  14 :  $datos = new \frontend\models\PerdidaInvestigacion();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->importe_total= $rowData[0][1]; 
                     $datos->cant_expedientas  = $rowData[0][2]; 
                     $datos->fuera_termino = $rowData[0][3]; 
                     $datos->valor_fuera_termino= $rowData[0][4];
         
                     $datos->tipo_expedienteid = 1;
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors()); 
                   {
                  
                  break;
                   }
     case 15 :  $datos = new \frontend\models\PerdidaInvestigacion();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->importe_total= $rowData[0][1]; 
                     $datos->cant_expedientas  = $rowData[0][2]; 
                     $datos->fuera_termino = $rowData[0][3]; 
                     $datos->valor_fuera_termino= $rowData[0][4];
         
                     $datos->tipo_expedienteid = 3;
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors()); 
                   {
                  
                  
                  break;
                   }
     case 16 :    $datos = new \frontend\models\Ventas();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->plan= $rowData[0][3]; 
                     $datos->vreal  = $rowData[0][2]; 
                    
         
                     $datos->tipo_ventaid = 2;
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors()); 
                   {
                  
                  break;
                   }
     case 17 :  $datos = new \frontend\models\Impuesto();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->venta35_plan = $rowData[0][1]; 
                     $datos->ventas35_vreal  = $rowData[0][2]; 
                     $datos->ventas2_plan = $rowData[0][3]; 
                     $datos->ventas2_vreal  = $rowData[0][4];
                     $datos->especial17_real2  = $rowData[0][5];
                     $datos->especial17_vreal  = $rowData[0][6];
                     $datos->recuperacion_plan  = $rowData[0][7];
                     $datos->recupercion_vreal  = $rowData[0][8];
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors()); 
                   {
                  
                  break;
                   }     
   case 18 :  $datos = new \frontend\models\Utilidad();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->real_anterior = $rowData[0][1]; 
                     $datos->plan_anual  = $rowData[0][2]; 
                     $datos->plan = $rowData[0][3]; 
                     $datos->vreal  = $rowData[0][4];
                     $datos->real_acum_plan = $rowData[0][7];
                     $datos->IPUI = $rowData[0][8];
                     $datos->IRUI  = $rowData[0][9];
                     $datos->IPGI  = $rowData[0][10];
                     $datos->IRGI  = $rowData[0][11];
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors()); 
                   {
                  
                  break;
                   }
                   
     case 19 :  $datos = new \frontend\models\ValorAgregado();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->plan_anterior= $rowData[0][1]; 
                     $datos->plan  = $rowData[0][2]; 
                     $datos->vreal= $rowData[0][3]; 
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors()); 
                   {
                  
                  break;
                   }
     case 20 :    $datos = new \frontend\models\Productividad();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->plan_anterior= $rowData[0][1]; 
                     $datos->plan  = $rowData[0][2]; 
                     $datos->vreal= $rowData[0][3];
                     $datos->correlacion = $rowData[0][6];
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors()); 
                   {
                  
                  break;
                   }
     case 21 :       $datos = new \frontend\models\FondoSalario();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->plan_anterior= $rowData[0][1]; 
                     $datos->FSVA_plan  = $rowData[0][2]; 
                     $datos->FSVA_vreal= $rowData[0][3];
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors()); 
                   {
                  
                  break;
                   }
     case 22 :      $datos = new \frontend\models\Utilidadxpeso();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->plan_anterior= $rowData[0][1]; 
                     $datos->UPVA_plan  = $rowData[0][2]; 
                     $datos->UPVA_vreal= $rowData[0][3];
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors()); 
                   {
                  
                  break;
                   }
     case 23 : $datos = new \frontend\models\Comedor();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->gastos = $rowData[0][1]; 
                     $datos->ingresos  = $rowData[0][2]; 
                    
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors()); 
                   {
                  
                  break;
                   }
     case 24 : 
                   {
                  
                  break;
                   }
     case 25 :  $datos = new \frontend\models\FondoTiempo();
                     $datos->empresaid = EvaluacionController::Buscarid($rowData[0][0]); 
                     $datos->adiestrado = $rowData[0][1]; 
                     $datos->indice_utilizacion  = $rowData[0][2]; 
                    $datos->indice_ausentismo = $rowData[0][3]; 
                     $datos->ausentismo_puro  = $rowData[0][4]; 
                    $datos->promedio_trab_mensual = $rowData[0][5];
                     $datos->fecha  = date('Ymd'); 
                     $datos->anexoid  = $model->id; 
                     $datos->save();
                     print_r($datos->getErrors()); 
                   {
                  
                  break;
                   }
     
     }               
                    
     
   }

    public function actionVeranexo($id) 
   {
      $evaluacionanexo = \frontend\models\EvaluacionAnexo::findOne(['evaluacionid'=>$id]);
      $searchModel = Yii::createObject($evaluacionanexo->anexo0->searchmodel);
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
     $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
     
     $GridColumns =  $searchModel->attributes(); 
   /*  \yii\helpers\ArrayHelper::removeValue($GridColumns,['id'] );
     \yii\helpers\ArrayHelper::removeValue($GridColumns, 'anexoid');
     */
        
         //$searchModel = new \frontend\models\VariacionGastosSearch();
       // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       // $dataProvider->query->andFilterWhere(['status'=>1]);
     $GridColumns =  $searchModel->attributes(); 
     
   
     \yii\helpers\ArrayHelper::removeValue($GridColumns, 'id' );
    \yii\helpers\ArrayHelper::removeValue($GridColumns, 'anexoid');
    //\yii\helpers\ArrayHelper::removeValue($GridColumns, 'tipo_ventaid');
    //return print_r($dataProvider);
        return $this->render('mostraranexo', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'GridColumns'=>$GridColumns,
           // 'forma'=>$forma,
        ]);
       
       
       //return print_r($dataProvider);    
   }
    public function actionVeranexos($id) 
   {
        $evaluacionanexo = \frontend\models\EvaluacionAnexo::findOne(['evaluacionid'=>$id]);
        
        
 switch ($evaluacionanexo->anexo0->id)
     {
     case 1 : 
                   {
         
             $this->redirect(['/ventas/index','id'=>$evaluacionanexo->id]);
                  break;
                   }
     
    case 2 :   $this->redirect(['/reclamaciones/index','id'=>$evaluacionanexo->id]);
                   {
                  
        
                  break;
                   }
     case 3 : 
                   {
                  
                  break;
                   }
     case 4 : 
                   {
                  
                  break;
                   }
     case 6 :  $this->redirect(['/informacion-laboratorios/index','id'=>$evaluacionanexo->id]);
             
                   {
                  
                  break;
                   }
     case 7 : 
                   {
                  
                  break;
                   }
     case 8 : 
                   {
         $this->redirect(['/variacion-gastos/index','id'=>$evaluacionanexo->id]);
       
                  break;
                   }
     case 9 :   $this->redirect(['/capital/index','id'=>$evaluacionanexo->id]);
                   {
                  
                  break;
                   }
     case 10 :  $this->redirect(['/ciclos/index','id'=>$evaluacionanexo->id]);
               
                   {
                  
                  break;
                   }
     case 11 :  $this->redirect(['/cuentas/index','id'=>$evaluacionanexo->id]);
                   {
                  
                  break;
                   }
     case 12 :  $this->redirect(['/cuentas/index','id'=>$evaluacionanexo->id]);
               
                   {
                  
                  break;
                   }
     case 13 : $this->redirect(['/perdida-investigacion/index','id'=>$evaluacionanexo->id]);
               
                   {
                  
                  break;
                   }
     case  14 : $this->redirect(['/perdida-investigacion/index','id'=>$evaluacionanexo->id]);
               
                   {
                  
                  break;
                   }
     case 15 : $this->redirect(['/perdida-investigacion/index','id'=>$evaluacionanexo->id]);
               
                   {
                  
                  break;
                   }
     case 16 : $this->redirect(['/ventas/index','id'=>$evaluacionanexo->id]);
                   {
                  
                  break;
                   }
     case 17 : $this->redirect(['/impuesto/index','id'=>$evaluacionanexo->id]);
                
                   {
                  
                  break;
                   }
     case 18 : $this->redirect(['/utilidad/index','id'=>$evaluacionanexo->id]);
                
                   {
                  
                  break;
                   }
     case 19 : $this->redirect(['/valor-agregado/index','id'=>$evaluacionanexo->id]);
                   {
                  
                  break;
                   }
     case 20 : $this->redirect(['/productividad/index','id'=>$evaluacionanexo->id]);
                   {
                  
                  break;
                   }
     case 21 :  $this->redirect(['/fondo-salario/index','id'=>$evaluacionanexo->id]);
               
                   {
                  
                  break;
                   }
     case 22 : $this->redirect(['/utilidadxpeso/index','id'=>$evaluacionanexo->id]);
               
                   {
                  
                  break;
                   }
     case 23 : $this->redirect(['/comedor/index','id'=>$evaluacionanexo->id]);
                   {
                  
                  break;
                   }
     case 24 : 
                   {
                  
                  break;
                   }
     case 25 : $this->redirect(['/fondo-tiempo/index','id'=>$evaluacionanexo->id]);
                 
                   {
                  
                  break;
                   }
     case 26 : 
          $url = Yii::$app->urlManager->baseUrl.'/'.$evaluacionanexo->anexo;
         return $this->redirect(Url::to($url)) ;  
        // return print_r(Yii::$app->urlManager->baseUrl);
         
         
         /*
         echo \lesha724\documentviewer\MicrosoftDocumentViewer::widget([
                    'url'=> Yii::$app->urlManager->baseUrl.'/'.$evaluacionanexo->anexo,//url на ваш документ
                    'width'=>'100%',
                    'height'=>'100%']); 
       
          echo \lesha724\documentviewer\GoogleDocumentViewer::widget([
      'url'=>Yii::$app->urlManager->baseUrl.'/'.$evaluacionanexo->anexo,//url на ваш документ 
      'width'=>'100%',
      'height'=>'100%',
      //https://geektimes.ru/post/111647/
      'embedded'=>true,
      'a'=>\lesha724\documentviewer\GoogleDocumentViewer::A_BI //A_V = 'v', A_GT= 'gt', A_BI = 'bi'
]);  */
                   {
                  
                  break;
                   }

     
     }               
                    
     
   }
    public static function ObtenerAnexo($model) 
   {
       if($model->anexo==1)
       {
          
           $modelevaluacion = EvaluacionAnexoController::findModels(['evaluacionid'=>$model->id]);
          if($modelevaluacion == false){
              return false;
          }
           
           if($modelevaluacion->anexo0->id == 26)
           {
               return $anexo = array('evaluacionid'=>$modelevaluacion->id ,'criterio' => CriteriomedidaController::buscarOrdenGeneral($modelevaluacion->evaluacion->criteriomedidaid), 'nombre' => $modelevaluacion->nombre); 
               
           }
           else{
               return FALSE;
           }
       }
       else{
           return false;
       }
       
   }
   public static function ObtenerAnexotabla($model) 
   {
       if($model->anexo==1)
       {
          
           $modelevaluacion = EvaluacionAnexoController::findModels(['evaluacionid'=>$model->id]);
          if($modelevaluacion == false){
              return false;
          }
           
           if($modelevaluacion->anexo0->id != 26)
           {
               return $modelevaluacion;   
           }
           else{
               return FALSE;
           }
       }
       else{
           return false;
       }
       
   }
   public static function buscarAnexo($models) 
   {
       $anexos = false;
       foreach ($models as $evaluacion) 
       {
         if(EvaluacionController::ObtenerAnexo($evaluacion))
         {
           $anexos[] = EvaluacionController::ObtenerAnexo($evaluacion);   
         }
           
         }
       return $anexos; 
   }
   public static function buscarAnexotabla($models) 
   {
       //return print_r($models);
       $anexos = false;
       foreach ($models as $evaluacion) 
       {
         if(EvaluacionController::ObtenerAnexotabla($evaluacion))
         {
           $anexos[] = EvaluacionController::ObtenerAnexotabla($evaluacion);   
         }
           
         }
       return $anexos; 
   }
   public function generarpdf($filename,$name) 
   {
      
       \PhpOffice\PhpWord\Settings::setPdfRendererName(\PhpOffice\PhpWord\Settings::PDF_RENDERER_MPDF);
       \PhpOffice\PhpWord\Settings::setPdfRendererPath('.');
       $phpWord = \PhpOffice\PhpWord\IOFactory::load($filename, 'Word2007');
       $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');
       $xmlWriter->save($name.'.pdf');
       
   }
   public function generarpdftabla($filename,$name) 
   {
       $inputFile = $filename;
        $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFile);
        $objPHPExcel->setActiveSheetIndex(0);

        $rendererLibrary = 'mPDF';
        $rendererLibraryPath = \Yii::getAlias('@vendor') . '/phpoffice/phpexcel/Classes/PHPExcel/Writer/PDF/' . $rendererLibrary;
        $rendererLibraryPath .= '.php';

        if (!\PHPExcel_Settings::setPdfRenderer(
            $rendererLibrary,
            $rendererLibraryPath
        )
        ) {
            die(
                'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
                '
' .
                'at the top of this script as appropriate for your directory structure'
            );
        }
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment;filename="01simple.pdf"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
        ob_end_clean();
        $objWriter->save($name.'.pdf');
    }
       
       /* $inputFile = $filename;
    try{
        $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFile);
    } catch (Exception $e) {
        die('Error');
    }
         \PHPExcel_Settings::setPdfRendererName('mPDF');
       \PHPExcel_Settings::setPdfRendererPath('.');
       $phpexcel = \PHPExcel_IOFactory::load($filename);
       $xmlwriter = \PHPExcel_IOFactory::createWriter($phpexcel,'PDF');
       $xmlwriter->save($name.'.pdf');*/
   
   public static function buscarAnexos($id) 
   {
      //return print_r($id);
       $model = EvaluacionAnexo::findOne(['evaluacionid'=>$id]);
        // return print_r($model);
         if($model['anexoid'] != 26)
       {
      //return print_r($model);
      
           return EvaluacionController::PdfAnexotabla($model['id']);  
       }
       
   }
     public function generarpdfxls($modelcumplimientoanexo)
   {
       
   }
 
}
