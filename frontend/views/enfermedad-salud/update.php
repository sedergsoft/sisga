<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EnfermedadSalud */

$this->title = Yii::t('app', 'Update Enfermedad Salud: {name}', [
    'name' => $model->enfermedadid,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Enfermedad Saluds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->enfermedadid, 'url' => ['view', 'enfermedadid' => $model->enfermedadid, 'saludid' => $model->saludid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="enfermedad-salud-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
