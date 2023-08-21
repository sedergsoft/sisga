<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EvaluacionCuadroIndicadoresEvaluacion */

$this->title = Yii::t('app', 'Create Evaluacion Cuadro Indicadores Evaluacion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evaluacion Cuadro Indicadores Evaluacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluacion-cuadro-indicadores-evaluacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
