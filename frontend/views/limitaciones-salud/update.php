<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\LimitacionesSalud */

$this->title = Yii::t('app', 'Update Limitaciones Salud: {name}', [
    'name' => $model->limitacionesid,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Limitaciones Saluds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->limitacionesid, 'url' => ['view', 'limitacionesid' => $model->limitacionesid, 'saludid' => $model->saludid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="limitaciones-salud-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
