<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Vehiculo */


$this->title = Yii::t('app', 'Editar vehiculo de : {name}', [
    'name' => ucwords($model->cuadro->personaCI0->Nombre).' '.ucwords($model->cuadro->personaCI0->primer_apellido).' '.ucwords($model->cuadro->personaCI0->segundo_apellido),]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadros'), 'url' => ['cuadro/index']];
$this->params['breadcrumbs'][] = ['label' => 'NI :'.($model->cuadro->personaCI0->CI), 'url' => ['cuadro/view', 'id' => $model->cuadro->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar vehículo');
$this->params['tittle'][] = $this->title;
?>
<div class="vehiculo-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
