<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CargosDireccion */

$this->title = Yii::t('app', 'Actualizar Cargo de Dirección: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cargos Dirección'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['tittle'][] = Yii::t('app', 'Update');
?>
<div class="cargos-direccion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
