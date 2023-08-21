<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Informe;
use yii\web\Controller;
use kartik\mpdf\Pdf;
//use yii\web\NotFoundHttpException;
//use yii\filters\VerbFilter;

/**
 * ComedorController implements the CRUD actions for Comedor model.
 */
class InformeController extends Controller
{
     public function actionIndex()
    {
       $model = new Informe();
         return $this->render('index',[
            'model' => $model,
        ]);
    }
    
    public function actionGenerarinforme()
    {
        $model = new Informe();

        if ($model->load(Yii::$app->request->post()) ) 
        {
          if($model->tipo == 0)
          {
            return $this->generarIndicadores($model); 
          }else{
              if($model->tipo == 1)
              {
                  return $this->generarCriterios($model);
              }else{
                  return $this->generar($model);
              }
          }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
    
    public function generarIndicadores($model)
    {
      if($model->mes)
        {
          
        $objetivos = \frontend\models\Objetivo::find()->andFilterWhere(['Status'=>1])->orderBy(['orden' => SORT_ASC])->all();
        $direciones = \frontend\models\Direccion::find()->where(['status'=>1])->all();
        $indicadores = \frontend\models\IndicadoresGestion::find()->orderBy(['orden' => SORT_ASC])->all();
        $tope = \frontend\models\TopeIndicador::find()->all();
        $sentido = \frontend\models\Sentido::find()->all();
        $evaluacionIndicador = \frontend\models\Cumplimiento::find()->where(['status'=>1])->andFilterWhere(['MONTH(fecha)' => $model->mes])->all();
        $user = \common\models\User::find()->all();
        $estado = \frontend\models\EstadoCumplimiento::find()->all();
        $datosobjetivos = \yii\helpers\ArrayHelper::toArray($objetivos);
        $datosdireciones = \yii\helpers\ArrayHelper::toArray($direciones);
        $datosIndicadores = \yii\helpers\ArrayHelper::toArray($indicadores);
        $datostope = \yii\helpers\ArrayHelper::toArray($tope);
        $datossentido = \yii\helpers\ArrayHelper::toArray($sentido);
        $datosevaluacionIndicador = \yii\helpers\ArrayHelper::toArray($evaluacionIndicador);
        $datosuser = \yii\helpers\ArrayHelper::toArray($user);
        $datosestado = \yii\helpers\ArrayHelper::toArray($estado);
        $anexotablasindicador = CumplimientoController::buscarAnexotabla($evaluacionIndicador);
        $anexoindicadorid[] = array();
         if($anexotablasindicador != false)
                {
                foreach ($anexotablasindicador as $indicadoranexo) 
                    {
                    $anexoindicadorid[$indicadoranexo->cumplimientoid] =  $this->obenerdatos($indicadoranexo) ;
                    }
                }        
        
        if($model->organizacion ==  0)
        {
            $view = '_pdfindicadorObjetivo';
            $nombre = 'Informe Estadístico de la Gestión por Objetivos - (Indicadores) ';
            $titulo = 'Informe Estadístico de la Gestión por Objetivos(Indicadores)' ;
            
        }else{
            if($model->organizacion ==1)
            {
                $view = '_pdfindicadordireccion';
                $nombre = 'Informe Estadístico de la Gestión por Direcciones - (Indicadores) ';
                $titulo = 'Informe Estadístico de la Gestión por Direcciones(Indicadores)';
            }
        }
                
        $content = $this->renderPartial($view, [
            'datosobjetivos' => $datosobjetivos,
            'datosdireciones'=> $datosdireciones,
            'datosIndicadores'=>$datosIndicadores,
            'datossentido'=>$datossentido,
            'datostope'=>$datostope,
            'datosevaluacionIndicador'=>$datosevaluacionIndicador,
            'datosuser'=>$datosuser,
            'datosestado' => $datosestado,
            'anexoindicadorid'=>$anexoindicadorid,
            'nombre' =>$titulo,
           
    
    ]);
        $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_CORE, 
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        //'orientation' => Pdf::ORIENT_LANDSCAPE, 
        // stream to browser inline
        'destination' => Pdf::DEST_BROWSER, 
        // your html content input
        'content' => $content,  
        'defaultFontSize'=>60,
        // format content from your own css file if needed or use the
       // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
       /*'cssInline' => 'td{font-size:45px},th{font-size:45px},div.panel-heading{font-size:45px},.panel-title {
    margin-top: 0;
    margin-bottom: 0;
    font-size: 45px;
    color: inherit;
}

sisga.css:144
h1', */    // format content from your own css file if needed or use the
       'filename' => $nombre.date('M, Y'),
       'options' => ['title' => "OSDE GA"],
         // call mPDF methods on the fly
        
        'methods' => [ 
            'SetHeader'=>["OSDE Grupo Alimentos - Generado: ".date('M, Y')], 
            'SetFooter'=>['{PAGENO}'],
        ]
    ]);
         if(CumplimientoController::buscarAnexo($evaluacionIndicador)!= false)
        {
         $anexos1 = CumplimientoController::buscarAnexo($evaluacionIndicador);
         foreach ($anexos1 as $anexo) 
            {
 
            $pdf->addPdfAttachment($anexo['nombre'],'Anexo del Indicador '.$anexo['indicador'],''); 
            }
        }
        return $pdf->render();   
        }    
    }
    
