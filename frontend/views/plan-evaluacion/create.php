<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PlanEvaluacion */

$this->title = Yii::t('app', 'Crear plan de Evaluación');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Plan de Evaluación'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="plan-evaluacion-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
