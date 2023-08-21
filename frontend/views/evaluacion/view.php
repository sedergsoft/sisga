<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Evaluacion */

$this->title = 'Criterio '.frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($model->criteriomedidaid);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Certificar Criterio de Medida'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="evaluacion-view">

   
  

   
    
     <?php 
     
      //return print_r($model);
   if(Yii::$app->user->identity->rolid == "2")
   {
     
     echo  DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
        'buttons1'=>'{delete}',
    'panel'=>[
        'heading'=> 'Evaluacion del criterio de medida '.frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($model->criteriomedidaid),
        'type'=>DetailView::TYPE_INFO,
        'footer'=>'El estado de cumplimiento de este indicador es : '.frontend\controllers\EvaluacionController::evaluarCumplimiento($model->id),
      'footerOptions'=> [
           'class'=>'panel-footer',
        
           
            ],
        
    ],
         
    'attributes'=>[
        
           [
                'attribute'=> 'criteriomedida[descripcion]',
                'label' => 'Criterio de medida',
                'value'=>$model->criteriomedida->Descripcion,
                ],
         
        [
                'attribute'=> 'criteriomedida[UM]',
                'label' => 'Unidad de medida',
                'value'=>$model->criteriomedida->UM,
                ],
         
        [
                'attribute'=> 'criteriomedida[Objetivoid]',
                'label' => 'Objetivo al que tributa',
                'value'=>$model->criteriomedida->objetivo->nombre,
       
                ],
            [
                'attribute'=> 'direccionid',
                'label' => 'Dirección que lo tributa',
                'value'=>$model->direccion->nombre,
              
                ],
        
         [
                    'attribute'=> 'periodo',
                    'label' => 'Periodo al que pertenece la información',
                    'value' => $model->periodo0->periodo,
     
                ],
         
                
          [
                'attribute'=> 'criteriomedida[topeid]',
                'label' => 'Valor planificado para este periodo',
               'value'=>$model->criteriomedida->tope->IVtrimestre,
//                'value'=> function ($model)
//                        {
//                    return $model->criteriomedida->tope->IIItrimestre;
//                        }
                ], 
        
       
        
        [
                'attribute'=> 'valor_vreal',
                'label' => 'Valor actual',
               // 'value'=>$model->tope->Itrimestre,
                
                ],
         [
                'attribute'=> 'observaciones',
                'label' => 'Observaciones',
                          'format'=>'raw',
               // 'value'=>$model->tope->Itrimestre,
                
                ],
        /* [
                'attribute'=> 'periodo',
                'label' => 'Periodo al que pertenece la información',
               // 'value'=> 
             
               
                ],*/
         [
                'attribute'=> 'fechacreado',
                'label' => 'Fecha de Creación',
               // 'value'=>$model->tope->IIItrimestre,
             
                ],
             
           [  'attribute'=> 'userid',
                'label' => 'Usuario que agrego la informacion',
                'value'=>$model->user->username,
                
                ],
        [  'attribute'=> 'estado',
                'label' => 'Estado de la información',
                'value'=>$model->estado0->estado,
                
                ],
        [
            'attribute'=> 'anexo',
            'label'=> 'Anexos',
             'format'=>'raw',
            'value'=>  $model->anexo==1 ? '<a class="btn btn-info" href="'.Url::toRoute(['veranexos','id' =>$model->id]).'"><i class="glyphicon glyphicon-eye-open"></i> Ver Anexo</a>' :'<span class="badge badge-success">No Contiene Anexos</span>' ,/*$model->anexo,/* function ($model)
                    {
                        
                    $anexo = $model['anexo'];
                    if($anexo ==1)
                        {
                            return Html::button('<i class="glyphicon glyphicon-plus"></i> Ver Anexos ', ['value'=>Url::to('index.php?r=evaluacion/veranexo'),'class' => 'btn btn-info']);
                        }
                                    
                        }*/
            
        ],

         
            ],
            
         'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ],
    'enableEditMode'=>true,
]);  
   }else{
         echo  DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        
        'heading'=> 'Evaluacion del criterio de medida '.frontend\controllers\CriteriomedidaController::buscarOrdenGeneral($model->criteriomedidaid),
        'type'=>DetailView::TYPE_INFO,
        'footer'=>'El estado de cumplimiento de este indicador es : '.frontend\controllers\EvaluacionController::evaluarCumplimiento($model->id),
      'footerOptions'=> [
           'class'=>'panel-footer',
        
           
            ],
        
    ],
         
    'attributes'=>[
        
           [
                'attribute'=> 'criteriomedida[descripcion]',
                'label' => 'Criterio de medida',
                'value'=>$model->criteriomedida->Descripcion,
                ],
         
        [
                'attribute'=> 'criteriomedida[UM]',
                'label' => 'Unidad de medida',
                'value'=>$model->criteriomedida->UM,
                ],
         
        [
                'attribute'=> 'criteriomedida[Objetivoid]',
                'label' => 'Objetivo al que tributa',
                'value'=>$model->criteriomedida->objetivo->nombre,
       
                ],
            [
                'attribute'=> 'direccionid',
                'label' => 'Dirección que lo tributa',
                'value'=>$model->direccion->nombre,
              
                ],
        
         [
                    'attribute'=> 'periodo',
                    'label' => 'Periodo al que pertenece la información',
                    'value' => $model->periodo0->periodo,
     
                ],
         
                
          [
                'attribute'=> 'criteriomedida[topeid]',
                'label' => 'Valor planificado para este periodo',
              'value'=>$model->criteriomedida->tope->IVtrimestre,
//                'value'=> function ($data)
//                        {
//                    return $model->criteriomedida->tope->IIItrimestre;
//                        }
                ], 
        
       
        
        [
                'attribute'=> 'valor_vreal',
                'label' => 'Valor actual',
               // 'value'=>$model->tope->Itrimestre,
                
                ],
         [
                'attribute'=> 'observaciones',
                'label' => 'Observaciones',
                          'format'=>'raw',
               // 'value'=>$model->tope->Itrimestre,
                
                ],
        /* [
                'attribute'=> 'periodo',
                'label' => 'Periodo al que pertenece la información',
               // 'value'=> 
             
               
                ],*/
         [
                'attribute'=> 'fechacreado',
                'label' => 'Fecha de Creación',
               // 'value'=>$model->tope->IIItrimestre,
             
                ],
             
           [  'attribute'=> 'userid',
                'label' => 'Usuario que agrego la informacion',
                'value'=>$model->user->username,
                
                ],
        [  'attribute'=> 'estado',
                'label' => 'Estado de la información',
                'value'=>$model->estado0->estado,
                
                ],
        [
            'attribute'=> 'anexo',
            'label'=> 'Anexos',
             'format'=>'raw',
            'value'=>  $model->anexo==1 ? '<a class="btn btn-info" href="'.Url::toRoute(['veranexos','id' =>$model->id]).'"><i class="glyphicon glyphicon-eye-open"></i> Ver Anexo</a>' :'<span class="badge badge-success">No Contiene Anexos</span>' ,/*$model->anexo,/* function ($model)
                    {
                        
                    $anexo = $model['anexo'];
                    if($anexo ==1)
                        {
                            return Html::button('<i class="glyphicon glyphicon-plus"></i> Ver Anexos ', ['value'=>Url::to('index.php?r=evaluacion/veranexo'),'class' => 'btn btn-info']);
                        }
                                    
                        }*/
            
        ],

         
            ],
            
         'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ],
    'enableEditMode'=>FALSE,
]); 
       
   }
  
     
     ?>
    
       
    <?php
    echo Html::a('<i class="glyphicon glyphicon-hand-left"></i> Regresar', ['indexall'], ['class' => 'btn btn-success']) 
    ?>


</div>
