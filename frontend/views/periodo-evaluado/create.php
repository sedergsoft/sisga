<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PeriodoEvaluado */

$this->title = Yii::t('app', 'Create Periodo Evaluado');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Periodo Evaluados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="periodo-evaluado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
