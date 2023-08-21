<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\CargosDireccion */

$this->title = $model->tipo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cargos Direccions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cargos-direccion-view">


    <p>
       
    </p>

 <?= DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Cargo de Dirección:'.$model->id,
        'type'=>DetailView::TYPE_INFO,
    ],        'attributes' => [
           // 'id',
            'tipo',
        ],
      'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
    ]) ?>

</div>