    public function generarCriterios($model)
    {
       
        if($model->mes);
        $objetivos = \frontend\models\Objetivo::find()->andFilterWhere(['Status'=>1])->orderBy(['orden' => SORT_ASC])->all();
        $criterios = \frontend\models\Criteriomedida::find()->andFilterWhere(['Status'=>1])->orderBy(['orden' => SORT_ASC])->all();
        $direciones = \frontend\models\Direccion::find()->where(['status'=>1])->all();
        $sentido = \frontend\models\Sentido::find()->all();
        $topec = \frontend\models\Tope::find()->all();
        $evaluacionCriterio = \frontend\models\Evaluacion::find()->where(['status'=>1])->andFilterWhere(['MONTH(fechacreado)' => $model->mes])->all();
        $periodos = \frontend\models\Periodo::find()->all();
        $user = \common\models\User::find()->all();
        $estado = \frontend\models\EstadoCumplimiento::find()->all();
        
        $datosobjetivos = \yii\helpers\ArrayHelper::toArray($objetivos);
        $datoscriterios = \yii\helpers\ArrayHelper::toArray($criterios);
        $datosdireciones = \yii\helpers\ArrayHelper::toArray($direciones);
        $datostopec = \yii\helpers\ArrayHelper::toArray($topec);
        $datosevaluacionCriterio = \yii\helpers\ArrayHelper::toArray($evaluacionCriterio);
        $datosperiodos = \yii\helpers\ArrayHelper::toArray($periodos);
        $datosuser = \yii\helpers\ArrayHelper::toArray($user);
        $datosestado = \yii\helpers\ArrayHelper::toArray($estado);
        
        $anexostabla = EvaluacionController::buscarAnexotabla($evaluacionCriterio);
        $anexocriterioid[] = array();
        if($anexostabla != false)
                {
                foreach ($anexostabla as $evaluacionanexo) 
                    {
                    $anexocriterioid[$evaluacionanexo->evaluacionid] =  $this->obenerdatos($evaluacionanexo) ;
                    }
                } 
           
        if($model->organizacion ==  0)
        {
            $view = '_pdfcriterioObjetivo';
            $nombre = 'Informe Estadístico de la Gestión por Objetivos - (Criterios de medida) ';
            $titulo = 'Informe Estadístico de la Gestión por Objetivos(Criterios de medida) ';
            
        }else{
            if($model->organizacion ==1)
            {
                $view = '_pdfcriteriodireccion';
                $nombre = 'Informe Estadístico de la Gestión por Direcciones - (Criterios de medida) ';
                $titulo = 'Informe Estadístico de la Gestión por Direcciones(Criterios de medida) ';
            }
        }
          
                
                $content = $this->renderPartial($view, [
            'datosobjetivos' => $datosobjetivos,
            'datoscriterios' => $datoscriterios,
            'datosdireciones'=> $datosdireciones,
            //'datosIndicadores'=>$datosIndicadores,
            //'datossentido'=>$datossentido,
            //'datostope'=>$datostope,
            'datostopec'=>$datostopec,
            //'datosevaluacionIndicador'=>$datosevaluacionIndicador,
            'datosevaluacionCriterio'=>$datosevaluacionCriterio,
            'datosperiodos'=>$datosperiodos,
            'datosuser'=>$datosuser,
            'datosestado' => $datosestado,
            'anexocriterioid'=>$anexocriterioid,
            //'anexoindicadorid'=>$anexoindicadorid,
                    'nombre' =>$titulo,
           
    
    ]);
      
        $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_CORE, 
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_LANDSCAPE, 
        // stream to browser inline
        'destination' => Pdf::DEST_BROWSER, 
        // your html content input
        'content' => $content,  
        'defaultFontSize'=>60,
        // format content from your own css file if needed or use the
       // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
        /*'cssInline' => 'td{font-size:45px},th{font-size:45px},div.panel-heading{font-size:45px},.panel-title {
    margin-top: 0;
    margin-bottom: 0;
    font-size: 45px;
    color: inherit;
}

sisga.css:144
h1',  */  // format content from your own css file if needed or use the
       'filename' => $nombre.date('M, Y'),
       'options' => ['title' => "OSDE GA"],
         // call mPDF methods on the fly
        
        'methods' => [ 
            'SetHeader'=>["OSDE Grupo Alimentos - Generado: ".date('M, Y')], 
            'SetFooter'=>['{PAGENO}'],
        ]
    ]);
       if(EvaluacionController::buscarAnexo($evaluacionCriterio)!= false)
        {
         $anexos = EvaluacionController::buscarAnexo($evaluacionCriterio);
       //  return print_r($anexos);
         foreach ($anexos as $anexo) 
            {
            
            $pdf->addPdfAttachment($anexo['nombre'],'Anexo del Criterio de Medida '.$anexo['criterio'],''); 
         
            }
        }
        
     
        return $pdf->render();   
    
 
   
          
    }
      
     
    public function generar($model) 
    {
        
     
        if($model->mes)
        {
           
        $objetivos = \frontend\models\Objetivo::find()->andFilterWhere(['Status'=>1])->orderBy(['orden' => SORT_ASC])->all();
        $criterios = \frontend\models\Criteriomedida::find()->andFilterWhere(['Status'=>1])->orderBy(['orden' => SORT_ASC])->all();
        $direciones = \frontend\models\Direccion::find()->where(['status'=>1])->all();
        $indicadores = \frontend\models\IndicadoresGestion::find()->orderBy(['orden' => SORT_ASC])->all();
        $tope = \frontend\models\TopeIndicador::find()->all();
        $sentido = \frontend\models\Sentido::find()->all();
        $topec = \frontend\models\Tope::find()->all();
        $evaluacionCriterio = \frontend\models\Evaluacion::find()->where(['status'=>1])->andFilterWhere(['MONTH(fechacreado)' => $model->mes])->all();
        $evaluacionIndicador = \frontend\models\Cumplimiento::find()->where(['status'=>1])->andFilterWhere(['MONTH(fecha)' => $model->mes])->all();
        $periodos = \frontend\models\Periodo::find()->all();
        $user = \common\models\User::find()->all();
        $estado = \frontend\models\EstadoCumplimiento::find()->all();
        
        $datosobjetivos = \yii\helpers\ArrayHelper::toArray($objetivos);
        $datoscriterios = \yii\helpers\ArrayHelper::toArray($criterios);
        $datosdireciones = \yii\helpers\ArrayHelper::toArray($direciones);
        $datosIndicadores = \yii\helpers\ArrayHelper::toArray($indicadores);
        $datostopec = \yii\helpers\ArrayHelper::toArray($topec);
        $datostope = \yii\helpers\ArrayHelper::toArray($tope);
        $datossentido = \yii\helpers\ArrayHelper::toArray($sentido);
        $datosevaluacionCriterio = \yii\helpers\ArrayHelper::toArray($evaluacionCriterio);
        $datosevaluacionIndicador = \yii\helpers\ArrayHelper::toArray($evaluacionIndicador);
        $datosperiodos = \yii\helpers\ArrayHelper::toArray($periodos);
        $datosuser = \yii\helpers\ArrayHelper::toArray($user);
        $datosestado = \yii\helpers\ArrayHelper::toArray($estado);
        
        $anexostabla = EvaluacionController::buscarAnexotabla($evaluacionCriterio);
        $anexocriterioid[] = array();
        $anexotablasindicador = CumplimientoController::buscarAnexotabla($evaluacionIndicador);
        $anexoindicadorid[] = array();
// return print_r($evaluacionCriterio); 
        if($anexostabla != false)
                {
                foreach ($anexostabla as $evaluacionanexo) 
                    {
                    $anexocriterioid[$evaluacionanexo->evaluacionid] =  $this->obenerdatos($evaluacionanexo) ;
                    }
                } 
         if($anexotablasindicador != false)
                {
                foreach ($anexotablasindicador as $indicadoranexo) 
                    {
                    $anexoindicadorid[$indicadoranexo->cumplimientoid] =  $this->obenerdatos($indicadoranexo) ;
                    }
                }        
             if($model->organizacion ==  0)
        {
            $view = '_pdfObjetivo';
            $nombre = 'Informe Estadístico de la Gestión por Objetivos - '.$model->mes.' - '.$model->anno;
            $titulo = 'Informe Estadístico de la Gestión por Objetivos'
                    . ' Periodo:('.$model->mes.' - '.$model->anno.')';
            
        }else{
            if($model->organizacion ==1)
            {
                $view = '_pdfdireccion';
                $nombre = 'Informe Estadístico de la Gestión por Direcciones - ';
                $titulo = 'Informe Estadístico de la Gestión por Direcciones';
            }
        }
               // return print_r($anexocriterioid);
        
        $content = $this->renderPartial($view, [
            'datosobjetivos' => $datosobjetivos,
            'datoscriterios' => $datoscriterios,
            'datosdireciones'=> $datosdireciones,
            'datosIndicadores'=>$datosIndicadores,
            'datossentido'=>$datossentido,
            'datostope'=>$datostope,
            'datostopec'=>$datostopec,
            'datosevaluacionIndicador'=>$datosevaluacionIndicador,
            'datosevaluacionCriterio'=>$datosevaluacionCriterio,
            'datosperiodos'=>$datosperiodos,
            'datosuser'=>$datosuser,
            'datosestado' => $datosestado,
            'anexocriterioid'=>$anexocriterioid,
            'anexoindicadorid'=>$anexoindicadorid,
            'nombre' => $titulo,
           
    
    ]);
       
        $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_CORE, 
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_LANDSCAPE, 
        // stream to browser inline
        'destination' => Pdf::DEST_BROWSER, 
        // your html content input
        'content' => $content,  
        'defaultFontSize'=>60,
        // format content from your own css file if needed or use the
       // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
       /* 'cssInline' => 'td{font-size:45px},th{font-size:45px},div.panel-heading{font-size:45px},.panel-title {
    margin-top: 0;
    margin-bottom: 0;
    font-size: 45px;
    color: inherit;
}

sisga.css:144
h1',   */ // format content from your own css file if needed or use the
       'filename' => $nombre.'('.date('M, Y').')',
       'options' => ['title' => "OSDE GA"],
         // call mPDF methods on the fly
        
        'methods' => [ 
            'SetHeader'=>["OSDE Grupo Alimentos - Generado: ".date('M, Y')], 
            'SetFooter'=>['{PAGENO}'],
        ]
    ]);
       if(EvaluacionController::buscarAnexo($evaluacionCriterio)!= false)
        {
         $anexos = EvaluacionController::buscarAnexo($evaluacionCriterio);
       //  return print_r($anexos);
         foreach ($anexos as $anexo) 
            {
            
            $pdf->addPdfAttachment($anexo['nombre'],'Anexo del Criterio de Medida '.$anexo['criterio'],''); 
         
            }
        }
        
         if(CumplimientoController::buscarAnexo($evaluacionIndicador)!= false)
        {
         $anexos1 = CumplimientoController::buscarAnexo($evaluacionIndicador);
        // return print_r($anexos1);
         foreach ($anexos1 as $anexo) 
            {
 
            $pdf->addPdfAttachment($anexo['nombre'],'Anexo del Indicador '.$anexo['indicador'],''); 
            }
        }
      
        return $pdf->render();   
    
 
   
        }  
    
   
        
    }
    
     public function obenerdatos($evaluacionanexo) 
    {
 switch ($evaluacionanexo->anexoid)
     {
     case 1 : 
                   {
         
                    $searchModel1 = new \frontend\models\VentasSearch();
                    $dataProvider1 = $searchModel1->search(Yii::$app->request->queryParams);
                    $dataProvider1->query->andFilterWhere(['anexoid'=> $evaluacionanexo->id]);
                    $dataProvider1->pagination = FALSE;
                    
                    $venta = Ventas::findOne(['anexoid'=>$id]);
                 
                    $content1=$this->renderPartial('..\ventas\indexpdf', [
                                                    'searchModel' => $searchModel1,
                                                    'dataProvider' => $dataProvider1,
                                                    'venta' =>$venta,    
                                                   ]);         
         
                    
                                                   return $content1;
                 
         
                   
                  break;
                   }
     
    case 2 :       $searchModel = new \frontend\models\ReclamacionesSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id])->orderBy(['tipo_reclamacion'=>'ASC']);
                    $dataProvider->pagination = FALSE;
        $content1 = $this->renderPartial('..\reclamaciones\indexpdf', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
        
        
        return $content1;
                   {
                  
        
                  break;
                   }
     case 3 : 
                 $searchModel1 = new \frontend\models\VentasSearch();
                    $dataProvider1 = $searchModel1->search(Yii::$app->request->queryParams);
                    $dataProvider1->query->andFilterWhere(['anexoid'=> $evaluacionanexo->id]);
                    $dataProvider1->pagination = FALSE;
                    
                    $venta = Ventas::findOne(['anexoid'=>$evaluacionanexo->id]);
                 
                    $content1=$this->renderPartial('..\ventas\indexpdf', [
                                                    'searchModel' => $searchModel1,
                                                    'dataProvider' => $dataProvider1,
                                                    'venta' =>$venta,    
                                                   ]);         
         
                    
                                                   return $content1;
                 
         
                   
                   {
                  
                  break;
                   }
     case 4 : 
                   {
                  
                  break;
                   }
     case 6 :  
                $searchModel = new \frontend\models\InformacionLaboratoriosSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andFilterWhere(['anexoid'=> $evaluacionanexo->id]);
                $dataProvider->pagination = FALSE;
                $content1 = $this->renderPartial('..\Informacion-laboratorios\indexpdf', [
                                                    'searchModel' => $searchModel,
                                                    'dataProvider' => $dataProvider
            
         ]);
         return $content1;
             
                   {
                  
                  break;
                   }
     case 7 :           $searchModel = new \frontend\models\CuentasSearch();
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                        $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                        $dataProvider->pagination = FALSE;
                        $tipocuenta = Cuentas::findOne(['anexoid'=>$evaluacionanexo->id]);

                        $content1 =  $this->renderPartial('..\cuentas\indexpdf', [
                                                        'searchModel' => $searchModel,
                                                        'dataProvider' => $dataProvider,
                                                        'tipocuenta'=>$tipocuenta,
                                                        ]);
                        return $content1;   
                   {
                  
                  break;
                   }
     case 8 : 
                    $searchModel = new \frontend\models\VariacionGastosSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id,'periodo'=>'2018-04'])->orderBy(['periodo'=>'ASC']);
                    $dataProvider->pagination = FALSE;

                    $content1 = $this->renderPartial('..\variacion-gastos\indexpdf', [
                                                    'searchModel' => $searchModel,
                                                     'dataProvider' => $dataProvider,
                                                                ]);
                    return $content1;
                   {
          
       
                  break;
                   }
     case 9 :  
                    $searchModel = new \frontend\models\CapitalSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $periodo = \frontend\models\Capital::findOne(['anexoid'=>$evaluacionanexo->id])->fecha;
                    $periodo = \Yii::$app->formatter->asDate($periodo,'M-Y');
        
                    $content =  $this->renderPartial('..\capital\indexpdf', [
                                                    'searchModel' => $searchModel,
                                                    'dataProvider' => $dataProvider,
                                                    'periodo' => $periodo,
                                                ]);
                    return $content;
         
                   {
                  
                  break;
                   }
     case 10 :      $searchModel = new \frontend\models\CiclosSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $content1 = $this->renderPartial('..\ciclos\indexpdf', [
                                                        'searchModel' => $searchModel,
                                                        'dataProvider' => $dataProvider,
                                                            ]);
         
         
                    return $content1;
                  {
                  
                  break;
                   }
     case 11 :          $searchModel = new \frontend\models\CuentasSearch();
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                        $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                        $dataProvider->pagination = FALSE;
                        $tipocuenta = \frontend\models\Cuentas::findOne(['anexoid'=>$evaluacionanexo->id]);

                        $content1 =  $this->renderPartial('..\cuentas\indexpdf', [
                                                        'searchModel' => $searchModel,
                                                        'dataProvider' => $dataProvider,
                                                        'tipocuenta'=>$tipocuenta,
                                                        ]);
                        return $content1;     {
                  
                  break;
                   }
     case 12 :       $searchModel = new \frontend\models\CuentasSearch();
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                        $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                        $tipocuenta = \frontend\models\Cuentas::findOne(['anexoid'=>$evaluacionanexo->id]);

                        $content1 =  $this->renderPartial('..\cuentas\indexpdf', [
                                                        'searchModel' => $searchModel,
                                                        'dataProvider' => $dataProvider,
                                                        'tipocuenta'=>$tipocuenta,
                                                        ]);
                        return $content1; 
                   {
                  
                  break;
                   }
     case 13 :      $searchModel = new \frontend\models\PerdidaInvestigacionSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $expediente = \frontend\models\PerdidaInvestigacion::findOne(['anexoid'=>$evaluacionanexo->id]);
                    $content1 = $this->renderPartial('..\perdida-investigacion\indexpdf', [
                                                        'searchModel' => $searchModel,
                                                        'dataProvider' => $dataProvider,
                                                        'expediente'=>$expediente,
        ]);
         
         
         return $content1; 
         
                   {
                  
                  break;
                   }
     case  14 :  $searchModel = new \frontend\models\PerdidaInvestigacionSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $expediente = \frontend\models\PerdidaInvestigacion::findOne(['anexoid'=>$evaluacionanexo->id]);
                    $content1 = $this->renderPartial('..\perdida-investigacion\indexpdf', [
                                                        'searchModel' => $searchModel,
                                                        'dataProvider' => $dataProvider,
                                                        'expediente'=>$expediente,
                                                            ]);
         
         
         return $content1;  
                   {
                  
                  break;
                   }
     case 15 :  $searchModel = new \frontend\models\PerdidaInvestigacionSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $expediente = \frontend\models\PerdidaInvestigacion::findOne(['anexoid'=>$evaluacionanexo->id]);
                    $content1 = $this->renderPartial('..\perdida-investigacion\indexpdf', [
                                                        'searchModel' => $searchModel,
                                                        'dataProvider' => $dataProvider,
                                                        'expediente'=>$expediente,
        ]);
         
         
         return $content1; 
                   {
                  
                  break;
                   }
     case 16 :      $searchModel1 = new \frontend\models\VentasSearch();
                    $dataProvider1 = $searchModel1->search(Yii::$app->request->queryParams);
                    $dataProvider1->query->andFilterWhere(['anexoid'=> $evaluacionanexo->id]);
                    $dataProvider1->pagination = FALSE;
                    
                    $venta = \frontend\models\Ventas::findOne(['anexoid'=>$evaluacionanexo->id]);
                 
                    $content1=$this->renderPartial('..\ventas\indexpdf', [
                                                    'searchModel' => $searchModel1,
                                                    'dataProvider' => $dataProvider1,
                                                    'venta' =>$venta,    
                                                   ]);         
         
                    
                                                   return $content1;
                     {
                  
                  break;
                   }
     case 17 :         $searchModel = new \frontend\models\ImpuestoSearch();
                        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                         $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                         $content1= $this->renderPartial('..\impuesto\indexpdf', [
                                                            'searchModel' => $searchModel,
                                                            'dataProvider' => $dataProvider,
                                                            ]);
         
         
         
         return $content1;
                
                   {
                  
                  break;
                   }
     case 18 : 
                    $searchModel = new \frontend\models\UtilidadSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $content1 =  $this->renderPartial('..\utilidad\indexpdf', [
                                                'searchModel' => $searchModel,
                                                'dataProvider' => $dataProvider,
        ]);
         
         
         return $content1 ;
                
                   {
                  
                  break;
                   }
     case 19 :
         
                 $searchModel = new \frontend\models\ValorAgregadoSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                $content1 =  $this->renderPartial('..\valor-agrgado\indexpdf', [
                                                'searchModel' => $searchModel,
                                                'dataProvider' => $dataProvider,
                                                ]);
         return $content1;
                   {
                  
                  break;
                   }
     case 20 :
         
                    $searchModel = new \frontend\models\ProductividadSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $content1 = $this->renderPartial('..\productividad\indexpdf', [
                                                'searchModel' => $searchModel,
                                                'dataProvider' => $dataProvider,
                                                           ]);
         return $content1;
                   {
                  
                  break;
                   }
     case 21 : // return ($evaluacionanexo); 
                    $searchModel = new \frontend\models\FondoSalarioSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $content1 = $this->renderPartial('..\fondo-salario\indexpdf', [
                                                    'searchModel' => $searchModel,
                                                    'dataProvider' => $dataProvider,
                                                    ]);
         
         
         
         
                    return $content1;
               
                   {
                  
                  break;
                   }
     case 22 :      $searchModel = new \frontend\models\UtilidadxpesoSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $content1 = $this->renderPartial('..\utilidadxpeso\indexpdf', [
                                                    'searchModel' => $searchModel,
                                                    'dataProvider' => $dataProvider,
                                                               ]);
         
         
         
         
         
         return $content1;
               
                   {
                  
                  break;
                   }
     case 23 : 
                $searchModel = new \frontend\models\ComedorSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider->pagination = FALSE;
                    $content1 = $this->renderPartial('..\comedor\indexpdf', [
                                 'searchModel' => $searchModel,
                                 'dataProvider' => $dataProvider,
                    ]);
         
         
         return $content1;   
                    {
                  
                  break;
                   }
     case 24 : 
                   {
                                      
                  break;
                   }
     case 25 :      
         
                    $searchModel1 = new \frontend\models\FondoTiempoSearch();
                    $dataProvider1 = $searchModel1->search(Yii::$app->request->queryParams);
                    $dataProvider1->query->andFilterWhere(['anexoid'=>$evaluacionanexo->id]);
                    $dataProvider1->pagination = FALSE;
                 
                    $content1=$this->renderPartial('..\fondo-tiempo\indexpdf', [
                                                    'searchModel' => $searchModel1,
                                                    'dataProvider' => $dataProvider1,
                                                   ]);         
         
                    
                                                   return $content1;
                                 
                   {
                  
                  break;
                   }
     
     }               
                    
     
   }
   
}
