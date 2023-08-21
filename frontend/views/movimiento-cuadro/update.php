<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\MovimientoCuadro */

$this->title = Yii::t('app', 'Actualizar Movimiento de Cuadro: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Actualizar Movimiento de Cuadro'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

$this->params['tittle'][] = $this->title;
?>
<div class="movimiento-cuadro-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelCuadro' => $modelCuadro,
       
    ]) ?>

</div>
