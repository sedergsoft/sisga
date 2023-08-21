<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EstanciaExterior */

$this->title = Yii::t('app', 'Editar extancia en el exterior de : {name}', [
    'name' => ucwords($model->cuadro->personaCI0->Nombre).' '.ucwords($model->cuadro->personaCI0->primer_apellido).' '.ucwords($model->cuadro->personaCI0->segundo_apellido),]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadros'), 'url' => ['cuadro/index']];
$this->params['breadcrumbs'][] = ['label' => 'NI :'.($cuadro->personaCI0->CI), 'url' => ['cuadro/view', 'id' => $model->cuadro->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar Estancia');
$this->params['tittle'][] = $this->title;
?>
<div class="estancia-exterior-update">

    <?= $this->render('_form', [
        'model' => $model,
        
    ]) ?>

</div>
