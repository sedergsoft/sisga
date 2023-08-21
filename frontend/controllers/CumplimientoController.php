<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Cumplimiento;
use frontend\models\CumplimientoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\controllers\UserController;
use frontend\models\Trazas;
use yii\web\UploadedFile;
use yii\helpers\Url;


/**
 * CumplimientoController implements the CRUD actions for Cumplimiento model.
 */
class CumplimientoController extends Controller
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
     * Lists all Cumplimiento models.
     * @return mixed
     */
    public function actionIndex()
    {
        
    
        
        $searchModel = new CumplimientoSearch();
        
        $dataProvider = new \yii\data\SqlDataProvider([
    'sql' => 'SELECT cumplimiento.id,cumplimiento.indicadores_gestionid, cumplimiento.valor, cumplimiento.userid, cumplimiento.observaciones, cumplimiento.estado_cumplimientoid, cumplimiento.fecha 
                FROM cumplimiento INNER JOIN indicadores_gestion ON cumplimiento.indicadores_gestionid = indicadores_gestion.id
                WHERE indicadores_gestion.direccionid = :direccionid AND  cumplimiento.estado_cumplimientoid = 1 AND  cumplimiento.status= 1 AND cumplimiento.actual= 1 AND indicadores_gestion.evaluado = 1  AND YEAR(cumplimiento.fecha) = :anno AND (MONTH(cumplimiento.fecha) = :periodo OR MONTH(cumplimiento.fecha) = :periodoanterior) ',
    'params' => [':direccionid' =>  UserController::findmodel(\Yii::$app->user->getId())->direccionid,
                ':periodo'=> date('m'),
                ':anno'=> date('Y'),
                ':periodoanterior'=> date('m')-1]
   

   ]);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cumplimiento model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    
    public function actionIndexall() 
    {
      if (!Yii::$app->user->isGuest) {
    
        if(\Yii::$app->user->identity-> rolid== 4)
     {
         return $this->redirect(['indicadoresgestion/llenar']);
     }else{
        $searchModel = new CumplimientoSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider = new \yii\data\SqlDataProvider([
          'sql' =>'SELECT cumplimiento.indicadores_gestionid,cumplimiento.userid,cumplimiento.id,cumplimiento.valor,cumplimiento.observaciones,cumplimiento.estado_cumplimientoid,cumplimiento.fecha,cumplimiento.status FROM `cumplimiento` INNER JOIN indicadores_gestion ON cumplimiento.indicadores_gestionid = indicadores_gestion.id WHERE indicadores_gestion.evaluado = 1 AND indicadores_gestion.status =1 AND cumplimiento.status = 1 AND cumplimiento.actual= 1 AND YEAR(cumplimiento.fecha) = :anno AND MONTH(cumplimiento.fecha) = :periodo ',
           'params' => [ ':periodo'=> date('m'),
                ':anno'=> date('Y')
           ]
                ]);
           // $dataProvider->query->andFilterWhere(['status'=>1]);
      
        return $this->render('indexall', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
         
        ]);   
    }
      }else{
        $searchModel = new CumplimientoSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider = new \yii\data\SqlDataProvider([
          'sql' =>'SELECT cumplimiento.indicadores_gestionid,cumplimiento.userid,cumplimiento.id,cumplimiento.valor,cumplimiento.observaciones,cumplimiento.estado_cumplimientoid,cumplimiento.fecha,cumplimiento.status FROM `cumplimiento` INNER JOIN indicadores_gestion ON cumplimiento.indicadores_gestionid = indicadores_gestion.id WHERE indicadores_gestion.evaluado = 1 AND indicadores_gestion.status =1 AND cumplimiento.status = 1 AND cumplimiento.actual= 1 AND YEAR(cumplimiento.fecha) = :anno AND MONTH(cumplimiento.fecha) = :periodo ',
           'params' => [ ':periodo'=> date('m'),
                ':anno'=> date('Y')
           ]
                ]);
           // $dataProvider->query->andFilterWhere(['status'=>1]);
      
        return $this->render('indexall', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
         
        ]);   
    }
    }
  public function actionIndexmes($mes, $anno)
    {
     //$forma = 1;
       if($mes != date('m'))
       {
         
        $searchModel = new CumplimientoSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider = new \yii\data\SqlDataProvider([
          'sql' =>'SELECT indicadores_gestion.orden, cumplimiento.indicadores_gestionid,cumplimiento.userid,cumplimiento.id,cumplimiento.valor,cumplimiento.observaciones,cumplimiento.estado_cumplimientoid,cumplimiento.fecha,cumplimiento.status FROM `cumplimiento` INNER JOIN indicadores_gestion ON cumplimiento.indicadores_gestionid = indicadores_gestion.id WHERE  indicadores_gestion.status =1 AND cumplimiento.status = 1  AND YEAR(cumplimiento.fecha) = :anno AND MONTH(cumplimiento.fecha) = :periodo ORDER BY indicadores_gestion.orden ',
           'params' => [ ':periodo'=> $mes,
                ':anno'=> $anno
           ]
                ]);
           // $dataProvider->query->andFilterWhere(['status'=>1]);
      
        return $this->render('indexall', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
         
        ]);  
        return $this->render('indexall', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
           // 'forma'=>$forma,
        ]);
       }else{
           return   $this->actionIndexall();
       }
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
 public function actionIndexcumplimiento() 
    {
      $searchModel = new CumplimientoSearch();
        
        $dataProvider = new \yii\data\SqlDataProvider([
    'sql' =>'SELECT indicadores_gestion.orden,cumplimiento.id,cumplimiento.indicadores_gestionid, cumplimiento.valor, cumplimiento.userid, cumplimiento.observaciones, cumplimiento.estado_cumplimientoid, cumplimiento.fecha FROM cumplimiento INNER JOIN indicadores_gestion ON cumplimiento.indicadores_gestionid = indicadores_gestion.id WHERE indicadores_gestion.direccionid = :direccionid AND cumplimiento.status= 1 AND cumplimiento.actual= 1 AND indicadores_gestion.evaluado =1 ORDER BY indicadores_gestion.orden AND MONTH(cumplimiento.fecha) = :periodo AND YEAR(cumplimiento.fecha) = :anno ',
    'params' => [':direccionid' =>  UserController::findmodel(\Yii::$app->user->getId())->direccionid,
                ':periodo'=> date('m'),
                   ':anno'=> date('Y')]
   

   ]);
        return $this->render('cumplimiento', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);  
    }
    
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('Error_autenticacion');
            $this->redirect(['cumplimiento/indexall'
                ]);
        }
        else{
        $model = $this->findModel($id);
        $model->observaciones = str_replace("<br>","\n", $model->observaciones);
          $model->observaciones = str_replace("<br/>","\n", $model->observaciones); 
        return $this->render('view', [
            'model' => $model,
        ]);
        }
        
        }
    public function actionVieweval($id)
    {
        $model = Cumplimiento::findOne(['indicadores_gestionid'=>$id,'status'=>1,'actual'=>1]);
       if(!$model)
       {
        Yii::$app->session->setFlash('error_no_existe');
           return $this->redirect(['indicadoresgestion/llenar']);   
       }
       else{
        $model->observaciones = str_replace("<br>","\n", $model->observaciones);
          $model->observaciones = str_replace("<br/>","\n", $model->observaciones); 
        return $this->render('view', [
            'model' => $model,
        ]);
       }
    }

    /**
     * Creates a new Cumplimiento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     *//*
    public function actionCreate1($id)
    {
        $model = new Cumplimiento();
        $modelindicador = IndicadoresgestionController::findModel($id);
        $modelcumplimientoanexo = new \frontend\models\CumplimientoAnexo();
       //$oldmodel = Cumplimiento::findOne(['indicadores_gestionid'=>$id , 'status'=> 1]);
        $tabla = 'Cumplimiento';
        /*if($oldmodel)
        {
            if( $modelindicador->evaluado == 1)
            {
             return CumplimientoController::actionUpdate($id);  
            }
        }*//*
       if ($model->load(Yii::$app->request->post()))
        {
         $model->indicadores_gestionid = $id;
         $model->userid = \Yii::$app->user->getId();
         date_default_timezone_set('America/Bogota'); //fija el huso horario en UTC-05:00
         $model->fecha = date('Y-m-d');
         $model->observaciones = nl2br($model->observaciones);
                
         /*if($oldmodel = Cumplimiento::findOne(['indicadores_gestionid'=>$id , 'status'=> 1]))
        {
          $accion = 'Actualizó';
          $old = $oldmodel->id;
          $oldmodel->updateAttributes(['status'=>0]);
        } */
     // return print_r($model);
      /*   if($model->save())  
            {
             //new
            if($model->anexo==1 && $modelcumplimientoanexo->load(Yii::$app->request->post()) )
          {
             
           
            $tablaName = trim($modelcumplimientoanexo->anexo0->anexo. date('ymdHm'));  
            $tablaName =  str_replace([' '],'_', $tablaName);
            $modelcumplimientoanexo->file = UploadedFile::getInstance($modelcumplimientoanexo,'anexo');
            return print_r($modelcumplimientoanexo);
            $modelcumplimientoanexo->file->saveAs('uploads/anexos/'.$tablaName.'.'.$modelcumplimientoanexo->file->extension);
            $modelcumplimientoanexo->anexo = 'uploads/anexos/'.$tablaName.'.'.$modelcumplimientoanexo->file->extension;
            $modelcumplimientoanexo->evaluacionid = $model->id;
            $modelcumplimientoanexo->fecha = $model->fechacreado;
            $modelcumplimientoanexo->idtabla = $model->id;
            $modelcumplimientoanexo->save();
            
          } 
            //new
            if($modelindicador->evaluado == 0)
            {
             $accion = 'Creó';
             $old = '';
            }
             $modelindicador->updateAttributes(['evaluado'=>1]);
             $new = $model->id;
             TrazasController::actionCreate($tabla,$accion,$new,$old,'frontend\models\Cumplimiento');
            return $this->redirect(['view', 'id' => $model->id]);  
            }
                
            
        }
        
        return $this->render('create', [
            'model' => $model,
            'modelindicador'=>$modelindicador,
            'modelcumplimientoanexo' => $modelcumplimientoanexo,
            'id'=>$id,
        ]);
    }
*/
    
     public function actionCreate($id)
    {
        $modelindicador = IndicadoresgestionController::findModel($id);
        $oldmodel = Cumplimiento::findOne(['indicadores_gestionid'=>$id , 'status'=> 1]);
        $tabla = 'Cumplimiento';
        
      if($modelindicador->editable ==1)
      {
       if($oldmodel)
       {
           if($oldmodel->estado_cumplimientoid == 2 && $modelindicador->evaluado == 1)
           {
            Yii::$app->session->setFlash('error_certificado');
          return $this->redirect(['indicadoresgestion/llenar']);
           }
               
       }
           
          
        $model = new Cumplimiento();
        $modelanexo = new \frontend\models\Anexo();
        $modelcumplimientoanexo = new \frontend\models\CumplimientoAnexo();
        
        
        if ($model->load(Yii::$app->request->post())&& $model->validate()) 
        {
         //desde aki
              if($model->anexo==1 && $modelcumplimientoanexo->load(Yii::$app->request->post()) )
          {
            if($modelcumplimientoanexo->anexoid ==26)
            {
             if(UploadedFile::getInstance($modelcumplimientoanexo,'anexo')->extension != 'docx'/*&&UploadedFile::getInstance($modelcumplimientoanexo,'anexo')->extension != 'xlsx'*/)
             {
                     
                Yii::$app->session->setFlash('archivo_no_valido');
                $model->anexo = 0;
                return $this->render('create', [
                                  'model' => $model,
                                  'modelindicador'=>$modelindicador,
                                  'modelanexo'=>$modelanexo,
                                  'modelcumplimientoanexo'=>$modelcumplimientoanexo,
                                ]);
             }
            }
          /*  else{
                if(UploadedFile::getInstance($modelcumplimientoanexo,'anexo')->extension != 'xlsx')
                {
                    
                Yii::$app->session->setFlash('archivo_no_valido');
                $model->anexo = 0;
                return $this->render('create', [
                                  'model' => $model,
                                  'modelindicador'=>$modelindicador,
                                  'modelanexo'=>$modelanexo,
                                  'modelcumplimientoanexo'=>$modelcumplimientoanexo,
                                ]);
                }
                
            }*/
          }   
           /*hasta aqui*/ 
            date_default_timezone_set('America/Bogota'); //fija el huso horario en UTC-05:00
            $model->fecha_informacion= date('Y-m-d');
            $model->indicadores_gestionid = $id;
        
      if($oldmodel )
      {
            $oldmodel->updateAttributes(['status'=>0]);
            $accion = 'Actualizó';
            $old = $oldmodel->id;    
            if($oldmodel->anexo == 1)
            {
                $oldanexo = \frontend\models\CumplimientoAnexo::findOne(['cumplimientoid'=>$oldmodel->id,'status'=>1]);
                if($oldanexo)
                {
                    $oldanexo->updateAttributes(['status'=>0]);
                }
            }
      }
      //return print_r($oldmodel);
      $model->indicadores_gestionid = $id;
    //  $model->direccionid = UserController::findmodel(\Yii::$app->user->getId())->direccionid;
      $model->userid= \Yii::$app->user->getId();
      $model->observaciones = nl2br($model->observaciones);
      if($model->save())
      {
            if($modelindicador->evaluado == 0)
            {
             $accion = 'Creó';
             $old = '';
            }
              $new = $model->id;
              TrazasController::actionCreate($tabla,$accion,$new,$old,'frontend\models\Cumplimiento');
            
          
          $modelindicador->updateAttributes(['evaluado'=>1]);
          if($model->anexo==1 && $modelcumplimientoanexo->load(Yii::$app->request->post()) )
          {
             
             // return print_r($modelcumplimientoanexo);
            $tablaName = trim($modelcumplimientoanexo->anexo0->anexo. date('ymdHm').$modelindicador->id);  
            $tablaName =  str_replace([' '],'_', $tablaName);
            $modelcumplimientoanexo->file = UploadedFile::getInstance($modelcumplimientoanexo,'anexo');
            $modelcumplimientoanexo->file->saveAs('uploads/anexos/indicadores/'.$tablaName.'.'.$modelcumplimientoanexo->file->extension);
            $modelcumplimientoanexo->anexo = 'uploads/anexos/indicadores/'.$tablaName.'.'.$modelcumplimientoanexo->file->extension;
            $modelcumplimientoanexo->cumplimientoid = $model->id;
            $modelcumplimientoanexo->nombre = $tablaName.'.pdf';
            $modelcumplimientoanexo->fecha = $model->fecha;
            $modelcumplimientoanexo->idtabla = $model->id;
            $modelcumplimientoanexo->save();
           // return print_r($modelcumplimientoanexo);
            if($modelcumplimientoanexo->anexo0->id==26)
           {
             if($modelcumplimientoanexo->file->extension == "xlsx"||$modelcumplimientoanexo->file->extension == "xls")
             {
                 CumplimientoController::generarpdfxls($modelcumplimientoanexo);   
             }
                else{
                    if($modelcumplimientoanexo->file->extension == "doc")
                    {
                    EvaluacionController::generarpdf($modelcumplimientoanexo->anexo,$tablaName);
          
                    }
                }
                 }
            
            if($modelcumplimientoanexo->anexo0->id!=26)
            {
            $this->Importardatos($modelcumplimientoanexo);
            }
                       
            
            return $this->redirect(['view', 
                 'id' => $model->id,
                ]);
          }
          return $this->redirect(['view', 'id' => $model->id]);
       }
            }
            else{

        return $this->render('create', [
            'model' => $model,
            'modelindicador'=>$modelindicador,
            'modelanexo'=>$modelanexo,
            'modelcumplimientoanexo'=>$modelcumplimientoanexo,
        ]);
        }
    
      }
       else{
            Yii::$app->session->setFlash('error_no_editable');
          return $this->redirect(['criteriomedida/llenar']);
           // CriteriomedidaController::actionLlenar();
       } 
            }

    
    
    /**
     * Updates an existing Cumplimiento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        
        $modelindicador = \frontend\models\IndicadoresGestion::findOne(['id'=>$id,'evaluado'=>1]);
        $modelcumplimientoanexo = new \frontend\models\CumplimientoAnexo();
        $model = $this->findModel(['indicadores_gestionid'=>$id,'status'=>1,'actual'=>1]);
        $model->observaciones = str_replace("<br>","\n", $model->observaciones);
          $model->observaciones = str_replace("<br />","", $model->observaciones); 
        $oldanexo = NULL;
        if($model)
        {
            if($model->estado_cumplimientoid == 2 && $modelindicador->evaluado == 1)
            {
              Yii::$app->session->setFlash('error_certificado');
              return $this->redirect(['indicadoresgestion/llenar']);  
            }
        }
        if($model->anexo == 1)
            {
                $oldanexo = \frontend\models\CumplimientoAnexo::findOne(['cumplimientoid'=>$model->id,'status'=>1]);
               
            }
             
          $model->anexo = 0;
        
        if ($model->load(Yii::$app->request->post())&& $model->validate())
        { 
            if($model->anexo==1 && $modelcumplimientoanexo->load(Yii::$app->request->post()) )
          {
            if($modelcumplimientoanexo->anexoid ==26)
            {
             if(UploadedFile::getInstance($modelcumplimientoanexo,'anexo')->extension != 'docx'/*&&UploadedFile::getInstance($modelcumplimientoanexo,'anexo')->extension != 'xlsx'*/)
             {
                     
                Yii::$app->session->setFlash('archivo_no_valido');
                $model->anexo = 0;
                return $this->render('update', [
                                        'model' => $model,
                                        'modelindicador'=>$modelindicador,
                                        'modelcumplimientoanexo' => $modelcumplimientoanexo,
                                ]);
             }
            }
          /*  else{
                if(UploadedFile::getInstance($modelcumplimientoanexo,'anexo')->extension != 'xlsx')
                {
                    
                Yii::$app->session->setFlash('archivo_no_valido');
                $model->anexo = 0;
                return $this->render('create', [
                                  'model' => $model,
                                  'modelindicador'=>$modelindicador,
                                  'modelanexo'=>$modelanexo,
                                  'modelcumplimientoanexo'=>$modelcumplimientoanexo,
                                ]);
                }
                
            }*/
          }   
            
            $newmodel = new Cumplimiento();    
            $newmodel->indicadores_gestionid = $model->indicadores_gestionid;
            $newmodel->userid = \Yii::$app->user->getId();
            date_default_timezone_set('America/Bogota'); //fija el huso horario en UTC-05:00
           $newmodel->fecha_informacion = date('Y-m-d');
           $newmodel->observaciones = nl2br($model->observaciones);
           $newmodel->valor = $model->valor;
           $newmodel->anexo = $model->anexo;
           $newmodel->fecha= $model->fecha;
           if($newmodel->save())
           {
                if($newmodel->anexo==1 && $modelcumplimientoanexo->load(Yii::$app->request->post()) )
              
          {
             
             // return print_r($modelcumplimientoanexo);
            $tablaName = trim($modelcumplimientoanexo->anexo0->anexo. date('ymdHm').$modelindicador->id);  
            $tablaName =  str_replace([' '],'_', $tablaName);
            $modelcumplimientoanexo->file = UploadedFile::getInstance($modelcumplimientoanexo,'anexo');
            $modelcumplimientoanexo->file->saveAs('uploads/anexos/indicadores/'.$tablaName.'.'.$modelcumplimientoanexo->file->extension);
            $modelcumplimientoanexo->anexo = 'uploads/anexos/indicadores/'.$tablaName.'.'.$modelcumplimientoanexo->file->extension;
            $modelcumplimientoanexo->cumplimientoid = $newmodel->id;
             $modelcumplimientoanexo->nombre = $tablaName.'.pdf';
            $modelcumplimientoanexo->fecha = $newmodel->fecha;
            $modelcumplimientoanexo->idtabla = $newmodel->id;
            $modelcumplimientoanexo->save();
             if($oldanexo)
                {
                    $oldanexo->updateAttributes(['status'=>0]);
                    if( $oldanexo->anexoid != 26)
                     {
                   $oldtabla = \frontend\models\Anexo::findOne(['id'=>$oldanexo->anexoid]);
                $query = new \yii\db\Connection();
                $query->dsn = \Yii::$app->db->dsn;
                $query->username = \Yii::$app->db->username;
                $query->password = \Yii::$app->db->password;
                $query->createCommand()->update($oldtabla->tabla, ['status'=>0], 'anexoid = '.$oldanexo->id)->execute();
                // $query = "UPDATE ".$oldtabla->tabla." SET `status` = '0' WHERE ".$oldtabla->tabla.".`anexoid` = ".$oldanexo->id.";";
                     }
                }
            
           // return print_r($modelcumplimientoanexo);
          /*  if($modelcumplimientoanexo->anexo0->id==26)
           {
                EvaluacionController::generarpdf($modelcumplimientoanexo->anexo,$tablaName);
           }
            
            if($modelcumplimientoanexo->anexo0->id!=26)
            {
            $this->Importardatos($modelcumplimientoanexo);
            }
            */
             if($modelcumplimientoanexo->anexo0->id==26)
           {
             if($modelcumplimientoanexo->file->extension == "xlsx"||$modelcumplimientoanexo->file->extension == "xls")
             {
                 CumplimientoController::generarpdfxls($modelcumplimientoanexo);   
             }
                else{
                    if($modelcumplimientoanexo->file->extension == "doc")
                    {
                    EvaluacionController::generarpdf($modelcumplimientoanexo->anexo,$tablaName);
          
                    }
                }
                 }
            
            if($modelcumplimientoanexo->anexo0->id!=26)
            {
            $this->Importardatos($modelcumplimientoanexo);
            }
            
            
          } 
           $accion = 'Actualizó';
          $old = $model->id;
          $model->updateAttributes(['status'=>0]);
          $model->updateAttributes(['actual'=>0]);
          $tabla = 'Cumplimiento';
          $new = $newmodel->id;
         
          TrazasController::actionCreate($tabla,$accion,$new,$old,'frontend\models\Cumplimiento');
          
               return $this->redirect(['view', 'id' => $newmodel->id]);
            }            
           }

        return $this->render('update', [
            'model' => $model,
            'modelindicador'=>$modelindicador,
              'modelcumplimientoanexo' => $modelcumplimientoanexo,
        ]);
    }
     public function actionCertificar($id)
    {
         
        $model = $this->findModel($id);
        $orden = IndicadoresgestionController::buscarOrdenGeneral($model->indicadoresGestion->id);
        Yii::$app->session->setFlash('ok_certificado', $orden);
        $model->updateAttributes(['estado_cumplimientoid'=>2]);
         
        TrazasController::actionCreate('Cumplimiento','Certificó evaluación',$id,'','frontend\models\Cumplimiento');
        
        return $this->redirect(['index']);
        
    }

    /**
     * Deletes an existing Cumplimiento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
     
        $this->findModel($id)->updateAttributes(['actual'=>0,'status'=>0]);//desactivo la evaaluacion
        \frontend\models\IndicadoresGestion::findOne(['id'=>$this->findModel($id)->indicadores_gestionid])->updateAttributes(['evaluado'=>0]);//pongo el campo evaluado del indicados en 0
        
        if($this->findModel($id)->anexo==1) //si la evaluacion tiene anexo
            {
        
            CumplimientoAnexoController::findModel(['cumplimientoid'=>$id])->updateAttributes(['status'=>0]); //desactivo el anexo
            
            }
         TrazasController::actionCreate('Cumplimiento','Eliminó',"",$id,'frontend\models\Cumplimiento'); //creo la traza de la operacion   
        
        return $this->redirect(['indexall']);
    }

    /**
     * Finds the Cumplimiento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cumplimiento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id)
    {
        if (($model = Cumplimiento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    public static function evaluarCumplimiento($id) 
    {
     $valorreal = CumplimientoController::findModel($id);
     $cumplimiento = 'No cumplido';
     if($valorreal->indicadoresGestion->tope->sentido->sentido == '<')
     {
         if($valorreal->indicadoresGestion->tope->valor > $valorreal->valor)
         {
             $cumplimiento = 'Cumplido';
         }
     }else{
            if($valorreal->indicadoresGestion->tope->sentido->sentido == '=')
                {
                if($valorreal->indicadoresGestion->tope->valor == $valorreal->valor)
                    {
                     $cumplimiento = 'Cumplido';
                    }
                }else{
         
                    if($valorreal->indicadoresGestion->tope->sentido->sentido == '>')
                        {
                        if($valorreal->indicadoresGestion->tope->valor <= $valorreal->valor)
                            {
                             $cumplimiento = 'Cumplido';
                             }
                    
                    
                      }
            }
    }
    return $cumplimiento;
    }
     public function actionVeranexos1($id) 
   {
        $cumplimientoanexo = \frontend\models\CumplimientoAnexo::findOne(['cumplimientoid'=>$id]);
        if($cumplimientoanexo)
        {
        $url = Yii::$app->urlManager->baseUrl.'/'.$cumplimientoanexo->anexo;
         return $this->redirect(Url::to($url)) ;  
        }else{
            throw new NotFoundHttpException (Yii::t('app', 'El archivo ha sido borrado por error'));
        }
         
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
 public function actionVeranexos($id) 
   {
        $evaluacionanexo = \frontend\models\CumplimientoAnexo::findOne(['cumplimientoid'=>$id]);
        
        
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
         return $this->redirect(Url::to($url)) ;  {
                  
                  break;
                   }

     
     }               
                    
     
   }
     public static function buscarAnexotabla($models) 
   {
       //return print_r($models);
       $anexos = false;
       foreach ($models as $cumplimiento) 
       {
         if(CumplimientoController::ObtenerAnexotabla($cumplimiento))
         {
           $anexos[] = CumplimientoController::ObtenerAnexotabla($cumplimiento);   
         }
           
         }
       return $anexos; 
   }
 public static function ObtenerAnexotabla($model) 
   {
       if($model->anexo==1)
       {
          
           $modelcumplimiento = CumplimientoAnexoController::findModels(['cumplimientoid'=>$model->id,'status' => 1]);
          if($modelcumplimiento == false){
              return false;
          }
           
           if($modelcumplimiento->anexo0->id != 26)
           {
               return $modelcumplimiento;   
           }
           else{
               return FALSE;
           }
       }
       else{
           return false;
       }
       
   }
      public static  function buscarAnexo($models) 
   {
       $anexos = false;
       foreach ($models as $evaluacion) 
       {
         if(CumplimientoController::ObtenerAnexo($evaluacion))
         {
           $anexos[] = CumplimientoController::ObtenerAnexo($evaluacion);   
         }
           
         }
       return $anexos; 
   }
   public function ObtenerAnexo($model) 
   {
       if($model->anexo==1)
       {
          
           $modelevaluacion = CumplimientoAnexoController::findModels(['cumplimientoid'=>$model->id]);
          if($modelevaluacion == false){
              return false;
          }
           
           if($modelevaluacion->anexo0->id == 26)
           {
              return $anexo = array('cumplimientoid'=>$modelevaluacion->id ,'indicador' => IndicadoresgestionController::buscarOrdenGeneral($modelevaluacion->cumplimiento->indicadores_gestionid), 'nombre' => $modelevaluacion->nombre); 
                 
           }
           else{
               return FALSE;
           }
       }
       else{
           return false;
       }
       
   }
   public function generarpdfxls($modelcumplimientoanexo)
   {
        /*sis\PhpOffice\PhpWord\Settings::setPdfRendererName(\PhpOffice\PhpWord\Settings::PDF_RENDERER_MPDF);
       \PhpOffice\PhpWord\Settings::setPdfRendererPath('.');
       $phpWord = \PhpOffice\PhpWord\IOFactory::load($filename, 'Word2007');
       $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');
       $xmlWriter->save($name.'.pdf');
       
       \PHPExcel_Settings::setPdfRendererName(\PHPExcel_Settings::PDF_RENDERER_MPDF);
       \PHPExcel_Settings::setPdfRendererPath('.');
       \PHPExcel_Settings::setpdf 
       $rendererName = \PHPExcel_Settings::PDF_RENDERER_MPDF;
       $rendererLibrary = \PHPExcel_Settings::PDF_RENDERER_MPDF;
       $rendererLibraryPath = \yii::getAlias('@vendor').'/phpoffice/phpexcel/Clases/PHPExcel/Writer/PDF/';//.$rendererLibrary;
     //  $rendererLibraryPath .= '.php';
       
    //  die( $rendererLibraryPath . $rendererName);
      // $rendererLibraryPath = dirname(dirname(__FILE__)).'libs/PDF/'.$rendererLibrary;
       if(!\PHPExcel_Settings::setPdfRenderer($rendererLibrary, $rendererLibraryPath))
       {
           die(
                    
                   'Por favor introdusca los valores de '.$rendererLibraryPath.' y '.$rendererName.' '.PHP_EOL.' de forma apropiada para su estructura de directorios'
                   );
       }
       $PHPExcel= new \PHPExcel();
       $PHPReader =new \PHPExcel_Reader_Excel2007();
       if(!$PHPReader->canRead($modelcumplimientoanexo->anexo))
       {
         $PHPReader = new \PHPExcel_Reader_Excel5();
           if($PHPReader->canRead($modelcumplimientoanexo->anexo))
           {
               echo 'no excel';
           }
       }
       $PHPExcel = $PHPReader->load($modelcumplimientoanexo->anexo);
       $PHPExcel->getActiveSheet()->setShowGridlines(FALSE);
       $objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'PDF');
       $savePath = dirname(dirname(__FILE__)).'upload/pdfxls.pdf';
       $objWriter->save($savePath);
       */
   }
}
