<?php

use yii\helpers\Html;
use kartik\detail\DetailView;


/* @var $this yii\web\View */
/* @var $model frontend\models\Entidad */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Entidades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="entidad-view">

    
  

   <?php 
   
   
    if(Yii::$app->user->identity->rolid == "2")
     {
       
   
   echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> $model->nombre,
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
        'nombre',
        'responsable'],
            
        
       'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
    
     ]);}
     else{
         
   echo DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> $model->nombre,
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
        'nombre',
        'responsable'],
            
         'enableEditMode'=>FALSE,      
       'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
    
]);
     }
    ?>    
   
    <?php
    echo Html::a('<i class="glyphicon glyphicon-hand-left"></i> Regresar', ['index'], ['class' => 'btn btn-success']) 
    ?>

</div>
