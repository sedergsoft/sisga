<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Indicadoresgestion */

$this->title = Yii::t('app', 'Update Indicadoresgestion: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Indicadoresgestions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['tittle'][]= $this->title;
?>
<div class="indicadoresgestion-update">


    <?= $this->render('_form', [
        'model' => $model,
        'criteriomedida'=>$criteriomedida,
    ]) ?>

</div>
