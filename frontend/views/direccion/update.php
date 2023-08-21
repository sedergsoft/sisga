<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Direccion */

$this->title = Yii::t('app', 'Update Direccion: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Direccions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="direccion-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
