<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EstadoCumplimiento */

$this->title = Yii::t('app', 'Update Estado Cumplimiento: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Estado Cumplimientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="estado-cumplimiento-update">

 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
