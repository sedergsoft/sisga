<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Objetivo */

$this->title = Yii::t('app', 'Update Objetivo: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objetivos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['tittle'][]= $this->title;
?>
<div class="objetivo-update">

 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
