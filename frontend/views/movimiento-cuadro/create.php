<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model frontend\models\MovimientoCuadro */

$this->title = Yii::t('app', 'Crear Movimiento de Cuadro: {name}', [
    'name' => ucwords($modelCuadro->personaCI0->Nombre).' '.ucwords($modelCuadro->personaCI0->primer_apellido).' '.ucwords($modelCuadro->personaCI0->segundo_apellido),]);
//$this->title
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Movimiento de Cuadros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="movimiento-cuadro-create">



    <?= $this->render('_form', [
        'model' => $model,
         'modelCuadro' => $modelCuadro,
    ]) ?>

</div>
