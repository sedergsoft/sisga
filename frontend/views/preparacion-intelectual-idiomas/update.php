<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\PreparacionIntelectualIdiomas */

$this->title = Yii::t('app', 'Update Preparacion Intelectual Idiomas: {name}', [
    'name' => $model->preparacion_intelectualid,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Preparacion Intelectual Idiomas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->preparacion_intelectualid, 'url' => ['view', 'preparacion_intelectualid' => $model->preparacion_intelectualid, 'idiomasid' => $model->idiomasid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="preparacion-intelectual-idiomas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
