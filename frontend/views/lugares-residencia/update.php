<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\LugaresResidencia */


$this->title = Yii::t('app', 'Editar Lugar de  recidencias de : {name}', [
    'name' => ucwords($cuadro->personaCI0->Nombre).' '.ucwords($cuadro->personaCI0->primer_apellido).' '.ucwords($cuadro->personaCI0->segundo_apellido),]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadros'), 'url' => ['cuadro/index']];
$this->params['breadcrumbs'][] = ['label' => 'NI :'.($cuadro->personaCI0->CI), 'url' => ['cuadro/view', 'id' => $cuadro->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar recidencia');
$this->params['tittle'][] = $this->title;
?>
<div class="lugares-residencia-update">


    <?= $this->render('_form', [
        'model' => $model,
            'cuadro'=>$cuadro,
            'modelDireResidencia'=>$modelDireResidencia,
       ]) ?>

</div>
