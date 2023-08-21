<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\IndicadoresEvaluacion */

$this->title = Yii::t('app', 'Actualizar Indicadores Evaluacion: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Indicadores Evaluacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
$this->params['tittle'][] = $this->title;
?>
<div class="indicadores-evaluacion-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
