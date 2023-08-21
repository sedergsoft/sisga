<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoIngresos */

$this->title = Yii::t('app', 'Agregar Tipo de Ingresos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo de Ingresos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="tipo-ingresos-create">

   
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
