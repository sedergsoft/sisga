<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\BeneficioIngresos */

$this->title = Yii::t('app', 'Update Beneficio Ingresos: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Beneficio Ingresos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="beneficio-ingresos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
