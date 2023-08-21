<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Producto */

$this->title = $model->producto;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="producto-view">

   
<?php
     echo DetailView::widget([
    'model'=>$model/*,$modelTope*/,
    'condensed'=>true,
    'hover'=>true,
        'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> $model->producto,
        'type'=>DetailView::TYPE_INFO,
    ],
    'attributes'=>[
        
        
            'id',
            'producto',
            'UM',
        ],
       'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
    
     ]); ?>

</div>
