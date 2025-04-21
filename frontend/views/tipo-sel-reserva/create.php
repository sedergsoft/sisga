<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoSelReserva */

$this->title = Yii::t('app', 'Create Tipo Sel Reserva');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Sel Reservas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-sel-reserva-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
