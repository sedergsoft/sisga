<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Cumplimiento */

$this->title = 'Ind. '.frontend\controllers\IndicadoresgestionController:: buscarOrdenGeneral($model->indicadoresGestion->id);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cumplimientos'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->params['tittle'][]= $this->title;
?>


<div class="cumplimiento-view">

  <?php
 if(Yii::$app->user->identity->rolid == "2")
   {
     
      echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
        
    'mode'=>DetailView::MODE_VIEW,
         'buttons1'=>'{delete}',
         
     'panel'=>[
         
        'heading'=> 'Ind. '.frontend\controllers\IndicadoresgestionController:: buscarOrdenGeneral($model->indicadoresGestion->id),
        'type'=>DetailView::TYPE_INFO,  
        'footer'=>'El estado de cumplimiento de este indicador es : '.frontend\controllers\CumplimientoController::evaluarCumplimiento($model->id),
      'footerOptions'=> [
           'class'=>'panel-footer',
        
           
            ],
         
         
        
    ],
    'attributes'=>[
         
             
                [
                    'attibute'=>'indicadoresGestion',
                    'label' => 'Descripcion',
                    'value'=>$model->indicadoresGestion->descripcion,
                ],
                [
                    'attibute'=>'indicadoresGestion',
                    'label' => 'Tope',
                    'value'=>$model->indicadoresGestion->tope->sentido->sentido.$model->indicadoresGestion->tope->valor,
                ],
         
                [
                    'attribute'=> 'valor',
                    'label' => 'Valor Actual',
                ],
                [
                    'format'=>'raw',
                    'attribute'=> 'observaciones',
                    'label' => 'Observaciones',
                ],
                [
                    'attribute'=> 'userid',
                    'label' => 'Informado por',
                    'value'=>$model->user->username,
                    
                ],
         [
                    'attribute'=> 'user[direccionid]',
                    'label' => 'Informado por la dirección',
                    'value'=>$model->user->direccion->nombre,
                    
                ],
        
                [
                    'attribute'=> 'fecha',
                    'label' => 'Fecha de actualización',
                    'value'=>$model->fecha,
                    
                ],
              [
                'attribute'=> 'estadoCumplimiento',
                'label' => 'Estado del criterio',
                'value'=>$model->estadoCumplimiento->estado,
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
     echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
        
    'mode'=>DetailView::MODE_VIEW,
         
     'panel'=>[
         
        'heading'=> 'Ind. '.frontend\controllers\IndicadoresgestionController:: buscarOrdenGeneral($model->indicadoresGestion->id),
        'type'=>DetailView::TYPE_INFO,  
        'footer'=>'El estado de cumplimiento de este indicador es : '.frontend\controllers\CumplimientoController::evaluarCumplimiento($model->id),
      'footerOptions'=> [
           'class'=>'panel-footer',
        
           
            ],
         
         
        
    ],
    'attributes'=>[
         
             
                [
                    'attibute'=>'indicadoresGestion',
                    'label' => 'Descripcion',
                    'value'=>$model->indicadoresGestion->descripcion,
                ],
                [
                    'attibute'=>'indicadoresGestion',
                    'label' => 'Tope',
                    'value'=>$model->indicadoresGestion->tope->sentido->sentido.$model->indicadoresGestion->tope->valor,
                ],
         
                [
                    'attribute'=> 'valor',
                    'label' => 'Valor Actual',
                ],
                [
                    'format'=>'raw',
                    'attribute'=> 'observaciones',
                    'label' => 'Observaciones',
                ],
                [
                    'attribute'=> 'userid',
                    'label' => 'Informado por',
                    'value'=>$model->user->username,
                    
                ],
         [
                    'attribute'=> 'user[direccionid]',
                    'label' => 'Informado por la dirección',
                    'value'=>$model->user->direccion->nombre,
                    
                ],
        
                [
                    'attribute'=> 'fecha',
                    'label' => 'Fecha de actualización',
                    'value'=>$model->fecha,
                    
                ],
              [
                'attribute'=> 'estadoCumplimiento',
                'label' => 'Estado del criterio',
                'value'=>$model->estadoCumplimiento->estado,
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
             'enableEditMode'=>FALSE,
       
    
]); 
    }  
?>
<?php
    echo Html::a('<i class="glyphicon glyphicon-hand-left"></i> Regresar', ['indexall'], ['class' => 'btn btn-success']) 
    ?>
</div>
