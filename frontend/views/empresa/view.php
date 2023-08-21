<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Empresa */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Empresas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="empresa-view">


   
<?php
     echo DetailView::widget([
    'model'=>$model/*,$modelTope*/,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> $model->nombre,
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
        
        [
                'attribute'=> 'nombre',
                'label' => 'Nombre de la empresa',
                'value'=>$model->nombre,
               
               ],
           
         
            ],
            
         'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
    
     ]); ?>
    
   

</div>
