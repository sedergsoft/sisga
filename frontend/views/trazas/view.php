<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Trazas */

$this->title = $model->IdTraza;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Trazas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trazas-view">

    
    <?php 
        echo  DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Información General',
        'type'=>DetailView::TYPE_INFO,
    
        
    ],
         
    'attributes'=>[
        
           [
                'attribute'=> 'IdUsuario',
                'label' => 'Usuario',
                'value'=>$model->usuario->username,
                ],
         
        [
                'attribute'=> 'tarea_realizada',
                'label' => 'Tarea Realizada',
                
                ],
         
        [
                'attribute'=> 'Tabla_Afectada',
                'label' => 'Datos',
               
                ],
            [
                'attribute'=> 'fecha',
                'label' => 'Fecha',
                ],
        
         [
                    'attribute'=> 'hora',
                    'label' => 'Hora',
                    
                ],
         
                
          [
                'attribute'=> 'valor_antiguo',
                'label' => 'ID datos Anteriores',
                ], 
        
       
        
        [
                'attribute'=> 'valor_actual',
                'label' => 'ID datos Actuales',
               // 'value'=>$model->tope->Itrimestre,
                
                ],
            ],
          
    'enableEditMode'=>FALSE,
]);  
 
      if($tarea == 1 && $evaluacion == false)
      {
        echo  DetailView::widget([
    'model'=>$dataanterior,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Datos Anteriores : ID - '.$dataanterior->id,
        'type'=>DetailView::TYPE_DANGER,
    
        
    ],
         
    'attributes'=>[
        
           [
                'attribute'=> 'valor',
                'label' => 'Valor Anterior',
              //  'value'=>$dataanterior->valor,
                ],
         [
                'attribute'=> 'observaciones',
                'label' => 'Observaciones',
             'format'=>'raw',
              //  'value'=>$dataanterior->valor,
                ],
         
        [
                'attribute'=> 'userid',
                'label' => 'Usuario que Informó',
                'value'=>$dataanterior->user->username
                ],
         
        [
                'attribute'=> 'indicadores_gestionid',
                'label' => 'Indicador',
               'value'=>$dataanterior->indicadoresGestion->descripcion
                ],
            [
                'attribute'=> 'fecha',
                'label' => 'Fecha en que se informó',
                ],
        
            ],
          
    'enableEditMode'=>FALSE,
]);  
      }
  if($evaluacion == FALSE)
  {
    echo  DetailView::widget([
    'model'=>$dataactual,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Datos Actuales: ID - '.$dataactual->id,
        'type'=>DetailView::TYPE_SUCCESS,
    
        
    ],
         
    'attributes'=>[
        
           [
                'attribute'=> 'valor',
                'label' => 'Valor Actual',
              //  'value'=>$dataanterior->valor,
                ],
        [
                'attribute'=> 'observaciones',
                'label' => 'Observaciones',
            'format'=>'raw',
              //  'value'=>$dataanterior->valor,
                ],
         
        [
                'attribute'=> 'userid',
                'label' => 'Usuario que Informó',
                'value'=>$dataactual->user->username
                ],
         
        [
                'attribute'=> 'indicadores_gestionid',
                'label' => 'Indicador',
               'value'=>$dataactual->indicadoresGestion->descripcion
                ],
            [
                'attribute'=> 'fecha',
                'label' => 'Fecha en que se informó',
                ],
        
            ],
          
    'enableEditMode'=>FALSE,
]);  
    
  } 
   
     
  if($tarea == 1 && $evaluacion == 1)//evaluacion
  {
    echo  DetailView::widget([
    'model'=>$dataanterior,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Datos Anteriores: ID - '.$dataanterior->id,
        'type'=>DetailView::TYPE_DANGER,
    
        
    ],
         
    'attributes'=>[
        [  'attribute'=> 'periodo',
                'value'=>$dataactual->periodo0->periodo,
                ],
        
           
        
        
        [
                'attribute'=> 'valor_vreal',
                'label' => 'Valor Actual',
              //  'value'=>$dataanterior->valor,
                ],
        [
                'attribute'=> 'observaciones',
                'label' => 'Observaciones',
            'format'=>'raw',
              //  'value'=>$dataanterior->valor,
                ],
         
        [
                'attribute'=> 'userid',
                'label' => 'Usuario que Informó',
                'value'=>$dataanterior->user->username
                ],
         
        [
                'attribute'=> 'criteriomedidaid',
                'label' => 'Criterio de Medida',
               'value'=>$dataanterior->criteriomedida->Descripcion
                ],
            [
                'attribute'=> 'anexo',
                'label' => 'Anexo',
                'value'=> $dataanterior->anexo ==1 ? '<i class="glyphicon glyphicon-ok" style="color:green"></i>' :'<i class="glyphicon glyphicon-remove" style="color:red"></i>',
            'format'=>'raw',
                ],
        
            ],
          
    'enableEditMode'=>FALSE,
]);  
    
  }    
  if($evaluacion == 1 && $tarea !=3)//evaluacion
  {
    echo  DetailView::widget([
    'model'=>$dataactual,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Datos Actuales: ID - '.$dataactual->id,
        'type'=>DetailView::TYPE_SUCCESS,
    
        
    ],
         
    'attributes'=>[
        [  'attribute'=> 'periodo',
                'value'=>$dataactual->periodo0->periodo,
                ],
        
           
        
        
        [
                'attribute'=> 'valor_vreal',
                'label' => 'Valor Actual',
              //  'value'=>$dataanterior->valor,
                ],
        [
                'attribute'=> 'observaciones',
                'label' => 'Observaciones',
            'format'=>'raw',
              //  'value'=>$dataanterior->valor,
                ],
         
        [
                'attribute'=> 'userid',
                'label' => 'Usuario que Informó',
                'value'=>$dataactual->user->username
                ],
         
        [
                'attribute'=> 'criteriomedidaid',
                'label' => 'Criterio de Medida',
               'value'=>$dataactual->criteriomedida->Descripcion
                ],
            [
                'attribute'=> 'anexo',
                'label' => 'Anexo',
                'value'=> $dataactual->anexo ==1 ? '<i class="glyphicon glyphicon-ok" style="color:green"></i>' :'<i class="glyphicon glyphicon-remove" style="color:red"></i>',
            'format'=>'raw',
                ],
        
            ],
          
    'enableEditMode'=>FALSE,
]);  
    
  }
  if($evaluacion == 1&& $tarea ==3)//evaluacion
  {
    echo  DetailView::widget([
    'model'=>$dataanterior,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Datos Eliminados: ID - '.$dataanterior->id,
        'type'=>DetailView::TYPE_DANGER,
    
        
    ],
         
    'attributes'=>[
        [  'attribute'=> 'periodo',
                'value'=>$dataanterior->periodo0->periodo,
                ],
        
           
        
        
        [
                'attribute'=> 'valor_vreal',
                'label' => 'Valor Actual',
              //  'value'=>$dataanterior->valor,
                ],
        [
                'attribute'=> 'observaciones',
                'label' => 'Observaciones',
            'format'=>'raw',
              //  'value'=>$dataanterior->valor,
                ],
         
        [
                'attribute'=> 'userid',
                'label' => 'Usuario que Informó',
                'value'=>$dataanterior->user->username
                ],
         
        [
                'attribute'=> 'criteriomedidaid',
                'label' => 'Criterio de Medida',
               'value'=>$dataanterior->criteriomedida->Descripcion
                ],
            [
                'attribute'=> 'anexo',
                'label' => 'Anexo',
                'value'=> $dataanterior->anexo ==1 ? '<i class="glyphicon glyphicon-ok" style="color:green"></i>' :'<i class="glyphicon glyphicon-remove" style="color:red"></i>',
            'format'=>'raw',
                ],
        
            ],
          
    'enableEditMode'=>FALSE,
]);  
    
  }
  
  if($evaluacion == 2 && $tarea ==3)//evaluacion eliminada
  {
    echo DetailView::widget([
    'model'=>$dataanterior/*,$modelTope*/,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Datos Eliminados : Criterio de Medida '.frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($dataanterior->id),
        'type'=>DetailView::TYPE_DANGER,
    ],
    'attributes'=>[
         'Descripcion',
            'UM',
        [
                'attribute'=> 'Objetivoid',
                'label' => 'Objetivo',
                'value'=>$dataanterior->objetivo->nombre,
                ],
            [
                'attribute'=> 'direccionid',
                'label' => 'Dirección que lo tributa',
                'value'=>$dataanterior->direccion->nombre,
                ],
         
                
         [
                'attribute'=> 'tope[Itrimestre]',
                'label' => 'I trimestre',
                'value'=>$dataanterior->tope->Itrimestre,
                
                ],
         [
                'attribute'=> 'tope[IItrimestre]',
                'label' => 'II trimestre',
                'value'=>$dataanterior->tope->IItrimestre,
               
                ],
         [
                'attribute'=> 'tope[IIItrimestre]',
                'label' => 'III trimestre',
                'value'=>$dataanterior->tope->IIItrimestre,
             
                ],
             
           [  'attribute'=> 'tope[IVtrimestre]',
                'label' => 'VI trimestre',
                'value'=>$dataanterior->tope->IVtrimestre,
                
                ],
         
            ],
     'enableEditMode'=>FALSE,
    
]);  
    
  }
  if($evaluacion == 2 && $tarea ==2)//evaluacion creada
  {
    echo DetailView::widget([
    'model'=>$dataactual/*,$modelTope*/,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Datos Actuales : Criterio de Medida '.frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($dataactual->id),
        'type'=>DetailView::TYPE_SUCCESS,
    ],
    'attributes'=>[
         'Descripcion',
            'UM',
        [
                'attribute'=> 'Objetivoid',
                'label' => 'Objetivo',
                'value'=>$dataactual->objetivo->nombre,
                ],
            [
                'attribute'=> 'direccionid',
                'label' => 'Dirección que lo tributa',
                'value'=>$dataactual->direccion->nombre,
                ],
         
                
         [
                'attribute'=> 'tope[Itrimestre]',
                'label' => 'I trimestre',
                'value'=>$dataactual->tope->Itrimestre,
                
                ],
         [
                'attribute'=> 'tope[IItrimestre]',
                'label' => 'II trimestre',
                'value'=>$dataactual->tope->IItrimestre,
               
                ],
         [
                'attribute'=> 'tope[IIItrimestre]',
                'label' => 'III trimestre',
                'value'=>$dataactual->tope->IIItrimestre,
             
                ],
             
           [  'attribute'=> 'tope[IVtrimestre]',
                'label' => 'VI trimestre',
                'value'=>$dataactual->tope->IVtrimestre,
                
                ],
         
            ],
     'enableEditMode'=>FALSE,
    
]);  
  }
   if($evaluacion == 3  && $tarea ==3)//Indicador eliminada
  {
    echo DetailView::widget([
    'model'=>$dataanterior,
    'condensed'=>true,
    'hover'=>true,
    'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Ind. '.frontend\controllers\IndicadoresgestionController:: buscarOrdenGeneral($dataanterior->id),
        'type'=>DetailView::TYPE_DANGER,
    ],
    'attributes'=>[
       // 'id',
            [
             'attribute' =>  'orden',
              'label' => 'No.Orden ',
                
               
            ], 
           
            [
             'attribute' =>  'descripcion',
              'label' => 'Descripción ',
            ], 
            [
             'attribute' =>  'UM',
              'label' => 'Unidad de Medida ',
            ],
          [
             'attribute' =>  'tope[valor]',
              'label' => 'Valor de Cumplimiento',
             'value'=> $dataanterior->tope->valor,
                      
            ],
        [    
        'attribute' =>  'tope[idsentido]',
              'label' => 'Sentido de Comparaciósn',
             'value'=> $dataanterior->tope->sentido->sentido,
             
        
          ],  [
             'attribute' =>  'fecha_chequeo',
              'label' => 'Fecha de Chequeo',
               ],
        
            [
             'attribute' =>  'direccionid',
              'label' => 'Responsable ',
              'value'=> $dataanterior->direccion->nombre,
            ],
          [
                'attribute'=> 'objetivoid',
                'label' => 'Objetivo',
                'value'=>$dataanterior->objetivo->nombre,
                ],
            
        ],
       
     'enableEditMode'=>FALSE,
    
]);  
    
  }
  if($evaluacion == 3 && $tarea ==2)//indicador creado
  {
      
       echo DetailView::widget([
    'model'=>$dataactual,
    'condensed'=>true,
    'hover'=>true,
    'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Datos Actuales : Ind. '.frontend\controllers\IndicadoresgestionController:: buscarOrdenGeneral($dataactual->id),
        'type'=>DetailView::TYPE_SUCCESS,
    ],
    'attributes'=>[
       // 'id',
            [
             'attribute' =>  'orden',
              'label' => 'No.Orden ',
                
               
            ], 
           
            [
             'attribute' =>  'descripcion',
              'label' => 'Descripción ',
            ], 
            [
             'attribute' =>  'UM',
              'label' => 'Unidad de Medida ',
            ],
          [
             'attribute' =>  'tope[valor]',
              'label' => 'Valor de Cumplimiento',
             'value'=> $dataactual->tope->valor,
                      
            ],
        [    
        'attribute' =>  'tope[idsentido]',
              'label' => 'Sentido de Comparaciósn',
             'value'=> $dataactual->tope->sentido->sentido,
             
        
          ],  [
             'attribute' =>  'fecha_chequeo',
              'label' => 'Fecha de Chequeo',
               ],
        
            [
             'attribute' =>  'direccionid',
              'label' => 'Responsable ',
              'value'=> $dataactual->direccion->nombre,
            ],
          [
                'attribute'=> 'objetivoid',
                'label' => 'Objetivo',
                'value'=>$dataactual->objetivo->nombre,
                ],
            
        ],
         'enableEditMode'=>FALSE,
    
]);  
  }
  if($tarea == 3 && $evaluacion == 4)//cumplimiento eliminado
      {
        echo  DetailView::widget([
    'model'=>$dataanterior,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Datos Anteriores : ID - '.$dataanterior->id,
        'type'=>DetailView::TYPE_DANGER,
    
        
    ],
         
    'attributes'=>[
        
           [
                'attribute'=> 'valor',
                'label' => 'Valor ',
              //  'value'=>$dataanterior->valor,
                ],
         [
                'attribute'=> 'observaciones',
                'label' => 'Observaciones',
             'format'=>'raw',
              //  'value'=>$dataanterior->valor,
                ],
         
        [
                'attribute'=> 'userid',
                'label' => 'Usuario que Informó',
                'value'=>$dataanterior->user->username
                ],
         
        [
                'attribute'=> 'indicadores_gestionid',
                'label' => 'Indicador',
               'value'=>$dataanterior->indicadoresGestion->descripcion
                ],
            [
                'attribute'=> 'fecha',
                'label' => 'Fecha en que se informó',
                ],
        
            ],
          
    'enableEditMode'=>FALSE,
]);  
      }
 
  if($tarea == 2 && $evaluacion == 4)//cumplimiento creado
      {
        echo  DetailView::widget([
    'model'=>$dataactual,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Datos Actuales : ID - '.$dataactual->id,
        'type'=>DetailView::TYPE_SUCCESS,
    
        
    ],
         
    'attributes'=>[
        
           [
                'attribute'=> 'valor',
                'label' => 'Valor ',
              //  'value'=>$dataanterior->valor,
                ],
         [
                'attribute'=> 'observaciones',
                'label' => 'Observaciones',
             'format'=>'raw',
              //  'value'=>$dataanterior->valor,
                ],
         
        [
                'attribute'=> 'userid',
                'label' => 'Usuario que Informó',
                'value'=>$dataactual->user->username
                ],
         
        [
                'attribute'=> 'indicadores_gestionid',
                'label' => 'Indicador',
               'value'=>$dataactual->indicadoresGestion->descripcion
                ],
            [
                'attribute'=> 'fecha',
                'label' => 'Fecha en que se informó',
                ],
        
            ],
          
    'enableEditMode'=>FALSE,
]);  
      }
 if($tarea == 1 && $evaluacion == 4)//cumplimiento creado
      {
        echo  DetailView::widget([
    'model'=>$dataanterior,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Datos Anteriores : ID - '.$dataanterior->id,
        'type'=>DetailView::TYPE_DANGER,
    
        
    ],
         
    'attributes'=>[
        
           [
                'attribute'=> 'valor',
                'label' => 'Valor ',
              //  'value'=>$dataanterior->valor,
                ],
         [
                'attribute'=> 'observaciones',
                'label' => 'Observaciones',
             'format'=>'raw',
              //  'value'=>$dataanterior->valor,
                ],
         
        [
                'attribute'=> 'userid',
                'label' => 'Usuario que Informó',
                'value'=>$dataanterior->user->username
                ],
         
        [
                'attribute'=> 'indicadores_gestionid',
                'label' => 'Indicador',
               'value'=>$dataanterior->indicadoresGestion->descripcion
                ],
            [
                'attribute'=> 'fecha',
                'label' => 'Fecha en que se informó',
                ],
        
            ],
          
    'enableEditMode'=>FALSE,
]);  
        
        echo  DetailView::widget([
    'model'=>$dataactual,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Datos Actuales : ID - '.$dataactual->id,
        'type'=>DetailView::TYPE_SUCCESS,
    
        
    ],
         
    'attributes'=>[
        
           [
                'attribute'=> 'valor',
                'label' => 'Valor ',
              //  'value'=>$dataanterior->valor,
                ],
         [
                'attribute'=> 'observaciones',
                'label' => 'Observaciones',
             'format'=>'raw',
              //  'value'=>$dataanterior->valor,
                ],
         
        [
                'attribute'=> 'userid',
                'label' => 'Usuario que Informó',
                'value'=>$dataactual->user->username
                ],
         
        [
                'attribute'=> 'indicadores_gestionid',
                'label' => 'Indicador',
               'value'=>$dataactual->indicadoresGestion->descripcion
                ],
            [
                'attribute'=> 'fecha',
                'label' => 'Fecha en que se informó',
                ],
        
            ],
          
    'enableEditMode'=>FALSE,
]);
      }
   if($evaluacion == 5 && $tarea ==3)//evaluacion eliminada
  {
    echo DetailView::widget([
    'model'=>$dataanterior/*,$modelTope*/,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Datos Eliminados : Objetivo - ID: '.$dataanterior->id,
        'type'=>DetailView::TYPE_DANGER,
    ],
    'attributes'=>[
       // 'id',
            [
             'attribute' =>  'nombre',
              'label' => 'Nombre ',
            ], 
            [
             'attribute' =>  'abreviatura',
              'label' => 'Abreviatura ',
            ],
            [
             'attribute' =>  'descripcion',
              'label' => 'Descripcion ',
            ],
            [
             'attribute' =>  'fechaAct',
              'label' => 'Fecha de puesta en vigor ',
              'type'=> DetailView::INPUT_DATE,
            
            ],
            [
             'attribute' =>  'responsable',
              'label' => 'Responsable ',
              'value'=> $dataanterior->responsable0->nombre,
             
            ],
           [
             'attribute' =>  'fechaDesac',
              'label' => 'Fecha de Desactivación',
            ],
          
        ],
     'enableEditMode'=>FALSE,
    
]);  
    
  }
  ?>

</div>
