<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TipoReserva */

$this->title = Yii::t('app', 'Create Tipo Reserva');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Reservas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-reserva-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
