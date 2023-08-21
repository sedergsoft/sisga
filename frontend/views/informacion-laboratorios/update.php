<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\InformacionLaboratorios */

$this->title = Yii::t('app', 'Update Informacion Laboratorios: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Informacion Laboratorios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['tittle'][]= $this->title;
?>
<div class="informacion-laboratorios-update">

 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
