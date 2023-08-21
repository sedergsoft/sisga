<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Criteriomedida */

$this->title = Yii::t('app', 'Update Criteriomedida: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Criteriomedidas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['tittle'][]= $this->title;
?>
<div class="criteriomedida-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
