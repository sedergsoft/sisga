<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Organismo */

$this->title = $model->organismo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organismos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="organismo-view">

    <p>
       
    </p>

  <?= DetailView::widget([
    'model'=>$model,
    'condensed'=>true,
    'hover'=>true,
    'hideIfEmpty'=>TRUE,
    'mode'=>DetailView::MODE_VIEW,
    'panel'=>[
        'heading'=> 'Organismo:'.$model->idorganismo,
        'type'=>DetailView::TYPE_INFO,
    ],
        'model' => $model,
        'attributes' => [
            //'idorganismo',
            'organismo',
        ],
         'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->idorganismo, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->idorganismo],
    ]
    ]) ?>

</div>
