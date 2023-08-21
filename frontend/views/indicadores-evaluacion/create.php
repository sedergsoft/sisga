<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\IndicadoresEvaluacion */

$this->title = Yii::t('app', 'Agregar Indicadores de Evaluación');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Indicadores Evaluacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="indicadores-evaluacion-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
