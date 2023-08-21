<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoIngresos */

$this->title = $model->tipo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Ingresos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tipo-ingresos-view">


    <?= DetailView::widget([
        'model' => $model,
         'condensed'=>true,
    'hover'=>true,
    'mode'=>DetailView::MODE_VIEW,
     //  'hideIfEmpty'=>TRUE,
    'panel'=>[
        'heading'=>'DATOS DEL CUADRO',
        'type'=>DetailView::TYPE_INFO,
    ],
        'attributes' => [
        //    'id',
            'tipo',
        ],
             
       'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
        
    ]) ?>

</div>
