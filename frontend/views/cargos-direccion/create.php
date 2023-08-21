<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CargosDireccion */

$this->title = Yii::t('app', 'Crear Cargos de Direccion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cargos de Direccion'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][] = $this->title;
?>
<div class="cargos-direccion-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
