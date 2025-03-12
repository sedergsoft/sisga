<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\ehlpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\CuadroEntidad */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadro Entidads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cuadro-entidad-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cuadro_id',
            'entidad_id',
        ],
                  'enableEditMode'=>FALSE,
         'deleteOptions'=>[ // your ajax delete parameters
        'params' => ['id' => $model->id, 'custom_param' => true],
           'url' => ['delete', 'id' => $model->id],
    ]
    ]) ?>

</div>
