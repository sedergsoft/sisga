<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CumplimientoAnexo */

$this->title = Yii::t('app', 'Update Cumplimiento Anexo: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cumplimiento Anexos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cumplimiento-anexo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
