<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Sanciones */

$this->title = Yii::t('app', 'Editar Sanciones de : {name}', [
    'name' => ucwords($model->cuadroSanciones[0]->cuadro->personaCI0->Nombre).' '.ucwords($model->cuadroSanciones[0]->cuadro->personaCI0->primer_apellido).' '.ucwords($model->cuadroSanciones[0]->cuadro->personaCI0->segundo_apellido),]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadros'), 'url' => ['cuadro/index']];
$this->params['breadcrumbs'][] = ['label' => 'NI :'.($model->cuadroSanciones[0]->cuadro->personaCI0->CI), 'url' => ['cuadro/view', 'id' => $model->cuadroSanciones[0]->cuadro->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar sanciones');
$this->params['tittle'][] = $this->title;
?>
<div class="sanciones-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
