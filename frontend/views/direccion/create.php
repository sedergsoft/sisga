<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Direccion */

$this->title = Yii::t('app', 'Crear Dirección');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dirección'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['tittle'][]= $this->title;
?>
<div class="direccion-create">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
