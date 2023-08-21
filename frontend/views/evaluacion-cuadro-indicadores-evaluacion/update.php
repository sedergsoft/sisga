<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EvaluacionCuadroIndicadoresEvaluacion */

$this->title = Yii::t('app', 'Update Evaluacion Cuadro Indicadores Evaluacion: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evaluacion Cuadro Indicadores Evaluacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="evaluacion-cuadro-indicadores-evaluacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
