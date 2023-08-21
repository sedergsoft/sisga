<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Condecoraciones */

$this->title = Yii::t('app', 'Agregar reconocimientos de : {name}', [
    'name' => ucwords($cuadro->personaCI0->Nombre).' '.ucwords($cuadro->personaCI0->primer_apellido).' '.ucwords($cuadro->personaCI0->segundo_apellido),]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadros'), 'url' => ['cuadro/index']];
$this->params['breadcrumbs'][] = ['label' => 'NI :'.($cuadro->personaCI0->CI), 'url' => ['cuadro/view', 'id' => $cuadro->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Agrear reconocimientos');
$this->params['tittle'][] = $this->title;
?>
<div class="condecoraciones-create">


    <?= $this->render('_form', [
        'model' => $model,
        'cuadro'=>$cuadro,
    ]) ?>

</div>
