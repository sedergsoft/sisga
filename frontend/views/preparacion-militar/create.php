<?php

use yii\helpers\Html;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model frontend\models\PreparacionMilitar */



$this->title = Yii::t('app', 'Agregar preparación militar de : {name}', [
    'name' => ucwords($cuadro->personaCI0->Nombre).' '.ucwords($cuadro->personaCI0->primer_apellido).' '.ucwords($cuadro->personaCI0->segundo_apellido),]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuadros'), 'url' => ['cuadro/index']];
$this->params['breadcrumbs'][] = ['label' => 'NI :'.($cuadro->personaCI0->CI), 'url' => ['cuadro/view', 'id' => $cuadro->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Agrear preparación militar');
$this->params['tittle'][] = $this->title;
?>
<div class="preparacion-militar-create">

    <?php if(Yii::$app->session->hasFlash("mensaje")):?>
        <?php 
           //Mensaje para mostrar cuando se ha insertado correctamente. Nota: Se puede utilizar otras clasificaciones como:
           //alert-success ; alert-warning ;  alert-danger
           echo Alert::widget(['options' => ['class' => $style], 'body' => $mensaje]);
        ?>
    <?php endif; ?>
    
    
    <?= $this->render('_form', [
        'model' => $model,
        'cuadro' => $cuadro,
    ]) ?>

</div>
