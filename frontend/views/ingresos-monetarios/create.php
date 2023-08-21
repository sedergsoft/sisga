<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\IngresosMonetarios */

$this->title = Yii::t('app', 'Agregar Ingresos Monetarios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ingresos Monetarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="ingresos-monetarios-create">

       <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
