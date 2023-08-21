<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CuadroFamiliar */

$this->title = Yii::t('app', 'Update Cuadro Familiar: {name}', [
    'name' => $model->cuadroid,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadro Familiars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cuadroid, 'url' => ['view', 'cuadroid' => $model->cuadroid, 'familiarid' => $model->familiarid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cuadro-familiar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
